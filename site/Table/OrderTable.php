<?php
namespace Joomla\Component\BookingManager\Site\Table;

defined('_JEXEC') or die;

/**
 * Order Table class
 *
 * @since  0.0.1
 */
class OrderTable extends \JTable
{
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  &$db  A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__orders', 'id', $db);
	}
}