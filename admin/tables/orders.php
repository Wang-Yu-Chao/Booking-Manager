<?php
defined('_JEXEC') or die('Restricted access');

/**
 * Orders Table class
 *
 * @since  0.0.1
 */
class BookingManagerTableOrders extends JTable
{
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  &$db  A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__orders', 'orderId', $db);
	}
}