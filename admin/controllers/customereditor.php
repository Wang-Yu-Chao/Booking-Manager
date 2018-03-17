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
	protected function allowEdit($data = array(), $key = 'customerId')
	{
		$id = isset($data[$key]) ? $data[$key] : 0;
		if(!empty($id))
		{
			return JFactory::getUser()->authorise("core.edit", "com_bookingmanager.customers." . $id);
		}
	}
}