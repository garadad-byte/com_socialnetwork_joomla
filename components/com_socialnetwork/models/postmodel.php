<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkModelPost extends JModelLegacy
{
    public function create(array $data): int
    {
        $feedModel = new SocialnetworkModelFeed();
        return $feedModel->addPost($data);
    }
}
