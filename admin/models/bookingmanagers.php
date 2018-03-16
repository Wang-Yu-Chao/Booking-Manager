<?php
defined('_JEXEC') or die;

/**
 * BookingManagerList Model
 *
 * @since  0.0.1
 */
class BookingManagerModelBookingManagers extends JModelList
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
				'roomId',
				'roomNumber',
				'state',
				'published'
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

		$query->select('r.roomId as roomId, r.roomNumber as roomNumber, r.state as state, r.published as published')
			->from($db->quoteName('#__rooms', 'r'));

		$query->select('c.title as category_title')
			->join('LEFT', $db->quoteName('#__categories', 'c') . ' ON c.id = r.catid');

		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$like = $db->quote('%' . $search . '%');
			$query->where('r.roomNumber LIKE ' . $like);
		}

		$published = $this->getState('filter.published');

		if (is_numeric($published))
		{
			$query->where('r.published = ' . (int) $published);
		}
		elseif ($published == '')
		{
			$query->where('(r.published IN (0, 1))');
		}

		$orderCol   = $this->state->get('list.ordering', 'roomNumber');
		$orderDirn  = $this->state->get('list.direction', 'asc');

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

		return $query;
	}
}