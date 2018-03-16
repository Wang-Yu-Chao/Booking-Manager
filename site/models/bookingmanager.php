<?php
defined('_JEXEC') or die;

/**
 * BookingManager Model
 *
 * @since  0.0.1
 */
class BookingManagerModelBookingManager extends JModelList
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

		$query->select('*')
			->from($db->quoteName('#__rooms'))
			->where('published = 1');

		return $query;
	}

	public function save($ids)
	{
		$db = JFactory::getDbo();
		foreach ($ids as $id)
		{
			$query  = $db->getQuery(true);
			$query->update('#__rooms')->set($db->quoteName('state') . ' = 1')->where($db->quoteName('roomId') . ' = ' . $id);
			$db->setQuery($query);
			$result = $db->execute();
		}
	}
}