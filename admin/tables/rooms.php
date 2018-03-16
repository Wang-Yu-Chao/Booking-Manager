<?php
defined('_JEXEC') or die;

/**
 * Rooms Table class
 *
 * @since  0.0.1
 */
class BookingManagerTableRooms extends JTable
{
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  &$db  A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__rooms', 'roomId', $db);
	}
}