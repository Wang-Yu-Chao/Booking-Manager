<?php
defined('_JEXEC') or die('Redirect access');

/**
 * BookingManagers View
 *
 * @since  0.0.1
 */
class BookingManagerViewBookingManagers extends JViewLegacy
{
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
		$app = JFactory::getApplication();
		$context = "bookingmanager.list.admin.bookingmanager";

		$this->items            = $this->get('Items');
		$this->pagination       = $this->get('Pagination');

		$this->status           = $this->get('State');
		$this->filter_order     = $app->getUserStateFromRequest($context.'.filter_order', 'filter_order', 'roomNumber', 'cmd');
		$this->filter_order_Dir = $app->getUserStateFromRequest($context.'.filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
		$this->filterForm       = $this->get('filterForm');
		$this->activeFilters    = $this->get('ActiveFilters');

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		BookingManagerHelper::addSubmenu('bookingmanagers');

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
		$title = JText::_('COM_BOOKINGMANAGER_MANAGER_BOOKINGMANAGERS');

		if ($this->pagination->total)
		{
			$title .= "<span style='font-size:0.5em;vertical-align:middle;'> (" . $this->pagination->total . ")</span>";
		}

		JToolBarHelper::title($title, 'bookingmanager');
		JToolBarHelper::addNew('bookingmanager.add');
		JToolBarHelper::editList('bookingmanager.edit');
		JToolBarHelper::deleteList('Are you sure?', 'bookingmanagers.delete');
	}

	/**
	 * Method to set up the document properties (sets the browser title)
	 *
	 * @return  void
	 */
	protected function setDocument()
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_BOOKINGMANAGER_ADMINISTRATION'));
	}
}