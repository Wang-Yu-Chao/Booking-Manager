<?php
namespace Joomla\Component\BookingManager\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;

/**
 * Room Model
 *
 * @since  0.0.1
 */
class RoomModel extends ListModel
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
		$db    = Factory::getDbo();
		$query = $db->getQuery(true);

		$query->select('*')
			->from($db->quoteName('#__rooms'))
			->where('published = 1');

		return $query;
	}

	public function save($ids)
	{
		$db = Factory::getDbo();
		foreach ($ids as $id)
		{
			$query  = $db->getQuery(true);
			$query->update('#__rooms')->set($db->quoteName('state') . ' = 1')->where($db->quoteName('id') . ' = ' . $id);
			$db->setQuery($query);
			$result = $db->execute();
		}

		return true;
	}
}