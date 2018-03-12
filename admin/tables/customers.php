<?php
defined('_JEXEC') or die('Restricted access');

/**
 * Customers Table class
 *
 * @since  0.0.1
 */
class BookingManagerTableCustomers extends JTable
{
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  &$db  A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__customers', 'customerId', $db);
	}
}