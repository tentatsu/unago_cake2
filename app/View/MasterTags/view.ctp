<div class="masterTags view">
<h2><?php echo __('Master Tag');?></h2>
	<dl>
		<dt>画像 </dt>
		<dd>
			<?php echo $this->AppImage->image($masterTag['Image'], 0); ?>
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($masterTag['MasterTag']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Master Id'); ?></dt>
		<dd>
			<?php echo h($masterTag['MasterTag']['master_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($masterTag['MasterTag']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Other Name'); ?></dt>
		<dd>
			<?php echo h($masterTag['MasterTag']['other_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($masterTag['MasterTag']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sort No'); ?></dt>
		<dd>
			<?php echo h($masterTag['MasterTag']['sort_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tag Count'); ?></dt>
		<dd>
			<?php echo h($masterTag['MasterTag']['tag_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($masterTag['MasterTag']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($masterTag['MasterTag']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Master Tag'), array('action' => 'edit', $masterTag['MasterTag']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Master Tag'), array('action' => 'delete', $masterTag['MasterTag']['id']), array(), __('Are you sure you want to delete # %s?', $masterTag['MasterTag']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Master Tags'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Master Tag'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Movie Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Tags'); ?></h3>
	<?php if (!empty($masterTag['MovieTag'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Master Tag Id'); ?></th>
		<th><?php echo __('Target Id'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($masterTag['MovieTag'] as $movieTag): ?>
		<tr>
			<td><?php echo $movieTag['id']; ?></td>
			<td><?php echo $movieTag['master_tag_id']; ?></td>
			<td><?php echo $movieTag['target_id']; ?></td>
			<td><?php echo $movieTag['comment']; ?></td>
			<td><?php echo $movieTag['created']; ?></td>
			<td><?php echo $movieTag['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'tags', 'action' => 'view', $movieTag['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'tags', 'action' => 'edit', $movieTag['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'tags', 'action' => 'delete', $movieTag['id']), array(), __('Are you sure you want to delete # %s?', $movieTag['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Movie Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
