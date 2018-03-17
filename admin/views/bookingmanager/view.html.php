<?php
defined('_JEXEC') or die;

/**
 * BookingManager View
 *
 * @since  0.0.1
 */
class BookingManagerViewBookingManager extends JViewLegacy
{
	protected $form;
	protected $item;
	protected $script;
	protected $canDo;

	/**
	 * Display the BookingManager view
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

		$this->canDo = JHelperContent::getActions('com_bookingmanager', 'bookingmanager', $this->item->roomId);

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

		$isNew = ($this->item->roomId == 0);

		if ($isNew)
		{
			// For new records, check the create permission.
			if ($this->canDo->get('core.create'))
			{
				JToolBarHelper::apply('bookingmanager.apply', 'JTOOLBAR_APPLY');
				JToolBarHelper::save('bookingmanager.save', 'JTOOLBAR_SAVE');
				JToolBarHelper::custom('bookingmanager.save2new', 'save-new.png', 'save-new_f2.png',
					'JTOOLBAR_SAVE_AND_NEW', false);
			}
			JToolBarHelper::cancel('bookingmanager.cancel', 'JTOOLBAR_CANCEL');
		}
		else
		{
			if ($this->canDo->get('core.edit'))
			{
				// We can save the new record
				JToolBarHelper::apply('bookingmanager.apply', 'JTOOLBAR_APPLY');
				JToolBarHelper::save('bookingmanager.save', 'JTOOLBAR_SAVE');

				// We can save this record, but check the create permission to see
				// if we can return to make a new one.
				if ($this->canDo->get('core.create'))
				{
					JToolBarHelper::custom('bookingmanager.save2new', 'save-new.png', 'save-new_f2.png',
						'JTOOLBAR_SAVE_AND_NEW', false);
				}
			}
			if ($this->canDo->get('core.create'))
			{
				JToolBarHelper::custom('bookingmanager.save2copy', 'save-copy.png', 'save-copy_f2.png',
					'JTOOLBAR_SAVE_AS_COPY', false);
			}
			JToolBarHelper::cancel('bookingmanager.cancel', 'JTOOLBAR_CLOSE');
		}
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$isNew = ($this->item->roomId < 1);
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? JText::_('COM_BOOKINGMANAGER_BOOKINGMANAGER_CREATING') :
			JText::_('COM_BOOKINGMANAGER_BOOKINGMANAGER_EDITING'));
	}
}