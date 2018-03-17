<?php
defined('_JEXEC') or die;

/**
 * BookingManager Controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_bookingmanager
 * @since       0.0.9
 */
class BookingManagerControllerBookingManager extends JControllerForm
{
	/**
	 * Implement to allowAdd or not
	 *
	 * Not used at this time (but you can look at how other components use it....)
	 * Overwrites: JControllerForm::allowAdd
	 *
	 * @param array $data
	 * @return bool
	 */
	protected function allowAdd($data = array())
	{
		return parent::allowAdd($data);
	}
	
	/**
	 * Implement to allow edit or not
	 * Overwrites: JControllerForm::allowEdit
	 *
	 * @param array $data
	 * @param string $key
	 *
	 * @return bool
	 */
	protected function allowEdit($data = array(), $key = 'roomId')
	{
		$id = isset($data[$key]) ? $data[$key] : 0;
		if(!empty($id))
		{
			return JFactory::getUser()->authorise("core.edit", "com_bookingmanager.bookingmanager." . $id);
		}
	}
}