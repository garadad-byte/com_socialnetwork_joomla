<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;

$app = Factory::getApplication();
$input = $app->input;
$viewName = $input->getCmd('view', 'feed');

if (empty($viewName)) {
    $viewName = 'feed';
}

$controller = BaseController::getInstance('Socialnetwork');
$controller->execute($input->getCmd('task', 'display'));
$controller->redirect();
