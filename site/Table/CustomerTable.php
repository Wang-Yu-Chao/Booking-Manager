<?php
namespace Joomla\Component\BookingManager\Site\Table;

defined('_JEXEC') or die;

/**
 * Customer Table class
 *
 * @since  0.0.1
 */
class CustomerTable extends \JTable
{
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  &$db  A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__customers', 'id', $db);
	}
}