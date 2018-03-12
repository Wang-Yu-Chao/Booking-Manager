<?php
defined('_JEXEC') or die('Restricted access');

/**
 * BookingManager Controller
 *
 * @package     Joomla.Site
 * @subpackage  com_bookingmanager
 *
 * Used to handle the http POST from the front-end form which allows users to reserve rooms
 *
 */
class BookingManagerControllerBookingManager extends JControllerForm
{
	public function save($key = NULL, $urlVar = NULL)
	{
		$app        = JFactory::getApplication();
		$context    = "bookingmanager.list.site.bookingmanager";
		$input      = $app->input;
		$roomIds    = $input->get('cid', array(), 'ARRAY');
		if (empty($roomIds))
		{
			$this->setRedirect(JRoute::_('index.php?option=com_bookingmanager', false), "Please select a room.");
			$this->redirect();
		}
		$app->setUserState($context . '.roomIds', $roomIds);
		$this->setRedirect(JRoute::_('index.php?option=com_bookingmanager&view=customereditor&layout=edit', false));
	}
}