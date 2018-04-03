<?php
namespace Joomla\Component\BookingManager\Site\View\Room;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;

/**
 * HTML View class for the BookingManager Component
 *
 * @since  0.0.1
 */
class HtmlView extends BaseHtmlView
{
	/**
	 * Display the BookingManager view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed
	 */
	function display($tpl = null)
	{
		$this->items            = $this->get('Items');
		$this->pagination       = $this->get('Pagination');

		$this->state            = $this->get('State');

		if (count($errors = $this->get('Errors')))
		{
			JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');

			return false;
		}

		parent::display($tpl);

		$this->setDocument();
	}

	/**
	 * Method to set up the document properties (sets the browser title)
	 *
	 * @return  void
	 */
	protected function setDocument()
	{
		$document = Factory::getDocument();
		$document->setTitle(\JText::_('COM_BOOKINGMANAGER_HOTEL_ROOM'));
	}
}