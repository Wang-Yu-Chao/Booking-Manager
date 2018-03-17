<?php
defined('_JEXEC') or die('Redirect access');

/**
 * Customers View
 *
 * @since  0.0.1
 */
class BookingManagerViewCustomers extends JViewLegacy
{
	protected $canDo;

	/**
	 * Display the Customers views
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void | bool
	 *
	 * @since   0.0.1
	 */
	function display($tpl = null)
	{
		$app     = JFactory::getApplication();
		$context = "bookingmanager.list.admin.customers";

		$this->items      = $this->get('Items');
		$this->pagination = $this->get('Pagination');

		$this->status           = $this->get('State');
		$this->filter_order     = $app->getUserStateFromRequest($context . '.filter_order', 'filter_order', 'name', 'cmd');
		$this->filter_order_Dir = $app->getUserStateFromRequest($context . '.filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
		$this->filterForm       = $this->get('filterForm');
		$this->activeFilters    = $this->get('ActiveFilters');

		$this->canDo = JHelperContent::getActions('com_bookingmanager');

		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors), 500);
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
		$title = JText::_('COM_BOOKINGMANAGER_MANAGER_CUSTOMERS');

		if ($this->pagination->total)
		{
			$title .= "<span style='font-size:0.5em;vertical-align:middle;'> (" . $this->pagination->total . ")</span>";
		}

		JToolBarHelper::title($title, 'bookingmanager');

		if ($this->canDo->get('core.create'))
		{
			JToolBarHelper::addNew('customereditor.add', 'JTOOLBAR_NEW');
		}
		if ($this->canDo->get('core.edit'))
		{
			JToolBarHelper::editList('customereditor.edit', 'JTOOLBAR_EDIT');
		}
		if ($this->canDo->get('core.delete'))
		{
			JToolBarHelper::deleteList('Are you sure?', 'customers.delete', 'JTOOLBAR_DELETE');
		}
		if ($this->canDo->get('core.admin'))
		{
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_bookingmanager');
		}
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