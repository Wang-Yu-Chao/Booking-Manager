<?php
namespace Joomla\Component\BookingManager\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;

/**
 * Rooms Table class
 *
 * @since  0.0.1
 */
class RoomTable extends Table
{
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  &$db  A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__rooms', 'id', $db);
	}

	/**
	 * Overloaded bind function
	 *
	 * @param       array           named array
	 *
	 * @return      null|string     null is operation was satisfactory, otherwise returns an error
	 *
	 * @see \JTable:bind
	 *
	 * @since 1.5
	 */
	public function bind($array, $ignore = '')
	{
		if (isset($array['params']) && is_array($array['params']))
		{
			$parameter = new \JRegistry;
			$parameter->loadArray($array['params']);
			$array['params'] = (string)$parameter;
		}

		// Bind the rules.
		if (isset($array['rules']) && is_array($array['rules']))
		{
			$rules = new \JAccessRules($array['rules']);
			$this->setRules($rules);
		}

		return parent::bind($array, $ignore);
	}

	/**
	 * Method to compute the default name of the asset.
	 * The default name is in the form `table_name.id`
	 * where id is the value of the primary key of the table.
	 *
	 * @return	string
	 *
	 * @since	0.0.1
	 */
	protected function _getAssetName()
	{
		$k = $this->_tbl_key;
		return 'com_bookingmanager.room.' . (int) $this->$k;
	}

	/**
	 * Method to return the title to use for the asset table.
	 *
	 * @return	string
	 *
	 * @since	0.0.1
	 */
	protected function _getAssetTitle()
	{
		return $this->roomNumber;
	}

	/**
	 * Method to get the asset-parent-id of the item
	 *
	 * @return	int
	 *
	 * @since   0.0.1
	 */
	protected function _getAssetParentId(\JTable $table = NULL, $id = NULL)
	{
		$assetParent = \JTable::getInstance('Asset');
		$assetParentId = $assetParent->getRootId();

		if (($this->catid) && !empty($this->catid))
		{
			$assetParent->loadByName('com_bookingmanager.category.' . (int) $this->catid);
		}
		else
		{
			$assetParent->loadByName('com_bookingmanager');
		}

		if ($assetParent->id)
		{
			$assetParentId = $assetParent->id;
		}
		return $assetParentId;
	}
}