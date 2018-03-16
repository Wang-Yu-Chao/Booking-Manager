<?php
defined('_JEXEC') or die;

/**
 * Order Controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_bookingmanager
 * @since       0.0.9
 */
class BookingManagerControllerOrder extends JControllerForm
{
	public function save($key = null, $urlVar = null)
	{
		$context    = 'bookingmanager.list.site.bookingmanager';
		$roomIds    = JFactory::getApplication()->getUserStateFromRequest($context . '.roomIds', 'roomIds', array(), 'ARRAY');
		$model      = $this->getModel('Order', 'BookingManagerModel', array('ignore_request' => true));
		$model->save($roomIds);
		$this->setRedirect(JRoute::_('index.php?option=com_bookingmanager', false), "Personal Info Saved");
	}
}