<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

$app = Factory::getApplication();
$input = $app->input;
$view = $input->getCmd('view', 'feed');

require_once __DIR__ . '/views/' . $view . '/view.html.php';
