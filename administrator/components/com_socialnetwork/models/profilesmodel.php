<?php
declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

class SocialnetworkModelProfiles extends ListModel
{
	public function getItems()
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true)
			->select('*')
			->from($db->quoteName('#__socialnetwork_profiles'))
			->order($db->quoteName('created_at') . ' DESC');

		$db->setQuery($query);
		return $db->loadObjectList();
	}
}
