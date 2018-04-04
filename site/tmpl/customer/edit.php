<?php
defined('_JEXEC') or die;
\JHtml::_('behavior.formvalidator');
?>
<form action="<?php echo \JRoute::_('index.php?option=com_bookingmanager&view=customer&layout=edit', false); ?>"
      method="post" name="adminForm" id="adminForm" class="form-validate">
	<div class="form-horizontal">
		<fieldset class="adminform">
			<legend><?php echo \JText::_('COM_BOOKINGMANAGER_CUSTOMEREDITOR_INFO'); ?></legend>
			<div class="row">
				<div class="col-md-6">
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
            <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('customer.save')">
                <span class="icon-ok"></span><?php echo \JText::_('COM_BOOKINGMANAGER_BOOKINGMANAGER_SUBMIT') ?>
            </button>
        </div>
        <div class="btn-group">
            <button type="button" class="btn" onclick="Joomla.submitbutton('customer.cancel')">
                <span class="icon-cancel"></span><?php echo \JText::_('JCANCEL') ?>
            </button>
        </div>
    </div>

	<input type="hidden" name="task" value="customer.edit" />
	<?php echo \JHtml::_('form.token'); ?>
</form>