<main>
	<section class="field">
		<div class="container">
			<div class="field__container content">
				<div class="field__box forgot-box">
					<?php if( $step == 2 ): ?>
						<h2 class="field__title">Обновление пароля</h2>
					<?php else: ?>
						<h2 class="field__title">Забыли пароль</h2>
					<?php endif; ?>

					<?= $this->Form->create(null, ['onsubmit' => 'submitForm()']) ?>
						<?php if( !$step ): ?>
							<div class="field__form">
								<div class="field__form-area grid-1">
									<span>Введите электронную почту. Вам будет выслана ссылка для восстановления пароля</span>
									<input class="field-input" type="text" placeholder="Введите вашу почту" name="username" required>
								</div>
								<div class="field__form-area grid-1">
									<input class="field-submit" type="submit" value="Отправить">
								</div>
							</div>
							<div hidden style="display: none;">
								<input type="hidden" name="submit_type" value="email_code">
							</div>
						
						<?php elseif( $step == 1 ): ?>
							<div class="field__form">
								<div class="field__form-area grid-1">
									<span>Введите код подтверждения. Код был отправлен на вашу почту</span>
									<input class="field-input" type="text" placeholder="Введите код" name="code" required>
								</div>
								<div class="field__form-area grid-1">
									<input class="field-submit" type="submit" value="Отправить">
								</div>
							</div>
							<div hidden style="display: none;">
								<input type="hidden" name="submit_type" value="code_submit">
							</div>

						<?php elseif( $step == 2 ): ?>
							<div class="field__form">
							    <div class="field__form-area grid-1">
							        <span>Введите новый пароль</span>
							        <div class="field__form-pass">
							            <input id="first-pass" class="field-input" type="password" placeholder="Новый пароль" name="new_pwd" required>
							            <label class="bg-pass"><input type="checkbox" class="password-checkbox"></label>
							        </div>
							    </div>
							    <div class="field__form-area grid-1">
							        <span>Повторите новый пароль</span>
							        <div class="field__form-pass">
							            <input id="second-pass" class="field-input" type="password" placeholder="Повторить пароль" name="repeat_new_pwd" required>
							            <label class="bg-pass"><input type="checkbox" class="password-checkbox"></label>
							        </div>
							    </div>
							    <div class="field__form-area grid-1">
							        <input type="submit" value="Обновить" class="field-submit js-field-submit">
							    </div>
							</div>
							<div hidden style="display: none;">
								<input type="hidden" name="submit_type" value="pwd_submit">
							</div>

						<?php endif; ?>
					<?= $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</section>
</main>
