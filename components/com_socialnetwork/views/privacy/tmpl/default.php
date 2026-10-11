<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
?>
<div class="socialnetwork-grid">
    <h2><?php echo Text::_('COM_SOCIALNETWORK_PRIVACY_SETTINGS'); ?></h2>
    <form method="post" action="index.php?option=com_socialnetwork&task=privacy.save" class="socialnetwork-card">
        <?php echo JHtml::_('form.token'); ?>
        <div class="form-group">
            <label><?php echo Text::_('COM_SOCIALNETWORK_PROFILE_VISIBILITY'); ?></label>
            <select name="profile_visibility" class="form-control">
                <option value="public" <?php echo ($this->settings->profile_visibility === 'public') ? 'selected' : ''; ?>>Public</option>
                <option value="followers" <?php echo ($this->settings->profile_visibility === 'followers') ? 'selected' : ''; ?>>Followers</option>
                <option value="circles" <?php echo ($this->settings->profile_visibility === 'circles') ? 'selected' : ''; ?>>Circles</option>
                <option value="private" <?php echo ($this->settings->profile_visibility === 'private') ? 'selected' : ''; ?>>Only me</option>
            </select>
        </div>
        <div class="form-group">
            <label><?php echo Text::_('COM_SOCIALNETWORK_FEED_VISIBILITY'); ?></label>
            <select name="feed_visibility" class="form-control">
                <option value="public" <?php echo ($this->settings->feed_visibility === 'public') ? 'selected' : ''; ?>>Public</option>
                <option value="followers" <?php echo ($this->settings->feed_visibility === 'followers') ? 'selected' : ''; ?>>Followers</option>
                <option value="circles" <?php echo ($this->settings->feed_visibility === 'circles') ? 'selected' : ''; ?>>Circles</option>
                <option value="private" <?php echo ($this->settings->feed_visibility === 'private') ? 'selected' : ''; ?>>Only me</option>
            </select>
        </div>
        <div class="form-group">
            <label><?php echo Text::_('COM_SOCIALNETWORK_MESSAGES_VISIBILITY'); ?></label>
            <select name="messages_visibility" class="form-control">
                <option value="friends" <?php echo ($this->settings->messages_visibility === 'friends') ? 'selected' : ''; ?>>Friends</option>
                <option value="circles" <?php echo ($this->settings->messages_visibility === 'circles') ? 'selected' : ''; ?>>Circles</option>
                <option value="private" <?php echo ($this->settings->messages_visibility === 'private') ? 'selected' : ''; ?>>Only me</option>
            </select>
        </div>
        <div class="form-group">
            <label><?php echo Text::_('COM_SOCIALNETWORK_EVENTS_VISIBILITY'); ?></label>
            <select name="events_visibility" class="form-control">
                <option value="public" <?php echo ($this->settings->events_visibility === 'public') ? 'selected' : ''; ?>>Public</option>
                <option value="members" <?php echo ($this->settings->events_visibility === 'members') ? 'selected' : ''; ?>>Members</option>
                <option value="private" <?php echo ($this->settings->events_visibility === 'private') ? 'selected' : ''; ?>>Only me</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo Text::_('COM_SOCIALNETWORK_SAVE'); ?></button>
    </form>
</div>
