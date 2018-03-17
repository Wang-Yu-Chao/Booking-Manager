<?php
defined('_JEXEC') or die;
JHtml::_('behavior.formvalidator');

JFactory::getDocument()->addScriptDeclaration('
	jQuery(document).ready(function() {
        roomNumber = jQuery("#jform_roomNumber").val();
		jQuery("#jform_title").val(roomNumber);
	});
');
?>
<form action="<?php echo JRoute::_('index.php?option=com_bookingmanager&layout=edit&roomId=' . (int) $this->item->roomId); ?>"
      method="post" name="adminForm" id="adminForm" class="form-validate">

	<input id="jform_title" type="hidden" name="rooms-rooms-title"/>

	<div class="form-horizontal">

		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details',
			empty($this->item->roomId) ? JText::_('COM_BOOKINGMANAGER_TAB_NEW_ROOM') : JText::_('COM_BOOKINGMANAGER_TAB_EDIT_ROOM')); ?>
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_BOOKINGMANAGER_LEGEND_DETAILS') ?></legend>
			<div class="row-fluid">
				<div class="span6">
					<?php echo $this->form->renderFieldset('details');  ?>
				</div>
			</div>
		</fieldset>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

<!--		--><?php //echo JHtml::_('bootstrap.addTab', 'myTab', 'params', JText::_('COM_BOOKINGMANAGER_TAB_PARAMS')); ?>
<!--		<fieldset class="adminform">-->
<!--			<legend>--><?php //echo JText::_('COM_BOOKINGMANAGER_LEGEND_PARAMS') ?><!--</legend>-->
<!--			<div class="row-fluid">-->
<!--				<div class="span6">-->
<!--					--><?php //echo $this->form->renderFieldset('params');  ?>
<!--				</div>-->
<!--			</div>-->
<!--		</fieldset>-->
<!--		--><?php //echo JHtml::_('bootstrap.endTab'); ?>

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
	<input type="hidden" name="task" value="bookingmanager.edit" />
	<?php echo JHtml::_('form.token'); ?>
</form>