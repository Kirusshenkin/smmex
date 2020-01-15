<?php require_once 'header.php'; ?>
<section>
    <div class="container">
        <div class="step-back">
            <a href="/selectWidget.php"><i class="fas fa-chevron-circle-left"></i> Назад</a>
        </div>
        <div class="row">
        	<div class="col-md-4">
                <div class="block">
                    <b class="block-title">Зачем вам виджет подписки?</b>
                    <div>Установите виджет подписки на сайт, чтобы клиенты подписывались на вас через мессенджеры. Подписка происходит в 1 клик без ввода email. Сообщения в мессенджерах открывает 80% получателей, это в 3,5 раза больше, чем в email.</div>
                </div>
        	</div>
        	<div class="col-md-8">
        		<div class="page-title">
        			<h2 class="page-title-inner">Виджеты подписки</h2>
        			<a href="#" class="btn btn-action" data-fancybox data-type="ajax" data-src="/modal/widgetCreate.php"><i class="fal fa-fw fa-plus"></i> Новый Виджет</a>
        		</div>
        		<table class="table table-sm">
                    <thead>
                        <tr style="line-height: 2;">
                        	<th scope="col">Наименование</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="widgetsList"></tbody>
                </table>
        	</div>
        </div>
    </div>
</section>
<?php $page = 'widgets'; ?>
<?php require_once 'footer.php'; ?>