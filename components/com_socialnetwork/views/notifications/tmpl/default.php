<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
?>
<div class="socialnetwork-grid">
    <h2><?php echo Text::_('COM_SOCIALNETWORK_NOTIFICATIONS'); ?></h2>
    <?php if (!empty($this->items)) : ?>
        <?php foreach ($this->items as $item) : ?>
            <div class="socialnetwork-card notification-item">
                <strong><?php echo htmlspecialchars((string) $item->type, ENT_QUOTES, 'UTF-8'); ?></strong>
                <p><?php echo htmlspecialchars((string) $item->message, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php if (!empty($item->link)) : ?>
                    <a href="<?php echo htmlspecialchars((string) $item->link, ENT_QUOTES, 'UTF-8'); ?>"><?php echo Text::_('COM_SOCIALNETWORK_VIEW'); ?></a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p><?php echo Text::_('COM_SOCIALNETWORK_NO_NOTIFICATIONS'); ?></p>
    <?php endif; ?>
</div>
