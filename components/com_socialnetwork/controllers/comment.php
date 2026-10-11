<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkControllerComment extends JControllerLegacy
{
    public function add()
    {
        JSession::checkToken() or jexit('Invalid token');

        $app = JFactory::getApplication();
        $input = $app->input;

        $model = $this->getModel('Feed');
        $saved = $model->addComment([
            'entity_type' => $input->getString('entity_type', 'post'),
            'entity_id' => $input->getInt('entity_id', 0),
            'content' => $input->getString('content', ''),
            'parent_id' => $input->getInt('parent_id', 0),
        ]);

        if ($saved) {
            $this->setRedirect('index.php?option=com_socialnetwork&view=feed', 'Comment added.');
            return;
        }

        $this->setRedirect('index.php?option=com_socialnetwork&view=feed', 'Unable to add comment.', 'error');
    }
}
