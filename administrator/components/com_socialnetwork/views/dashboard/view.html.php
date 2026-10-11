<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Language\Text;

class SocialnetworkViewDashboard extends HtmlView
{
	public function display($tpl = null)
	{
		$this->stats = $this->get('Stats');
		ToolbarHelper::title(Text::_('COM_SOCIALNETWORK_DASHBOARD'), 'users');
		ToolbarHelper::preferences('com_socialnetwork');
		parent::display($tpl);
	}
}
