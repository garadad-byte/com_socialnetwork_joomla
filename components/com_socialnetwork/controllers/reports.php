<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkControllerReports extends JControllerLegacy
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
        $model = $this->getModel('Reports');

        $saved = $model->addReport([
            'entity_type' => $input->getString('entity_type', ''),
            'entity_id' => $input->getInt('entity_id', 0),
            'reason' => $input->getString('reason', ''),
        ]);

        if ($saved) {
            $this->setRedirect('index.php?option=com_socialnetwork&view=feed', 'Report submitted.');
            return;
        }

        $this->setRedirect('index.php?option=com_socialnetwork&view=feed', 'Unable to submit report.', 'error');
    }
}
