<main class="section_bg regestr-main">
    <header class="reg-header">
        <div class="header-container">
            <div class="header__title__block">
                <a class="header-arrow" href="javascript:;"><img src="/img/header-arrow.svg" alt=""></a>
                <h1 class="title header-title">Просмотр статьи</h1>
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
                    <div class="register-form__content">
                        <div class="publish__vacancy__content">

                            <div class="publush__vacancy__input register-input">
                                <label class="auth-label"><b>Серия:</b> <?= $journals_series[$data['journals_series_id']] ?></label>
                            </div>
                            <div class="publush__vacancy__input">
                                <label class="auth-label" for="title"><b>Название статьи:</b> <?= $data['title'] ?></label>
                            </div>

                            <div class="publush__vacancy__input">
                                <label class="auth-label">
                                    <b>Файл: </b>
                                    <a href="/files/articles/<?= $data['doc'] ?>" target="_blank">Просмотреть</a>
                                </label>
                            </div>

                            <div class="publush__vacancy__input">
                                <label class="auth-label" for="title"><b>Статус работы:</b> <?= $articles_statuses[$data['status']] ?></label>
                            </div>

                            <?php if( $users_articles ): ?>
                                <?php foreach( $users_articles as $index => $item ): ?>
                                    <div class="publush__vacancy__input">
                                        <label class="auth-label" for="title">Актуальность <?= ($index + 1) ?></label>
                                        <textarea class="resume__bottom__input" rows="4" disabled><?= $item['actuality'] ?></textarea>
                                    </div>
                                    <div class="publush__vacancy__input">
                                        <label class="auth-label" for="title">Новизна <?= ($index + 1) ?></label>
                                        <textarea class="resume__bottom__input" rows="4" disabled><?= $item['novelty'] ?></textarea>
                                    </div>
                                    <div class="publush__vacancy__input">
                                        <label class="auth-label" for="title">Оригинальность <?= ($index + 1) ?></label>
                                        <textarea class="resume__bottom__input" rows="4" disabled><?= $item['originality'] ?></textarea>
                                    </div>
                                    <div class="publush__vacancy__input">
                                        <label class="auth-label" for="title">Инновационность <?= ($index + 1) ?></label>
                                        <textarea class="resume__bottom__input" rows="4" disabled><?= $item['innovation'] ?></textarea>
                                    </div>
                                    <div class="publush__vacancy__input">
                                        <label class="auth-label" for="title">Структурированность <?= ($index + 1) ?></label>
                                        <textarea class="resume__bottom__input" rows="4" disabled><?= $item['structure'] ?></textarea>
                                    </div>
                                    <div class="publush__vacancy__input">
                                        <label class="auth-label" for="title">Литературный уровень <?= ($index + 1) ?></label>
                                        <textarea class="resume__bottom__input" rows="4" disabled><?= $item['lit_level'] ?></textarea>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>
                <?= $this->element('tariff_info') ?>
            </div>
        </div>
    </section>
</main>
