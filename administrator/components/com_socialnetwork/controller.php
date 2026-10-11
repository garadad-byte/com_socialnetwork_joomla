<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

class SocialnetworkController extends BaseController
{
	public function display($cachable = false, $urlparams = [])
	{
		$viewName = $this->input->getCmd('view', 'dashboard');
		$this->input->set('view', $viewName);

		return parent::display($cachable, $urlparams);
	}
}
