<?php
defined('_JEXEC') or die;

/**
 * Orders Controller
 *
 * @since  0.0.1
 */
class BookingManagerControllerOrders extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  object  The model.
	 *
	 * @since   1.6
	 */
	public function getModel($name = 'Order', $prefix = 'BookingManagerModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}
}