<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
?>
<div class="socialnetwork-grid">
    <h2><?php echo Text::_('COM_SOCIALNETWORK_MEDIA'); ?></h2>

    <form method="post" action="index.php?option=com_socialnetwork&task=media.upload" enctype="multipart/form-data" class="socialnetwork-card">
        <?php echo JHtml::_('form.token'); ?>
        <input type="hidden" name="entity_type" value="post" />
        <input type="hidden" name="entity_id" value="0" />
        <input type="file" name="media_file" class="form-control" accept="image/*" />
        <button type="submit" class="btn btn-primary"><?php echo Text::_('COM_SOCIALNETWORK_UPLOAD'); ?></button>
    </form>

    <?php if (!empty($this->items)) : ?>
        <?php foreach ($this->items as $item) : ?>
            <div class="socialnetwork-card">
                <img src="<?php echo JUri::root(true) . '/' . htmlspecialchars((string) $item->path, ENT_QUOTES, 'UTF-8'); ?>" alt="Upload" style="max-width:100%;border-radius:8px;" />
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p><?php echo Text::_('COM_SOCIALNETWORK_NO_MEDIA'); ?></p>
    <?php endif; ?>
</div>
