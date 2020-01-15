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
	var edit_id_mailing = <?= $id_mailing; ?>;
	var edit_id_channel = '<?= field($data->fields, 'channel') ?>';
	var edit_id_category = '<?= field($data->fields, 'product') ?>';
</script>
<section class="mb-4">
	<div class="container">
		<div class="row">
			<div class="success-menu col-md-6">
				<div class="page-title">
					<?php if (isset($_GET['id'])) { ?>
						<h2 class="page-title-inner">Редактирование рассылки "<?= $data->fields->name ?>"</h2>
					<?php } else { ?>
						<h2 class="page-title-inner">Создание рассылки</h2>
					<?php } ?>
				</div>
				<div class="block mb-4">
					<div class="form-group">
						<div class="block-step block-step_2">
							<div class="step-desc">
								<b>Изображение или видео</b>
								<div class="step-text">Рекомендованный размер 1200х300px, до 10mb</div>
								<div class="step-text">Добавьте картинку или видео, чтобы привлечь внимание посетителя.</div>
							</div>
							<div class="step-list">
								<div class="step-list__radio">

									<div class="form-group">
										<div class="row">
											<div class="form-check col-md-7">
												<input type="radio" class="form-check-input" name="button_type" value="link" id="url">
												<label class="form-check-label" for="url">Ссылка на изображение / YouTube видео</label>
											</div>
											<div class="form-check col-md-5">
												<input type="radio" class="form-check-input" name="button_type" value="letter" id="answer" checked="">
												<label class="form-check-label" for="answer">Загрузить изображение</label>
											</div>
										</div>
									</div>

									<input type="text" id="link" name="link" class="form-control button_type button_type-link" placeholder="" value="">
									<input type="file" id="label" name="label" ckass="button_type button_type-letter">

								</div>
								<div class="step-list__input">

								</div>
							</div>

							<div class="media-title"><b>Заголовок</b></div>
							<div class="media-desc">Сформулируйте кратко — что получит клиент при подписке.</div>

							<div class="form-group">
								<input type="text" class="form-control" name="name-landing" placeholder="" style="background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
								<small class="form-text text-muted">
									Придумайте название вашего товарного предложения в вашем личном кабинете. Его видеть будете только вы. Он понадобится, чтобы вы могли найти его в списке ваших
								</small>
							</div>

							<div class="media-title"><b>Описание</b></div>
							<div class="text-muted">Замотивируйте вашего клиента подписаться. Опишите подробнее, чем ему будет полезна ваша рассылка, что он получит в результате и почему это нужно сделать прямо сейчас.</div>

							<div class="test-emoji emoji" style="position: relative;">
								<textarea class="form-control letter-body" cols="60" rows="10"></textarea>
								<div class="emoji-panel">
									<div class="emoji-panel-tabs">
										<div class="emoji-panel-header" data-category="0">
											<i class="fas fa-smile"></i>
										</div>
										<div class="emoji-panel-header" data-category="1">
											<i class="fas fa-sun"></i>
										</div>
										<div class="emoji-panel-header" data-category="2">
											<i class="fas fa-utensils"></i>
										</div>
										<div class="emoji-panel-header" data-category="3">
											<i class="fas fa-hashtag"></i>
										</div>
										<div class="emoji-panel-header" data-category="4">
											<i class="fas fa-lightbulb"></i>
										</div>
										<div class="emoji-panel-header emoji-panel-control">
											<i class="fal fa-smile"></i>
										</div>
									</div>
									<div class="emoji-panel-list">
										<span class="emoji-panel-item" role="button"></span>
									</div>
								</div>
							</div>
						</div>

						<div class="block-step block-step_3">
							<div class="step-desc">
								<b>Скрипты для веб-аналитики и ретаргетинга</b>
							</div>
							<div class="form-group step-script">
								<label>
									<span>Яндекс.Метрика</span>
									<input type="text" class="form-control" placeholder="Укажите номер вашего счетчика Яндекс.Метрики" style="background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
								</label>
								<label>
									<span>Google Analytics</span>
									<input type="text" class="form-control" placeholder="Укажите Идентификатор отслеживания Google Analytics" style="background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
								</label>
								<label>
									<span>Пиксель ВКонтакте</span>
									<input type="text" class="form-control" placeholder="Введите уникальный Код пикселя ретаргетинга ВК" style="background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
								</label>
								<label>
									<span>Пиксель Facebook</span>
									<input type="text" class="form-control" placeholder="Введите идентификатор пикселя" style="background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
								</label>
							</div>
						</div>
						<button type="submit" class="btn ml-2 submit-btn">Сохранить</button>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="visual-landing">
					<h2 class="page-title-inner">Предпросмотр лендинга</h2>
					<img src="/img/steps_bg.png" class="visual-landing__img" alt="Изображение лендинг">
					<div class="visual-landing__title-contant">СКИДКИ, АКЦИИ, СПЕЦПРЕДЛОЖЕНИЯ!</div>
					<div class="visual-landing__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur asperiores exercitationem consequuntur deleniti ratione veniam dolorem dolore aspernatur ipsum recusandae.</div>
					<div class="visual-landing__link-title">Ссылка на лендинг:</div>
					<a href="#" class="visual-landing__link">https://lp.textback.ru/4a008109-c0bc-9ecd-51f7-016f7b0d9c38</a>
				</div>

				<form onsubmit="mailings.save(event, this)">
					<input type="hidden" name="state_time" value="2019-10-29T10:46:44.186Z">
				</form>
			</div>
		</div>
	</div>
</section>
<?php $page = 'miniLanding'; ?>
<?php require_once 'footer.php' ?>