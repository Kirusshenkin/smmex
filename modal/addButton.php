<?php 
require_once '../functions.php';
$products = get_products();
$letters = ajax($apiUrl . '/chain/message/letter/all', array('Authorization' => $token, 'id_message' => $_GET['id_message']));
$letters = json_decode($letters);
$letters = json_decode($letters->data);
// print_r($letters);

$chain_id = field($_GET, 'id_chain', true);

$name = 'Новая кнопка'; 
$add_tags = '';
$remove_tags = '';

$color = "#FF0000";
$type  = "offer";
$button_type  = "letter";

$url  = "";
$display_letter_id  = false;

$display_offer_id  = false;

if(isset($_GET['id_button'])){
    $data = ajax($apiUrl . '/button/info', array('Authorization' => $token, 'id_button' => $_GET['id_button']));
    $data = json_decode($data);
    $data = json_decode($data->data);
    $data = $data[0];

    if(!$chain_id) $chain_id = $data->fields->chain;

    $name = $data->fields->name;
    $add_tags = $data->fields->add_tags;
    $remove_tags = $data->fields->remove_tags;

    $type = $data->fields->type;
    $color = $data->fields->color;
    $button_type = $data->fields->type_button;

    $url  = $data->fields->display_link;
    $display_letter_id  = $data->fields->display_letter;

    $display_offer_id  = $data->fields->display_offer;
}else{
    $buttons = ajax($apiUrl . '/button/all', array('Authorization' => $token, 'id_chain' => $_GET['id_chain']));
    $buttons = json_decode($buttons);
    $buttons = json_decode($buttons->data);
    // print_r($buttons);
}

?>
<form onsubmit="saveButton(event, this)" class="create-button" style="padding: 10px;width: 600px;">
    <input type="hidden" name="id_chain" value="<?=$chain_id?>">
    <input type="hidden" name="id_message" value="<?=field($_GET, 'id_message')?>">
    <input type="hidden" name="id_letter" value="<?=field($_GET, 'id_letter')?>">
    <input type="hidden" name="id_button" value="<?=field($_GET, 'id_button')?>">

    <input type="hidden" name="type" value="<?=$type?>">
    <input type="hidden" name="type_button" value="<?=$button_type?>">

    <div class="form-group">
        <label for="button-name">Название</label>
        <input type="text" id="button-name" class="form-control button-name" name="name" value="<?=$name?>">
    </div>
    <div class="form-group">
        <label for="button-add_tags">Добавить теги</label>
        <input type="text" id="button-add_tags" class="form-control button-add_tags" name="add_tags" value="<?=$add_tags?>">
    </div>
    <div class="form-group">
        <label for="button-remove_tags">Удалить теги</label>
        <input type="text" id="button-remove_tags" class="form-control button-remove_tags" name="remove_tags" value="<?=$remove_tags?>">
    </div>
    <div class="form-group">
        <label>Цвет кнопки</label>
        <div class="color-select">
            <div class="color-variant">
                <input type="radio" id="color-red" class="form-control" name="color" value="#FF0000" <?php if($color == '#FF0000'){ ?>checked <?php } ?>>
                <label for="color-red" style="background: #FF0000"></label>
            </div>

            <div class="color-variant">
                <input type="radio" id="color-green" class="form-control" name="color" value="#00FF00" <?php if($color == '#00FF00'){ ?>checked <?php } ?>>
                <label for="color-green" style="background: #00FF00"></label>
            </div>

            <div class="color-variant">
                <input type="radio" id="color-blue" class="form-control" name="color" value="#0000FF" <?php if($color == '#0000FF'){ ?>checked <?php } ?>>
                <label for="color-blue" style="background: #0000FF"></label>
            </div>
        </div>
        <small class="form-text text-muted">Цвет кнопки для VK стандартный цвет синий, для Viber - фиолетовый.</small>
    </div>
    <div class="create-button-tabs">
        <div class="create-button-header">
            <div class="create-button-header__item <?php if($type == 'button'){ ?>active<?php } ?> js-tab-trigger" data-tab="1" data-type="button">Кнопка</div>
            <?php if(!isset($_GET['id_button'])){ ?>
                <div class="create-button-header__item <?php if($type == 'inherit'){ ?>active<?php } ?> js-tab-trigger" data-tab="2" data-type="inherit">Существующая</div>
            <?php } ?>
            <div class="create-button-header__item <?php if($type == 'offer'){ ?>active<?php } ?> js-tab-trigger" data-tab="3" data-type="offer">Товар</div>
        </div>
    </div>
    <div class="create-button-tabs-content">
        <div class="create-button-tabs-content__item <?php if($type == 'button'){ ?>active<?php } ?> js-tab-content" data-tab="1">
            <div class="form-group">
                <div class="form-check col-md-6">
                    <input type="radio" class="form-check-input" name="button_type" value="link" id="url" <?php if($button_type == 'link'){ ?>checked<?php } ?>>
                    <label class="form-check-label" for="url">Ссылка</label>
                </div>
                <div class="form-check col-md-6">
                    <input type="radio" class="form-check-input" name="button_type" value="letter" id="answer" <?php if($button_type == 'letter'){ ?>checked<?php } ?>>
                    <label class="form-check-label" for="answer">Ответ</label>
                </div>
            </div>
            <div class="form-group button_type-link" <?php if($button_type == 'letter'){ ?>style="display: none;"<?php } ?>>
                <label for="link">URL:</label>
                <input type="text" id="link" name="link" class="form-control" placeholder="URL-адрес можно с UTM" value="<?=$url?>">
            </div>
            <div class="form-group button_type-letter" <?php if($button_type == 'link'){ ?>style="display: none;"<?php } ?>>
                <label for="next_letter_id">Выберите сообщение:</label>
                <select id="next_letter_id" name="next_letter_id" class="form-control">
                    <?php foreach($letters as $item){ ?>
                        <option value="<?=$item->pk?>" <?php if($item->pk == $display_letter_id){ ?>selected<?php } ?>><?=$item->fields->name?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class=" create-button-tabs-content__item <?php if($type == 'inherit'){ ?>active<?php } ?> js-tab-content" data-tab="2">
            <div class="form-group">
                <label for="button_id">Выберите кнопку:</label>
                <select id="button_id" name="button_id" class="form-control">
                    <?php foreach($buttons as $item){ ?>
                        <option value="<?=$item->pk?>"><?=$item->fields->name?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="create-button-tabs-content__item <?php if($type == 'offer'){ ?>active<?php } ?> js-tab-content" data-tab="3">
            <div class="form-group">
                <label for="product">Выберите товар:</label>
                <select id="product" name="id_offer" class="form-control">
                    <?php foreach($products as $item){ ?>
                        <?php $item = json_decode($item->offer)[0]; ?>
                        <option value="<?=$item->pk?>" <?php if($item->pk == $display_offer_id){ ?>selected<?php } ?>><?=$item->fields->name?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group mt-3">
        <button class="btn btn-action">Сохранить</button>
        <button class="btn submit-btn">Отменить</button>
    </div>
</form>