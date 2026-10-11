<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkModelBlocks extends JModelLegacy
{
    public function getItems(): array
    {
        $user = JFactory::getUser();
        if (!$user->id) {
            return [];
        }

        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('b.*, u.name AS blocked_name')
            ->from($db->quoteName('#__socialnetwork_blocks', 'b'))
            ->leftJoin($db->quoteName('#__users', 'u') . ' ON ' . $db->quoteName('u.id') . ' = ' . $db->quoteName('b.blocked_user_id'))
            ->where($db->quoteName('b.user_id') . ' = ' . (int) $user->id)
            ->order($db->quoteName('b.created_at') . ' DESC');

        $db->setQuery($query);
        return $db->loadObjectList() ?: [];
    }

    public function blockUser(int $blockedUserId, string $reason = ''): bool
    {
        $user = JFactory::getUser();
        if (!$user->id || $blockedUserId <= 0 || $blockedUserId === (int) $user->id) {
            return false;
        }

        $db = $this->getDbo();
        $check = $db->getQuery(true)
            ->select('COUNT(*)')
            ->from($db->quoteName('#__socialnetwork_blocks'))
            ->where($db->quoteName('user_id') . ' = ' . (int) $user->id)
            ->where($db->quoteName('blocked_user_id') . ' = ' . (int) $blockedUserId);

        $db->setQuery($check);
        if ((int) $db->loadResult() > 0) {
            return true;
        }

        $row = new stdClass();
        $row->user_id = (int) $user->id;
        $row->blocked_user_id = (int) $blockedUserId;
        $row->reason = trim($reason);
        $row->created_at = gmdate('Y-m-d H:i:s');

        return (bool) $db->insertObject('#__socialnetwork_blocks', $row, 'id');
    }
}
