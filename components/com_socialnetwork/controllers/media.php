<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkControllerMedia extends JControllerLegacy
{
    public function display($cachable = false, $urlparams = [])
    {
        parent::display($cachable, $urlparams);
    }

    public function upload()
    {
        JSession::checkToken() or jexit('Invalid token');

        $app = JFactory::getApplication();
        $input = $app->input;
        $files = $input->files->get('media_file', []);

        if (empty($files) || empty($files['name'])) {
            $this->setRedirect('index.php?option=com_socialnetwork&view=media', 'No file selected.', 'error');
            return;
        }

        $uploadDir = JPATH_SITE . '/media/com_socialnetwork/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filename = preg_replace('/[^A-Za-z0-9_.-]/', '-', $files['name']);
        $dest = $uploadDir . $filename;

        if (!move_uploaded_file($files['tmp_name'], $dest)) {
            $this->setRedirect('index.php?option=com_socialnetwork&view=media', 'Upload failed.', 'error');
            return;
        }

        $model = $this->getModel('Media');
        $saved = $model->addUpload([
            'filepath' => 'media/com_socialnetwork/uploads/' . $filename,
            'entity_type' => $input->getString('entity_type', 'post'),
            'entity_id' => $input->getInt('entity_id', 0),
            'mime' => $files['type'] ?? 'application/octet-stream',
            'size' => (int) $files['size'],
        ]);

        if ($saved) {
            $this->setRedirect('index.php?option=com_socialnetwork&view=media', 'Media uploaded.');
            return;
        }

        $this->setRedirect('index.php?option=com_socialnetwork&view=media', 'Unable to save upload metadata.', 'error');
    }
}
