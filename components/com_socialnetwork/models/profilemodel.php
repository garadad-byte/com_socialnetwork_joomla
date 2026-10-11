<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkModelProfile extends JModelLegacy
{
    public function getProfile($userId = null)
    {
        $user = JFactory::getUser();
        $targetUserId = (int) ($userId ?: $user->id);

        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('p.*')
            ->from($db->quoteName('#__socialnetwork_profiles', 'p'))
            ->where($db->quoteName('p.user_id') . ' = ' . (int) $targetUserId)
            ->where($db->quoteName('p.state') . ' = 1');

        $db->setQuery($query, 0, 1);
        $profile = $db->loadObject();

        if (!$profile) {
            $profile = (object) [
                'id' => 0,
                'user_id' => $targetUserId,
                'display_name' => $user->name ?: 'User',
                'tagline' => 'Member of the network',
                'bio' => 'Profile created from Joomla user account.',
                'avatar' => '',
                'cover' => '',
                'location' => '',
                'website' => '',
                'privacy' => 1,
                'state' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        return $profile;
    }

    public function getRelationships($userId = null)
    {
        $user = JFactory::getUser();
        $targetUserId = (int) ($userId ?: $user->id);

        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__socialnetwork_relationships'))
            ->where($db->quoteName('user_id') . ' = ' . (int) $targetUserId)
            ->where($db->quoteName('status') . ' = ' . $db->quote('active'));

        $db->setQuery($query);

        return $db->loadObjectList() ?: [];
    }
}
