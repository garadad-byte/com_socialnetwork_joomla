<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkViewNotifications extends JViewLegacy
{
    public function display($tpl = null)
    {
        $model = $this->getModel();
        $this->items = $model->getItems();
        parent::display($tpl);
    }
}
