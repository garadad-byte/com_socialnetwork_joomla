<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkViewMedia extends JViewLegacy
{
    public function display($tpl = null)
    {
        $input = JFactory::getApplication()->input;
        $entityType = $input->getString('entity_type', 'post');
        $entityId = $input->getInt('entity_id', 0);

        $model = $this->getModel();
        $this->items = $model->getItems($entityId, $entityType);
        parent::display($tpl);
    }
}
