<div id="loginInnerWrap">
	<div class="section"><img src="images/common/bd_section.png" /></div>
	<div id="loginInner">
		<div id="loginInnerContent">
			<div id="topIcon"><img src="images/login/Icon_topIcon.png" width="100%" /></div>
			<div id="sectionTop">
				<p id="sectionTitle">パスワード再設定</p>
				<p id="sectionCaption">再設定が完了しました。</p>
			</div>

			<?php echo $this->Html->link("ログイン", array('controller' => 'owners', 'action' => 'login'), array('class' => 'halfButtonB ophv')); ?>
		</div><!-- /#loginInnerContent -->
	</div><!-- /#loginInner -->
	<div class="section"><img src="images/common/bd_section.png" /></div>
	<div class="privacy">
		<a href="#">利用規約及び個人情報に関して</a>
	</div>
</div><!-- /#loginInnerWrap -->
