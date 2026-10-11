<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkModelFeed extends JModelLegacy
{
    public function getItems(): array
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('p.*, u.name AS author_name')
            ->from($db->quoteName('#__socialnetwork_posts', 'p'))
            ->leftJoin($db->quoteName('#__users', 'u') . ' ON ' . $db->quoteName('u.id') . ' = ' . $db->quoteName('p.author_id'))
            ->where($db->quoteName('p.state') . ' = 1')
            ->order($db->quoteName('p.created_at') . ' DESC');

        $db->setQuery($query, 0, 20);
        $posts = $db->loadObjectList() ?: [];

        foreach ($posts as $post) {
            $post->comments = $this->getComments('post', (int) $post->id);
            $post->plusones = $this->countReactions('post', (int) $post->id);
            $post->hashtags = $this->extractHashtags((string) ($post->content ?? ''));
        }

        return $posts;
    }

    public function addPost(array $data): int
    {
        $user = JFactory::getUser();
        if (!$user->id) {
            return 0;
        }

        $content = trim((string) ($data['content'] ?? ''));
        if ($content === '') {
            return 0;
        }

        $db = $this->getDbo();
        $table = new stdClass();
        $table->author_id = (int) $user->id;
        $table->author_name = $user->name ?: 'User';
        $table->content = $content;
        $table->link_url = isset($data['link_url']) ? trim((string) $data['link_url']) : '';
        $table->visibility = isset($data['visibility']) ? (string) $data['visibility'] : 'public';
        $table->circle_id = isset($data['circle_id']) ? (int) $data['circle_id'] : null;
        $table->community_id = isset($data['community_id']) ? (int) $data['community_id'] : null;
        $table->state = 1;
        $table->created_at = gmdate('Y-m-d H:i:s');
        $table->updated_at = gmdate('Y-m-d H:i:s');

        $db->insertObject('#__socialnetwork_posts', $table, 'id');
        $postId = (int) $db->insertid();

        if ($postId > 0) {
            $this->saveHashtags('post', $postId, $content);
        }

        return $postId;
    }

    public function addComment(array $data): bool
    {
        $user = JFactory::getUser();
        if (!$user->id) {
            return false;
        }

        $entityType = (string) ($data['entity_type'] ?? 'post');
        $entityId = (int) ($data['entity_id'] ?? 0);
        $content = trim((string) ($data['content'] ?? ''));

        if ($entityId <= 0 || $content === '') {
            return false;
        }

        $db = $this->getDbo();
        $table = new stdClass();
        $table->parent_id = isset($data['parent_id']) ? (int) $data['parent_id'] : null;
        $table->entity_type = $entityType;
        $table->entity_id = $entityId;
        $table->author_id = (int) $user->id;
        $table->content = $content;
        $table->state = 1;
        $table->created_at = gmdate('Y-m-d H:i:s');

        return (bool) $db->insertObject('#__socialnetwork_comments', $table, 'id');
    }

    public function addReaction(array $data): bool
    {
        $user = JFactory::getUser();
        if (!$user->id) {
            return false;
        }

        $entityType = (string) ($data['entity_type'] ?? 'post');
        $entityId = (int) ($data['entity_id'] ?? 0);
        $reaction = (string) ($data['reaction'] ?? 'plusone');

        if ($entityId <= 0) {
            return false;
        }

        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('COUNT(*)')
            ->from($db->quoteName('#__socialnetwork_reactions'))
            ->where($db->quoteName('entity_type') . ' = ' . $db->quote($entityType))
            ->where($db->quoteName('entity_id') . ' = ' . (int) $entityId)
            ->where($db->quoteName('user_id') . ' = ' . (int) $user->id)
            ->where($db->quoteName('reaction') . ' = ' . $db->quote($reaction));

        $db->setQuery($query);
        if ((int) $db->loadResult() > 0) {
            return true;
        }

        $table = new stdClass();
        $table->entity_type = $entityType;
        $table->entity_id = $entityId;
        $table->user_id = (int) $user->id;
        $table->reaction = $reaction;
        $table->created_at = gmdate('Y-m-d H:i:s');

        return (bool) $db->insertObject('#__socialnetwork_reactions', $table, 'id');
    }

    public function getComments(string $entityType, int $entityId): array
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('c.*, u.name AS author_name')
            ->from($db->quoteName('#__socialnetwork_comments', 'c'))
            ->leftJoin($db->quoteName('#__users', 'u') . ' ON ' . $db->quoteName('u.id') . ' = ' . $db->quoteName('c.author_id'))
            ->where($db->quoteName('c.entity_type') . ' = ' . $db->quote($entityType))
            ->where($db->quoteName('c.entity_id') . ' = ' . (int) $entityId)
            ->where($db->quoteName('c.state') . ' = 1')
            ->order($db->quoteName('c.created_at') . ' ASC');

        $db->setQuery($query);
        return $db->loadObjectList() ?: [];
    }

    public function countReactions(string $entityType, int $entityId): int
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('COUNT(*)')
            ->from($db->quoteName('#__socialnetwork_reactions'))
            ->where($db->quoteName('entity_type') . ' = ' . $db->quote($entityType))
            ->where($db->quoteName('entity_id') . ' = ' . (int) $entityId)
            ->where($db->quoteName('reaction') . ' = ' . $db->quote('plusone'));

        $db->setQuery($query);
        return (int) $db->loadResult();
    }

    protected function extractHashtags(string $text): array
    {
        preg_match_all('/#([\w\x{0400}-\x{04FF}]+)/u', $text, $matches);
        return $matches[1] ?? [];
    }

    protected function saveHashtags(string $entityType, int $entityId, string $content): void
    {
        $db = $this->getDbo();
        $tags = $this->extractHashtags($content);

        foreach ($tags as $tag) {
            $tag = trim((string) $tag);
            if ($tag === '') {
                continue;
            }

            $tagQuery = $db->getQuery(true)
                ->select('id')
                ->from($db->quoteName('#__socialnetwork_hashtags'))
                ->where($db->quoteName('tag') . ' = ' . $db->quote($tag));

            $db->setQuery($tagQuery, 0, 1);
            $tagId = $db->loadResult();

            if (!$tagId) {
                $tagRow = new stdClass();
                $tagRow->tag = $tag;
                $tagRow->state = 1;
                $db->insertObject('#__socialnetwork_hashtags', $tagRow, 'id');
                $tagId = (int) $db->insertid();
            }

            if ($tagId > 0) {
                $map = new stdClass();
                $map->entity_type = $entityType;
                $map->entity_id = $entityId;
                $map->tag_id = $tagId;

                $db->insertObject('#__socialnetwork_hashtag_map', $map, 'id');
            }
        }
    }
}
