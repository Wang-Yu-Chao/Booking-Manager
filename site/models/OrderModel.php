<?php
namespace Joomla\Component\BookingManager\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;

/**
 * Order Model
 *
 * @since  0.0.1
 */
class OrderModel extends ListModel
{
	public function save($ids)
	{
		$context    = 'room.list.site.room';
		$data   = Factory::getApplication()->getUserStateFromRequest($context . 'data', 'data', 'ARRAY');
		$db     = Factory::getDbo();

		foreach ($ids as $id)
		{
			$query  = $db->getQuery(true);
			$query->select('id')
				->from($db->quoteName('#__customers'))
				->where($db->quoteName('name') . ' = ' . $db->quote($data['name']));

			$db->setQuery($query);
			$id = $db->loadColumn();

			if (!empty($id))
			{
				$query = $db->getQuery(true);
				$query->insert('#__orders')->columns('id, id')
					->values($db->quote($id) . ', ' . $db->quote($id[0]));
				$db->setQuery($query);
				$db->execute();
			}
		}


	}
}