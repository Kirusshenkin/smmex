<form onsubmit="mailings.create(event, this)">
	<div class="form-group text-center">
		<label>Название лендинга</label>
		<input type="text" name="name" class="form-control">
	</div>
	<button class="btn home-btn btn-warning btn-block">Сохранить</button>
	<!-- <input type="hidden" name="Authorization" value="<?= $apiUrl ?>"> -->
</form>