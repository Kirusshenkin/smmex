<?php require_once 'functions.php'; ?>
<?php require_once 'header.php'; ?>
<?php

$id_mailing = 'false';
$data = (object) array('fields' => array('how_much' => 1, 'channel' => '', 'product' => '', 'sleep' => 60, 'use_interval' => false));
$days = array('Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье');

if (isset($_GET['id'])) {

    $id_mailing = $_GET['id'];
    $data = ajax($apiUrl . '/mailing/info', array('id_mailing' => $id_mailing, 'Authorization' => $token));
    $data = json_decode($data);

    if ($data->success) {

        $data = $data->data;
        $intervals = (array) $data->intervals;
        $data = json_decode($data->mailing);
        $data = $data[0];
        
        // увидеть надо чтобы понять
        // echo "<pre>";
        // print_r($data->fields);

    } else {
        header("Location: /404.php");
    }

} else {
    header("Location: /404.php");
}

?>
<script>
    var edit = true;
    var edit_id_mailing = <?=$id_mailing; ?>;
    var edit_id_channel = '<?=field($data->fields, 'channel')?>';
    var edit_id_category = '<?=field($data->fields, 'product')?>';
</script>
<section class="mb-4">
    <div class="container">
        <div class="row">
            <div class="success-menu col-md-4">
                <div class="page-title">
                    <?php if(isset($_GET['id'])){ ?>
                        <h2 class="page-title-inner">Редактирование рассылки "<?= $data->fields->name ?>"</h2>
                    <?php }else{ ?>
                        <h2 class="page-title-inner">Создание рассылки</h2>
                    <?php } ?>
                </div>
                <div class="block mb-4">
                    <b class="block-title">Охват</b>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi non odit laboriosam, quaerat commodi accusamus, praesentium delectus, ullam soluta eaque optio similique, dolore consectetur debitis qui laudantium! Et, velit, dolore!
                </div>
                <div class="block mb-4">
                    <b class="block-title">Статистика</b>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quis, molestias fugit harum sed iste cum enim nam. Consequuntur autem ducimus, expedita ratione dignissimos aperiam modi quasi hic numquam pariatur!
                </div>
            </div>
            <div class="col-md-8">
                <form onsubmit="mailings.save(event, this)">
                    <input type="hidden" name="id_mailing" value="<?=$id_mailing?>">
                    <div class="widget-settings__list row mb-3" style="width: 100%;">
                        <div class="js-tab-trigger active" data-tab="1">Общее</div>
                        <div class="js-tab-trigger" data-tab="2">Аудитория</div>
                        <div class="js-tab-trigger" data-tab="3">Настройки</div>
                    </div>
                    <div class="js-tab-content active" data-tab="1">
                        <div class="form-group">
                            <label for="name">Название рассылки</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= field($data->fields, 'name') ?>">
                            <small class="form-text text-muted">
                                Придумайте название вашей рассылки в вашем личном кабинете. Его будете видеть будете только вы. Он понадобится, чтобы вы могли найти его в списке ваших
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="channel">Выберите канал</label>
                            <select id="channel" name="id_channel" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            <label>Выберите категорию</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <select class="form-control product-category" name="id_category"></select>
                                </div>
                                <div class="col-md-4 form-delete">
                                    <button class="btn btn-action btn-warning btn-block mr-4" data-fancybox="" data-type="ajax" data-src="/modal/addCategory.php">Добавить</button>
                                    <button class="btn submit-btn btn-warning btn-block delete-category">Удалить</button>
                                </div>
                            </div>
                            <small class="form-text text-muted">
                                Это категория товаров, которую вы будете предлагать клиентам. Вы можете создать новую категорию, а можете использовать уже существующую.
                            </small>
                        </div>
                    </div>
                    <div class="js-tab-content" data-tab="2">
                        <div class="form-group">
                            <label for="recipients">Выберите получателей:</label>
                            <select id="recipients" name="recipients" class="form-control">
                                <option value="all" <?php if(field($data->fields, 'recipients', true) == 'all'){ ?> selected <?php } ?>>Все</option>
                                <option value="subscribe" <?php if(field($data->fields, 'recipients', true) == 'subscribe'){ ?> selected <?php } ?>>Подписчики</option>
                                <option value="unsubscribe" <?php if(field($data->fields, 'recipients', true) == 'unsubscribe'){ ?> selected <?php } ?>>Обратились в чат</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <span class="">Фильтровать</span>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="state_user" id="state_user" <?php if(field($data->fields, 'state_user', true)){?> checked <?php } ?>>
                                <label class="custom-control-label" for="state_user">Ранее не получали письма</label>
                            </div>
                            <!-- <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="date-filter">
                                <label class="custom-control-label" for="date-filter">Фильтровать по дате</label>
                            </div> -->
                        </div>
                        <div class="block mt-4 mb-4">
                            <div class="block-tags__title">Запускать рассылку при условии</div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="send_add_tag" id="send-adding-tags" <?php if(field($data->fields, 'send_add_tag', true)){?> checked <?php } ?>>
                                <label class="custom-control-label" for="send-adding-tags"> При добавлении тегов</label>
                            </div>
                            <div class="form-group adding-tags-block" <?php if(!field($data->fields, 'send_add_tag', true)){?> style="display: none" <?php } ?>>
                                <!-- <label for="adding-tags">Укажите Теги через пробел</label> -->
                                <textarea class="form-control" name="name_add_tag" cols="50" rows="3"><?=field($data->fields, 'send_add_tag')?></textarea>
                                <small class="form-text text-muted">Укажите Теги через пробел</small>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="send_del_tag" id="send-removal-tags" <?php if(field($data->fields, 'send_del_tag', true)){?> checked <?php } ?>>
                                <label class="custom-control-label" for="send-removal-tags">При снятии тегов</label>
                            </div>
                            <div class="form-group removal-tags-block" <?php if(!field($data->fields, 'send_del_tag', true)){?> style="display: none" <?php } ?>>
                                <textarea class="form-control" name="name_del_tag" cols="50" rows="3"><?=field($data->fields, 'send_del_tag')?></textarea>
                                <small class="form-text text-muted">Укажите Теги через пробел</small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="block mt-4 mb-4">
                            <div class="custom-control custom-switch time-after mb-2">
                                <span class="h4">Ограничить время отправки </span>
                                <input type="checkbox" class="custom-control-input" name="use_interval" id="rollback" <?php if(field($data->fields, 'use_interval', true)){?> checked <?php } ?>>
                                <label class="custom-control-label" for="rollback">Сообщения будут отправляться в это время, а в остальное - откладываться.</label>
                            </div>
                            <div class="restrict-send-time" <?php if(@!$data->fields->use_interval){?> style="display: none;" <?php } ?>>
                                <?php foreach($days as $day_key => $day_name){ ?>
                                <?php $start_time = (isset($intervals[$day_key]))?$intervals[$day_key]->start_time:'9:00'; ?>
                                <?php $stop_time = (isset($intervals[$day_key]))?$intervals[$day_key]->stop_time:'22:00'; ?>
                                <div class="restrict-send-time-row custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="intervals[<?=$day_key?>][enable]" id="interval-<?=$day_key?>" <?php if(isset($intervals[$day_key])){?> checked <?php } ?>>
                                    <label class="custom-control-label" for="interval-<?=$day_key?>" style="width: 20%;display: block"><b><?=$day_name?></b></label>
                                    <span for="from">c</span>
                                    <select class="custom-select" name="intervals[<?=$day_key?>][start_time]" style="width:20%;">
                                        <?php for($i=9;$i<24;$i++){ ?>
                                            <option value="<?=$i?>:00" <?php if($start_time == $i.':00'){ ?>selected<?php } ?>><?=$i?>:00</option>
                                        <?php } ?>
                                    </select>
                                    <span for="to">по</span>
                                    <select class="custom-select" name="intervals[<?=$day_key?>][stop_time]" style="width:20%;">
                                        <?php for($i=2;$i<24;$i++){ ?>
                                            <option value="<?=$i?>:00" <?php if($stop_time == $i.':00'){ ?>selected<?php } ?>><?=$i?>:00</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="js-tab-content" data-tab="3">
                        <div class="form-group">
                            <label for="sleep">Задержка</label>
                            <div class="input-group">
                                <input type="number"id="sleep" name="sleep" class="form-control" value="<?= field($data->fields, 'sleep') ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">минут</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="how_much">Количество товаров</label>
                            <input type="number"id="how_much" name="how_much" class="form-control" value="<?= field($data->fields, 'how_much') ?>">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="show_new" id="show_new" <?php if(field($data->fields, 'show_new', true)){?> checked <?php } ?>>
                                <label class="custom-control-label" for="show_new">Рассылать новинки</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="show_price" id="show_price" <?php if(field($data->fields, 'show_price', true)){?> checked <?php } ?>>
                                <label class="custom-control-label" for="show_price">Показывать цену</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="show_delivery" id="show_delivery" <?php if(field($data->fields, 'show_delivery', true)){?> checked <?php } ?>>
                                <label class="custom-control-label" for="show_delivery">Показывать время доставки</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="show_image" id="show_image" <?php if(field($data->fields, 'show_image', true)){?> checked <?php } ?>>
                                <label class="custom-control-label" for="show_image">Показывать изображение</label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="state_time" value="2019-10-29T10:46:44.186Z">
                    <div class="row">
                        <div class="col-md-6 <?php if($data->fields->active){ ?>is-active<?php } ?>" data-id="<?=$data->pk?>" data-toggle-active>
                            <button type="button" class="btn btn-action" data-active="true"><i class="fal fa-play fa-fw"></i> Включить</button>
                            <button type="button" class="btn btn-action" data-active="false"><i class="fal fa-pause fa-fw"></i> Остановить</button>
                            <button type="submit" class="btn ml-2 submit-btn">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php $page = 'mailings'; ?>
<?php require_once 'footer.php' ?>