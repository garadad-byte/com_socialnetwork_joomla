<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkControllerMessages extends JControllerLegacy
{
    public function display($cachable = false, $urlparams = [])
    {
        parent::display($cachable, $urlparams);
    }

    public function send()
    {
        JSession::checkToken() or jexit('Invalid token');

        $app = JFactory::getApplication();
        $input = $app->input;
        $peerId = $input->getInt('to_user_id', 0);
        $message = $input->getString('message', '');

        $model = $this->getModel('Messages');
        $saved = $model->sendMessage($peerId, $message);

        if ($saved) {
            $this->setRedirect('index.php?option=com_socialnetwork&view=messages', 'Message sent.');
            return;
        }

        $this->setRedirect('index.php?option=com_socialnetwork&view=messages', 'Unable to send message.', 'error');
    }
}
