<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView;

class SocialnetworkViewFeed extends HtmlView
{
	public function display($tpl = null)
	{
		$this->items = $this->get('Items');
		$this->setLayout('default');
		parent::display($tpl);
	}
}
