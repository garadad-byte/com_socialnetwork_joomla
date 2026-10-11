<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
?>
<div class="com-socialnetwork-profiles">
	<h2><?php echo Text::_('COM_SOCIALNETWORK_PROFILES'); ?></h2>
	<?php if (!empty($this->items)) : ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>User ID</th>
					<th>Display name</th>
					<th>Created</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($this->items as $item) : ?>
				<tr>
					<td><?php echo (int) $item->id; ?></td>
					<td><?php echo (int) $item->user_id; ?></td>
					<td><?php echo htmlspecialchars((string) $item->display_name, ENT_QUOTES, 'UTF-8'); ?></td>
					<td><?php echo htmlspecialchars((string) $item->created_at, ENT_QUOTES, 'UTF-8'); ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	<?php else : ?>
		<p><?php echo Text::_('COM_SOCIALNETWORK_NO_ITEMS'); ?></p>
	<?php endif; ?>
</div>
