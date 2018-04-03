<?php
namespace Joomla\Component\BookingManager\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;

/**
 * Orders Model
 *
 * @since  0.0.1
 */
class OrdersModel extends ListModel
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see     JController
	 * @since   1.6
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id',
				'roomNumber',
				'name',
				'date'
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return      string  An SQL query
	 */
	protected function getListQuery()
	{
		$db    = Factory::getDbo();
		$query = $db->getQuery(true);

		$query->select('o.id as id, o.roomId as roomId, o.customerId as customerId, o.date as date')
			->from($db->quoteName('#__orders', 'o'));

		$query->select($db->quoteName('r.roomNumber', 'roomNumber'))
			->join('LEFT', $db->quoteName('#__rooms', 'r') . ' ON r.id = o.roomId');

		$query->select($db->quoteName('c.name', 'name'))
			->join('LEFT', $db->quoteName('#__customers', 'c') . ' ON c.id = o.customerId');

		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$like = $db->quote('%' . $search . '%');
			$query->where('roomNumber LIKE ' . $like);
		}

		$orderCol   = $this->state->get('list.ordering', 'date');
		$orderDirn  = $this->state->get('list.direction', 'asc');

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

		return $query;
	}
}