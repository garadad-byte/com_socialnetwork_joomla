<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkControllerCommunities extends JControllerLegacy
{
    public function display($cachable = false, $urlparams = [])
    {
        parent::display($cachable, $urlparams);
    }

    public function add()
    {
        JSession::checkToken() or jexit('Invalid token');

        $input = JFactory::getApplication()->input;
        $model = $this->getModel('Communities');
        $data = [
            'title' => $input->getString('title', ''),
            'description' => $input->getString('description', ''),
            'visibility' => $input->getInt('visibility', 1),
        ];

        if ($model->createCommunity($data)) {
            $this->setRedirect('index.php?option=com_socialnetwork&view=communities', 'Community created successfully.');
            return;
        }

        $this->setRedirect('index.php?option=com_socialnetwork&view=communities', 'Unable to create community.', 'error');
    }
}
