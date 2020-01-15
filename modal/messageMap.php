<?php
if(!isset($_GET['id_message'])){
	die();
}
$id_message = $_GET['id_message'];
require_once '../functions.php';
$data = ajax($apiUrl . '/message/getmap', array('Authorization' => $token, 'id_message' => $id_message));
$data = json_decode($data);
$data = $data->data[0];

$letters = $data->letters;
$message = json_decode($data->message)[0];

$chain = ajax($apiUrl . '/chain/info', array('Authorization' => $token, 'id_chain' => $message->fields->chain));
$chain = json_decode($chain);
$chain = json_decode($chain->data->chain)[0];

// $channel = ajax($apiUrl . '/channel/info', array('Authorization' => $token, 'id_channel' => $chain->fields->channel));
// $channel = json_decode($channel);
// $channel = json_decode($channel->data)[0];
// print_r($channel);

?>
<div class="modal" style="max-width: 800px;">
	<div class="page-title">
        <div class="page-title-inner">Карта "<?=$message->fields->name?>"</div>
    </div>
    <dl class="dl-horizontal row">
    	<dt class="col-md-2">Автоворонка:</dt>
    	<dd class="col-md-9"><?=$chain->fields->name?></dd>

    	<dt class="col-md-2">Писем:</dt>
    	<dd class="col-md-9"><?=$data->count_letters?></dd>

    	<dt class="col-md-2">Кнопок:</dt>
    	<dd class="col-md-9"><?=$data->count_buttons?></dd>

    	<dt class="col-md-2">Файлов:</dt>
    	<dd class="col-md-9"><?=$data->count_files?></dd>

    	<dt class="col-md-2">Товаров:</dt>
    	<dd class="col-md-9"><?=$data->count_offers?></dd>
    </dl>
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
</div>