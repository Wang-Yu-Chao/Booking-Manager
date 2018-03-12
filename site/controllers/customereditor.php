<?php
defined('_JEXEC') or die('Restricted access');

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
		$validate = parent::save($key, $urlVar);

		if ($validate)
		{
			$app        = JFactory::getApplication();
			$context    = 'bookingmanager.list.site.bookingmanager';
			$roomIds    = JFactory::getApplication()->getUserStateFromRequest($context . '.roomIds', 'roomIds', array(), 'ARRAY');
			$model      = $this->getModel('BookingManager', 'BookingManagerModel', array('ignore_request' => true));
			$model->save($roomIds);
			$data   = $app->getUserStateFromRequest('jform', 'jform', 'ARRAY');
			$app->setUserState($context . 'data', $data);
			$this->setRedirect(JRoute::_('index.php?option=com_bookingmanager&task=order.save', false));
		}
		return $validate;
	}

	public function cancel($key = null)
	{
		parent::cancel($key);
		$this->setRedirect(JRoute::_('index.php?option=com_bookingmanager', false), 'Operation canceled');
	}
}