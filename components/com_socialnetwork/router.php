<?php
declare(strict_types=1);

defined('_JEXEC') or die;

class SocialnetworkRouter implements Joomla\CMS\Router\RouterInterface
{
	public function build(&$query)
	{
		$segments = [];

		if (!empty($query['view'])) {
			$segments[] = $query['view'];
			unset($query['view']);
		}

		if (!empty($query['id'])) {
			$segments[] = $query['id'];
			unset($query['id']);
		}

		return $segments;
	}

	public function parse(&$segments)
	{
		$vars = [];

		if (isset($segments[0])) {
			$vars['view'] = $segments[0];
		}

		if (isset($segments[1])) {
			$vars['id'] = $segments[1];
		}

		return $vars;
	}
}
