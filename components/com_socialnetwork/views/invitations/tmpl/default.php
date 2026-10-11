<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
?>
<div class="socialnetwork-grid">
    <h2><?php echo Text::_('COM_SOCIALNETWORK_INVITATIONS'); ?></h2>
    <?php if (!empty($this->items)) : ?>
        <?php foreach ($this->items as $item) : ?>
            <div class="socialnetwork-card">
                <p><strong><?php echo htmlspecialchars((string) $item->from_user_name, ENT_QUOTES, 'UTF-8'); ?></strong> invited you to <?php echo htmlspecialchars((string) $item->type, ENT_QUOTES, 'UTF-8'); ?></p>
                <form method="post" action="index.php?option=com_socialnetwork&task=invitations.respond">
                    <?php echo JHtml::_('form.token'); ?>
                    <input type="hidden" name="invitation_id" value="<?php echo (int) $item->id; ?>" />
                    <button type="submit" name="status" value="accepted" class="btn btn-primary"><?php echo Text::_('COM_SOCIALNETWORK_ACCEPT'); ?></button>
                    <button type="submit" name="status" value="declined" class="btn btn-default"><?php echo Text::_('COM_SOCIALNETWORK_DECLINE'); ?></button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p><?php echo Text::_('COM_SOCIALNETWORK_NO_INVITATIONS'); ?></p>
    <?php endif; ?>
</div>
