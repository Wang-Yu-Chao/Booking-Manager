<?php
defined('_JEXEC') or die;

/**
 * Form Rule class for the Joomla Framework.
 */
class JFormRuleRoomnumber extends JFormRule
{
	/**
	 * The regular expression.
	 *
	 * @access	protected
	 * @var		string
	 * @since	2.5
	 */
	protected $regex = '^[A-Z][0-9]+$';
}