<?php
defined('_JEXEC') or die;
JHtml::_('behavior.formvalidator');
?>
<form action="<?php echo JRoute::_('index.php?option=com_bookingmanager&view=customereditor&layout=edit&customerId=' . (int) $this->item->customerId, false); ?>"
      method="post" name="adminForm" id="adminForm" class="form-validate">
	<div class="form-horizontal">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_BOOKINGMANAGER_CUSTOMEREDITOR_INFO'); ?></legend>
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

    <div class="btn-toolbar">
        <div class="btn-group">
            <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('customereditor.save')">
                <span class="icon-ok"></span><?php echo JText::_('COM_BOOKINGMANAGER_BOOKINGMANAGER_SUBMIT') ?>
            </button>
        </div>
        <div class="btn-group">
            <button type="button" class="btn" onclick="Joomla.submitbutton('customereditor.cancel')">
                <span class="icon-cancel"></span><?php echo JText::_('JCANCEL') ?>
            </button>
        </div>
    </div>

	<input type="hidden" name="task" value="customereditor.edit" />
	<?php echo JHtml::_('form.token'); ?>
</form>