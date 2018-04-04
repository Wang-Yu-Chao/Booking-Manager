<?php
namespace Joomla\Component\BookingManager\Administrator\Helper;

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Factory;

/**
 * Configure the Link bar.
 *
 * @param   string  $submenu  The name of the active view.
 *
 * @return  void
 *
 * @since   1.6
 */
abstract class BookingManagerHelper extends ContentHelper
{
	/**
	 * Configure the Linkbar.
	 *
	 * @return Bool
	 */

	public static function addSubmenu($submenu)
	{
		\JHtmlSidebar::addEntry(
			\JText::_('COM_BOOKINGMANAGER_SUBMENU_ROOMS'),
			'index.php?option=com_bookingmanager',
			$submenu == 'rooms'
		);

		\JHtmlSidebar::addEntry(
			\JText::_('COM_BOOKINGMANAGER_SUBMENU_CUSTOMERS'),
			'index.php?option=com_bookingmanager&view=Customers',
			$submenu == 'Customers'
		);

		\JHtmlSidebar::addEntry(
			\JText::_('COM_BOOKINGMANAGER_SUBMENU_ORDERS'),
			'index.php?option=com_bookingmanager&view=Orders',
			$submenu == 'Orders'
		);

		\JHtmlSidebar::addEntry(
			\JText::_('COM_BOOKINGMANAGER_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&view=categories&extension=com_bookingmanager',
			$submenu == 'categories'
		);

		$document = Factory::getDocument();
		switch ($submenu)
		{
			case 'Customers':
				$document->setTitle(\JText::_('COM_BOOKINGMANAGER_ADMINISTRATION_CUSTOMERS'));
				break;
			case 'Orders':
				$document->setTitle(\JText::_('COM_BOOKINGMANAGER_ADMINISTRATION_ORDERS'));
				break;
			case 'categories':
				$document->setTitle(\JText::_('COM_BOOKINGMANAGER_ADMINISTRATION_CATEGORIES'));
			default:
				break;
		}
	}
}