<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkViewMessages extends JViewLegacy
{
    public function display($tpl = null)
    {
        $model = $this->getModel();
        $this->threads = $model->getThreads();
        parent::display($tpl);
    }
}
