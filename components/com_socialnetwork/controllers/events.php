<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkControllerEvents extends JControllerLegacy
{
    public function display($cachable = false, $urlparams = [])
    {
        parent::display($cachable, $urlparams);
    }

    public function add()
    {
        JSession::checkToken() or jexit('Invalid token');

        $app = JFactory::getApplication();
        $input = $app->input;
        $model = $this->getModel('Events');

        $saved = $model->create([
            'title' => $input->getString('title', ''),
            'description' => $input->getString('description', ''),
            'location' => $input->getString('location', ''),
            'start_at' => $input->getString('start_at', ''),
            'end_at' => $input->getString('end_at', ''),
            'visibility' => $input->getString('visibility', 'public'),
        ]);

        if ($saved) {
            $this->setRedirect('index.php?option=com_socialnetwork&view=events', 'Event created.');
            return;
        }

        $this->setRedirect('index.php?option=com_socialnetwork&view=events', 'Unable to create event.', 'error');
    }
}
