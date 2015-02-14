<div class="beers form">
<?php echo $this->Form->create('Beer'); ?>
	<fieldset>
		<legend><?php echo __('Edit Beer'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('company_id');
		echo $this->Form->input('bitter');
		echo $this->Form->input('bottle_body');
		echo $this->Form->hidden('Image.0.id', array('type' => 'file'));
		echo $this->Form->input('Image.0.images', array('type' => 'file'));
		echo $this->Form->hidden('Image.0.model', array('value'=>'Beer'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Beer.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Beer.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Beers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Companies'), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('controller' => 'companies', 'action' => 'add')); ?> </li>
	</ul>
</div>
