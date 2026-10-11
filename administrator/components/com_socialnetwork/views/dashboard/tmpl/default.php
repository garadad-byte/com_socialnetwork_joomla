<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$stats = $this->stats;
?>
<div class="com-socialnetwork-dashboard">
	<h2><?php echo Text::_('COM_SOCIALNETWORK_DASHBOARD'); ?></h2>
	<div class="row">
		<div class="col-md-2">
			<div class="card">
				<h4><?php echo Text::_('COM_SOCIALNETWORK_PROFILES'); ?></h4>
				<p><?php echo (int) $stats['profiles']; ?></p>
			</div>
		</div>
		<div class="col-md-2">
			<div class="card">
				<h4><?php echo Text::_('COM_SOCIALNETWORK_CIRCLES'); ?></h4>
				<p><?php echo (int) $stats['circles']; ?></p>
			</div>
		</div>
		<div class="col-md-2">
			<div class="card">
				<h4><?php echo Text::_('COM_SOCIALNETWORK_COMMUNITIES'); ?></h4>
				<p><?php echo (int) $stats['communities']; ?></p>
			</div>
		</div>
		<div class="col-md-2">
			<div class="card">
				<h4><?php echo Text::_('COM_SOCIALNETWORK_POSTS'); ?></h4>
				<p><?php echo (int) $stats['posts']; ?></p>
			</div>
		</div>
		<div class="col-md-2">
			<div class="card">
				<h4><?php echo Text::_('COM_SOCIALNETWORK_NOTIFICATIONS'); ?></h4>
				<p><?php echo (int) $stats['notifications']; ?></p>
			</div>
		</div>
		<div class="col-md-2">
			<div class="card">
				<h4><?php echo Text::_('COM_SOCIALNETWORK_EVENTS'); ?></h4>
				<p><?php echo (int) $stats['events']; ?></p>
			</div>
		</div>
	</div>
</div>
