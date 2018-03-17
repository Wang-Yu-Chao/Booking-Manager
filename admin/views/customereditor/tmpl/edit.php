<?php
defined('_JEXEC') or die;
JHtml::_('behavior.formvalidator');

JFactory::getDocument()->addScriptDeclaration('
	jQuery(document).ready(function() {
        name = jQuery("#jform_name").val();
		jQuery("#jform_title").val(name);
	});
');
?>
<form action="<?php echo JRoute::_('index.php?option=com_bookingmanager&view=customereditor&layout=edit&customerId=' . (int) $this->item->customerId, false); ?>"
      method="post" name="adminForm" id="adminForm" class="form-validate">

	<input id="jform_title" type="hidden" name="customers-name-title"/>

	<div class="form-horizontal">

		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details',
			empty($this->item->customerId) ? JText::_('COM_BOOKINGMANAGER_TAB_NEW_CUSTOMER') : JText::_('COM_BOOKINGMANAGER_TAB_EDIT_CUSTOMER')); ?>
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_BOOKINGMANAGER_LEGEND_DETAILS') ?></legend>
			<div class="row-fluid">
				<div class="span6">
					<?php echo $this->form->renderFieldset('details');  ?>
				</div>
			</div>
		</fieldset>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'permissions', JText::_('COM_BOOKINGMANAGER_TAB_PERMISSIONS')); ?>
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_BOOKINGMANAGER_LEGEND_PERMISSIONS') ?></legend>
			<div class="row-fluid">
				<div class="span12">
					<?php echo $this->form->renderFieldset('accesscontrol');  ?>
				</div>
			</div>
		</fieldset>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		<?php echo JHtml::_('bootstrap.endTabSet'); ?>

	</div>
	<input type="hidden" name="task" value="customereditor.edit" />
	<?php echo JHtml::_('form.token'); ?>
</form>