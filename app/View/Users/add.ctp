<?php
 echo $this->BootstrapForm->create('User', array('url' => 'add'));
 echo $this->BootstrapForm->input('username',array('label'=>'ユーザ名'));
 echo $this->BootstrapForm->input('password',array('label'=>'パスワード'));
 echo $this->BootstrapForm->input('email',array('label'=>'メールアドレス'));
 echo $this->BootstrapForm->input('profile_fields',array('label'=>'何か一言！'));
 echo $this->BootstrapForm->input('nickname',array('label'=>'ニックネーム'));
 echo $this->BootstrapForm->input('prefecture_id', array(
	'type' => 'select', 
	'options' => $prefecture,
	'required' => 'required',
	'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
);
echo $this->Form->input('controller', array('type' => 'hidden', 'value' => $controller, 'label' => 'パスワード'));
echo $this->Form->input('action', array('type' => 'hidden', 'value' => $action, 'label' => 'パスワード'));

 echo $this->Form->end('新規ユーザを作成する');
?>