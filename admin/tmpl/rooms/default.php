<?php
defined('_JEXEC') or die;

\JHtml::_('formbehavior.chosen', 'select');

$listOrder  = $this->escape($this->state->get('list.ordering'));
$listDirn   = $this->escape($this->state->get('list.direction'));
?>
<form action="index.php?option=com_bookingmanager&view=bookingmanagers" method="post" id="adminForm" name="adminForm">
    <div class="row">
        <div id="j-sidebar-container" class="col-md-2">
		    <?php echo \JHtmlSidebar::render(); ?>
        </div>

        <div id="j-main-container" class="j-main-container col-md-10">
            <div class="row-fluid">
                <div class="col-md-6">
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
                    <th width="2%"><?php echo \JText::_('COM_BOOKINGMANAGER_NUM'); ?>
                    </th>
                    <th width="4%">
					    <?php echo \JHtml::_('grid.checkall'); ?>
                    </th>
                    <th width="40%">
					    <?php echo \JHtml::_('searchtools.sort', 'COM_BOOKINGMANAGER_BOOKINGMANAGERS_ROOMNUMBER', 'roomNumber', $listDirn, $listOrder); ?>
                    </th>
                    <th width="40%">
					    <?php echo \JHtml::_('searchtools.sort', 'COM_BOOKINGMANAGER_BOOKINGMANAGERS_STATE', 'state', $listDirn, $listOrder) ?>
                    </th>
                    <th width="10%">
					    <?php echo \JHtml::_('searchtools.sort', 'COM_BOOKINGMANAGER_PUBLISHED', 'published', $listDirn, $listOrder) ?>
                    </th>
                    <th width="4%">
					    <?php echo \JHtml::_('searchtools.sort', 'COM_BOOKINGMANAGER_ROOM_ID', 'id', $listDirn, $listOrder) ?>
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
					    $link = \JRoute::_('index.php?option=com_bookingmanager&task=room.edit&id=' . $row->id);
					    ?>
                        <tr>
                            <td>
							    <?php echo $this->pagination->getRowOffset($i); ?>
                            </td>
                            <td>
							    <?php echo \JHtml::_('grid.id', $i, $row->id); ?>
                            </td>
                            <td>
                                <a href="<?= $link ?>" title="<?= \JText::_('COM_BOOKINGMANAGER_EDIT_ROOM'); ?>">
								    <?php echo $row->roomNumber; ?>
                                </a>
								<div class="small">
									<?php echo \JText::_('JCATEGORY') . ': ' . $this->escape($row->category_title); ?>
								</div>
                            </td>
                            <td>
							    <?php echo ($row->state == 0) ? \JText::_('COM_BOOKINGMANAGER_BOOKINGMANAGERS_VACANT')
								    : \JText::_('COM_BOOKINGMANAGER_BOOKINGMANAGERS_OCCUPIED'); ?>
                            </td>
                            <td align="center">
							    <?php echo \JHtml::_('jgrid.published', $row->published, $i, 'Rooms.', true, 'cb'); ?>
                            </td>
                            <td align="center">
							    <?php echo $row->id; ?>
                            </td>
                        </tr>
				    <?php endforeach; ?>
			    <?php endif; ?>
                </tbody>
            </table>
            <input type="hidden" name="task" value=""/>
            <input type="hidden" name="boxchecked" value="0"/>
		    <?php echo \JHtml::_('form.token'); ?>
        </div>
    </div>
</form>