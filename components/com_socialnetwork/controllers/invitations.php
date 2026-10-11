<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkControllerInvitations extends JControllerLegacy
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
        $model = $this->getModel('Invitations');

        $saved = $model->sendInvitation(
            $input->getInt('to_user_id', 0),
            $input->getString('type', 'circle'),
            $input->getInt('entity_id', 0)
        );

        if ($saved) {
            $this->setRedirect('index.php?option=com_socialnetwork&view=invitations', 'Invitation sent.');
            return;
        }

        $this->setRedirect('index.php?option=com_socialnetwork&view=invitations', 'Unable to send invitation.', 'error');
    }

    public function respond()
    {
        JSession::checkToken() or jexit('Invalid token');

        $app = JFactory::getApplication();
        $input = $app->input;
        $model = $this->getModel('Invitations');

        $saved = $model->respond($input->getInt('invitation_id', 0), $input->getString('status', 'declined'));

        if ($saved) {
            $this->setRedirect('index.php?option=com_socialnetwork&view=invitations', 'Invitation updated.');
            return;
        }

        $this->setRedirect('index.php?option=com_socialnetwork&view=invitations', 'Unable to update invitation.', 'error');
    }
}
