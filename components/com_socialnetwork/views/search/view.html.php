<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkViewSearch extends JViewLegacy
{
    public function display($tpl = null)
    {
        $input = JFactory::getApplication()->input;
        $q = $input->getString('q', '');
        $model = $this->getModel();
        $this->results = $model->search($q);
        $this->query = $q;
        parent::display($tpl);
    }
}
