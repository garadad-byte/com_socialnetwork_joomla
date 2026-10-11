<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkModelInvitations extends JModelLegacy
{
    public function getItems(): array
    {
        $user = JFactory::getUser();
        if (!$user->id) {
            return [];
        }

        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('i.*, u.name AS from_user_name')
            ->from($db->quoteName('#__socialnetwork_invitations', 'i'))
            ->leftJoin($db->quoteName('#__users', 'u') . ' ON ' . $db->quoteName('u.id') . ' = ' . $db->quoteName('i.from_user_id'))
            ->where($db->quoteName('i.to_user_id') . ' = ' . (int) $user->id)
            ->where($db->quoteName('i.status') . ' = ' . $db->quote('pending'))
            ->order($db->quoteName('i.created_at') . ' DESC');

        $db->setQuery($query);
        return $db->loadObjectList() ?: [];
    }

    public function sendInvitation(int $toUserId, string $type, int $entityId): bool
    {
        $user = JFactory::getUser();
        if (!$user->id || $toUserId <= 0 || $entityId <= 0 || trim($type) === '') {
            return false;
        }

        $db = $this->getDbo();
        $row = new stdClass();
        $row->type = $type;
        $row->entity_id = $entityId;
        $row->from_user_id = (int) $user->id;
        $row->to_user_id = $toUserId;
        $row->status = 'pending';
        $row->created_at = gmdate('Y-m-d H:i:s');

        return (bool) $db->insertObject('#__socialnetwork_invitations', $row, 'id');
    }

    public function respond(int $invitationId, string $status): bool
    {
        $user = JFactory::getUser();
        if (!$user->id || $invitationId <= 0) {
            return false;
        }

        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->update($db->quoteName('#__socialnetwork_invitations'))
            ->set($db->quoteName('status') . ' = ' . $db->quote(in_array($status, ['accepted', 'declined'], true) ? $status : 'declined'))
            ->where($db->quoteName('id') . ' = ' . (int) $invitationId)
            ->where($db->quoteName('to_user_id') . ' = ' . (int) $user->id);

        $db->setQuery($query);
        return $db->execute();
    }
}
