<?php if(isset($tg_posts) && $tg_posts): ?>
    <div class="widget__tg">
        <div class="widget__tg-block">
            <a href="<?= $comps[8]['body'] ?>" target="_blank" class="widget__tg-header">
                <?= __('Последние в нашем Telegram-канале') ?>
                <img src="/img/tg-widget-icon.png" alt="">
            </a>
            <div class="widget__tg-items">
                <?php foreach ($tg_posts as $tg_post): ?>
                    <?php if ($tg_post['title']): ?>
                        <a href="<?= $tg_post['link'] ?>" target="_blank" class="widget__tg-item">
                            <div class="widget__tg-title"><?= $tg_post['title'] ?></div>
                            <div class="widget__tg-elems">
                                <div class="widget__tg-elem">
                                    <?= date('d.m.Y | H:m', $tg_post['date']) ?>
                                </div>
                            </div>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
