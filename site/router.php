<?php
defined('_JEXEC') or die;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Component\Router\RouterViewConfiguration;
use Joomla\CMS\Component\Router\Rules\MenuRules;
use Joomla\CMS\Component\Router\Rules\NomenuRules;
use Joomla\CMS\Component\Router\Rules\StandardRules;

/**
 * Routing class from com_bookingmanager
 *
 * @since  0.0.1
 */
class BookingManagerRouter extends RouterView
{
	protected $noIDs = false;

	/**
	 * Search Component router constructor
	 *
	 * @param   CMSApplication  $app   The application object
	 * @param   AbstractMenu    $menu  The menu object to work with
	 */
	public function __construct($app = null, $menu = null)
	{
		$params      = ComponentHelper::getParams('com_bookingmanager');
		$this->noIDs = (bool) $params->get('sef_ids');
		$room = new RouterViewConfiguration('room');
		$room->setKey('id');
		$this->registerView($room);
		$customer  = new RouterViewConfiguration('customer');
		$customer->setKey('id');
		$this->registerView($customer);

		parent::__construct($app, $menu);

		$this->attachRule(new StandardRules($this));
		$this->attachRule(new NomenuRules($this));
	}
}