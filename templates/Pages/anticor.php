
<main>
    <div class="container">
        <div class="wrapper-parent">
            <div class="wrapper">
                <div class="wrapper-col">
                    <section class="media">
                        <div class="media__container block">
                            <ul class="breadcrumbs">
                                <li>
                                    <a  href="/<?= $lang ?>"><?= __('Главная') ?></a>
                                </li>
                                <li>
                                    <a href="#"><?= $page['title'] ?></a>
                                </li>
                            </ul>
                            <div class="media__text">
                                <?php if ($docs): ?>
                                    <div class="inner__text">
                                        <?php foreach ($docs as $index => $doc): ?>
                                            <?php if ($index < 2): ?>
                                                <p><a href="/files/docs/<?= $doc['doc'] ?>"><?= $doc['title'] ?></a></p>
                                            <?php else: ?>
                                                <p><?= $index - 1 ?>. <a href="/files/docs/<?= $doc['doc'] ?>"><?= $doc['title'] ?></a></p>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</main>
