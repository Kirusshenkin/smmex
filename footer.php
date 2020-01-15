<!-- =========================
     FOOTER
============================== -->

<section class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="">
                    <div class="copyright-title">Информация</div>
                    <p>
                        <a href="#" data-fancybox data-type="ajax" data-src="/modal/rules.php">Условия использования</a>
                    </p>
                    <p>
                        <a href="#" data-fancybox data-type="ajax" data-src="/modal/rules.php">Правовая информация</a>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="">
                    <div class="copyright-title">Аккаунт</div>
                    <p>
                        <a href="/register.php">Регистрация</a>
                    </p>
                    <p>
                        <a href="/login.php">Вход в аккаунт</a>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="copyright-title">Поддержка</div>
                <p>
                    +7 495 123-45-34 | Москва и МО <br>
                    +7 812 123-34-45 | Санкт-Петербург и ЛО <br>
                    +7 800 300 65 67 | Регионы РФ <br>
                </p>
            </div>
            <div class="col-md-3">
                <div class="copy_right_text text-right">
                    <p>
                        ИП Горбунов А. В. <br>
                        Москва, Б. Академическая 71. <br>
                        ОГРНИП ‎317554300052514 <br>
                        ИНН ‎550201247998 <br>
                        info@smmex.ru <br>
                    </p>
                </div>
            </div>


        </div>
    </div>
</section>
<!-- END FOOTER -->

<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
<script src="/js/jv/dist/jquery.validate.js"></script>
<script src="/js/jv/src/localization/messages_ru.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="/js/auth.js"></script>
<script src="/js/main.js"></script>
<?php if (isset($page)) { ?>
    <?php if ($page == 'edit-product') { ?>
        <script src="js/edit-product.js"></script>
    <?php } ?>
    <?php if ($page == 'create_widget') { ?>
        <script src="js/create_widget.js"></script>
    <?php } ?>
    <?php if ($page == 'product-offer') { ?>
        <script src="js/offer.js"></script>
    <?php } ?>
    <?php if ($page == 'edit-product') { ?>
        <script src="js/offer.js"></script>
    <?php } ?>
    <?php if ($page == 'getting-subscribers') { ?>
        <script src="js/getting-subscribers.js"></script>
    <?php } ?>
    <?php if ($page == 'distribution') { ?>
        <!-- <script src="js/emojiarea/tether.min.js"></script> -->
        <!-- <script src="js/emojiarea/nanoscroller.min.js"></script> -->
        <!-- <script src="js/emojiarea/jquery.emojiarea.js"></script> -->
        <script src="/js/emoji.js"></script>
        <script src="/js/distribution.js"></script>
        <script src="/js/upload.js"></script>
    <?php } ?>
    <?php if ($page == 'chains') { ?>
        <script src="js/chains.js"></script>
    <?php } ?>
    <?php if ($page == 'addCategory') { ?>
        <script src="js/addCategory.js"></script>
    <?php } ?>
    <?php if ($page == 'widgets') { ?>
        <script src="js/widgets.js"></script>
    <?php } ?>
    <?php if ($page == 'mailings') { ?>
        <script src="js/mailing.js"></script>
    <?php } ?>
    <?php if ($page == 'payment') { ?>
        <script src="js/payment.js"></script>
    <?php } ?>
    <?php if ($page == 'dialog') { ?>
        <script src="js/dialog.js"></script>
    <?php } ?>
    <?php if ($page == 'import') { ?>
        <script src="/js/import.js"></script>
    <?php } ?>
    <?php if ($page == 'miniLanding') { ?>
        <script src="js/emoji.js"></script>
        <script>
            var emojiPicker = new EmojiPicker('.test-emoji');
        </script>
    <?php } ?>
<?php } ?>
<script src="https://smmex.ru/api.js"></script>
<div data-smmex="links" data-view-type="2" data-user-id="2" data-widget-id="22">
    </body>

    </html>