<?php
namespace Joomla\Component\BookingManager\Administrator\View\Order;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;

/**
 * Order View
 *
 * @since  0.0.1
 */
class HtmlView extends BaseHtmlView
{
	protected $form;
	protected $item;
	protected $script;
	protected $canDo;

	/**
	 * Display the Order view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');

		$this->canDo = \JHelperContent::getActions('com_bookingmanager', 'Orders', $this->item->id);

		if (count($errors = $this->get('Errors')))
		{
			throw new \Exception(implode("\n", $errors), 500);
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
		$input = Factory::getApplication()->input;

		$input->set('hidemainmenu', true);

		$isNew = ($this->item->id == 0);

		if ($isNew)
		{
			$title = \JText::_('COM_BOOKINGMANAGER_MANAGER_ORDER_NEW');
		}
		else
		{
			$title = \JText::_('COM_BOOKINGMANAGER_MANAGER_ORDER_EDIT');
		}

		\JToolBarHelper::title($title, 'Order');

		if ($isNew)
		{
			// For new records, check the create permission.
			if ($this->canDo->get('core.create'))
			{
				\JToolBarHelper::apply('room.apply', 'JTOOLBAR_APPLY');
				\JToolBarHelper::save('room.save', 'JTOOLBAR_SAVE');
				\JToolBarHelper::custom('room.save2new', 'save-new.png', 'save-new_f2.png',
					'JTOOLBAR_SAVE_AND_NEW', false);
			}
			\JToolBarHelper::cancel('room.cancel', 'JTOOLBAR_CANCEL');
		}
		else
		{
			if ($this->canDo->get('core.edit'))
			{
				// We can save the new record
				\JToolBarHelper::apply('room.apply', 'JTOOLBAR_APPLY');
				\JToolBarHelper::save('room.save', 'JTOOLBAR_SAVE');

				// We can save this record, but check the create permission to see
				// if we can return to make a new one.
				if ($this->canDo->get('core.create'))
				{
					\JToolBarHelper::custom('room.save2new', 'save-new.png', 'save-new_f2.png',
						'JTOOLBAR_SAVE_AND_NEW', false);
				}
			}
			if ($this->canDo->get('core.create'))
			{
				\JToolBarHelper::custom('room.save2copy', 'save-copy.png', 'save-copy_f2.png',
					'JTOOLBAR_SAVE_AS_COPY', false);
			}
			\JToolBarHelper::cancel('room.cancel', 'JTOOLBAR_CLOSE');
		}
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$isNew = ($this->item->id < 1);
		$document = Factory::getDocument();
		$document->setTitle($isNew ? \JText::_('COM_BOOKINGMANAGER_ORDER_CREATING') :
			\JText::_('COM_BOOKINGMANAGER_ORDER_EDITING'));
	}
}