<div class="beers view">
<h2><?php echo __('Beer');?></h2>
	<dl>
		<dt>画像 </dt>
		<dd>
			<?php echo $this->AppImage->image($beer['Image'], 0); ?>
		</dd>
		<dt>サムネイル１ </dt>
		<dd>
			<?php echo $this->AppImage->thumb150($beer['Image'], 0); ?>
		</dd>
		<dt>サムネイル２ </dt>
		<dd>
			<?php echo $this->AppImage->thumb80($beer['Image'], 0); ?>
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($beer['Beer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($beer['Beer']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company'); ?></dt>
		<dd>
			<?php echo $this->Html->link($beer['Company']['name'], array('controller' => 'companies', 'action' => 'view', $beer['Company']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bitter'); ?></dt>
		<dd>
			<?php echo h($beer['Beer']['bitter']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bottle Body'); ?></dt>
		<dd>
			<?php echo h($beer['Beer']['bottle_body']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($beer['Beer']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($beer['Beer']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Beer'), array('action' => 'edit', $beer['Beer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Beer'), array('action' => 'delete', $beer['Beer']['id']), array(), __('Are you sure you want to delete # %s?', $beer['Beer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Beers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Beer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies'), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('controller' => 'companies', 'action' => 'add')); ?> </li>
	</ul>
</div>
