<?php $this->start('meta'); ?>
<script src="/js/jquery.autocomplete.js"></script>
<link rel="stylesheet" href="/css/autocomplete-styles.css">
<?php $this->end(); ?>

<div class="beers form">
	<?php echo $this->Form->create('Beer', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Beer'); ?></legend>
		<?php
		echo $this->Form->input('name');
		echo $this->Form->input('company_id');
		echo $this->Form->input('bitter');
		echo $this->Form->input('color');
		echo $this->Form->input('kind');
		echo $this->Form->input('bottle_body');
		echo $this->Form->input('Image.0.images', array('type' => 'file'));
		echo $this->Form->hidden('Image.0.model', array('value'=>'Beer'));

		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Beers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Companies'), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('controller' => 'companies', 'action' => 'add')); ?> </li>
	</ul>
</div>
