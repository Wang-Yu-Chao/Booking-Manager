<?php
defined('_JEXEC') or die;

/**
 * CustomerEditor Controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_bookingmanager
 * @since       0.0.9
 */
class BookingManagerControllerCustomerEditor extends JControllerForm
{
	public function save($key = null, $urlVar = null)
	{
		parent::save($key, $urlVar);
		$this->setRedirect(JRoute::_('index.php?option=com_bookingmanager&view=customers', false), "Record saved");
	}

	public function cancel($key = null)
	{
		parent::cancel($key);
		$this->setRedirect(JRoute::_('index.php?option=com_bookingmanager&view=customers', false), 'Operation canceled');
	}
}