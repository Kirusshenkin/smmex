<?php require_once 'functions.php'; ?>
<?php require_once 'header.php'; ?>
<?php

if (isset($_GET['id_offer'])) {

    $id_offer = $_GET['id_offer'];

    $data = ajax($apiUrl . '/offer/info', array('id_offer' => $id_offer, 'Authorization' => $token));
    $data = json_decode($data); // object

    if ($data->success) {

        // $data = $data[0];

        // увидеть надо чтобы понять
        // echo "<pre>";
        // print_r($data);

        // $photo = json_decode(str_replace("'", '"', @$data->fields->photo));
        // $photo_url = $photo->url;

    } else {
        header("Location: /404.php");
    }

} else {
    header("Location: /404.php");
}

?>
<script>
    var edit_id_offer = "<?php echo $_GET['id_offer']; ?>";
    var edit_id_category = "<?php echo $data->fields->product; ?>";
    var edit_id_gateway = "<?php echo @$data->fields->shop; ?>";
</script>
<section class="mb-4">
    <div class="container">
        <div class="row">
            <div class="success-menu col-md-4">
                <?php require_once 'steps.php'; ?>
            </div>
            <div class="create-prudct-description col-md-8">
                <div class="page-title">
                    <h2 class="page-title-inner">Ваши продукты</h2>
                </div>
                <table class="table table-sm">
                    <thead>
                        <tr style="line-height: 2;">
                            <th scope="col">Наименование</th>
                            <th scope="col">Категория</th>
                            <th scope="col" style="white-space:nowrap;">Цена в руб.</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="product_all"></tbody>
                </table>
                <div class="page-title mt-5">
                    <h2 class="page-title-inner">Редактирование продукта "<?= $data->fields->name ?>"</h2>
                </div>
                <form class="product-creation" enctype="multipart/form-data">
                    <input type="hidden" name="id_offer" value="<?= $_GET['id_offer'] ?>">
                    <div class="form-group">
                        <input type="text" class="form-control product-name" name="name" id="formGroupExampleInput" placeholder="Название продукта" value="<?= field($data->fields, 'name') ?>">
                        <small id="formGroupExampleInput" class="form-text text-muted">
                            Придумайте название вашего товарного предложения в вашем личном кабинете. Его видеть будете только вы. Он понадобится, чтобы вы могли найти его в списке ваших
                        </small>
                    </div>
                    <div class="form-group">
                        <label>Изображение товарного предложение</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="photo" id="photo">
                            <label class="custom-file-label" for="photo">Выберите изображение</label>
                        </div>
                        <small class="form-text text-muted ">
                            Изображение будет отображаться в рассылках
                        </small>
                        <div class="form-images">
                            <img id="blah" src="<?php echo $photo_url ?>" alt="изображение">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea name="text" id="description" class="form-control" rows="3"><?= field($data->fields, 'text') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Добавить теги</label>
                        <input type="text" class="form-control add-tags" name="add_tags" id="formGroupExampleInput" placeholder="Теги, навешиваемые после успешной оплаты" value="<?= field($data->fields, 'add_tags') ?>">
                        <small class="form-text text-muted">
                            Создайте новое письмо по тегу, после успешной оплаты, предлагайте другие свои товары покупателю, <b>через пробел</b>
                        </small>
                    </div>
                    <div class="form-group">
                        <label>Удалить теги</label>
                        <input type="text" class="form-control remove-tags" name="remove_tags" id="formGroupExampleInput" placeholder="Теги, удаляемые после успешной оплаты" value="<?= field($data->fields, 'remove_tags') ?>">
                        <small class="form-text text-muted">
                            <b>Через пробел</b>
                        </small>
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
                        <small id="formGroupExampleInput" class="form-text text-muted">
                            Это продукт, который вы будете предлагать клиентам. Вы можете создать новый продукт, а можете использовать уже существующий, если для разных типов продуктов у нас настроены разные товарные предложения (с разной стоимостью)
                        </small>
                    </div>
                    <div class="form-group">
                        <label>Выберите платежный шлюз</label>
                        <div class="row">
                            <div class="col-md-8">
                                <select type="text" class="form-control gateway-name" name="id_shop" placeholder="Платежные шлюзы"></select>
                            </div>
                            <div class="col-md-4 form-delete">
                                <button class="btn btn-action btn-warning btn-block mr-4" data-fancybox="" data-type="ajax" data-src="/modal/addGateway.php">Добавить</button>
                                <button class="btn submit-btn btn-warning btn-block delete-gat">Удалить</button>
                            </div>
                        </div>
                    </div>
                    <div class="currency form-group">
                        <label for="">Цена (в рублях)</label>
                        <input type="text" placeholder="Цена" name="price" class="form-control currency-price" value="<?= field($data->fields, 'price') ?>">
                    </div>
                    <div class="currency form-group">
                        <label for="">Срок доставки</label>
                        <div class="input-group">
                            <input type="number" id="shipping" name="shipping" class="form-control" value="<?= field($data->fields, 'shipping') ?>">
                            <div class="input-group-append">
                                <span class="input-group-text">дней</span>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-warning submit-btn create-new-product">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php $page = 'edit-product'; ?>
<?php require_once 'footer.php' ?>