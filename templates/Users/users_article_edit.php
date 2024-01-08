<main class="section_bg regestr-main">
    <header class="reg-header">
        <div class="header-container">
            <div class="header__title__block">
                <a class="header-arrow" href="javascript:;"><img src="/img/header-arrow.svg" alt=""></a>
                <h1 class="title header-title">Рецензирование работы</h1>
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
                    <?php echo $this->Form->create($data, [
                        'type' => 'file',
                        'onsubmit' => 'submitForm()',
                    ]); ?>
                    <div class="register-form__content">
                        <div class="publish__vacancy__content">

                             <div class="publush__vacancy__input register-input">
                                <label class="auth-label">Серия</label>
                                <div><?= $journals_series[$data['article']['journals_series_id']] ?></div>
                            </div>

                            <div class="publush__vacancy__input">
                                <label class="auth-label" for="title">Название статьи</label>
                                <div class="auth-input">
                                    <?= $data['article']['title'] ?>
                                </div>
                            </div>

                            <div class="resume__bottom__block resume__bottom__block-input">
                                <label class="auth-label">Актуальность</label>
                                <?= $this->Form->textarea('actuality', array('class' => 'resume__bottom__input')); ?>
                            </div>
                            <div class="resume__bottom__block resume__bottom__block-input">
                                <label class="auth-label">Новизна</label>
                                <?= $this->Form->textarea('novelty', array('class' => 'resume__bottom__input')); ?>
                            </div>
                            <div class="resume__bottom__block resume__bottom__block-input">
                                <label class="auth-label">Оригинальность</label>
                                <?= $this->Form->textarea('originality', array('class' => 'resume__bottom__input')); ?>
                            </div>
                            <div class="resume__bottom__block resume__bottom__block-input">
                                <label class="auth-label">Инновационность</label>
                                <?= $this->Form->textarea('innovation', array('class' => 'resume__bottom__input')); ?>
                            </div>
                            <div class="resume__bottom__block resume__bottom__block-input">
                                <label class="auth-label">Структурированность</label>
                                <?= $this->Form->textarea('structure', array('class' => 'resume__bottom__input')); ?>
                            </div>
                            <div class="resume__bottom__block resume__bottom__block-input">
                                <label class="auth-label">Литературный уровень</label>
                                <?= $this->Form->textarea('lit_level', array('class' => 'resume__bottom__input')); ?>
                            </div>
                            <div class="resume__bottom__block resume__bottom__block-input">
                                <label class="auth-label">Качество оформления</label>
                                <?= $this->Form->textarea('quality', array('class' => 'resume__bottom__input')); ?>
                            </div>


                            <div class="publush__vacancy__input register-input">
                                <label class="auth-label">Статус работы</label>
                                <?= $this->Form->select('status', $users_articles_statuses, array('empty' => 'Выберите статус', 'required', 'default' => $data['status'], 'disabled' => $system_statuses,)) ?>
                            </div>


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
