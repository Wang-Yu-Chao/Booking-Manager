<?php

defined('_JEXEC') or die;

use Joomla\CMS\Form\FormRule;

/**
 * Form Rule class for the Joomla Framework.
 */
class JFormRuleRoomnumber extends FormRule
{
	/**
	 * The regular expression.
	 *
	 * @access	protected
	 * @var		string
	 * @since	0.0.1
	 */
	protected $regex = '^[A-Z][0-9]+$';
}