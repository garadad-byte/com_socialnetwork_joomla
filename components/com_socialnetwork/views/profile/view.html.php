<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkViewProfile extends JViewLegacy
{
    public function display($tpl = null)
    {
        $model = $this->getModel();
        $this->profile = $model->getProfile();
        $this->relationships = $model->getRelationships();

        parent::display($tpl);
    }
}
