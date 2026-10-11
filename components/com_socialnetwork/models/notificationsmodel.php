<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkModelNotifications extends JModelLegacy
{
    public function getItems(): array
    {
        $user = JFactory::getUser();
        if (!$user->id) {
            return [];
        }

        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__socialnetwork_notifications'))
            ->where($db->quoteName('user_id') . ' = ' . (int) $user->id)
            ->where($db->quoteName('state') . ' = 1')
            ->order($db->quoteName('created_at') . ' DESC');

        $db->setQuery($query, 0, 50);
        return $db->loadObjectList() ?: [];
    }

    public function addNotification(int $userId, string $type, string $message, string $link = ''): bool
    {
        if ($userId <= 0 || $type === '' || $message === '') {
            return false;
        }

        $db = $this->getDbo();
        $row = new stdClass();
        $row->user_id = $userId;
        $row->type = $type;
        $row->message = $message;
        $row->link = $link;
        $row->read_flag = 0;
        $row->state = 1;
        $row->created_at = gmdate('Y-m-d H:i:s');

        return (bool) $db->insertObject('#__socialnetwork_notifications', $row, 'id');
    }

    public function markAsRead(int $id): bool
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->update($db->quoteName('#__socialnetwork_notifications'))
            ->set($db->quoteName('read_flag') . ' = 1')
            ->where($db->quoteName('id') . ' = ' . (int) $id);

        $db->setQuery($query);
        return $db->execute();
    }
}
