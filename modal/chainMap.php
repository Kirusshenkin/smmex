<?php
if(!isset($_GET['id_chain'])){
	die();
}
require_once '../functions.php';

$id_chain = $_GET['id_chain'];

$chain = ajax($apiUrl . '/chain/info', array('Authorization' => $token, 'id_chain' => $id_chain));
$chain = json_decode($chain);
$chain = json_decode($chain->data->chain)[0];

$messages = ajax($apiUrl . '/chain/message/all', array('Authorization' => $token, 'id_chain' => $id_chain));
$messages = json_decode($messages);
$messages = json_decode($messages->data);

$count_messages = count($messages);
$count_letters = 0;
$count_buttons = 0;
$count_offers = 0;
$count_files = 0;

$length = 0;

foreach($messages as $key => $item){
	$message = ajax($apiUrl . '/message/getmap', array('Authorization' => $token, 'id_message' => $item->pk));
	$message = json_decode($message);
	$message = $message->data[0];

	$messages[$key]->map = $message;

	$count_letters += $message->count_letters;
	$count_buttons += $message->count_buttons;
	$count_offers += $message->count_offers;
	$count_files += $message->count_files;

	$message = json_decode($message->message)[0];
	$length += $message->fields->sleep;
}

?>
<div class="modal" style="max-width: 800px;">
	<div class="page-title">
        <div class="page-title-inner">Карта автоворонки "<?=$chain->fields->name?>"</div>
    </div>
    <dl class="dl-horizontal row">
    	<dt class="col-md-3">Сообщений:</dt>
    	<dd class="col-md-9"><?=$count_messages?></dd>

    	<dt class="col-md-3">Писем:</dt>
    	<dd class="col-md-9"><?=$count_letters?></dd>

    	<dt class="col-md-3">Кнопок:</dt>
    	<dd class="col-md-9"><?=$count_buttons?></dd>

    	<dt class="col-md-3">Файлов:</dt>
    	<dd class="col-md-9"><?=$count_files?></dd>

    	<dt class="col-md-3">Товаров:</dt>
    	<dd class="col-md-9"><?=$count_offers?></dd>

    	<dt class="col-md-3">Общая длительность:</dt>
    	<dd class="col-md-9"><?=$length?> минут</dd>
    </dl>
    <?php
    	foreach($messages as $item){
    		$letters = $item->map->letters;
    		$message = json_decode($item->map->message)[0];
    ?>
	    <div class="page-title" style="margin-bottom: 0px;margin-top: 25px">
	        <div class="page-title-inner">Сообщение "<?=$message->fields->name?>"</div>
	    </div>
	    <div id="treeview1" class="treeview">
		    <ul class="list-group">
		    	<?php foreach($letters as $item){ ?>
		    		<?php $letter = json_decode($item->letter)[0]; ?>
			        <li class="list-group-item node-treeview1" data-nodeid="0" style="background: #f5f8fa;margin-top: 10px">
			        	<span class="icon expand-icon fal fa-envelope"></span>
			        	<span class="icon node-icon"></span>
						<div class="list-group-item__info">
				        	<div class="list-group-item__title"><b><?=$letter->fields->name?></b></div>
				        	<div class="list-group-item__text"><?=$letter->fields->body?></div>
				        </div>
				    </li>
				    <?php if(!empty($item->letter_buttons)){ ?>
				    	<?php foreach($item->letter_buttons as $button){ ?>
				    		<?php
				    			$button_info = json_decode($button->button)[0];
				    			$icon = '';
				    			$text = '';
				    			if($button_info->fields->type == 'offer'){
				    				$icon = 'fa-shopping-basket';
				    				if(!is_array($button->button_offer)){
					    				$offer_info = json_decode($button->button_offer)[0];
				    					$text = 'Товар: <a href="">' . @$offer_info->fields->name . '</a> ';
				    				}
					    		}else{
					    			if($button_info->fields->type_button == 'link'){
					    				$icon = 'fa-external-link-alt';
					    				$text = 'Ссылка: <a href="' . $button_info->fields->display_link . '">' . $button_info->fields->display_link . '</a>';
					    			}else{
					    				$answer_letter = ajax($apiUrl . '/letter/info', array('Authorization' => $token, 'id_letter' => $button_info->fields->display_letter));
										$answer_letter = json_decode($answer_letter);
										$answer_letter = $answer_letter->data;
										$answer_letter = json_decode($answer_letter->letter)[0];
					    				$icon = 'fa-reply';
					    				$text = 'Ответ: ' . $answer_letter->fields->name;
					    			}
					    		}
				    		?>
							<li class="list-group-item node-treeview1" data-nodeid="1">
					        	<span class="indent"></span>
					        	<span class="icon expand-icon fal <?=$icon?>"></span>
					        	<span class="icon node-icon"></span>
						        <div class="list-group-item__info">
						        	<div class="list-group-item__title">
						        		<b><?=$button_info->fields->name?></b> (<?=$text?>) (Добавить теги: <?=(!empty($button_info->add_tags))?$button_info->add_tags:'нет'?>) (Удалить теги: <?=(!empty($button_info->remove_tags))?$button_info->remove_tags:'нет'?>)
						        	</div>
						        </div>
						    </li>
			    		<?php } ?>
			    	<?php } ?>
				<?php } ?>
		    </ul>
		</div>
	<?php } ?>
</div>