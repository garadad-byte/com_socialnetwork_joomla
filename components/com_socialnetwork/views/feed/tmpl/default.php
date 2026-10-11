<?php
declare(strict_types=1);

use Joomla\CMS\Language\Text;

defined('_JEXEC') or die;
?>
<div class="socialnetwork-feed">
	<div class="socialnetwork-composer">
		<h3><?php echo Text::_('COM_SOCIALNETWORK_SHARE_UPDATE'); ?></h3>
		<textarea class="form-control" rows="4" placeholder="<?php echo Text::_('COM_SOCIALNETWORK_SHARE_PLACEHOLDER'); ?>"></textarea>
		<div class="socialnetwork-actions">
			<button class="btn btn-primary"><?php echo Text::_('COM_SOCIALNETWORK_POST'); ?></button>
		</div>
	</div>

	<?php if (!empty($this->items)) : ?>
		<?php foreach ($this->items as $item) : ?>
			<article class="socialnetwork-post-card">
				<div class="post-header">
					<strong><?php echo htmlspecialchars((string) $item->author_name ?? 'User', ENT_QUOTES, 'UTF-8'); ?></strong>
					<span><?php echo htmlspecialchars((string) $item->created_at, ENT_QUOTES, 'UTF-8'); ?></span>
				</div>
				<div class="post-body">
					<?php echo nl2br(htmlspecialchars((string) $item->content, ENT_QUOTES, 'UTF-8')); ?>
				</div>
				<div class="post-footer">
					<span>+1</span>
					<span>Comment</span>
					<span>Share</span>
				</div>
			</article>
		<?php endforeach; ?>
	<?php else : ?>
		<p><?php echo Text::_('COM_SOCIALNETWORK_NO_POSTS'); ?></p>
	<?php endif; ?>
</div>
