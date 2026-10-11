<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkHelper
{
    public static function getSiteNavigation(): array
    {
        return [
            ['link' => 'index.php?option=com_socialnetwork&view=feed', 'label' => 'Feed'],
            ['link' => 'index.php?option=com_socialnetwork&view=profile', 'label' => 'Profile'],
            ['link' => 'index.php?option=com_socialnetwork&view=circles', 'label' => 'Circles'],
            ['link' => 'index.php?option=com_socialnetwork&view=communities', 'label' => 'Communities'],
            ['link' => 'index.php?option=com_socialnetwork&view=events', 'label' => 'Events'],
            ['link' => 'index.php?option=com_socialnetwork&view=messages', 'label' => 'Messages'],
            ['link' => 'index.php?option=com_socialnetwork&view=notifications', 'label' => 'Notifications'],
            ['link' => 'index.php?option=com_socialnetwork&view=privacy', 'label' => 'Privacy'],
            ['link' => 'index.php?option=com_socialnetwork&view=invitations', 'label' => 'Invitations'],
            ['link' => 'index.php?option=com_socialnetwork&view=media', 'label' => 'Media'],
            ['link' => 'index.php?option=com_socialnetwork&view=search', 'label' => 'Search'],
        ];
    }
}
