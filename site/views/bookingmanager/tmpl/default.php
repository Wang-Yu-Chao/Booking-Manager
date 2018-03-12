<?php
defined('_JEXEC') or die('Restricted Access');

//JHtml::_('formbehavior.chosen', 'select');

//$listOrder  = $this->escape($this->filter_order);
//$listDirn   = $this->escape($this->filter_order_Dir);
?>
<form action="index.php?option=com_bookingmanager" method="post" id="adminForm" name="adminForm">

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th width="4%"><?php echo JText::_('COM_BOOKINGMANAGER_NUM'); ?></th>
            <th width="6%">
				<?php echo JHtml::_('grid.checkall'); ?>
            </th>
            <th width="45%">
				<?php echo JText::_('COM_BOOKINGMANAGER_BOOKINGMANAGERS_ROOMNUMBER'); ?>
            </th>
            <th width="45%">
				<?php echo JText::_('COM_BOOKINGMANAGER_BOOKINGMANAGERS_STATE'); ?>
            </th>
<!--            <th width="10%">-->
<!--				--><?php //echo JText::_('COM_BOOKINGMANAGER_PUBLISHED'); ?>
<!--            </th>-->
<!--            <th width="4%">-->
<!--				--><?php //echo JText::_('COM_BOOKINGMANAGER_ROOMID'); ?>
<!--            </th>-->
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="5">
				<?php echo $this->pagination->getListFooter(); ?>
            </td>
        </tr>
        </tfoot>
        <tbody>
		<?php if (!empty($this->items)) : ?>
			<?php foreach ($this->items as $i => $row) :
				$link = JRoute::_('index.php?option=com_bookingmanager&task=bookingmanager.edit&roomId=' . $row->roomId);
				?>
                <tr>
                    <td>
						<?php echo $this->pagination->getRowOffset($i); ?>
                    </td>
                    <td>
						<?php echo JHtml::_('grid.id', $i, $row->roomId, ($row->state == 0) ? false : true); ?>
                    </td>
                    <td>
                        <a href="<?= $link ?>" title="<?= JText::_('COM_BOOKINGMANAGER_EDIT_ROOM'); ?>">
							<?php echo $row->roomNumber; ?>
                        </a>
                    </td>
                    <td>
						<?php echo ($row->state == 0) ? JText::_('COM_BOOKINGMANAGER_BOOKINGMANAGERS_VACANT')
							: JText::_('COM_BOOKINGMANAGER_BOOKINGMANAGERS_OCCUPIED'); ?>
                    </td>
                </tr>
			<?php endforeach; ?>
		<?php endif; ?>
        </tbody>
    </table>

    <div class="btn-toolbar">
        <div class="btn-group">
            <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('bookingmanager.save')">
                <span class="icon-ok"></span><?php echo JText::_('COM_BOOKINGMANAGER_BOOKINGMANAGER_RESERVE') ?>
            </button>
        </div>
    </div>

    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value="0"/>
	<?php echo JHtml::_('form.token'); ?>
</form>