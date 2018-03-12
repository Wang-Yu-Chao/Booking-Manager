<?php
defined('_JEXEC') or die('Restricted access');

/**
 * Order Model
 *
 * @since  0.0.1
 */
class BookingManagerModelOrder extends JModelList
{
	public function save($roomIds)
	{
		$context    = 'bookingmanager.list.site.bookingmanager';
		$data   = JFactory::getApplication()->getUserStateFromRequest($context . 'data', 'data', 'ARRAY');
		$db     = JFactory::getDbo();

		foreach ($roomIds as $roomId)
		{
			$query  = $db->getQuery(true);
			$query->select('customerId')
				->from($db->quoteName('#__customers'))
				->where($db->quoteName('name') . ' = ' . $db->quote($data['name']));

			$db->setQuery($query);
			$customerId = $db->loadColumn();

			if (!empty($customerId))
			{
				$query = $db->getQuery(true);
				$query->insert('#__orders')->columns('roomId, customerId')
					->values($db->quote($roomId) . ', ' . $db->quote($customerId[0]));
				$db->setQuery($query);
				$db->execute();
			}
		}


	}
}