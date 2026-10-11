<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

class SocialnetworkModelFeed extends ListModel
{
	public function getItems(): array
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true)
			->select('*')
			->from($db->quoteName('#__socialnetwork_posts'))
			->where($db->quoteName('state') . ' = 1')
			->order($db->quoteName('created_at') . ' DESC');

		$db->setQuery($query, 0, 10);
		return (array) $db->loadObjectList();
	}
}
