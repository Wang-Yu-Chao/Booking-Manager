<?php
defined('_JEXEC') or die;

/**
 * CustomerEditor View
 *
 * @since  0.0.1
 */
class BookingManagerViewCustomerEditor extends JViewLegacy
{
	protected $form;
	protected $item;
	protected $script;
	protected $canDo;

	/**
	 * Display the CustomerEditor view
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

		$this->canDo = JHelperContent::getActions('com_bookingmanager', 'customers', $this->item->customerId);

		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors), 500);
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

		$isNew = ($this->item->customerId == 0);

		//		if ($isNew)
		//		{
		//			$title = JText::_('COM_BOOKINGMANAGER_MANAGER_CUSTOMEREDITOR_NEW');
		//		}
		//		else
		//		{
		//			$title = JText::_('COM_BOOKINGMANAGER_MANAGER_CUSTOMEREDITOR_EDIT');
		//		}
		//
		//		JToolbarHelper::title($title, 'customereditor');
		//		JToolbarHelper::save('customereditor.save');
		//		JToolbarHelper::cancel(
		//			'customereditor.cancel',
		//			$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
		//		);

		if ($isNew)
		{
			// For new records, check the create permission.
			if ($this->canDo->get('core.create'))
			{
				JToolBarHelper::apply('customereditor.apply', 'JTOOLBAR_APPLY');
				JToolBarHelper::save('customereditor.save', 'JTOOLBAR_SAVE');
				JToolBarHelper::custom('customereditor.save2new', 'save-new.png', 'save-new_f2.png',
					'JTOOLBAR_SAVE_AND_NEW', false);
			}
			JToolBarHelper::cancel('customereditor.cancel', 'JTOOLBAR_CANCEL');
		}
		else
		{
			if ($this->canDo->get('core.edit'))
			{
				// We can save the new record
				JToolBarHelper::apply('customereditor.apply', 'JTOOLBAR_APPLY');
				JToolBarHelper::save('customereditor.save', 'JTOOLBAR_SAVE');

				// We can save this record, but check the create permission to see
				// if we can return to make a new one.
				if ($this->canDo->get('core.create'))
				{
					JToolBarHelper::custom('customereditor.save2new', 'save-new.png', 'save-new_f2.png',
						'JTOOLBAR_SAVE_AND_NEW', false);
				}
			}
			if ($this->canDo->get('core.create'))
			{
				JToolBarHelper::custom('customereditor.save2copy', 'save-copy.png', 'save-copy_f2.png',
					'JTOOLBAR_SAVE_AS_COPY', false);
			}
			JToolBarHelper::cancel('customereditor.cancel', 'JTOOLBAR_CLOSE');
		}
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$isNew = ($this->item->customerId < 1);
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? JText::_('COM_BOOKINGMANAGER_CUSTOMEREDITOR_CREATING') :
			JText::_('COM_BOOKINGMANAGER_CUSTOMEREDITOR_EDITING'));
	}
}