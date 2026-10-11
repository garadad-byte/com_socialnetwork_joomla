<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

class SocialnetworkHelper
{
	public static function getActions(): Joomla\CMS\Object\CMSObject
	{
		$user = Factory::getUser();
		$assetName = 'com_socialnetwork';

		$actions = new Joomla\CMS\Object\CMSObject;
		$actions->set('core.manage', $user->authorise('core.manage', $assetName));
		$actions->set('core.create', $user->authorise('core.create', $assetName));
		$actions->set('core.edit', $user->authorise('core.edit', $assetName));
		$actions->set('core.edit.state', $user->authorise('core.edit.state', $assetName));
		$actions->set('core.delete', $user->authorise('core.delete', $assetName));

		return $actions;
	}

	public static function getDefaultMenu(): array
	{
		return [
			['label' => Text::_('COM_SOCIALNETWORK_DASHBOARD'), 'link' => 'index.php?option=com_socialnetwork&view=dashboard'],
			['label' => Text::_('COM_SOCIALNETWORK_PROFILES'), 'link' => 'index.php?option=com_socialnetwork&view=profiles'],
			['label' => Text::_('COM_SOCIALNETWORK_CIRCLES'), 'link' => 'index.php?option=com_socialnetwork&view=circles'],
			['label' => Text::_('COM_SOCIALNETWORK_COMMUNITIES'), 'link' => 'index.php?option=com_socialnetwork&view=communities'],
			['label' => Text::_('COM_SOCIALNETWORK_POSTS'), 'link' => 'index.php?option=com_socialnetwork&view=posts'],
			['label' => Text::_('COM_SOCIALNETWORK_EVENTS'), 'link' => 'index.php?option=com_socialnetwork&view=events'],
			['label' => Text::_('COM_SOCIALNETWORK_REPORTS'), 'link' => 'index.php?option=com_socialnetwork&view=reports'],
		];
	}
}
