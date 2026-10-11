<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkControllerAjax extends JControllerLegacy
{
    public function preview()
    {
        $app = JFactory::getApplication();
        $input = $app->input;
        $url = $input->getString('url', '');

        $model = $this->getModel('Media');
        $meta = $model->parseLinkMetadata($url);

        echo json_encode([
            'status' => 'success',
            'title' => $meta['title'],
            'description' => $meta['description'],
            'image' => $meta['image'],
        ]);
        $app->close();
    }
}
