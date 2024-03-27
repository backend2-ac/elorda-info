<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- <link rel="icon" href="/img/fav-icon.svg"> -->
		<link rel="icon" href="/img/favicon.png" type="image/x-icon">

		<?php if( isset($meta) && $meta['title'] ): ?>
			<title><?= $meta['title'] ?></title>
			<meta name="description" content="<?= $meta['desc'] ?>"/>
			<meta name="keywords" content="<?= $meta['keys'] ?>"/>
		<?php else: ?>
			<title>Elorda.com</title>
			<meta name="description" content=""/>
			<meta name="keywords" content=""/>
		<?php endif; ?>

		<?php if( $request['controller'] == 'Articles' && $request['action'] == 'view' ): ?>
			<?php if( isset($data) && $data ): ?>
				<meta property="og:url" content="https://<?= $_SERVER['HTTP_HOST'] ?><?= $_SERVER['REQUEST_URI'] ?>">
				<meta property="og:title" content="<?= str_replace('"', '&quot;', $data['title']) ?>">
				<meta property="og:description" content="<?= str_replace('"', '&quot;', $data['sub_title']) ?>">
				<meta property="og:image" content="https://<?= $_SERVER['HTTP_HOST'] ?>/img/articles/<?= $data['img']?>">
			<?php endif; ?>
		<?php endif; ?>

	    <!-- <link rel="stylesheet" href="/css/fancybox.css"> -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css?_v=20231128123125">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.css?_v=20231128123125">
	    <link rel="stylesheet" href="/css/style.css?_v=3.18">

	    <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>

	    <?= (isset($comps[1]['body'])) ? $comps[1]['body'] : '' ?>

	</head>
	<body>

		<!-- front 1 -->

		<?php
			$session = $this->request->getSession();
			$msg = $session->read('Flash.flash');
			$msg_type = '';
			if( $msg ){
				$msg_type = mb_substr($msg[0]['element'], 6);

				if( $msg_type == 'success' ){
					$msg_type = 'alert--active';
				} elseif( $msg_type == 'warning' ){
					$msg_type = 'alert--warning';
				} elseif( $msg_type == 'error' ){
					$msg_type = 'alert--error';
				}
			}
		?>

		<div class="alert--fixed box-size <?= ( isset($msg) && $msg[0]['message'] && $msg_type) ? $msg_type : '' ?>" hidden>
	        <div class="alert--content alert--width alert--block box-size">
	            <div class="alert--img">
	                <div class="alert--img__item active box-size">
	                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	                        viewBox="0 0 329.954 329.954" xml:space="preserve">
	                        <path id="XMLID_89_" d="M99.85,299.045c2.813,2.813,6.629,4.393,10.607,4.393c3.979,0,7.794-1.581,10.606-4.393L325.56,94.548
	                            c2.814-2.813,4.394-6.628,4.394-10.606c0-3.979-1.58-7.794-4.394-10.607l-42.427-42.426c-5.857-5.857-15.355-5.858-21.213,0
	                            L110.461,182.37l-42.428-42.428c-2.813-2.813-6.629-4.394-10.607-4.394s-7.793,1.581-10.606,4.394L4.393,182.369
	                            c-5.857,5.858-5.857,15.355,0,21.213L99.85,299.045z"/>
	                    </svg>
	                </div>
	                <div class="alert--img__item warning box-size">
	                    <svg height="512pt" viewBox="0 -18 512.00043 512" width="512pt" xmlns="http://www.w3.org/2000/svg"><path d="m241 116h30v165h-30zm0 0"/>
	                        <path d="m256 371c-8.277344 0-15 6.722656-15 15s6.722656 15 15 15 15-6.722656 15-15-6.722656-15-15-15zm0 0"/>
	                        <path d="m502.53125 364.714844-180.890625-326.011719c-13.40625-24.230469-37.941406-38.703125-65.640625-38.703125s-52.234375 14.472656-65.640625 38.714844l-180.890625 325.988281c-12.976562 23.480469-12.597656 51.28125 1.027344 74.398437 13.621094 23.101563 37.777344 36.898438 64.597656 36.898438h361.8125c26.820312 0 50.976562-13.796875 64.597656-36.898438 13.625-23.117187 14.003906-50.917968 1.027344-74.386718zm-246.53125 66.285156c-24.8125 0-45-20.1875-45-45s20.1875-45 45-45 45 20.1875 45 45-20.1875 45-45 45zm45-120h-90v-225h90zm0 0"/>
	                    </svg>
	                </div>
	                <div class="alert--img__item error box-size">
	                    <svg class="box-size" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	                        viewBox="0 0 455.111 455.111" xml:space="preserve">
	                        <circle style="fill:#E24C4B;" cx="227.556" cy="227.556" r="227.556"/>
	                        <path style="fill:#D1403F;" d="M455.111,227.556c0,125.156-102.4,227.556-227.556,227.556c-72.533,0-136.533-32.711-177.778-85.333
	                        c38.4,31.289,88.178,49.778,142.222,49.778c125.156,0,227.556-102.4,227.556-227.556c0-54.044-18.489-103.822-49.778-142.222
	                        C422.4,91.022,455.111,155.022,455.111,227.556z"/>
	                        <path style="fill:#FFFFFF;" d="M331.378,331.378c-8.533,8.533-22.756,8.533-31.289,0l-72.533-72.533l-72.533,72.533
	                        c-8.533,8.533-22.756,8.533-31.289,0c-8.533-8.533-8.533-22.756,0-31.289l72.533-72.533l-72.533-72.533
	                        c-8.533-8.533-8.533-22.756,0-31.289c8.533-8.533,22.756-8.533,31.289,0l72.533,72.533l72.533-72.533
	                        c8.533-8.533,22.756-8.533,31.289,0c8.533,8.533,8.533,22.756,0,31.289l-72.533,72.533l72.533,72.533
	                        C339.911,308.622,339.911,322.844,331.378,331.378z"/>
	                    </svg>
	                </div>
	            </div>
	            <div class="alert-text box-size">
                    <?php if (isset($msg[0])): ?>
	                <div class="alert--title box-size"><?= $msg[0]['message'] ?></div>
                    <?php endif; ?>
	                <?php if( $msg && count($msg) > 1 ): ?>
	                	<?php foreach( $msg as $index => $msg_item ): ?>
	                		<?php if( $index != 0 ): ?>
	                			<div class="alert--title box-size <?= mb_substr($msg_item['element'], 6) ?>"><?= $msg_item['message'] ?></div>
	                		<?php endif; ?>
	                	<?php endforeach; ?>
	                <?php endif; ?>
	                <!-- <div class="alert--subtitle box-size"></div> -->
	            </div>
	            <div class="alert--x alert--close box-size">
	                <svg class="box-size" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 284.559 284.559" xml:space="preserve">
	                    <path id="XMLID_90_" d="M4.394,237.739l42.427,42.427c2.812,2.813,6.629,4.394,10.606,4.394c3.978,0,7.794-1.581,10.606-4.394
	                        l74.246-74.246l74.246,74.246c2.813,2.813,6.629,4.394,10.606,4.394c3.978,0,7.794-1.581,10.607-4.394l42.427-42.427
	                        c5.858-5.858,5.858-15.355,0-21.213L205.92,142.28l74.245-74.247c2.814-2.813,4.394-6.628,4.394-10.606
	                        c0-3.979-1.58-7.794-4.394-10.607L237.739,4.393c-5.857-5.858-15.356-5.858-21.213,0.001L142.28,78.639L68.033,4.394
	                        c-5.857-5.858-15.356-5.858-21.213,0L4.394,46.82C1.58,49.633,0,53.448,0,57.426c0,3.978,1.58,7.793,4.394,10.606l74.245,74.247
	                        L4.394,216.526C-1.465,222.384-1.465,231.881,4.394,237.739z"/>
	                </svg>
	            </div>
	        </div>
	        <div class="alert--bg alert--close box-size"></div>
	    </div>
	    <?php if( isset($msg) && $msg[0]['message'] && $msg_type ){ $session->delete('Flash'); } ?>


		<?= $this->element('header') ?>

		<?= $this->fetch('content') ?>

		<?= $this->element('footer') ?>


		<!-- <div class="popup form_loader " id="form_loader ">
		    <div class="form_loader_block ">
		        <div class="form_loader_animate "></div>
		        <div class="form_loader_text " style="color: #000; ">Пожалуйста, подождите</div>
		    </div>
		</div>
		<div class="upper">
		    <div class="container">
		        <div class="upper-btn">
		            <svg width="60" height="58" viewBox="0 0 60 58" fill="none" xmlns="http://www.w3.org/2000/svg">
		                <path fill-rule="evenodd" clip-rule="evenodd" d="M55 34.6585L33.5714 13.439L33.5714 58L26.4286 58L26.4286 13.439L5 34.6585L2.57798e-06 29.7073L30 1.31134e-06L60 29.7073L55 34.6585Z" fill="#E3E0DB"/>
		            </svg>
		        </div>
		    </div>
		</div> -->




		<script src="https://code.jquery.com/jquery-3.6.0.min.js?_v=20231128123125" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js?_v=20231128123125" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js?_v=20231128123125"></script>
		<script src="/js/jquery-marquee.js?_v=20231128123125" type="text/javascript"></script>
		<script src="/js/app.js?_v=2.11"></script>

	</body>
</html>
