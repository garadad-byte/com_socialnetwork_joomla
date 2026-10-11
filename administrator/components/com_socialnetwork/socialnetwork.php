<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\ToolbarHelper;

$input = Factory::getApplication()->input;
$view = $input->getString('view', 'dashboard');

if (!file_exists(__DIR__ . '/views/' . $view)) {
	$view = 'dashboard';
}

if ($view === 'dashboard') {
	ToolbarHelper::title(Text::_('COM_SOCIALNETWORK'), 'users');
	ToolbarHelper::preferences('com_socialnetwork');
}

require_once __DIR__ . '/views/' . $view . '/view.html.php';
