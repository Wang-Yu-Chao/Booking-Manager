<?php
defined('_JEXEC') or die('Restricted access');

/**
 * BookingManager View
 *
 * @since  0.0.1
 */
class BookingManagerViewCustomerEditor extends JViewLegacy
{
	/**
	 * View form
	 *
	 * @var form
	 */
	protected $form = null;

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

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		parent::display($tpl);

		$this->setDocument();
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