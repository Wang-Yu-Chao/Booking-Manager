<?php
defined('_JEXEC') or die('Restricted access');

/**
 * Order View
 *
 * @since  0.0.1
 */
class BookingManagerViewOrder extends JViewLegacy
{
	/**
	 * View form
	 *
	 * @var form
	 */
	protected $form = null;

	/**
	 * Display the Order view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		// Get the Data
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

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
		$input = JFactory::getApplication()->input;

		$input->set('hidemainmenu', true);

		$isNew = ($this->item->orderId == 0);

		if ($isNew)
		{
			$title = JText::_('COM_BOOKINGMANAGER_MANAGER_ORDER_NEW');
		}
		else
		{
			$title = JText::_('COM_BOOKINGMANAGER_MANAGER_ORDER_EDIT');
		}

		JToolbarHelper::title($title, 'order');
		JToolbarHelper::save('order.save');
		JToolbarHelper::cancel(
			'order.cancel',
			$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
		);
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$isNew = ($this->item->orderId < 1);
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? JText::_('COM_BOOKINGMANAGER_ORDER_CREATING') :
			JText::_('COM_BOOKINGMANAGER_ORDER_EDITING'));
	}
}