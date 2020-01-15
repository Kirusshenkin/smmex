<?php require_once 'header.php' ?>
<section>
    <div class="container">
        <div class="row">
            <div class="success-menu col-md-4">
                <?php require_once 'steps.php'; ?>
            </div>
            <div class="mailing col-md-8">
                <div class="page-title">
                    <h2 class="page-title-inner">Ваши автоворонки</h2>
                    <button type="submit" class="page-title-button btn btn-action" data-fancybox data-type="ajax" data-src="/modal/selectChainType.php"><i class="fal fa-fw fa-plus"></i> Новая автоворонка</button>
                </div>
                <table class="table table-sm">
                    <thead>
                        <tr style="line-height: 2;">
                            <th scope="col">Наименование</th>
                            <th scope="col">Дата создания</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="mailing-list"></tbody>
                </table>
                <!-- <div class="mailing-lists">
                    <table style="table-layout:fixed;">
                        <caption>Статистика рассылок</caption>
                        <thead>
                            <tr>
                                <th>Название</th>
                                <th>Отправлена</th>
                                <th>Адресатов</th>
                                <th>Доставлено</th>
                                <th>Прочитали</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div> -->
            </div>
        </div>
    </div>
</section>
<?php $page = 'chains'; ?>
<?php require_once 'footer.php'; ?>