<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkModelEvents extends JModelLegacy
{
    public function getItems(): array
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('e.*, u.name AS owner_name')
            ->from($db->quoteName('#__socialnetwork_events', 'e'))
            ->leftJoin($db->quoteName('#__users', 'u') . ' ON ' . $db->quoteName('u.id') . ' = ' . $db->quoteName('e.owner_id'))
            ->where($db->quoteName('e.state') . ' = 1')
            ->order($db->quoteName('e.start_at') . ' ASC');

        $db->setQuery($query);
        return $db->loadObjectList() ?: [];
    }

    public function create(array $data): bool
    {
        $user = JFactory::getUser();
        if (!$user->id) {
            return false;
        }

        $title = trim((string) ($data['title'] ?? ''));
        $description = trim((string) ($data['description'] ?? ''));
        if ($title === '') {
            return false;
        }

        $db = $this->getDbo();
        $row = new stdClass();
        $row->owner_id = (int) $user->id;
        $row->title = $title;
        $row->description = $description;
        $row->location = trim((string) ($data['location'] ?? ''));
        $row->start_at = isset($data['start_at']) ? (string) $data['start_at'] : gmdate('Y-m-d H:i:s');
        $row->end_at = isset($data['end_at']) ? (string) $data['end_at'] : gmdate('Y-m-d H:i:s', time() + 3600);
        $row->visibility = isset($data['visibility']) ? (string) $data['visibility'] : 'public';
        $row->state = 1;
        $row->created_at = gmdate('Y-m-d H:i:s');

        return (bool) $db->insertObject('#__socialnetwork_events', $row, 'id');
    }

    public function attend(int $eventId, string $status = 'going'): bool
    {
        $user = JFactory::getUser();
        if (!$user->id || $eventId <= 0) {
            return false;
        }

        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('COUNT(*)')
            ->from($db->quoteName('#__socialnetwork_event_members'))
            ->where($db->quoteName('event_id') . ' = ' . (int) $eventId)
            ->where($db->quoteName('user_id') . ' = ' . (int) $user->id);

        $db->setQuery($query);
        if ((int) $db->loadResult() > 0) {
            $update = $db->getQuery(true)
                ->update($db->quoteName('#__socialnetwork_event_members'))
                ->set($db->quoteName('status') . ' = ' . $db->quote($status))
                ->where($db->quoteName('event_id') . ' = ' . (int) $eventId)
                ->where($db->quoteName('user_id') . ' = ' . (int) $user->id);
            $db->setQuery($update);
            return $db->execute();
        }

        $row = new stdClass();
        $row->event_id = $eventId;
        $row->user_id = (int) $user->id;
        $row->status = $status;
        $row->created_at = gmdate('Y-m-d H:i:s');

        return (bool) $db->insertObject('#__socialnetwork_event_members', $row, 'id');
    }
}
