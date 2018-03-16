<?php
defined('_JEXEC') or die;

/**
 * BookingManager component helper.
 *
 * @param   string  $submenu  The name of the active view.
 *
 * @return  void
 *
 * @since   1.6
 */
abstract class BookingManagerHelper extends JHelperContent
{
	/**
	 * Configure the Linkbar.
	 *
	 * @return Bool
	 */

	public static function addSubmenu($submenu)
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_BOOKINGMANAGER_SUBMENU_ROOMS'),
			'index.php?option=com_bookingmanager',
			$submenu == 'rooms'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_BOOKINGMANAGER_SUBMENU_CUSTOMERS'),
			'index.php?option=com_bookingmanager&view=customers',
			$submenu == 'customers'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_BOOKINGMANAGER_SUBMENU_ORDERS'),
			'index.php?option=com_bookingmanager&view=orders',
			$submenu == 'orders'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_BOOKINGMANAGER_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&view=categories&extension=com_bookingmanager',
			$submenu == 'categories'
		);

		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-bookingmanager ' .
			'{background-image: url(../media/com_bookingmanager/images/hotel-48x48.png);}');
		switch ($submenu)
		{
			case 'customers':
				$document->setTitle(JText::_('COM_BOOKINGMANAGER_ADMINISTRATION_CUSTOMERS'));
				break;
			case 'orders':
				$document->setTitle(JText::_('COM_BOOKINGMANAGER_ADMINISTRATION_ORDERS'));
				break;
			case 'categories':
				$document->setTitle(JText::_('COM_BOOKINGMANAGER_ADMINISTRATION_CATEGORIES'));
			default:
				break;
		}
	}
}