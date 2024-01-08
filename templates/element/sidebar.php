<aside class="aside">
	<div class="aside__container">
		<?php if( $sidebar_fixed ): ?>
			<div class="aside__primery primery">
				<div class="aside__title title">
					<h2><?= __('Важное') ?></h2>
				</div>
				<div class="cards">
					<a class="card card_lg" href="/<?= $lang ?><?= $categories_slug_parts[$full_categories[$sidebar_fixed['category_id']]['alias']] ?>/<?= $sidebar_fixed['alias'] ?>">
						<div class="card__img">
							<img src="/img/articles/<?= $sidebar_fixed['img'] ?>" alt="">
						</div>
						<div class="card__description">
							<?php if( $sidebar_fixed['rubric'] ): ?>
								<span class="card__type"><?= $sidebar_fixed['rubric']['title'] ?></span>
							<?php endif; ?>
							<h5 class="card__caption"><?= $sidebar_fixed['title'] ?></h5>
							<div class="card__elements">
								<div class="card__date card__elem">
									<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M15.8333 3.33333H4.16667C3.24619 3.33333 2.5 4.07952 2.5 4.99999V16.6667C2.5 17.5871 3.24619 18.3333 4.16667 18.3333H15.8333C16.7538 18.3333 17.5 17.5871 17.5 16.6667V4.99999C17.5 4.07952 16.7538 3.33333 15.8333 3.33333Z" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M13.3333 1.66667V5.00001" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M6.66666 1.66667V5.00001" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M2.5 8.33333H17.5" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
									<span><?= $this->Time->format($sidebar_fixed['date'], 'dd.MM.yyyy HH:mm') ?></span>
								</div>
								<div class="card__view card__elem">
									<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
										<g clip-path="url(#clip0_1_116)">
										<path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 10C18.3334 5.39763 14.6024 1.66667 10 1.66667C5.39765 1.66667 1.66669 5.39763 1.66669 10C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M10 5V10L13.3333 11.6667" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										</g>
										<defs>
										<clipPath id="clip0_1_116">
										<rect width="20" height="20" fill="white"/>
										</clipPath>
										</defs>
									</svg>
									<span><?= number_format($sidebar_fixed['reading_time'], 0, '', ' ') ?> мин.</span>
								</div>
							</div>
							<div class="card__txt"><?= $sidebar_fixed['short_desc'] ?></div>
						</div>
					</a>
				</div>
			</div>
		<?php endif; ?>
		<?php if( $last_news ): ?>
			<div class="aside__news">
				<div class="aside__title title">
					<h2><?= __('Новости') ?></h2>
				</div>
				<div class="cards">
					<?php foreach( $last_news as $item ): ?>
						<a class="card" href="/<?= $lang ?>news/<?= $item['alias'] ?>">
							<div class="card__img">
								<img src="/img/articles/thumbs/<?= $item['img'] ?>" alt="">
							</div>
							<div class="card__description">
								<?php if( $item['rubric'] ): ?>
									<span class="card__type"><?= $item['rubric']['title'] ?></span>
								<?php endif; ?>
								<h5 class="card__caption"><?= $item['title'] ?></h5>
								<div class="card__elements">
									<div class="card__date card__elem">
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M15.8333 3.33333H4.16667C3.24619 3.33333 2.5 4.07952 2.5 4.99999V16.6667C2.5 17.5871 3.24619 18.3333 4.16667 18.3333H15.8333C16.7538 18.3333 17.5 17.5871 17.5 16.6667V4.99999C17.5 4.07952 16.7538 3.33333 15.8333 3.33333Z" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M13.3333 1.66667V5.00001" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M6.66666 1.66667V5.00001" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M2.5 8.33333H17.5" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
										<span><?= $this->Time->format($item['date'], 'dd.MM.yyyy HH:mm') ?></span>
									</div>
									<div class="card__view card__elem">
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
											<g clip-path="url(#clip0_1_116)">
											<path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 10C18.3334 5.39763 14.6024 1.66667 10 1.66667C5.39765 1.66667 1.66669 5.39763 1.66669 10C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M10 5V10L13.3333 11.6667" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											</g>
											<defs>
											<clipPath id="clip0_1_116">
											<rect width="20" height="20" fill="white"/>
											</clipPath>
											</defs>
										</svg>
										<span><?= number_format($item['reading_time'], 0, '', ' ') ?> мин.</span>
									</div>
								</div>
								<div class="card__txt"><?= $item['short_desc'] ?></div>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if( $sidebar_blocks ): ?>
			<div class="aside__promo promo promo_sm">
				<div class="promo__container">
					<?php foreach( $sidebar_blocks as $item ): ?>
						<a class="promo__img" href="<?= $item['link'] ?>" target="_blank">
							<img src="/img/blocks/<?= $item['img'] ?>" alt="">
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if( $most_popular ): ?>
			<div class="aside__popular">
				<div class="aside__title title">
					<h2><?= __('Популярное') ?></h2>
				</div>
				<div class="cards">
					<?php foreach( $most_popular as $item ): ?>
						<a class="card" href="/<?= $lang ?><?= $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>">
							<div class="card__img">
								<img src="/img/articles/thumbs/<?= $item['img'] ?>" alt="">
							</div>
							<div class="card__description">
								<?php if( $item['rubric'] ): ?>
									<span class="card__type"><?= $item['rubric']['title'] ?></span>
								<?php endif; ?>
								<h5 class="card__caption"><?= $item['title'] ?></h5>
								<div class="card__elements">
									<div class="card__date card__elem">
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M15.8333 3.33333H4.16667C3.24619 3.33333 2.5 4.07952 2.5 4.99999V16.6667C2.5 17.5871 3.24619 18.3333 4.16667 18.3333H15.8333C16.7538 18.3333 17.5 17.5871 17.5 16.6667V4.99999C17.5 4.07952 16.7538 3.33333 15.8333 3.33333Z" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M13.3333 1.66667V5.00001" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M6.66666 1.66667V5.00001" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M2.5 8.33333H17.5" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
										<span><?= $this->Time->format($item['date'], 'dd.MM.yyyy HH:mm') ?></span>
									</div>
									<div class="card__view card__elem">
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
											<g clip-path="url(#clip0_1_116)">
											<path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 10C18.3334 5.39763 14.6024 1.66667 10 1.66667C5.39765 1.66667 1.66669 5.39763 1.66669 10C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M10 5V10L13.3333 11.6667" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											</g>
											<defs>
											<clipPath id="clip0_1_116">
											<rect width="20" height="20" fill="white"/>
											</clipPath>
											</defs>
										</svg>
										<span><?= number_format($item['reading_time'], 0, '', ' ') ?> мин.</span>
									</div>
								</div>
								<div class="card__txt"><?= $item['short_desc'] ?></div>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</aside>