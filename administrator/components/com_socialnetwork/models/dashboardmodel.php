<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

class SocialnetworkModelDashboard extends ListModel
{
	public function getStats(): array
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true);

		$queries = [
			'profiles' => 'SELECT COUNT(*) FROM #__socialnetwork_profiles',
			'circles' => 'SELECT COUNT(*) FROM #__socialnetwork_circles',
			'communities' => 'SELECT COUNT(*) FROM #__socialnetwork_communities',
			'posts' => 'SELECT COUNT(*) FROM #__socialnetwork_posts',
			'notifications' => 'SELECT COUNT(*) FROM #__socialnetwork_notifications',
			'events' => 'SELECT COUNT(*) FROM #__socialnetwork_events',
		];

		$stats = [];
		foreach ($queries as $key => $sql) {
			$db->setQuery($sql);
			$stats[$key] = (int) $db->loadResult();
		}

		return $stats;
	}
}
