<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkModelSearch extends JModelLegacy
{
    public function search(string $query): array
    {
        $search = trim($query);
        if ($search === '') {
            return ['posts' => [], 'users' => [], 'communities' => [], 'circles' => []];
        }

        $db = $this->getDbo();
        $like = $db->quote('%' . str_replace(['%', '_'], ['\\%', '\\_'], $search) . '%');

        $posts = $db->getQuery(true)
            ->select('p.*, u.name AS author_name')
            ->from($db->quoteName('#__socialnetwork_posts', 'p'))
            ->leftJoin($db->quoteName('#__users', 'u') . ' ON ' . $db->quoteName('u.id') . ' = ' . $db->quoteName('p.author_id'))
            ->where($db->quoteName('p.content') . ' LIKE ' . $like)
            ->where($db->quoteName('p.state') . ' = 1');

        $users = $db->getQuery(true)
            ->select('u.id, u.name, p.display_name')
            ->from($db->quoteName('#__users', 'u'))
            ->leftJoin($db->quoteName('#__socialnetwork_profiles', 'p') . ' ON ' . $db->quoteName('p.user_id') . ' = ' . $db->quoteName('u.id'))
            ->where('(' . $db->quoteName('u.name') . ' LIKE ' . $like . ' OR ' . $db->quoteName('p.display_name') . ' LIKE ' . $like . ')');

        $communities = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__socialnetwork_communities'))
            ->where($db->quoteName('title') . ' LIKE ' . $like . ' OR ' . $db->quoteName('description') . ' LIKE ' . $like)
            ->where($db->quoteName('state') . ' = 1');

        $circles = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__socialnetwork_circles'))
            ->where($db->quoteName('title') . ' LIKE ' . $like . ' OR ' . $db->quoteName('description') . ' LIKE ' . $like)
            ->where($db->quoteName('state') . ' = 1');

        $db->setQuery($posts);
        $results = [
            'posts' => $db->loadObjectList() ?: [],
            'users' => [],
            'communities' => [],
            'circles' => [],
        ];

        $db->setQuery($users);
        $results['users'] = $db->loadObjectList() ?: [];

        $db->setQuery($communities);
        $results['communities'] = $db->loadObjectList() ?: [];

        $db->setQuery($circles);
        $results['circles'] = $db->loadObjectList() ?: [];

        return $results;
    }
}
