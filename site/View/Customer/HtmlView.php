<?php
namespace Joomla\Component\BookingManager\Site\View\Customer;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;

/**
 * BookingManager View
 *
 * @since  0.0.1
 */
class HtmlView extends BaseHtmlView
{
	/**
	 * View form
	 *
	 * @var form
	 *
	 * @since 0.0.1
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

		if (count($errors = $this->get('Errors')))
		{
			throw new \Exception(implode("\n", $errors), 500);
		}

		parent::display($tpl);

		$this->setDocument();
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 *
	 * @since 0.0.1
	 */
	protected function setDocument()
	{
		$isNew = ($this->item->id < 1);
		$document = Factory::getDocument();
		$document->setTitle($isNew ? \JText::_('COM_BOOKINGMANAGER_CUSTOMEREDITOR_CREATING') :
			\JText::_('COM_BOOKINGMANAGER_CUSTOMEREDITOR_EDITING'));
	}
}