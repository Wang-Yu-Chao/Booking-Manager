<?php
defined('_JEXEC') or die;

\JHtml::_('formbehavior.chosen', 'select');

$listOrder  = $this->escape($this->state->get('list.ordering'));
$listDirn   = $this->escape($this->state->get('list.direction'));
?>
<form action="index.php?option=com_bookingmanager&view=customers" method="post" id="adminForm" name="adminForm">
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
					<th width="2%"><?php echo \JText::_('COM_BOOKINGMANAGER_CUSTOMERS_NUM'); ?>
					</th>
					<th width="4%">
						<?php echo \JHtml::_('grid.checkall'); ?>
					</th>
					<th width="45%">
						<?php echo \JHtml::_('searchtools.sort', 'COM_BOOKINGMANAGER_CUSTOMERS_NAME', 'name', $listDirn, $listOrder); ?>
					</th>
					<th width="45%">
						<?php echo \JHtml::_('searchtools.sort', 'COM_BOOKINGMANAGER_CUSTOMERS_EMAIL', 'email', $listDirn, $listOrder) ?>
					</th>
					<th width="4%">
						<?php echo \JHtml::_('searchtools.sort', 'COM_BOOKINGMANAGER_CUSTOMERS_ID', 'id', $listDirn, $listOrder) ?>
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
						$link = \JRoute::_('index.php?option=com_bookingmanager&task=customer.edit&id=' . $row->id);
                        ?>
						<tr>
							<td>
								<?php echo $this->pagination->getRowOffset($i); ?>
							</td>
							<td>
								<?php echo \JHtml::_('grid.id', $i, $row->id); ?>
							</td>
							<td>
                                <a href="<?= $link ?>" title="<?= \JText::_('COM_BOOKINGMANAGER_EDIT_CUSTOMER'); ?>">
								    <?php echo $row->name; ?>
                                </a>
							</td>
							<td>
								<?php echo $row->email; ?>
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
			<input type="hidden" name="filter_order" value="<?= $listOrder ?>">
			<input type="hidden" name="filter_order_Dir" value="<? $listDirn ?>">
			<?php echo \JHtml::_('form.token'); ?>
		</div>
	</div>
</form>