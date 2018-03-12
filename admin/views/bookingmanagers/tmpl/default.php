<?php
defined('_JEXEC') or die('Restricted Access');

JHtml::_('formbehavior.chosen', 'select');

$listOrder  = $this->escape($this->filter_order);
$listDirn   = $this->escape($this->filter_order_Dir);
?>
<form action="index.php?option=com_bookingmanager&view=bookingmanagers" method="post" id="adminForm" name="adminForm">
    <div class="row">
        <div id="j-sidebar-container" class="span2 col-md-2">
		    <?php echo JHtmlSidebar::render(); ?>
        </div>

        <div id="j-main-container" class="j-main-container span10 col-md-10">
            <div class="row-fluid">
                <div class="span6">
				    <?php
				    echo JLayoutHelper::render(
					    'joomla.searchtools.default',
					    array('view' => $this)
				    );
				    ?>
                </div>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th width="2%"><?php echo JText::_('COM_BOOKINGMANAGER_NUM'); ?>
                    </th>
                    <th width="4%">
					    <?php echo JHtml::_('grid.checkall'); ?>
                    </th>
                    <th width="40%">
					    <?php echo JHtml::_('grid.sort', 'COM_BOOKINGMANAGER_BOOKINGMANAGERS_ROOMNUMBER', 'roomNumber', $listDirn, $listOrder); ?>
                    </th>
                    <th width="40%">
					    <?php echo JHtml::_('grid.sort', 'COM_BOOKINGMANAGER_BOOKINGMANAGERS_STATE', 'state', $listDirn, $listOrder) ?>
                    </th>
                    <th width="10%">
					    <?php echo JHtml::_('grid.sort', 'COM_BOOKINGMANAGER_PUBLISHED', 'published', $listDirn, $listOrder) ?>
                    </th>
                    <th width="4%">
					    <?php echo JHtml::_('grid.sort', 'COM_BOOKINGMANAGER_ROOMID', 'roomId', $listDirn, $listOrder) ?>
                    </th>
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
							    <?php echo JHtml::_('grid.id', $i, $row->roomId); ?>
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
                            <td align="center">
							    <?php echo JHtml::_('jgrid.published', $row->published, $i, 'bookingmanagers.', true, 'cb'); ?>
                            </td>
                            <td align="center">
							    <?php echo $row->roomId; ?>
                            </td>
                        </tr>
				    <?php endforeach; ?>
			    <?php endif; ?>
                </tbody>
            </table>
            <input type="hidden" name="task" value=""/>
            <input type="hidden" name="boxchecked" value="0"/>
            <input type="hidden" name="filter_order" value="<?= $listOrder ?>">
            <input type="hidden" name="filter_order_Dir" value="<? $listDirn ?>">
		    <?php echo JHtml::_('form.token'); ?>
        </div>
    </div>
</form>