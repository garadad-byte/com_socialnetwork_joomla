<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkControllerPrivacy extends JControllerLegacy
{
    public function display($cachable = false, $urlparams = [])
    {
        parent::display($cachable, $urlparams);
    }

    public function save()
    {
        JSession::checkToken() or jexit('Invalid token');

        $app = JFactory::getApplication();
        $input = $app->input;
        $model = $this->getModel('PrivacySettings');

        $saved = $model->saveSettings([
            'profile_visibility' => $input->getString('profile_visibility', 'public'),
            'feed_visibility' => $input->getString('feed_visibility', 'followers'),
            'messages_visibility' => $input->getString('messages_visibility', 'friends'),
            'events_visibility' => $input->getString('events_visibility', 'public'),
        ]);

        if ($saved) {
            $this->setRedirect('index.php?option=com_socialnetwork&view=privacy', 'Privacy settings saved.');
            return;
        }

        $this->setRedirect('index.php?option=com_socialnetwork&view=privacy', 'Unable to save privacy settings.', 'error');
    }
}
