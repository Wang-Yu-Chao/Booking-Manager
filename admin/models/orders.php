<?php
defined('_JEXEC') or die('Restricted access');

/**
 * Orders Model
 *
 * @since  0.0.1
 */
class BookingManagerModelOrders extends JModelList
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
				'orderId',
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
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('o.orderId as orderId, o.roomId as roomId, o.customerId as customerId, o.date as date')
			->from($db->quoteName('#__orders', 'o'));

		$query->select($db->quoteName('r.roomNumber', 'roomNumber'))
			->join('LEFT', $db->quoteName('#__rooms', 'r') . ' ON r.roomId = o.roomId');

		$query->select($db->quoteName('c.name', 'name'))
			->join('LEFT', $db->quoteName('#__customers', 'c') . ' ON c.customerId = o.customerId');

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