<?php
namespace Joomla\Component\BookingManager\Administrator\View\Rooms;

defined('_JEXEC') or die('Redirect access');

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\Component\BookingManager\Administrator\Helper\BookingManagerHelper;

/**
 * BookingManagers View
 *
 * @since  0.0.1
 */
class HtmlView extends BaseHtmlView
{
	/**
	 * An array of items
	 *
	 * @var   array
	 *
	 * @since  0.0.1
	 */
	protected $items;

	/**
	 * The pagination object
	 *
	 * @var    \Joomla\CMS\Pagination\Pagination
	 *
	 * @since  0.0.1
	 */
	protected $pagination;

	/**
	 * The model state
	 *
	 * @var    object
	 *
	 * @since  0.0.1
	 */
	protected $state;

	/**
	 * The actions the user is authorised to perform
	 *
	 * @var    \JObject
	 *
	 * @since  0.0.1
	 */
	protected $canDo;

	/**
	 * Display the BookingManager views
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void | bool
	 *
	 * @since   0.0.1
	 */
	function display($tpl = null)
	{
		$app = Factory::getApplication();
		$context = "room.list.admin.room";

		$this->items            = $this->get('Items');
		$this->pagination       = $this->get('Pagination');
		$this->state            = $this->get('State');
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
		$title = \JText::_('COM_BOOKINGMANAGER_MANAGER_BOOKINGMANAGERS');

		if ($this->pagination->total)
		{
			$title .= "<span style='font-size:0.5em;vertical-align:middle;'> (" . $this->pagination->total . ")</span>";
		}

		\JToolBarHelper::title($title, 'Room');

		if ($this->canDo->get('core.create'))
		{
			\JToolBarHelper::addNew('room.add', 'JTOOLBAR_NEW');
		}
		if ($this->canDo->get('core.edit'))
		{
			\JToolBarHelper::editList('room.edit', 'JTOOLBAR_EDIT');
		}
		if ($this->canDo->get('core.delete'))
		{
			\JToolBarHelper::deleteList('Are you sure?', 'Rooms.delete', 'JTOOLBAR_DELETE');
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