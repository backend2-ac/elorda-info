<main class="section_bg regestr-main">
	<header class="reg-header">
		<div class="header-container">
			<div class="header__title__block">
				<a href="javascript:;" class="header-arrow"><img src="/img/header-arrow.svg" alt=""></a>
				<h1 class="title header-title"><?= __('Смена почты') ?></h1>
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
					<div class="resume__blocks">

						<?php if( $step == 1 ): ?>
							<div class="resume__block">
								<div class="resume__top__block">
									<div class="bold_text"><?= __('Шаг 1') ?></div>
								</div>
								<?= $this->Form->create(null, ['onsubmit' => 'showLoader()']) ?>
									<div class="resume__bottom__blocks">
										<div class="resume__bottom__block" style="width: 100%;">
											<div class="pa-form__block">
												<label class="auth-label"><?= __('Введите код верификации') ?></label>
												<input class="auth-input" type="text" required="" name="code">
											</div>
										</div>
										<input type="hidden" name="submit_type" value="confirm_code">
										<div class="auth__btn">
											<input type="submit" class="auth__sumbit__btn" value="<?= __('Далее') ?>">
										</div>
									</div>
								<?= $this->Form->end(); ?>
							</div>

						<?php elseif( $step == 2 ): ?>
							<div class="resume__block">
								<div class="resume__top__block">
									<div class="bold_text"><?= __('Шаг 2') ?></div>
								</div>
								<?= $this->Form->create(null, ['onsubmit' => 'showLoader()']) ?>
									<div class="resume__bottom__blocks">
										<div class="resume__bottom__block" style="width: 100%;">
											<div class="pa-form__block">
												<label class="auth-label"><?= __('Введите новую почту') ?></label>
												<input class="auth-input" type="email" required="" name="email">
											</div>
										</div>
										<input type="hidden" name="submit_type" value="change_email">
										<div class="auth__btn">
											<input type="submit" class="auth__sumbit__btn" value="<?= __('Далее') ?>">
										</div>
									</div>
								<?= $this->Form->end(); ?>
							</div>

						<?php elseif( $step == 3 ): ?>
							<div class="resume__block">
								<div class="resume__top__block">
									<div class="bold_text"><?= __('Шаг 3') ?></div>
								</div>
								<?= $this->Form->create(null, ['onsubmit' => 'showLoader()']) ?>
									<div class="resume__bottom__blocks">
										<div class="resume__bottom__block" style="width: 100%;">
											<div class="pa-form__block">
												<label class="auth-label"><?= __('Введите код верификации новой почты') ?></label>
												<input class="auth-input" type="text" required="" name="code">
											</div>
										</div>
										<input type="hidden" name="submit_type" value="verify_email">
										<div class="auth__btn">
											<input type="submit" class="auth__sumbit__btn" value="<?= __('Далее') ?>">
										</div>
									</div>
								<?= $this->Form->end(); ?>
							</div>

						<?php endif; ?>
						
					</div>
				</div>
				<?= $this->element('vip_vakancy') ?>
			</div>
		</div>
	</section>
</main>