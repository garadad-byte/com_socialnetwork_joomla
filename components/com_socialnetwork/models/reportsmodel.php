<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkModelReports extends JModelLegacy
{
    public function getItems(): array
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('r.*, u.name AS reporter_name')
            ->from($db->quoteName('#__socialnetwork_reports', 'r'))
            ->leftJoin($db->quoteName('#__users', 'u') . ' ON ' . $db->quoteName('u.id') . ' = ' . $db->quoteName('r.reporter_id'))
            ->order($db->quoteName('r.created_at') . ' DESC');

        $db->setQuery($query);
        return $db->loadObjectList() ?: [];
    }

    public function addReport(array $data): bool
    {
        $user = JFactory::getUser();
        if (!$user->id) {
            return false;
        }

        $entityType = trim((string) ($data['entity_type'] ?? ''));
        $entityId = (int) ($data['entity_id'] ?? 0);
        $reason = trim((string) ($data['reason'] ?? ''));

        if ($entityType === '' || $entityId <= 0 || $reason === '') {
            return false;
        }

        $db = $this->getDbo();
        $row = new stdClass();
        $row->reporter_id = (int) $user->id;
        $row->entity_type = $entityType;
        $row->entity_id = $entityId;
        $row->reason = $reason;
        $row->status = 'pending';
        $row->created_at = gmdate('Y-m-d H:i:s');

        return (bool) $db->insertObject('#__socialnetwork_reports', $row, 'id');
    }
}
