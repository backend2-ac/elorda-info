<main class="section_bg regestr-main">
    <header class="reg-header">
        <div class="header-container">
            <div class="header__title__block">
                <a class="header-arrow" href="javascript:;"><img src="/img/header-arrow.svg" alt=""></a>
                <h1 class="title header-title">Добавление статьи</h1>
            </div>
            <?= $this->element('header_search_form') ?>
            <div class="header__kebab">
                <img src="/img/menukebab.svg" alt="">
            </div>
        </div>
    </header>
    <section class="register-section">
        <div class="section-container">
            <div class="registration-content">
                <div class="register-forms">
                    <?php echo $this->Form->create(null, [
                        'url' => '/'.$lang.'users/article-add',
                        'type' => 'file',
                        'onsubmit' => 'showLoader()',
                    ]); ?>
                    <div class="register-form__content">
                        <div class="publish__vacancy__content">

                            <div class="publush__vacancy__input register-input">
                                <label class="auth-label">Выбор серии</label>
                                <?= $this->Form->select('journals_series_id', $journals_series, array('empty' => 'Выберите серию', 'required')) ?>
                            </div>

                            <div class="publush__vacancy__input">
                                <label class="auth-label" for="title">Название статьи</label>
                                <input type="text" id="title" class="auth-input" name="title" required="" aria-required="true">
                                <div class="publish__input__del">
                                    <img src="/img/del.svg" alt="">
                                </div>
                            </div>

                            <div class="publush__vacancy__input">
                                <label class="auth-label">Прикрепить файл</label>
                                <?= $this->Form->input('doc', array('type' => 'file', 'accept' => 'application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document')) ?>
                            </div>

                            <!-- <div class="resume__bottom__block resume__bottom__block-input">
                                <label class="auth-label">Описание</label>
                                <textarea id="vakancy_body" class="resume__bottom__input" name="body" cols="30" rows="10"></textarea>
                            </div> -->
                            

                            <div class="publush__vacancy__input js-files-block">
                                <div class="publish__vacancy__btns">
                                    <button class="view__show__btn" type="submit">Сохранить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                   <?php echo $this->Form->end(); ?>
                </div>
                <?= $this->element('tariff_info') ?>
            </div>
        </div>
    </section>
</main>

<!-- 
<script type="text/javascript">
    CKEDITOR.replace( 'vakancy_body', {
      removePlugins: 'easyimage, about, image, imagebase, link, table, tableselection, tabletools, pastefromgdocs, pastefromword, pastetools, dialog, clipboard, a11yhelp, widget, wsc, uploadwidget, uploadimage, scayt, pastetext, specialchar, magicline, sourcearea, resize, maximize, blockquote, format, indentlist, list, htmlwriter, stylescombo, horizontalrule, undo'
    } );
</script> -->