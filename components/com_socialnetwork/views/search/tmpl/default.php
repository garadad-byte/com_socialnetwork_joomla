<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
?>
<div class="socialnetwork-grid">
    <h2><?php echo Text::_('COM_SOCIALNETWORK_SEARCH'); ?></h2>
    <form method="get" action="index.php" class="socialnetwork-card">
        <input type="hidden" name="option" value="com_socialnetwork" />
        <input type="hidden" name="view" value="search" />
        <input type="text" name="q" class="form-control" value="<?php echo htmlspecialchars((string) $this->query, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Search users, posts, communities, circles">
        <button type="submit" class="btn btn-primary"><?php echo Text::_('COM_SOCIALNETWORK_SEARCH'); ?></button>
    </form>

    <?php if ($this->query !== '') : ?>
        <div class="socialnetwork-card">
            <h3><?php echo Text::_('COM_SOCIALNETWORK_POSTS'); ?></h3>
            <?php if (!empty($this->results['posts'])) : ?>
                <?php foreach ($this->results['posts'] as $post) : ?>
                    <p><?php echo htmlspecialchars((string) $post->content, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endforeach; ?>
            <?php else : ?>
                <p><?php echo Text::_('COM_SOCIALNETWORK_NO_RESULTS'); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
