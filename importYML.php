<?php require_once 'header.php'; ?>
<section>
    <div class="container">
        <div class="step-back">
            <a href="/selectWidget.php"><i class="fas fa-chevron-circle-left"></i> Назад</a>
        </div>
        <div class="row">
        	<div class="col-md-4">
                <div class="block">
                    <b class="block-title">Зачем нужен импорт?</b>
                    Бла-бла-бла
                </div>
                <div class="block mt-4">
                    <b class="block-title">Что такое YML?</b>
                    YML (Yandex Market Language) — особый стандарт, разработанный Яндексом для принятия и размещения информации в базе данных Яндекс. Маркет.
                </div>
            </div>
        	<div class="col-md-8">
        		<div class="page-title">
        			<h2 class="page-title-inner">Импорт товарных предложений</h2>
        		</div>
        		
                <form onsubmit="importing.yml(event, this)">
                    <div class="form-group">
                        <label>Выберите категорию</label>
                        <select class="form-control product-category" name="id_product"></select>
                        <small class="form-text text-muted">
                            Это продукт, который вы будете предлагать клиентам. Вы можете создать новый продукт, а можете использовать уже существующий, если для разных типов продуктов у нас настроены разные товарные предложения (с разной стоимостью)
                        </small>
                    </div>
                    <div class="form-group">
                        <label>Выберите платежный шлюз</label>
                        <select type="text" class="form-control gateway-name" name="id_shop" placeholder="Платежные шлюзы"></select>
                    </div>
                    <div class="form-group">
                        <label>URL фида</label>
                        <input type="text" name="url" class="form-control">
                        <small class="form-text text-muted">Ссылка на XML-файл</small>
                    </div>
                    <div class="currency form-group">
                        <label for="">Срок доставки</label>
                        <div class="input-group">
                            <input type="number" id="shipping" name="shipping" class="form-control" value="1">
                            <div class="input-group-append">
                                <span class="input-group-text">дней</span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row mt-3 align-items-center">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-action mr-2">Отправить</button>
                            <span class="error"></span>
                        </div>
                    </div>
                </form>

        	</div>
        </div>
    </div>
</section>
<?php $page = 'import'; ?>
<?php require_once 'footer.php'; ?>