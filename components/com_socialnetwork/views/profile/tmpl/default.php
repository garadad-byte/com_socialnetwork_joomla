<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
?>
<div class="socialnetwork-profile">
	<div class="profile-cover"></div>
	<div class="profile-header">
		<div class="avatar"></div>
		<div class="profile-meta">
			<h2><?php echo Text::_('COM_SOCIALNETWORK_PROFILE'); ?></h2>
			<p><?php echo Text::_('COM_SOCIALNETWORK_PROFILE_TAGLINE'); ?></p>
		</div>
	</div>
	<div class="profile-content">
		<p><?php echo Text::_('COM_SOCIALNETWORK_PROFILE_DESCRIPTION'); ?></p>
	</div>
</div>
