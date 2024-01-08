<main>
	<section class="field">
		<div class="container">
			<div class="field__container content">
				<div class="field__box forgot-box">
					<h2 class="field__title">Смена пароля</h2>
					<?= $this->Form->create(null, ['url' => '/'.$lang.'users/pswedit', 'onsubmit' => 'submitForm()']) ?>
						<div class="field__form">
						    <div class="field__form-area grid-1">
						        <span>Введите старый пароль</span>
						        <div class="field__form-pass">
						            <input id="old-pass" class="field-input" type="password" placeholder="Старый пароль" name="old_password" required>
						            <label class="bg-pass"><input type="checkbox" class="password-checkbox"></label>
						        </div>
						    </div>
						    <div class="field__form-area grid-1">
						        <span>Введите новый пароль</span>
						        <div class="field__form-pass">
						            <input id="first-pass" class="field-input" type="password" placeholder="Новый пароль" name="new_password" required>
						            <label class="bg-pass"><input type="checkbox" class="password-checkbox"></label>
						        </div>
						    </div>
						    <div class="field__form-area grid-1">
						        <span>Повторите новый пароль</span>
						        <div class="field__form-pass">
						            <input id="second-pass" class="field-input" type="password" placeholder="Повторить пароль" name="new_password_repeat" required>
						            <label class="bg-pass"><input type="checkbox" class="password-checkbox"></label>
						        </div>
						    </div>
						    <div class="field__form-area grid-1">
						        <input type="submit" value="Обновить" class="field-submit js-field-submit">
						    </div>
						</div>
					<?= $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</section>
</main>
