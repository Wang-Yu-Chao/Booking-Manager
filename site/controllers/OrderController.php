<?php
namespace Joomla\Component\BookingManager\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Factory;

/**
 * Order Controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_bookingmanager
 * @since       0.0.9
 */
class OrderController extends FormController
{
	public function save($key = null, $urlVar = null)
	{
		$context    = 'room.list.site.room';
		$ids        = Factory::getApplication()->getUserStateFromRequest($context . '.ids', 'ids', array(), 'ARRAY');
		$model      = $this->getModel('Order', 'BookingManagerModel', array('ignore_request' => true));
		$model->save($ids);
		$this->setRedirect(\JRoute::_('index.php?option=com_bookingmanager', false), "Personal Info Saved");
	}
}