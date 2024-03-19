
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $this->fetch('title'); ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/admin/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/css/admin/ionicons.min.css">
    <link rel="stylesheet" href="/css/admin/croppie.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/css/admin/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/admin/adminlte.min.css?v=1.17">
    <link rel="stylesheet" href="/js/admin/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <?php
        echo $this->Html->meta('icon');
        if(isset($login) && !empty($login)){
            // echo $this->Html->css(array('cake.generic'));
        }

        echo $this->Html->script('ckeditor/ckeditor.js');
        echo $this->fetch('meta');

        echo $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken'));
    ?>
</head>
<?php if(isset($login) && !empty($login)): ?>
    <body class="hold-transition sidebar-mini layout-fixed">
        <!-- Site wrapper -->
        <div class="wrapper">
          <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="javascript:;" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="/" class="nav-link">Перейти на сайт</a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4" >

                <a href="/" class="brand-link">
                  <img src="/img/admin_img/admin_logo.svg" alt="AdminLTE Logo" class="brand-image">
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                  <!-- Sidebar user (optional) -->
                  <?php
                  $cur_user = $this->request->getSession()->read('Auth.User');
                  $cur_user_id = $cur_user['author_id'];
                  $cur_user_role = $cur_user['role'];
                  $cur_user_name = $cur_user['username']; ?>

                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="/img/admin_img/technical-support.svg" class="img-circle " alt="User Image">
                        </div>
                        <div class="info">
                            <div class="d-block" style="color:#fff"><?php echo $cur_user_name ?></div>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <?php if( $cur_user_role == 'admin' ): ?>
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                                <li class="nav-item">
                                    <a href="/admin" class="nav-link">
                                        <i class="nav-icon fas fa-address-card"></i>
                                        <p>Панель администратора</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/requests" class="nav-link">
                                        <i class="nav-icon fab fa-elementor"></i>
                                        <p>Заявки</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/categories" class="nav-link">
                                        <i class="nav-icon fas fa-bars"></i>
                                        <p>Категории</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/articles" class="nav-link">
                                        <i class="nav-icon fas fa-newspaper"></i>
                                        <p>Статьи</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/tags" class="nav-link">
                                        <i class="nav-icon fas fa-tags"></i>
                                        <p>Теги</p>
                                    </a>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="javascript:;" class="nav-link">
                                        <i class="nav-icon fa fa-clipboard-list"></i>
                                        <p>Отделы <i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview" style="padding-left: 15px;">
                                        <li class="nav-item">
                                            <a href="/admin/branches" class="nav-link">
                                                <i class="nav-icon fas fa-book"></i>
                                                <p>Отделы</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/admin/employees" class="nav-link">
                                                <i class="nav-icon fas fa-book"></i>
                                                <p>Сотрудники</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/authors" class="nav-link">
                                        <i class="nav-icon fas fa-user-edit"></i>
                                        <p>Авторы</p>
                                    </a>
                                </li>

<!--                                <li class="nav-item">-->
<!--                                    <a href="/admin/blocks" class="nav-link">-->
<!--                                        <i class="nav-icon fas fa-coins"></i>-->
<!--                                        <p>Рекламные баннеры</p>-->
<!--                                    </a>-->
<!--                                </li>-->



                                <li class="nav-item">
                                    <a href="/admin/pages" class="nav-link">
                                        <i class="nav-icon fas fa-pager"></i>
                                        <p>Страницы</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/comps" class="nav-link">
                                        <i class="nav-icon fab fa-elementor"></i>
                                        <p>Элементы</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/admin/logout" class="nav-link">
                                        <i class="nav-icon fas fa-sign-out-alt"></i>
                                        <p>Выход</p>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    <?php elseif ($cur_user_role == 'author'): ?>
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                                <li class="nav-item">
                                    <a href="/admin" class="nav-link">
                                        <i class="nav-icon fas fa-address-card"></i>
                                        <p>Панель автора</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/authors/edit/<?= $cur_user_id ?>" class="nav-link">
                                        <i class="nav-icon fas fa-newspaper"></i>
                                        <p>Профиль</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/articles-kz" class="nav-link">
                                        <i class="nav-icon fas fa-newspaper"></i>
                                        <p>Статьи на каз</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/articles-ru" class="nav-link">
                                        <i class="nav-icon fas fa-newspaper"></i>
                                        <p>Статьи на рус</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/tags" class="nav-link">
                                        <i class="nav-icon fas fa-tags"></i>
                                        <p>Теги</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/admin/logout" class="nav-link">
                                        <i class="nav-icon fas fa-sign-out-alt"></i>
                                        <p>Выход</p>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>
            </aside>

            <div class="content-wrapper">
                <section class="content">
                    <?php echo $this->Flash->render(); ?>
                    <?php echo $this->fetch('content'); ?>
                </section>
            </div>

            <footer class="main-footer">
                <strong>Разработка сайтов в <a href="https://astanacreative.kz/" target="_blank">AstanaCreative.kz</a>.</strong>
            </footer>
        </div>


        <div class="submit_preloader" id="form_submit">
            <div class="loader_block">
                <div class="lds-spinner">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <div class="loader_text">Идет загрузка</div>
            </div>
        </div>

        <div class="popup-result" data-id="">
            <div class="popup-container">
                <div class="popup-result-img">
                    <img src="" alt="">
                </div>
                <div class="popup-result-wrapper">
                    <div class="popup-result-btn popup-result-ok">ОК</div>
                    <div class="popup-result-btn popup-result-cancel">Отмена</div>
                </div>
            </div>
        </div>
        <!-- Include jQuery -->
        <?= $this->Html->script('https://code.jquery.com/jquery-3.6.0.min.js') ?>

        <!-- Bootstrap 4 -->
        <script src="/js/admin/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- overlayScrollbars -->
        <script src="/js/admin/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- AdminLTE App -->
        <script src="/js/admin/adminlte.min.js?v=1.11"></script>
        <script src="/js/admin/bs-custom-file-input/bs-custom-file-input.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="/js/admin/inputmask/min/jquery.inputmask.bundle.min.js"></script>
        <!-- date-range-picker -->
        <script src="/js/admin/moment/moment-with-locales.min.js"></script>
        <script src="/js/admin/daterangepicker/daterangepicker.js"></script>
        <script src="/js/admin/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="/js/admin/demo.js"></script>
        <script src="/js/admin/croppie.js"></script>
        <script type="text/javascript">
            function submitForm(){
                $('#form_submit').show();
            }
            $(document).ready(function () {
              bsCustomFileInput.init();
              $('.js-tags-multiple').select2();
            });
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date range picker

            $('#articles_date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm',
                locale: 'ru'
            });

            $('#articles_publish_start_at').datetimepicker({
                format: 'YYYY-MM-DD HH:mm',
                locale: 'ru'
            });

            $('#articles_publish_end_at').datetimepicker({
                format: 'YYYY-MM-DD HH:mm',
                locale: 'ru'
            });

            $('#reservationdate').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'ru'
            });
            $('#reservationdate_end').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'ru'
            });
            $('#vek_begin_date').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'ru'
            });
            $('#vek_end_date').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'ru'
            });
            $('#meeting_date').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'ru'
            });
            $('#reservationdate_prog').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'ru'
            });
            $('#reservationdate_end_prog').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'ru'
            });
            $('#vek_begin_date_prog').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'ru'
            });
            $('#vek_end_date_prog').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'ru'
            });

        </script>

        <script>
            var $uploadCrop;
            let file_format = 'png';
            function readFile(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    file_format = input.files[0].type.replace('image/', '');
                    reader.onload = function (e) {
                        $uploadCrop.croppie('bind', {
                            url: e.target.result
                        }).then(function(){
                            // console.log('jQuery bind complete');
                        });
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            let size = 'viewport';
            let popupResult = document.querySelector('.popup-result');
            let popupResultImg = document.querySelector('.popup-result-img img');
            $('.js-photo-croppie').on('change', function (e) {
                let button = e.target.closest('.form-group').querySelector('.upload-result-btn');
                let viewBox = e.target.closest('.form-group').querySelector('.upload-demo-box');
                $(this).closest('.form-group').find('.upload-wrapper').addClass('active');
                button.style.display = 'block';
                viewBox.style.display = 'block';
                // console.log(e.target.files)
                if(e.target.files.length === 0) {
                    button.style.display = 'none';
                    viewBox.style.display = 'none';
                }
                readFile(this);
                size = { width: $(this).attr('data-width'), height: $(this).attr('data-height')}
                let viewportParams = { width: size.width / 8, height: size.height / 8, type: 'square'};
                $uploadCrop = $(this).closest('.form-group').find('.upload-demo').croppie({
                    viewport: viewportParams,
                    boundary: {
                        width: 300,
                        height: 300
                    },
                    enableExif: true,
                    forceBoundary: false,
                    mouseWheelZoom: false,
                });
            });

            $('.upload-result').on('click', function (ev) {
                $uploadCrop.croppie('result', {
                    type: 'canvas',
                    size: size,
                    format: file_format,
                }).then(function (resp) {
                    // ev.target.closest('.form-group').querySelector('.js-result-base').value = resp;
                    let data_id = ev.target.getAttribute('data-id');
                    popupResultImg.src = resp;
                    popupResult.classList.add('active');
                    popupResult.setAttribute('data-id', data_id);
                });
            });

            $('.popup-result-btn').on("click", function(){
                let data_id = $('.popup-result').attr('data-id');
                let img_code = popupResultImg.src;
                $('.popup-result').removeClass('active');
                if( $(this).hasClass('popup-result-ok') ){
                    $('#'+data_id).val(img_code);
                    $('#'+data_id).parent().parent().siblings('.upload-wrapper').removeClass('active');
                } else if( $(this).hasClass('popup-result-cancel') ){
                    $('#'+data_id).val('');
                }
            });

        </script>
    </body>

<?php else: ?>

    <div class="login-page">
        <div class="form">
            <?php echo $this->Flash->render(); ?>
            <?php echo $this->fetch('content'); ?>
        </div>
    </div>
<?php endif ?>

</html>
