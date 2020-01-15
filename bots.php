<?php require_once 'header.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="step-back">
                    <a href="/"><i class="fal fa-chevron-circle-left"></i><span>Назад</span></a>
                </div>
                <div class="edit-organizations">
                    <div class="social-netwowk">
                        <div class="social-netwowk__icon-text"><i class="fab fa-fw fa-vk"></i><span>ВКонтакте</span>
                        </div>
                        <button class="btn home-btn">Редактировать</button>
                    </div>
                    <div class="social-netwowk">
                        <div class="social-netwowk__icon-text"><i class="fab fa-fw fa-telegram-plane"></i><span>Telegram</span>
                        </div>
                        <button class="btn home-btn">Редактировать</button>
                    </div>
                    <div class="social-netwowk">
                        <div class="social-netwowk__icon-text"><i class="fab fa-fw fa-viber"></i><span>Viber</span>
                        </div>
                        <button class="btn home-btn">Редактировать</button>
                    </div>
                    <div class="social-netwowk">
                        <div class="social-netwowk__icon-text"><i class="fab fa-fw fa-facebook-f"></i><span>Facebook</span>
                        </div>
                        <button class="btn home-btn">Редактировать</button>
                    </div>
                    <div class="social-netwowk">
                        <div class="social-netwowk__icon-text"><i class="fab fa-fw fa-whatsapp"></i><span>WhatsApp</span>
                        </div>
                        <button class="btn home-btn">Редактировать</button>
                    </div>
                    <div class="social-netwowk">
                        <div class="social-netwowk__icon-text"><i class="fab fa-fw fa-whatsapp"></i><span>WhatsApp Business</span>
                        </div>
                        <button class="btn home-btn">Редактировать</button>
                    </div>
                    <div class="social-netwowk">
                        <div class="social-netwowk__icon-text"><i class="fab fa-fw fa-instagram"></i><span>Instagram</span>
                        </div>
                        <button class="btn home-btn">Редактировать</button>
                    </div>
                    <div class="social-netwowk">
                        <div class="social-netwowk__icon-text"><i class="fab fa-fw fa-odnoklassniki"></i><span>Odnoklassniki</span>
                        </div>
                        <button class="btn home-btn">Редактировать</button>
                    </div>
                </div>
            </div>
            <div class="editing-information col-md-8">
                <div class="page-title">
                    <div class="h2 page-title-inner"><i class="fab fa-telegram-plane"></i>Подключенные боты - <span>Telegram</span></div>
                </div>
                <div class="information-bot">
                    <div class="information-bot__designation">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Состояние</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="channelList">
                            </tbody>
                        </table>
                    </div>
                </div>
                <form class="block create-channel mt-5">
                    <div class="form-group">
                        <label class="font-weight-bold">Новый канал</label>
                        <input type="text" class="form-control" style="margin-top:10px;" id="token-channel" placeholder="Введите токен бота Telegram">
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <button class="btn btn-action mr-2">Добавить бота</button>
                            <span class="error"></span>
                        </div>
                    </div>
                </form>
                <div class="connection mt-5">
                    <div class="connection-inner">
                        <div class="page-title page-title-block">
                            <h3 class="page-title-inner">Как подключить Telegram Бота</h3>
                        </div>
                        Подключите Telegram Бота в 3 простых шага:
                        <ol>
                            <li>Откройте приложение Telegram и через поиск перейдите в аккаунт <a href="#">@BotFather</a>, напишите команду <strong>/newbot</strong> и у вас появится бот вашей компании. Если бот у вас уже есть, то напишите команду <strong>/mybots</strong> и выберите существующий.</li>
                            <li>Задайте имя для бота. Оно должно быть на английском языке и соответствовать названию вашей компании.</li>
                            <li>Задайте юзернейм бота, это может быть сочетание имени вашего бота и слова bot. Возможны вариации: NameBot или Name_bot.</li>
                            <li>Ваш бот готов. С помощью команды <strong>/token</strong> получите ключ доступа к боту (токен). Обычно он выглядит так: 3245214234:AAsdgfgre87qJddYccR-ynswefcWz21324</li>
                            <li> Скопируйте его и добавьте его в <strong>Настройках </strong>в <a href="#">Личном кабинете TextBack</a></li>
                        </ol>
                        <div class="page-title page-title-block mt-3">
                            <h3 class="page-title-inner">Что такое Telegram Бот</h3>
                        </div>
                        Telegram Бот - это аккаунт, через который вы можете общаться с вашими клиентами в Telegram. Внешне он ничем не отличается от обычного аккаунта Telegram. Вы сможете общаться с клиентами в TextBack только через Telegram Бота, а не через личный аккаунт в Telegram. <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $page = 'getting-subscribers'; ?>
<?php require_once 'footer.php'; ?>