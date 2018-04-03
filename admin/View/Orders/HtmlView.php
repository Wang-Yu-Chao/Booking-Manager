<?php
namespace Joomla\Component\BookingManager\Administrator\View\Orders;

defined('_JEXEC') or die('Redirect access');

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\Component\BookingManager\Administrator\Helper\BookingManagerHelper;

/**
 * Orders View
 *
 * @since  0.0.1
 */
class HtmlView extends BaseHtmlView
{
	protected $canDo;

	/**
	 * Display the Orders views
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void | bool
	 *
	 * @since   0.0.1
	 */
	function display($tpl = null)
	{
		$app     = Factory::getApplication();
		$context = "room.list.admin.Orders";

		$this->items      = $this->get('Items');
		$this->pagination = $this->get('Pagination');

		$this->status           = $this->get('State');
		$this->filter_order     = $app->getUserStateFromRequest($context . '.filter_order', 'filter_order', 'date', 'cmd');
		$this->filter_order_Dir = $app->getUserStateFromRequest($context . '.filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
		$this->filterForm       = $this->get('filterForm');
		$this->activeFilters    = $this->get('ActiveFilters');

		$this->canDo = \JHelperContent::getActions('com_bookingmanager');

		if (count($errors = $this->get('Errors')))
		{
			throw new \Exception(implode("\n", $errors), 500);
		}

		BookingManagerHelper::addSubmenu('Rooms');

		$this->addToolBar();

		parent::display($tpl);

		$this->setDocument();
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolBar()
	{
		$title = \JText::_('COM_BOOKINGMANAGER_MANAGER_ORDERS');

		if ($this->pagination->total)
		{
			$title .= "<span style='font-size:0.5em;vertical-align:middle;'> (" . $this->pagination->total . ")</span>";
		}

		\JToolBarHelper::title($title, 'Room');

		if ($this->canDo->get('core.delete'))
		{
			\JToolBarHelper::deleteList('Are you sure?', 'orders.delete', 'JTOOLBAR_DELETE');
		}
		if ($this->canDo->get('core.admin'))
		{
			\JToolBarHelper::divider();
			\JToolBarHelper::preferences('com_bookingmanager');
		}
	}

	/**
	 * Method to set up the document properties (sets the browser title)
	 *
	 * @return  void
	 */
	protected function setDocument()
	{
		$document = Factory::getDocument();
		$document->setTitle(\JText::_('COM_BOOKINGMANAGER_ADMINISTRATION'));
	}
}