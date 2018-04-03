<?php
namespace Joomla\Component\BookingManager\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Factory;

/**
 * BookingManager Model
 *
 * @since  0.0.1
 */
class CustomerModel extends AdminModel
{
	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  \JTable  A \JTable object
	 *
	 * @since   1.6
	 */
	public function getTable($type = 'Customer', $prefix = 'Administrator', $config = array())
	{
		return \JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  mixed    A JForm object on success, false on failure
	 *
	 * @since   1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm(
			'com_bookingmanager.Customer',
			'Customer',
			array(
				'control' => 'jform',
				'load_data' => $loadData
			)
		);

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed  The data for the form.
	 *
	 * @since   1.6
	 */
	protected function loadFormData()
	{
		$data = Factory::getApplication()->getUserState(
			'com_bookingmanager.edit.Customer.data',
			array()
		);

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}

	/**
	 * Method to check if it's OK to delete a room.
	 *
	 * Overrides JModelAdmin::canDelete
	 */
	protected function canDelete($record)
	{
		if(!empty($record->id))
		{
			return Factory::getUser()->authorise("core.delete", "com_bookingmanager.Customer." . $record->id);
		}
	}
}