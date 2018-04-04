<?php
namespace Joomla\Component\BookingManager\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\AdminController;

/**
 * BookingManagers Controller
 *
 * @since  0.0.1
 */
class RoomsController extends AdminController
{
	/**
	 * The URL view list variable.
	 *
	 * @var    string
	 *
	 * @since  0.0.1
	 */
	protected $view_list = 'rooms';

	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  object  The model.
	 *
	 * @since   0.0.1
	 */
	public function getModel($name = 'Room', $prefix = 'Administrator', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}
}