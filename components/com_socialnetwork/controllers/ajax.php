<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkControllerAjax extends JControllerLegacy
{
    public function post()
    {
        $app = JFactory::getApplication();
        $input = $app->input;

        JSession::checkToken() or jexit('Invalid token');

        $model = $this->getModel('Feed');
        $postId = $model->addPost([
            'content' => $input->getString('content', ''),
            'link_url' => $input->getString('link_url', ''),
            'visibility' => $input->getString('visibility', 'public'),
        ]);

        echo json_encode([
            'status' => $postId > 0 ? 'success' : 'error',
            'post_id' => $postId,
            'message' => $postId > 0 ? 'Published.' : 'Unable to publish.',
        ]);
        $app->close();
    }

    public function comment()
    {
        $app = JFactory::getApplication();
        $input = $app->input;

        JSession::checkToken() or jexit('Invalid token');

        $model = $this->getModel('Feed');
        $saved = $model->addComment([
            'entity_type' => $input->getString('entity_type', 'post'),
            'entity_id' => $input->getInt('entity_id', 0),
            'content' => $input->getString('content', ''),
        ]);

        echo json_encode([
            'status' => $saved ? 'success' : 'error',
            'message' => $saved ? 'Comment added.' : 'Unable to add comment.',
        ]);
        $app->close();
    }

    public function reaction()
    {
        $app = JFactory::getApplication();
        $input = $app->input;

        JSession::checkToken() or jexit('Invalid token');

        $model = $this->getModel('Feed');
        $saved = $model->addReaction([
            'entity_type' => $input->getString('entity_type', 'post'),
            'entity_id' => $input->getInt('entity_id', 0),
            'reaction' => $input->getString('reaction', 'plusone'),
        ]);

        echo json_encode([
            'status' => $saved ? 'success' : 'error',
            'count' => $saved ? $model->countReactions($input->getString('entity_type', 'post'), $input->getInt('entity_id', 0)) : 0,
            'message' => $saved ? 'Reaction saved.' : 'Reaction not saved.',
        ]);
        $app->close();
    }

    public function follow()
    {
        $app = JFactory::getApplication();
        $user = JFactory::getUser();

        if (!$user->id) {
            echo json_encode(['status' => 'error', 'message' => 'Login required']);
            $app->close();
        }

        JSession::checkToken() or jexit('Invalid token');

        $input = $app->input;
        $targetId = $input->getInt('target_id', 0);

        if ($targetId <= 0 || $targetId === (int) $user->id) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid target user']);
            $app->close();
        }

        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('COUNT(*)')
            ->from($db->quoteName('#__socialnetwork_relationships'))
            ->where($db->quoteName('user_id') . ' = ' . (int) $user->id)
            ->where($db->quoteName('target_user_id') . ' = ' . (int) $targetId)
            ->where($db->quoteName('relation') . ' = ' . $db->quote('follow'));

        $db->setQuery($query);
        if ((int) $db->loadResult() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Already following', 'action' => 'noop']);
            $app->close();
        }

        $row = new stdClass();
        $row->user_id = (int) $user->id;
        $row->target_user_id = (int) $targetId;
        $row->relation = 'follow';
        $row->status = 'active';
        $row->created_at = gmdate('Y-m-d H:i:s');
        $db->insertObject('#__socialnetwork_relationships', $row, 'id');

        echo json_encode(['status' => 'success', 'message' => 'Followed successfully', 'action' => 'followed']);
        $app->close();
    }
}
