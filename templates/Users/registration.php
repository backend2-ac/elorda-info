<main>
	<section class="field">
		<div class="container">
			<div class="field__container content">
				<div class="field__box reg-box">
					<h2 class="field__title">Регистрация</h2>
					<?= $this->Form->create(null, ['url' => '/'.$lang.'users/registration', 'onsubmit' => 'submitForm()']); ?>
						<div class="field__form">
							<div class="field__form-area grid-1 flex">
								<label for="author">
									<input type="radio" id="author" name="role" value="author" checked>
									<span>Автор</span>
								</label>
								<label for="reviewer">
									<input type="radio" id="reviewer" name="role" value="reviewer">
									<span>Рецензент</span>
								</label>
							</div>
							<div class="field__form-area">
								<span>Фамилия</span>
								<input type="text" placeholder="Введите фамилию" class="field-input" name="surname" required>
							</div>
							<div class="field__form-area">
								<span>Имя</span>
								<input type="text" placeholder="Введите ваше имя" class="field-input" name="name" required>
							</div>
							<div class="field__form-area">
								<span>Почта</span>
								<input type="email" placeholder="Введите вашу почту" class="field-input" name="username" required>
							</div>
							<div class="field__form-area">
								<span>Номер телефона</span>
								<input type="tel" placeholder="Введите номер телефона" class="field-input" name="phone" required>
							</div>
							<div class="field__form-area">
								<span>Пароль</span>
								<div class="field__form-pass">
									<input type="password" placeholder="Придумайте пароль" class="field-input" id="first-pass" name="password" required>
									<label class="bg-pass"><input type="checkbox" class="password-checkbox"></label>
								</div>
							</div>
							<div class="field__form-area">
								<span>Повторите пароль</span>
								<div class="field__form-pass">
									<input type="password" placeholder="Повторите пароль" class="field-input" id="second-pass" name="password_repeat" required>
									<label class="bg-pass"><input type="checkbox" class="password-checkbox"></label>
								</div>
							</div>
							<div class="field__form-area grid-1">
								<input type="submit" value="Зарегистрироваться" class="field-submit js-field-submit">
							</div>
							<div class="field__form-area grid-1 text-form">
								<label for="">Уже есть аккаунт?<a href="/<?= $lang ?>users/login">Войти</a></label>
							</div>
						</div>
					<?= $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</section>
</main>
