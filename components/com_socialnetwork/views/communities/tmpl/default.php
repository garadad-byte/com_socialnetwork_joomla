<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
?>
<div class="socialnetwork-grid socialnetwork-communities">
    <h2><?php echo Text::_('COM_SOCIALNETWORK_COMMUNITIES'); ?></h2>

    <form method="post" action="index.php?option=com_socialnetwork&task=communities.add">
        <?php echo JHtml::_('form.token'); ?>
        <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Community name" required>
        </div>
        <div class="form-group">
            <textarea name="description" class="form-control" rows="3" placeholder="Community summary"></textarea>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo Text::_('COM_SOCIALNETWORK_CREATE'); ?></button>
    </form>

    <?php if (!empty($this->items)) : ?>
        <?php foreach ($this->items as $item) : ?>
            <article class="socialnetwork-card">
                <h3><?php echo htmlspecialchars((string) $item->title, ENT_QUOTES, 'UTF-8'); ?></h3>
                <p><?php echo htmlspecialchars((string) $item->description, ENT_QUOTES, 'UTF-8'); ?></p>
            </article>
        <?php endforeach; ?>
    <?php else : ?>
        <p><?php echo Text::_('COM_SOCIALNETWORK_NO_ITEMS'); ?></p>
    <?php endif; ?>
</div>
