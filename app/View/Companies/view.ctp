<div class="companies view">
<h2><?php echo __('Company'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($company['Company']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($company['Company']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($company['Company']['zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prefecture Id'); ?></dt>
		<dd>
			<?php echo h($company['Company']['prefecture_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($company['Company']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tel'); ?></dt>
		<dd>
			<?php echo h($company['Company']['tel']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($company['Company']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($company['Company']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Company'), array('action' => 'edit', $company['Company']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Company'), array('action' => 'delete', $company['Company']['id']), array(), __('Are you sure you want to delete # %s?', $company['Company']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Owners'), array('controller' => 'owners', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Owner'), array('controller' => 'owners', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Owners'); ?></h3>
	<?php if (!empty($company['Owner'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Company Id'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Last Name Kana'); ?></th>
		<th><?php echo __('First Name Kana'); ?></th>
		<th><?php echo __('Section'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Prefecture Id'); ?></th>
		<th><?php echo __('Is Open'); ?></th>
		<th><?php echo __('Password Reminder Date'); ?></th>
		<th><?php echo __('Password Reminder Token'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($company['Owner'] as $owner): ?>
		<tr>
			<td><?php echo $owner['id']; ?></td>
			<td><?php echo $owner['company_id']; ?></td>
			<td><?php echo $owner['last_name']; ?></td>
			<td><?php echo $owner['first_name']; ?></td>
			<td><?php echo $owner['last_name_kana']; ?></td>
			<td><?php echo $owner['first_name_kana']; ?></td>
			<td><?php echo $owner['section']; ?></td>
			<td><?php echo $owner['email']; ?></td>
			<td><?php echo $owner['password']; ?></td>
			<td><?php echo $owner['prefecture_id']; ?></td>
			<td><?php echo $owner['is_open']; ?></td>
			<td><?php echo $owner['password_reminder_date']; ?></td>
			<td><?php echo $owner['password_reminder_token']; ?></td>
			<td><?php echo $owner['created']; ?></td>
			<td><?php echo $owner['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'owners', 'action' => 'view', $owner['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'owners', 'action' => 'edit', $owner['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'owners', 'action' => 'delete', $owner['id']), array(), __('Are you sure you want to delete # %s?', $owner['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Owner'), array('controller' => 'owners', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
