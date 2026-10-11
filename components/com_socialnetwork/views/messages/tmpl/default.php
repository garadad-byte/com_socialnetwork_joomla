<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
?>
<div class="socialnetwork-grid">
    <h2><?php echo Text::_('COM_SOCIALNETWORK_MESSAGES'); ?></h2>

    <form method="post" action="index.php?option=com_socialnetwork&task=messages.send" class="socialnetwork-card">
        <?php echo JHtml::_('form.token'); ?>
        <div class="form-group">
            <input type="number" name="to_user_id" class="form-control" placeholder="User ID" required>
        </div>
        <div class="form-group">
            <textarea name="message" class="form-control" rows="3" placeholder="Type your message" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo Text::_('COM_SOCIALNETWORK_SEND'); ?></button>
    </form>

    <?php if (!empty($this->threads)) : ?>
        <?php foreach ($this->threads as $thread) : ?>
            <div class="socialnetwork-card">
                <strong>Peer: <?php echo (int) $thread['peer_id']; ?></strong>
                <?php foreach ($thread['messages'] as $message) : ?>
                    <div class="message-item">
                        <small><?php echo htmlspecialchars((string) $message->created_at, ENT_QUOTES, 'UTF-8'); ?></small>
                        <p><?php echo htmlspecialchars((string) $message->message, ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p><?php echo Text::_('COM_SOCIALNETWORK_NO_MESSAGES'); ?></p>
    <?php endif; ?>
</div>
