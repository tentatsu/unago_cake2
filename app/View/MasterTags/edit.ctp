<div class="masterTags form">
	<?php echo $this->Form->create('MasterTag', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Edit Master Tag'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('master_id');
		echo $this->Form->input('name');
		echo $this->Form->input('other_name');
		echo $this->Form->input('comment');
		echo $this->Form->input('sort_no');
		echo $this->Form->input('tag_count');
		echo $this->Form->hidden('Image.0.id', array('type' => 'file'));
		echo $this->Form->input('Image.0.images', array('type' => 'file'));
		echo $this->Form->hidden('Image.0.model', array('value'=>'MasterTag'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MasterTag.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('MasterTag.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Master Tags'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Movie Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
