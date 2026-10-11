<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
?>
<div class="socialnetwork-grid">
    <h2><?php echo Text::_('COM_SOCIALNETWORK_REPORTS'); ?></h2>
    <?php if (!empty($this->items)) : ?>
        <?php foreach ($this->items as $item) : ?>
            <div class="socialnetwork-card">
                <strong><?php echo htmlspecialchars((string) $item->entity_type, ENT_QUOTES, 'UTF-8'); ?></strong>
                <p><?php echo htmlspecialchars((string) $item->reason, ENT_QUOTES, 'UTF-8'); ?></p>
                <small><?php echo htmlspecialchars((string) $item->status, ENT_QUOTES, 'UTF-8'); ?></small>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p><?php echo Text::_('COM_SOCIALNETWORK_NO_REPORTS'); ?></p>
    <?php endif; ?>
</div>
