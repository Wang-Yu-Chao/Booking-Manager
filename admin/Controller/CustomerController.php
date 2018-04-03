<?php
namespace Joomla\Component\BookingManager\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Factory;

/**
 * CustomerEditor Controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_bookingmanager
 * @since       0.0.9
 */
class CustomerController extends FormController
{
	public function save($key = null, $urlVar = null)
	{
		parent::save($key, $urlVar);
		$this->setRedirect(\JRoute::_('index.php?option=com_bookingmanager&view=Customers', false), "Record saved");
	}

	public function cancel($key = null)
	{
		parent::cancel($key);
		$this->setRedirect(\JRoute::_('index.php?option=com_bookingmanager&view=Customers', false), 'Operation canceled');
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
	protected function allowEdit($data = array(), $key = 'id')
	{
		$id = isset($data[$key]) ? $data[$key] : 0;
		if(!empty($id))
		{
			return Factory::getUser()->authorise("core.edit", "com_bookingmanager.Customer." . $id);
		}
	}
}