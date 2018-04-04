<?php
namespace Joomla\Component\BookingManager\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;

/**
 * Order Model
 *
 * @since  0.0.1
 */
class OrderModel extends AdminModel
{
	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $name    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $options  Configuration array for model. Optional.
	 *
	 * @return  \JTable  A \JTable object
	 *
	 * @since   0.0.1
	 */
	public function getTable($name = 'Order', $prefix = 'Site', $options = array())
	{
		$table = parent::getTable($name, $prefix, $options);
		return $table;
	}

	/**
	 * Method to get the record form.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  mixed    A JForm object on success, false on failure
	 *
	 * @since   0.0.1
	 */
	public function getForm($data = array(), $loadData = true)
	{
	}

	/**
	 * Method to save the form data.
	 *
	 * @param   array  $data  The form data.
	 *
	 * @return  boolean  True on success, False on error.
	 *
	 * @since   0.0.1
	 */
	public function save($data)
	{
		$db     = Factory::getDbo();
		$query  = $db->getQuery(true);
		$query->select('id')
			->from($db->quoteName('#__customers'))
			->where($db->quoteName('name') . ' = ' . $db->quote($data['name']));

		$db->setQuery($query);
		$customerId = $db->loadColumn();

		if (!empty($customerId))
		{
			foreach ($data['roomIds'] as $roomId)
			{
				$query = $db->getQuery(true);
				$query->insert('#__orders')->columns('roomId, customerId')
					->values($db->quote($roomId) . ', ' . $db->quote($customerId[0]));
				$db->setQuery($query);
				$db->execute();
			}

			return true;
		}

		return false;
	}
}