<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkModelMedia extends JModelLegacy
{
    public function getItems(int $entityId = 0, string $entityType = 'post'): array
    {
        if ($entityId <= 0) {
            return [];
        }

        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__socialnetwork_media'))
            ->where($db->quoteName('entity_type') . ' = ' . $db->quote($entityType))
            ->where($db->quoteName('entity_id') . ' = ' . (int) $entityId)
            ->where($db->quoteName('state') . ' = 1')
            ->order($db->quoteName('created_at') . ' DESC');

        $db->setQuery($query);
        return $db->loadObjectList() ?: [];
    }

    public function addUpload(array $data): bool
    {
        $user = JFactory::getUser();
        if (!$user->id || empty($data['filepath'])) {
            return false;
        }

        $db = $this->getDbo();
        $row = new stdClass();
        $row->user_id = (int) $user->id;
        $row->entity_type = (string) ($data['entity_type'] ?? 'post');
        $row->entity_id = (int) ($data['entity_id'] ?? 0);
        $row->filename = (string) basename((string) $data['filepath']);
        $row->path = (string) $data['filepath'];
        $row->mime = (string) ($data['mime'] ?? 'application/octet-stream');
        $row->size = (int) ($data['size'] ?? 0);
        $row->state = 1;
        $row->created_at = gmdate('Y-m-d H:i:s');

        return (bool) $db->insertObject('#__socialnetwork_media', $row, 'id');
    }

    public function parseLinkMetadata(string $url): array
    {
        $url = trim($url);
        if ($url === '' || !preg_match('#^https?://#i', $url)) {
            return ['title' => '', 'description' => '', 'image' => ''];
        }

        $html = @file_get_contents($url);
        if ($html === false || $html === '') {
            return ['title' => '', 'description' => '', 'image' => ''];
        }

        preg_match('/<title[^>]*>(.*?)<\/title>/is', $html, $titleMatches);
        preg_match('/<meta[^>]+property=["\']og:description["\'][^>]+content=["\']([^"\']+)["\']/is', $html, $descMatches);
        preg_match('/<meta[^>]+property=["\']og:image["\'][^>]+content=["\']([^"\']+)["\']/is', $html, $imgMatches);

        return [
            'title' => trim(html_entity_decode(strip_tags($titleMatches[1] ?? ''), ENT_QUOTES, 'UTF-8')),
            'description' => trim(html_entity_decode($descMatches[1] ?? '', ENT_QUOTES, 'UTF-8')),
            'image' => trim((string) ($imgMatches[1] ?? '')),
        ];
    }
}
