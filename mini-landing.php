<?php require_once 'header.php'; ?>
<script>
	var edit = false;
</script>
<section>
	<div class="container">
		<div class="step-back">
			<a href="/selectWidget.php"><i class="fas fa-chevron-circle-left"></i> Назад</a>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="block">
					<b class="block-title">Зачем вам нужны лендигн?</b>
					<div>Бла бла бла бла</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="page-title">
					<h2 class="page-title-inner">Шаг 1 - Базовые настройки</h2>
					<button type="submit" class="page-title-button btn btn-action" data-fancybox data-type="ajax" data-src="/modal/addLanding.php"><i class="fal fa-fw fa-plus"></i>Новый лендинг</button>
				</div>
				<table class="table table-sm">
					<thead>
						<tr style="line-height: 2;">
							<th scope="col">Наименование</th>
							<th></th>
						</tr>
					</thead>
					<tbody class="mailingsList"></tbody>
				</table>
			</div>
		</div>
	</div>
</section>
<?php $page = 'mailings'; ?>
<?php require_once 'footer.php'; ?>