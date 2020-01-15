<?php require_once 'header.php' ?>
<?php
$channels = ajax($apiUrl . '/channel/all', array('Authorization' => $token));
$channels = json_decode($channels);
$channels = json_decode($channels->data);
?>

<link rel="stylesheet" href="css/dialog.css">

<div class="container">
	<div class="row">

		<div id="frame">
			<div id="sidepanel">
				<div id="profile">
					<div class="wrap">
						<img id="profile-img" src="http://slto.ru/no_avatar.png" class="online" alt="" />
						<p class="channel-name"></p>
						<!-- <i class="fa fa-chevron-down expand-button" aria-hidden="true"></i> -->
						<div id="status-options">
							<ul>
								<?php foreach($channels as $channel){ ?>
									<li data-id="<?=$channel->pk?>" onclick="dialog.channel('<?=$channel->pk?>', '<?=$channel->fields->name?>')"><p><?=$channel->fields->name?></p></li>
								<?php } ?>
							</ul>
						</div>
						<div id="expanded">
							<label for="twitter"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></label>
							<input name="twitter" type="text" value="mikeross" />
							<label for="twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></label>
							<input name="twitter" type="text" value="ross81" />
							<label for="twitter"><i class="fa fa-instagram fa-fw" aria-hidden="true"></i></label>
							<input name="twitter" type="text" value="mike.ross" />
						</div>
					</div>
				</div>
				<div id="search">
					<label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
					<input type="text" placeholder="Найти..." />
				</div>
				<div id="contacts">
					<ul>
						
					</ul>
				</div>
				<div id="bottom-bar">
					<button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add contact</span></button>
					<button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Настройки</span></button>
				</div>
			</div>
			<div class="content" style="display: none;">
				<div class="contact-profile">
					<img src="http://slto.ru/no_avatar.png" alt="" />
					<p>Alex Safr</p>
					<div class="social-media">
						<i class="fa fa-facebook" aria-hidden="true"></i>
						<i class="fa fa-twitter" aria-hidden="true"></i>
						 <i class="fa fa-instagram" aria-hidden="true"></i>
					</div>
				</div>
				<div class="messages">
					<ul>
						
					</ul>
				</div>
				<form class="message-input" onsubmit="dialog.send(event, this)">
					<div class="wrap">
					<input type="text" placeholder="Write your message..." />
					<i class="fa fa-paperclip attachment" aria-hidden="true"></i>
					<button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>

<?php $page = 'dialog'; ?>
<?php require_once 'footer.php' ?>