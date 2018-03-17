<?php
defined('_JEXEC') or die;

$document = JFactory::getDocument();

if (!JFactory::getUser()->authorise('core.manage', 'com_bookingmanager'))
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

JLoader::register('BookingManagerHelper', JPATH_COMPONENT . '/helpers/bookingmanager.php');

$controller = JControllerLegacy::getInstance('BookingManager');

$controller->execute(JFactory::getApplication()->input->get('task'));

$controller->redirect();