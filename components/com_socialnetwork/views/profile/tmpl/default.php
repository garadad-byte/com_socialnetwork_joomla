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
            <h2><?php echo htmlspecialchars((string) $this->profile->display_name, ENT_QUOTES, 'UTF-8'); ?></h2>
            <p><?php echo htmlspecialchars((string) $this->profile->tagline, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        <button type="button" class="btn btn-primary js-follow-user" data-target-id="<?php echo (int) $this->profile->user_id; ?>"><?php echo Text::_('COM_SOCIALNETWORK_FOLLOW'); ?></button>
    </div>
    <div class="profile-content">
        <p><?php echo nl2br(htmlspecialchars((string) $this->profile->bio, ENT_QUOTES, 'UTF-8')); ?></p>
        <ul>
            <li><?php echo Text::_('COM_SOCIALNETWORK_LOCATION'); ?>: <?php echo htmlspecialchars((string) $this->profile->location, ENT_QUOTES, 'UTF-8'); ?></li>
            <li><?php echo Text::_('COM_SOCIALNETWORK_WEBSITE'); ?>: <?php echo htmlspecialchars((string) $this->profile->website, ENT_QUOTES, 'UTF-8'); ?></li>
        </ul>
    </div>
</div>
