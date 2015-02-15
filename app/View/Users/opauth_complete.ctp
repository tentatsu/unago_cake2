<?php pr($this->request->data); ?>
	<div class="user_info">
		<?php echo $this->Form->create('User', array('class' => 'form-horizontal'));?>
		<table>
			<tr>
				<th>メールアドレス</th>
				<td><?php
					echo $this->Form->input('email', array(
							'required' => 'required',
							'class' => 'long',
							'label' => false
						)
					);
					?>
				</td>
			</tr>
			<tr>
				<th>ニックネーム</th>
				<td><?php
					echo $this->Form->input('nickname', array(
							'required' => 'required',
							'class' => 'long',
							'label' => false,
						)
					);
					?>
				</td>
			</tr>
			<tr>
				<th>都道府県</th>
				<td><?php
					echo $this->Form->input('prefecture_id', array(
							'type' => 'select',
							'label' => false,
							'options' => $prefecture,
							'required' => 'required'
						)
					);
					?>
				</td>
			</tr>
		</table>
		<p>
			<?php echo $this->Form->submit('更新する');?>
		</p>
		<?php echo $this->Form->end();?>
	</div>