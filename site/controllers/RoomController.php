<?php
namespace Joomla\Component\BookingManager\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Factory;

/**
 * BookingManager Controller
 *
 * @package     Joomla.Site
 * @subpackage  com_bookingmanager
 *
 * Used to handle the http POST from the front-end form which allows users to reserve rooms
 *
 */
class RoomController extends FormController
{
	public function save($key = NULL, $urlVar = NULL)
	{
		$app        = Factory::getApplication();
		$context    = "room.list.site.room";
		$input      = $app->input;
		$ids    = $input->get('cid', array(), 'ARRAY');
		if (empty($ids))
		{
			$this->setRedirect(\JRoute::_('index.php?option=com_bookingmanager', false), "Please select a room.");
			$this->redirect();
		}
		$app->setUserState($context . '.ids', $ids);
		$this->setRedirect(\JRoute::_('index.php?option=com_bookingmanager&view=Customer&layout=edit', false));
	}
}