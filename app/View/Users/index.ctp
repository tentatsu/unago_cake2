<?php echo $this->Html->script('swfobject'); ?>
<?php echo $this->Html->script('yt_controller'); ?>

<?php $movies = $userfavorite; ?>
	<div id="content" class="prefecture_detail">
		<h3><?php echo h($login_info['nickname']); ?>の動画</h3>
		<div class="span8">
		<?php if($userfavorite) { ?>
			<h4><a href="<?php echo $this->Html->webroot; ?>movie/<?php echo h($userfavorite[0]['Movie']['id']); ?>/">
					<?php echo h($userfavorite[0]['Movie']['title']); ?>
				</a></h4>
			<div class="main_movie text-center">
				<div id="example"></div>
			</div>
			<div class="other_movies prefecture text-center clearfix">
				<h5 class="text-left">お気に入り動画</h5>
				<?php foreach ($userfavorite as $m) { ?>

					<div class="movie_box other_movies">
						<p class="title"><small><?php echo $this->Html->link($m['Movie']['title'], '/movie/'. $m['Movie']['id']. '/');  ?></small></p>
						<p class="thumb change_movie_thumb" data-code="<?php echo $m['Movie']['movie_code']; ?>" data-second="<?php echo $m['Movie']['second']; ?>">
							<?php echo
							$this->youtube->thumbnail(
								$m['Movie']['movie_code'],
								'thumb',
								array('alt' => $m['Movie']['title'],
									'fullBase' => true,
									'escape' => false
								)
							);
							?>
							<span class="triangle"></span>
							<span class="circle"></span>
						</p>
					</div>
				<?php } ?>
			</div>
		<?php } else { ?>
			<?php $movies = $osusume; ?>
			<div class="no_movies">
				まだお気に入りに登録した動画は無いようです。
				<div class="other_movies prefecture text-center clearfix">
					<h5 class="text-left">おすすめの動画はこちら！</h5>
					<div class="main_movie text-center">
						<div id="example"></div>
					</div>

				<?php foreach ($osusume as $m) { ?>

					<div class="movie_box other_movies">
						<p class="title"><small><?php echo $this->Html->link($m['Movie']['title'], '/movie/'. $m['Movie']['id']. '/');  ?></small></p>
						<p class="thumb change_movie_thumb" data-code="<?php echo $m['Movie']['movie_code']; ?>" data-second="<?php echo $m['Movie']['second']; ?>">
							<?php echo
							$this->youtube->thumbnail(
								$m['Movie']['movie_code'],
								'thumb',
								array('alt' => $m['Movie']['title'],
									'fullBase' => true,
									'escape' => false
								)
							);
							?>
							<span class="triangle"></span>
							<span class="circle"></span>
						</p>
					</div>
				<?php } ?>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>

	<script type="text/javascript">
		var params = { allowScriptAccess: "always" };
		var atts = { id: "myytplayer", autoplay: 1 };
		swfobject.embedSWF("http://www.youtube.com/v/<?php echo $movies[0]['Movie']['movie_code']; ?>?enablejsapi=1&playerapiid=ytplayer&start=<?php echo $movies[0]['Movie']['second']; ?>",
			"example", "640", "480", "8", null, null, params, atts);
		// youtubeのハンドラ。
		// 各テンプレでそれぞれ別のことをやりたいのでここに書く。
		ytplayer = "";
		function onYouTubePlayerReady(id) {
			ytplayer = document.getElementById("myytplayer");
			ytplayer.addEventListener("onStateChange", "onytplayerStateChange");
			ytplayer.addEventListener("onError", "onPlayerError");
//			play();
		}

		function onPlayerError(errorCode) {
			alert("この動画はyoutubeから削除されました。");
		}

	</script>