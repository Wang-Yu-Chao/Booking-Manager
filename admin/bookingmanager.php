<?php
defined('_JEXEC') or die;

$document = JFactory::getDocument();
//$document->addStyleDeclaration('.icon-bookingmanager {background-image: url(../media/com_bookingmanager/images/hotel-64x64.png);}');

JLoader::register('BookingManagerHelper', JPATH_COMPONENT . '/helpers/bookingmanager.php');

$controller = JControllerLegacy::getInstance('BookingManager');

$controller->execute(JFactory::getApplication()->input->get('task'));

$controller->redirect();