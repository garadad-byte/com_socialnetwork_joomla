<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkControllerPost extends JControllerLegacy
{
    public function add()
    {
        JSession::checkToken() or jexit('Invalid token');

        $app = JFactory::getApplication();
        $input = $app->input;

        $model = $this->getModel('Feed');
        $postId = $model->addPost([
            'content' => $input->getString('content', ''),
            'link_url' => $input->getString('link_url', ''),
            'visibility' => $input->getString('visibility', 'public'),
        ]);

        if ($postId > 0) {
            $this->setRedirect('index.php?option=com_socialnetwork&view=feed', 'Post published.');
            return;
        }

        $this->setRedirect('index.php?option=com_socialnetwork&view=feed', 'Unable to publish post.', 'error');
    }
}
