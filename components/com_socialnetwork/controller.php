<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;

class SocialnetworkController extends BaseController
{
    public function display($cachable = false, $urlparams = [])
    {
        $view = $this->input->getCmd('view', 'feed');
        $this->input->set('view', $view);

        return parent::display($cachable, $urlparams);
    }
}
