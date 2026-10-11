<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkControllerBlocks extends JControllerLegacy
{
    public function add()
    {
        JSession::checkToken() or jexit('Invalid token');

        $app = JFactory::getApplication();
        $input = $app->input;
        $model = $this->getModel('Blocks');

        $saved = $model->blockUser($input->getInt('blocked_user_id', 0), $input->getString('reason', ''));

        if ($saved) {
            $this->setRedirect('index.php?option=com_socialnetwork&view=profile', 'User blocked.');
            return;
        }

        $this->setRedirect('index.php?option=com_socialnetwork&view=profile', 'Unable to block user.', 'error');
    }
}
