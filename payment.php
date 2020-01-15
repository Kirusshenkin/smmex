<?php require_once 'header.php'; ?>
<section>
    <div class="container">
        <div class="step-back">
            <a href="/selectWidget.php"><i class="fas fa-chevron-circle-left"></i> Назад</a>
        </div>
        <div class="row">
        	<div class="col-md-4">
                <div class="block">
                    <b class="block-title">Подписчиков: <?=$userInfo->number_clients?></b>
                    Бесплатный период до 100 подписчиков
                </div>
        	</div>
        	<div class="col-md-8">
        		<div class="page-title">
        			<h2 class="page-title-inner">Оплата</h2>
        		</div>
        		
                <div class="chain-rates row mx-md-n1"></div>

        	</div>
        </div>
    </div>
</section>
<?php $page = 'payment'; ?>
<?php require_once 'footer.php'; ?>