<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
?>
<div class="socialnetwork-feed">
    <div class="socialnetwork-composer">
        <h3><?php echo Text::_('COM_SOCIALNETWORK_SHARE_UPDATE'); ?></h3>
        <form method="post" action="index.php?option=com_socialnetwork&task=post.add" class="js-social-post-form">
            <?php echo JHtml::_('form.token'); ?>
            <textarea class="form-control" name="content" rows="4" placeholder="<?php echo Text::_('COM_SOCIALNETWORK_SHARE_PLACEHOLDER'); ?>" required></textarea>
            <input type="url" class="form-control" name="link_url" placeholder="Optional link URL" />
            <div class="socialnetwork-actions">
                <button type="submit" class="btn btn-primary"><?php echo Text::_('COM_SOCIALNETWORK_POST'); ?></button>
            </div>
        </form>
    </div>

    <?php if (!empty($this->items)) : ?>
        <?php foreach ($this->items as $item) : ?>
            <article class="socialnetwork-post-card" data-post-id="<?php echo (int) $item->id; ?>">
                <div class="post-header">
                    <strong><?php echo htmlspecialchars((string) ($item->author_name ?? 'User'), ENT_QUOTES, 'UTF-8'); ?></strong>
                    <span><?php echo htmlspecialchars((string) $item->created_at, ENT_QUOTES, 'UTF-8'); ?></span>
                </div>

                <div class="post-body">
                    <?php echo nl2br(htmlspecialchars((string) $item->content, ENT_QUOTES, 'UTF-8')); ?>
                    <?php if (!empty($item->link_url)) : ?>
                        <div class="link-preview">
                            <a href="<?php echo htmlspecialchars((string) $item->link_url, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
                                <?php echo htmlspecialchars((string) $item->link_url, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="post-footer">
                    <button type="button" class="btn btn-link js-reaction" data-entity-type="post" data-entity-id="<?php echo (int) $item->id; ?>" data-reaction="plusone">
                        +1 (<?php echo (int) $item->plusones; ?>)
                    </button>
                    <span><?php echo count($item->comments); ?> comments</span>
                </div>

                <div class="comment-list">
                    <?php foreach ($item->comments as $comment) : ?>
                        <div class="comment-item">
                            <strong><?php echo htmlspecialchars((string) ($comment->author_name ?? 'User'), ENT_QUOTES, 'UTF-8'); ?></strong>
                            <span><?php echo htmlspecialchars((string) $comment->content, ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <form method="post" action="index.php?option=com_socialnetwork&task=comment.add" class="js-comment-form">
                    <?php echo JHtml::_('form.token'); ?>
                    <input type="hidden" name="entity_type" value="post" />
                    <input type="hidden" name="entity_id" value="<?php echo (int) $item->id; ?>" />
                    <textarea class="form-control" name="content" rows="2" placeholder="Write a comment" required></textarea>
                    <button type="submit" class="btn btn-primary"><?php echo Text::_('COM_SOCIALNETWORK_COMMENT'); ?></button>
                </form>
            </article>
        <?php endforeach; ?>
    <?php else : ?>
        <p><?php echo Text::_('COM_SOCIALNETWORK_NO_POSTS'); ?></p>
    <?php endif; ?>
</div>
