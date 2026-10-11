<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkControllerReaction extends JControllerLegacy
{
    public function add()
    {
        JSession::checkToken() or jexit('Invalid token');

        $app = JFactory::getApplication();
        $input = $app->input;

        $model = $this->getModel('Feed');
        $saved = $model->addReaction([
            'entity_type' => $input->getString('entity_type', 'post'),
            'entity_id' => $input->getInt('entity_id', 0),
            'reaction' => $input->getString('reaction', 'plusone'),
        ]);

        if ($saved) {
            $this->setRedirect('index.php?option=com_socialnetwork&view=feed', 'Reaction saved.');
            return;
        }

        $this->setRedirect('index.php?option=com_socialnetwork&view=feed', 'Unable to save reaction.', 'error');
    }
}
