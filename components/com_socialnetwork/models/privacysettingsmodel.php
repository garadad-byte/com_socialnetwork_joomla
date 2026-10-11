<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkModelPrivacySettings extends JModelLegacy
{
    public function getSettings(): object
    {
        $user = JFactory::getUser();
        if (!$user->id) {
            return (object) [
                'id' => 0,
                'user_id' => 0,
                'profile_visibility' => 'public',
                'feed_visibility' => 'followers',
                'messages_visibility' => 'friends',
                'events_visibility' => 'public',
            ];
        }

        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__socialnetwork_privacy_settings'))
            ->where($db->quoteName('user_id') . ' = ' . (int) $user->id)
            ->where($db->quoteName('state') . ' = 1');

        $db->setQuery($query, 0, 1);
        $settings = $db->loadObject();

        if ($settings) {
            return $settings;
        }

        return (object) [
            'id' => 0,
            'user_id' => (int) $user->id,
            'profile_visibility' => 'public',
            'feed_visibility' => 'followers',
            'messages_visibility' => 'friends',
            'events_visibility' => 'public',
        ];
    }

    public function saveSettings(array $data): bool
    {
        $user = JFactory::getUser();
        if (!$user->id) {
            return false;
        }

        $db = $this->getDbo();
        $settings = $this->getSettings();

        $row = new stdClass();
        $row->user_id = (int) $user->id;
        $row->profile_visibility = in_array((string) ($data['profile_visibility'] ?? 'public'), ['public', 'followers', 'circles', 'private'], true)
            ? (string) $data['profile_visibility']
            : 'public';
        $row->feed_visibility = in_array((string) ($data['feed_visibility'] ?? 'followers'), ['public', 'followers', 'circles', 'private'], true)
            ? (string) $data['feed_visibility']
            : 'followers';
        $row->messages_visibility = in_array((string) ($data['messages_visibility'] ?? 'friends'), ['public', 'friends', 'circles', 'private'], true)
            ? (string) $data['messages_visibility']
            : 'friends';
        $row->events_visibility = in_array((string) ($data['events_visibility'] ?? 'public'), ['public', 'members', 'private'], true)
            ? (string) $data['events_visibility']
            : 'public';
        $row->state = 1;
        $row->created_at = gmdate('Y-m-d H:i:s');

        if (!empty($settings->id)) {
            $row->id = (int) $settings->id;
            return (bool) $db->updateObject('#__socialnetwork_privacy_settings', $row, 'id');
        }

        return (bool) $db->insertObject('#__socialnetwork_privacy_settings', $row, 'id');
    }
}
