<div class="beers index">
	<h2><?php echo __('Beers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('company_id'); ?></th>
			<th><?php echo $this->Paginator->sort('bitter'); ?></th>
			<th><?php echo $this->Paginator->sort('bottle_body'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($beers as $beer): ?>
	<tr>
		<td><?php echo h($beer['Beer']['id']); ?>&nbsp;</td>
		<td><?php echo h($beer['Beer']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($beer['Company']['name'], array('controller' => 'companies', 'action' => 'view', $beer['Company']['id'])); ?>
		</td>
		<td><?php echo h($beer['Beer']['bitter']); ?>&nbsp;</td>
		<td><?php echo h($beer['Beer']['bottle_body']); ?>&nbsp;</td>
		<td><?php echo h($beer['Beer']['created']); ?>&nbsp;</td>
		<td><?php echo h($beer['Beer']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $beer['Beer']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $beer['Beer']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $beer['Beer']['id']), array(), __('Are you sure you want to delete # %s?', $beer['Beer']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Beer'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Companies'), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('controller' => 'companies', 'action' => 'add')); ?> </li>
	</ul>
</div>
