<?php
namespace Joomla\Component\BookingManager\Site;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

$controller = JControllerLegacy::getInstance('BookingManager');

// Perform the Request task
$input = Factory::getApplication()->input;
$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
$controller->redirect();