<div class="letter">
    <div class="edit-messange">
        <!-- <div class="row"> -->
        <div class="post-creation">
            <div class="post-title h4">
                Изменить сообщение
            </div>
            <!-- <div class="premium">
            <a href="premium.php">premium</a>
        </div> -->
        </div>
        <div class="form-group">
            <label for="">Название</label>
            <input type="text" class="form-control message-name" value="<?php echo $_GET['name']; ?>">
        </div>
        <!-- <div class="row"> -->
        <div class="edit-main row">
            <div class="edit-main__messange col-md-4">
                <div class="letters-list"></div>
                <button class="btn btn-action btn-block home-btn" id="add-letter" style="margin-bottom:5px;" data-message-id="<?php echo $_GET['id_message']; ?>"><i class="fas fa-plus"></i> Добавить сообщение</button>
            </div>
            <div class="edit-main__text col-md-8">
                <div class="letter-form" style="display: none;">
                    <input class="form-control letter-name" type="text">
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
                                <span class="emoji-panel-item" role="button">🐶</span>
                            </div>
                        </div>
                    </div>
                    <div class="buttons-list"></div>
                    <button class="btn btn-block btn-light" data-fancybox data-type='ajax' data-src='/modal/addButton.php?id_chain=<?=$_GET['id_chain'];?>&id_message=<?=$_GET['id_message'];?>'><i class="fas fa-plus"></i> Добавить кнопку</button>
                    <div class="files-list"></div>
                    <input id="file" type="file" onchange="upload.onFile('document', this.files);" multiple="true" size="28">
                    <!-- <i class="fas fa-paperclip mb-1 mt-1" style="font-size:24px;"></i> -->
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <button class="btn submit-btn save-message" data-message-id="<?php echo $_GET['id_message']; ?>" style="width:100%;">Сохранить</button>
            </div>
        </div>
    </div>
</div>