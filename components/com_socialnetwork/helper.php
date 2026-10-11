<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

class SocialnetworkHelper
{
	public static function getSiteNavigation(): array
	{
		return [
			['link' => 'index.php?option=com_socialnetwork&view=feed', 'label' => Text::_('COM_SOCIALNETWORK_FEED')],
			['link' => 'index.php?option=com_socialnetwork&view=profile', 'label' => Text::_('COM_SOCIALNETWORK_PROFILE')],
			['link' => 'index.php?option=com_socialnetwork&view=communities', 'label' => Text::_('COM_SOCIALNETWORK_COMMUNITIES')],
			['link' => 'index.php?option=com_socialnetwork&view=circles', 'label' => Text::_('COM_SOCIALNETWORK_CIRCLES')],
			['link' => 'index.php?option=com_socialnetwork&view=messages', 'label' => Text::_('COM_SOCIALNETWORK_MESSAGES')],
			['link' => 'index.php?option=com_socialnetwork&view=events', 'label' => Text::_('COM_SOCIALNETWORK_EVENTS')],
		];
	}
}
