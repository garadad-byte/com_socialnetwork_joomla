<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkModelCommunities extends JModelLegacy
{
    public function getItems()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__socialnetwork_communities'))
            ->where($db->quoteName('state') . ' = 1')
            ->order($db->quoteName('created_at') . ' DESC');

        $db->setQuery($query);

        return $db->loadObjectList() ?: [];
    }

    public function createCommunity(array $data): bool
    {
        $user = JFactory::getUser();
        if (!$user->id) {
            return false;
        }

        $db = $this->getDbo();
        $table = new stdClass();
        $table->owner_id = (int) $user->id;
        $table->title = trim((string) ($data['title'] ?? ''));
        $table->description = trim((string) ($data['description'] ?? ''));
        $table->visibility = (int) ($data['visibility'] ?? 1);
        $table->state = 1;
        $table->created_at = gmdate('Y-m-d H:i:s');

        if ($table->title === '') {
            return false;
        }

        return (bool) $db->insertObject('#__socialnetwork_communities', $table, 'id');
    }
}
