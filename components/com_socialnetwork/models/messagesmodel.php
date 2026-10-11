<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkModelMessages extends JModelLegacy
{
    public function getThreads(): array
    {
        $user = JFactory::getUser();
        if (!$user->id) {
            return [];
        }

        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('m.*')
            ->from($db->quoteName('#__socialnetwork_messages', 'm'))
            ->where('(' . $db->quoteName('m.from_user_id') . ' = ' . (int) $user->id . ' OR ' . $db->quoteName('m.to_user_id') . ' = ' . (int) $user->id . ')')
            ->where($db->quoteName('m.state') . ' = 1')
            ->order($db->quoteName('m.created_at') . ' DESC');

        $db->setQuery($query);
        $items = $db->loadObjectList() ?: [];

        $threads = [];
        foreach ($items as $item) {
            $peerId = (int) ($item->from_user_id === (int) $user->id ? $item->to_user_id : $item->from_user_id);
            $threads[$peerId]['messages'][] = $item;
            $threads[$peerId]['peer_id'] = $peerId;
        }

        return array_values($threads);
    }

    public function getConversation(int $peerId): array
    {
        $user = JFactory::getUser();
        if (!$user->id || $peerId <= 0) {
            return [];
        }

        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('m.*, u.name AS author_name')
            ->from($db->quoteName('#__socialnetwork_messages', 'm'))
            ->leftJoin($db->quoteName('#__users', 'u') . ' ON ' . $db->quoteName('u.id') . ' = ' . $db->quoteName('m.from_user_id'))
            ->where('(' . $db->quoteName('m.from_user_id') . ' = ' . (int) $user->id . ' AND ' . $db->quoteName('m.to_user_id') . ' = ' . (int) $peerId . ') OR (' . $db->quoteName('m.from_user_id') . ' = ' . (int) $peerId . ' AND ' . $db->quoteName('m.to_user_id') . ' = ' . (int) $user->id . '))')
            ->where($db->quoteName('m.state') . ' = 1')
            ->order($db->quoteName('m.created_at') . ' ASC');

        $db->setQuery($query);
        return $db->loadObjectList() ?: [];
    }

    public function sendMessage(int $peerId, string $message): bool
    {
        $user = JFactory::getUser();
        if (!$user->id || $peerId <= 0 || trim($message) === '') {
            return false;
        }

        $db = $this->getDbo();
        $row = new stdClass();
        $row->thread_id = md5((string) min((int) $user->id, $peerId) . '-' . max((int) $user->id, $peerId));
        $row->from_user_id = (int) $user->id;
        $row->to_user_id = (int) $peerId;
        $row->message = trim($message);
        $row->state = 1;
        $row->created_at = gmdate('Y-m-d H:i:s');

        return (bool) $db->insertObject('#__socialnetwork_messages', $row, 'id');
    }
}
