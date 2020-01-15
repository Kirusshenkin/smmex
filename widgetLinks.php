<?php require_once 'header.php'; ?>
<?php require_once 'functions.php'; ?>
<?php 

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $data = ajax($apiUrl . '/widgetli/info', array('id_widget' => $id, 'Authorization' => $token, 'id_user' => $userInfo->id));
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

$channels = ajax($apiUrl . '/channel/all', array('Authorization' => $token));
$channels = json_decode($channels);
$channels = json_decode($channels->data);

?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="page-title page-title-block">
                <h2 class="page-title-inner">Виджет подписок</h2>
            </div>
            Какая-то информация о виджете
        </div>
        <form class="widget-settings col-md-8" onsubmit="widgets.save(event, this)">
            <input type="hidden" name="id_widget" value="<?=$id?>">
            <div class="widget-settings__list row mb-3" style="width: 100%;">
                <div class="js-tab-trigger active" data-tab="1">Общее</div>
                <div class="js-tab-trigger" data-tab="2">Вшнений вид</div>
                <div class="js-tab-trigger" data-tab="3">Настройки показа</div>
            </div>
            <div class="widget-content js-tab-content active" data-tab="1">
                <div class="form-group">
                    <label for="widget-title">Название виджета:</label>
                    <input type="text" id="widget-title" name="name" class="form-control" value="<?=field($widget->fields, 'name')?>">
                </div>
                <div class="widget-content__code mb-3">
                    <p>Cкопируйте код виджета и установите на сайт перед закрывающим тегом
                        <b>&lt;/body&gt;</b>
                        на всех страницах, где он должен отображаться.</p>
                    <pre id="widgetCode"><?=$widgetCode?></pre>
                    <button onclick="copyToClipboard($('#widgetCode'));" class="btn-clipboard btn">Скопировать в буфер обмена</button>
                </div>
                <!-- <div class="widget-content__explanation">
                    <p>Из-за блокировки Telegram у пользователей могут возникать сложности с подпиской в telegram канале. Есть несколько редирект-сервисов, которые перенаправляют пользователя по ссылке с внешней площадки на вашего бота.</p>
                    <p>Это сторонние сервисы, поэтому мы не можем отвечать за их стабильную работу и безопасность. Здесь предложено несколько редирект-сервисов, чтобы в случае прекращения работы одного их них - вы могли воспользоваться другим.</p>
                    <div class="form-group">
                        <select class="form-control" style="width:60%;" name="" id="">
                            редактор для telegram
                            <option value="0">https://tgdo.me/</option>
                            <option value="1">http://t-do.ru/</option>
                            <option value="2">https://tlg.name/</option>
                            <option value="3">https://tmgo.me/</option>
                        </select>
                    </div>
                </div> -->
                <div class="mt-4 mb-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="50px"></th>
                                <th>Канал</th>
                                <th>Активность</th>
                                <th>Дополнительные настройки</th>
                            </tr>
                        </thead>
                        <tbody class="channelList">
                            <?php if(!empty($channels)){ ?>
                                <?php foreach($channels as $channel){ ?>
                                    <tr>
                                        <td><img width="24px" src="widget/img/icon_tg.svg" alt=""></td>
                                        <td><?=$channel->fields->name?></td>
                                        <td>
                                            <div class='custom-control custom-switch'>
                                                <input type='checkbox' class='custom-control-input' id='control-activ<?=$channel->pk?>' data-channel-id="<?=$channel->pk?>" onchange="widgets.channelPlug(event, this, '<?=$id?>')" <?=(in_array($channel->pk, $selectedChannelsIDs))?'checked':''?>>
                                                <label class='custom-control-label' for='control-activ<?=$channel->pk?>'></label>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- <div class="form-group">
                    <label for="successfully">Теги, навешиваемые после успешной подписки</label>
                    <input type="text" placeholder="Добавить тег" style="width:50%;" class="form-control" id="successfully">
                </div> -->

                <!-- <div class="add-widget-msg" style="width:50%;">
                    <button class="btn home-btn" id="add-btn">+ Добавить сообщение</button>
                    <div class="new-add" style="border:0px;"></div>
                </div> -->
            </div>
            <div class="js-tab-content" data-tab="2">
                <div class="col-md-12" style="padding:20px;">
                    <div class="form-group mb-3">
                        <label>Вариант показа</label>
                        <select name="" class="appearance form-control">
                            <option value="0" selected="selected">Кнопки мессенджеров</option>
                            <option value="1">Всплывающее окно</option>
                        </select>
                    </div>
                    <div class="appearance-types">
                        <div style="display:none;">
                            <h2>hello</h2>
                            <span>Lorem Lorem Lorem Lorem</span>
                        </div>
                        <div>
                            <div class="from-group mb-3">
                                <label>Внешний вид</label>
                                <select id="" class="form-control">
                                    <option value="0">Прямоугольные Кнопки</option>
                                    <option value="1">Скругленные кнопки</option>
                                    <option value="2">Иконки мессенджеров</option>
                                    <option value="3">Новый дизайн кнопок</option>
                                </select>
                            </div>
                            <div class="from-group mb-3">
                                <label>Расположение кнопок</label>
                                <select id="" class="form-control">
                                    <option value="0">По вертикали</option>
                                    <option value="1">По горизонтали</option>
                                </select>
                            </div>
                            <div class="from-group">
                                <label>Местоположение на странице</label>
                                <select id="" class="form-control">
                                    <option value="0">По центру</option>
                                    <option value="1">По левому краю</option>
                                    <option value="2">По правому краю</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="js-tab-content" data-tab="3"></div>
            <div class="step-save mt-3">
                <button class="btn btn-action home-btn">Сохранить</button>
                <a href="/widgetsLinks.php" class="btn submit-btn home-btn mr-1">Назад</a>
            </div>
        </form>
    </div>
</div>
<?php $page = 'widgets'; ?>
<?php require_once 'footer.php'; ?>