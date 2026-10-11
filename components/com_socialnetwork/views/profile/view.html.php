<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

class SocialnetworkViewProfile extends Joomla\CMS\MVC\View\HtmlView
{
	public function display($tpl = null)
	{
		$this->title = Text::_('COM_SOCIALNETWORK_PROFILE');
		parent::display($tpl);
	}
}
