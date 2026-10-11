<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkControllerAjax extends JControllerLegacy
{
    public function follow()
    {
        $app = JFactory::getApplication();
        $user = JFactory::getUser();

        if (!$user->id) {
            echo json_encode(['status' => 'error', 'message' => 'Login required']);
            $app->close();
        }

        JSession::checkToken('post') or jexit('Invalid token');

        $input = $app->input;
        $targetId = (int) $input->getInt('target_id', 0);

        if ($targetId <= 0 || $targetId === (int) $user->id) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid target user']);
            $app->close();
        }

        $db = JFactory::getDbo();
        $existsQuery = $db->getQuery(true)
            ->select('COUNT(*)')
            ->from($db->quoteName('#__socialnetwork_relationships'))
            ->where($db->quoteName('user_id') . ' = ' . (int) $user->id)
            ->where($db->quoteName('target_user_id') . ' = ' . (int) $targetId)
            ->where($db->quoteName('relation') . ' = ' . $db->quote('follow'));

        $db->setQuery($existsQuery);
        $exists = (int) $db->loadResult();

        if ($exists > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Already following', 'action' => 'noop']);
            $app->close();
        }

        $obj = new stdClass();
        $obj->user_id = (int) $user->id;
        $obj->target_user_id = (int) $targetId;
        $obj->relation = 'follow';
        $obj->status = 'active';
        $obj->created_at = gmdate('Y-m-d H:i:s');

        $db->insertObject('#__socialnetwork_relationships', $obj, 'id');

        echo json_encode(['status' => 'success', 'message' => 'Followed successfully', 'action' => 'followed']);
        $app->close();
    }
}
