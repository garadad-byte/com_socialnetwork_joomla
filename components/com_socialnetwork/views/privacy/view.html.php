<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkViewPrivacy extends JViewLegacy
{
    public function display($tpl = null)
    {
        $model = $this->getModel();
        $this->settings = $model->getSettings();
        parent::display($tpl);
    }
}
