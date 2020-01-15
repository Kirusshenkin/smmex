<?php require_once 'header.php' ?>
<?php

$days = array('Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье');


if (isset($_GET['id_chain'])) {

    $id_chain = $_GET['id_chain'];
    $data = ajax($apiUrl . '/chain/info', array('id_chain' => $id_chain, 'Authorization' => $token));
    $data = json_decode($data);

    if ($data->success) {

        $data = $data->data;
        $intervals = (array) $data->intervals;
        $data = json_decode($data->chain);
        $data = $data[0];
        
        // увидеть надо чтобы понять
        // echo "<pre>";
        // print_r($intervals);
        // echo "</pre>";

    } else {
        header("Location: /404.php");
    }

} else {
    header("Location: /404.php");
}


?>
<script>
    var chain = '<?=$data->pk?>';
    var id_channel = '<?=$data->fields->channel?>';
</script>
<section>
    <div class="container">
        <div class="row">
            <div class="success-menu col-md-4">
                <?php require_once 'steps.php'; ?>
            </div>
            <div class="chaining col-md-8">
                <div class="page-title">
                    <div class="page-title-inner">Редактирование автоворонки "<?=field($data->fields, 'name')?>"</div>
                </div>
                <form class="edit-chain">
                    <div class="form-group">
                        <label for="name">Наименование автоворонки:</label>
                        <input type="text" id="name" class="form-control" value="<?=field($data->fields, 'name')?>">
                    </div>
                    <div class="form-group">
                        <label for="channel">Выберите каналы:</label>
                        <select id="channel" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        <label for="recipients">Выберите получателей:</label>
                        <select id="recipients" class="form-control">
                            <option value="all" <?=(field($data->fields, 'recipients', true) == 'all')?'selected':''?>>Все</option>
                            <option value="subscribe" <?=(field($data->fields, 'recipients', true) == 'subscribe')?'selected':''?>>Подписчики</option>
                            <option value="unsubscribe" <?=(field($data->fields, 'recipients', true) == 'unsubscribe')?'selected':''?>>Обратились в чат</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <span class="">Фильтровать</span>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="filter-by-tags">
                            <label class="custom-control-label" for="filter-by-tags">Ранее не получали письма</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="not-receive">
                            <label class="custom-control-label" for="not-receive">Ранее не получали письма</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="date-filter">
                            <label class="custom-control-label" for="date-filter">Фильтровать по дате</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-for-Facebook">Выберите тип сообщения для Facebook</label>
                        <select id="message-for-Facebook" class="form-control">
                            <option value="0">Опция 1</option>
                            <option value="1">Опция 2</option>
                            <option value="2">Опция 3</option>
                            <option value="3">Опция 4</option>
                            <option value="4">Опция 5</option>
                        </select>
                    </div>
                    <div class="block mt-4 mb-4">
                        <div class="block-tags__title">Запускать автоворонку при условии</div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="send-start" class="custom-control-input" <?php if($data->fields->start_dialog){?> checked <?php } ?>>
                            <label for="send-start" class="custom-control-label"> При начале диалога</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="send-adding-tags" <?php if($data->fields->send_add_tag){?> checked <?php } ?>>
                            <label class="custom-control-label" for="send-adding-tags"> При добавлении тегов</label>
                        </div>
                        <div class="form-group adding-tags-block" <?php if(!$data->fields->send_add_tag){?> style="display: none" <?php } ?>>
                            <label for="adding-tags">Укажите Теги через пробел</label>
                            <textarea class="form-control" id="adding-tags" cols="50" rows="3"><?php echo $data->fields->name_add_tag; ?></textarea>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="send-removal-tags" <?php if($data->fields->send_del_tag){?> checked <?php } ?>>
                            <label class="custom-control-label" for="send-removal-tags">При снятии тегов</label>
                        </div>
                        <div class="form-group removal-tags-block" <?php if(!$data->fields->send_del_tag){?> style="display: none" <?php } ?>>
                            <label for="removal-tags">Укажите Теги через пробел</label>
                            <textarea class="form-control" id="removal-tags" cols="50" rows="3"><?php echo $data->fields->name_del_tag; ?></textarea>
                        </div>
                        <br>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="repeat-tags-start" class="custom-control-input" <?php if(@$data->fields->repeat_tags_start){?> checked <?php } ?>>
                            <label for="repeat-tags-start" class="custom-control-label"> Повторный запуск при добавлении тегов</label>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="block mt-4 mb-4">
                        <div class="custom-control custom-switch time-after mb-2">
                            <span class="h4">Ограничить время отправки </span>
                            <input type="checkbox" class="custom-control-input" id="rollback" <?php if($data->fields->use_interval){?> checked <?php } ?>>
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
                    <div class="clearfix"></div>
                    <div class="letter-msg block mt-4 mb-4">
                        <table class="table table-striped_">
                            <thead>
                                <tr>
                                    <th width="100px">Задержка</th>
                                    <th></th>
                                    <th>Активность</th>
                                    <th>Название сообщения</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="message-list"></tbody>
                        </table>
                        <button type="button" class="btn btn-action add-msg" style="white-space:nowrap;"><i class="fal fa-fw fa-plus"></i> Добавить сообщение</button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="control mt-2">
                        <div class="row mt-3 mb-3">
                            <div class="col-md-6 <?php if($data->fields->active){ ?>is-active<?php } ?>" data-id="<?=$data->pk?>" data-toggle-active>
                                <button type="button" class="btn btn-action" data-active="true"><i class="fal fa-play fa-fw"></i> Включить</button>
                                <button type="button" class="btn btn-action" data-active="false"><i class="fal fa-pause fa-fw"></i> Остановить</button>
                                <button href="#" class="btn ml-2 submit-btn float-right_ edit-chain">Сохранить</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" data-fancybox data-type="ajax" data-src="/modal/chainMap.php?id_chain=<?=$data->pk?>" class="btn submit-btn float-right"><i class="fal fa-sitemap mr-1"></i> Карта</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php $page = 'distribution'; ?>
<?php require_once 'footer.php' ?>