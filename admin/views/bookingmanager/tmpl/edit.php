<?php
defined('_JEXEC') or die;
JHtml::_('behavior.formvalidator');
?>
<form action="<?php echo JRoute::_('index.php?option=com_bookingmanager&layout=edit&roomId=' . (int) $this->item->roomId); ?>"
      method="post" name="adminForm" id="adminForm" class="form-validate">
	<div class="form-horizontal">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_BOOKINGMANAGER_BOOKINGMANAGER_DETAILS'); ?></legend>
			<div class="row-fluid">
				<div class="span6">
					<?php foreach ($this->form->getFieldset() as $field): ?>
						<div class="control-group">
							<div class="control-label"><?php echo $field->label; ?></div>
							<div class="controls"><?php echo $field->input; ?></div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</fieldset>
	</div>
	<input type="hidden" name="task" value="bookingmanager.edit" />
	<?php echo JHtml::_('form.token'); ?>
</form>