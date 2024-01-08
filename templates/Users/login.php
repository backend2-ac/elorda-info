<main>
	<section class="field">
		<div class="container">
			<div class="field__container content">
				<div class="field__box login-box">
					<h2 class="field__title">Войти</h2>
					<?= $this->Form->create(null, ['url' => '/'.$lang.'users/login', 'onsubmit' => 'submitForm()']); ?>
						<div class="field__form">
							<div class="field__form-area grid-1">
								<span>Email</span>
								<input class="field-input" type="text" placeholder="Введите вашу почту" name="username" required>
							</div>
							<div class="field__form-area grid-1">
								<span>Пароль</span>
								<div class="field__form-pass">
									<input class="field-input" type="password" placeholder="Введите пароль" name="password" required>
									<label class="bg-pass"><input type="checkbox" class="password-checkbox"></label>
								</div>
							</div>
							<div class="field__form-area">
								<label for="save-login" class="save-login">
									<input type="checkbox" id="save-login">
									Запомнить меня
								</label>
							</div>
							<div class="field__form-area grid-1">
								<input type="submit" value="Войти" class="field-submit">
							</div>
							<div class="field__form-area grid-1 text-form">
								<label for="">Нет аккаунта?<a href="/<?= $lang ?>users/registration">Зарегистрироваться</a></label>
							</div>
							<div class="field__form-area grid-1 text-form">
								<label for="">Забыли пароль?<a href="/<?= $lang ?>users/forgetpwd">Восстановить</a></label>
							</div>
						</div>
					<?= $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</section>
</main>