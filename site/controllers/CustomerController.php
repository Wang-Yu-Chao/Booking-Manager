<?php
namespace Joomla\Component\BookingManager\Site\Controller;

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
		$validate = parent::save($key, $urlVar);

		if ($validate)
		{
			$app        = Factory::getApplication();
			$context    = 'room.list.site.room';
			$ids    = Factory::getApplication()->getUserStateFromRequest($context . '.ids', 'ids', array(), 'ARRAY');
			$model      = $this->getModel('BookingManager', 'BookingManagerModel', array('ignore_request' => true));
			$model->save($ids);
			$data   = $app->getUserStateFromRequest('jform', 'jform', 'ARRAY');
			$app->setUserState($context . 'data', $data);
			$this->setRedirect(\JRoute::_('index.php?option=com_bookingmanager&task=order.save', false));
		}
		return $validate;
	}

	public function cancel($key = null)
	{
		parent::cancel($key);
		$this->setRedirect(\JRoute::_('index.php?option=com_bookingmanager', false), 'Operation canceled');
	}
}