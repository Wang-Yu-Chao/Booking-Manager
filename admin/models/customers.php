<?php
defined('_JEXEC') or die;

/**
 * BookingManagerList Model
 *
 * @since  0.0.1
 */
class BookingManagerModelCustomers extends JModelList
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
				'customerId',
				'name',
				'email'
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

		$query->select('*')
			->from($db->quoteName('#__customers'));

		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$like = $db->quote('%' . $search . '%');
			$query->where('name LIKE ' . $like);
		}

		$orderCol   = $this->state->get('list.ordering', 'name');
		$orderDirn  = $this->state->get('list.direction', 'asc');

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

		return $query;
	}
}