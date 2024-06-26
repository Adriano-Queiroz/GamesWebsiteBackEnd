<!doctype html>
<html lang="zxx">

<!-- Mirrored from rtsolutz.com/vizzstudio/demo-yanyx/yanyx-html/yanyx-dark-theme/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Nov 2023 17:07:48 GMT -->
<head>
    <!--=========================*
                Met Data
    *===========================-->
    
            <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta property="og:title" content="Seja Bem Vindo a Sinodasorte" />
    <meta property="og:url" content="https://www.sinodasorte.com" />
    <meta property="og:description" content="Bem-vindo ao Seu Site Sinodasorte! O Site mais seguro para você tentar a sua sorte com nossas rifas e concorrer a prémios que vão desde Iphones até carros de topo.">
    <meta property="og:image" content="http://sinodasorte.com/favicon_sinodasorte.jpg">
    <meta property="og:type" content="article" />
        
        <link rel="shortcut icon" href="favicon.ico"/>



    <!--=========================*
              Page Title
    *===========================-->

    <title>Sua Sorte aqui, Sorteios toda Semana</title>
    <!--=========================*
                Favicon
    *===========================-->
        <link rel="shortcut icon" href="favicon.ico"/>

    <!--=========================*
            Bootstrap Css
    *===========================-->
    <link rel="stylesheet" href="<?=base_url()?>css/bootstrap.min.css">

    <!--=========================*
              Custom CSS
    *===========================-->
    <link rel="stylesheet" href="<?=base_url()?>css/style.css">

    <!--=========================*
               Owl CSS
    *===========================-->
    <link href="<?=base_url()?>css/owl.carousel.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>css/owl.theme.default.min.css" rel="stylesheet" type="text/css">

    <!--=========================*
            Font Awesome
    *===========================-->
    <link rel="stylesheet" href="<?=base_url()?>css/font-awesome.min.css">

    <!--=========================*
             Themify Icons
    *===========================-->
    <link rel="stylesheet" href="<?=base_url()?>css/themify-icons.css">

    <!--=========================*
               Ionicons
    *===========================-->
    <link href="<?=base_url()?>css/ionicons.min.css" rel="stylesheet"/>

    <!--=========================*
              EtLine Icons
    *===========================-->
    <link href="<?=base_url()?>css/et-line.css" rel="stylesheet"/>

    <!--=========================*
              Feather Icons
    *===========================-->
    <link href="<?=base_url()?>css/feather.css" rel="stylesheet"/>

    <!--=========================*
              Modernizer
    *===========================-->
    <script src="<?=base_url()?>js/modernizr-2.8.3.min.js"></script>

    <!--=========================*
               Metis Menu
    *===========================-->
    <link rel="stylesheet" href="<?=base_url()?>css/metisMenu.css">

    <!--=========================*
               Slick Menu
    *===========================-->
    <link rel="stylesheet" href="<?=base_url()?>css/slicknav.min.css">

    <!--=========================*
            Google Fonts
    *===========================-->

    <!-- Overpass USE: font-family: 'Overpass', sans-serif;-->
    <link href="https://fonts.googleapis.com/css?family=Overpass:100,200,300,400,600,700,800,900&amp;display=swap" rel="stylesheet">

    <!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="darker">

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="login-bg">
                    <div class="login-overlay"></div>
                    <div class="login-left">
                        <img src="<?=base_url()?>logo.png" alt="Logo">
                    </div><!--login-left-->
                </div><!--login-bg-->

                <div class="login-form">
                    <form action="<?=base_url()?>admin/logar" method="post">
                        <div class="login-form-body">
                            <div class="form-gp">
                                <label for="exampleInputEmail1">E-mail</label>
                                <input type="email" name="email" id="exampleInputEmail1">
                                <i class="ti-email"></i>
                            </div>
                            <div class="form-gp">
                                <label for="exampleInputPassword1">Senha</label>
                                <input type="password" name="senha" id="exampleInputPassword1">
                                <i class="ti-lock"></i>
                            </div>
                            <div class="row mb-4 rmber-area">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox primary-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                        <label class="custom-control-label" for="customControlAutosizing">Lembrar-me</label>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="#" class="text-primary">Esqueceu sua senha?</a>
                                </div>
                            </div>
                            <div class="submit-btn-area">
                                <button id="form_submit" type="submit" class="btn btn-primary">Acessar <i class="ti-arrow-right"></i></button>
                               
                            </div>
                           
                        </div>
                    </form>
                </div><!--login-form-->

            </div><!--row-->
        </div><!--container-fluid-->
    </div><!--wrapper-->


<!--=========================*
            Scripts
*===========================-->

<!-- Jquery Js -->
<script src="<?=base_url()?>js/jquery.min.js"></script>
<!-- bootstrap 4 js -->
<script src="<?=base_url()?>js/popper.min.js"></script>
<script src="<?=base_url()?>js/bootstrap.min.js"></script>
<!-- Owl Carousel Js -->
<script src="<?=base_url()?>js/owl.carousel.min.js"></script>
<!-- Metis Menu Js -->
<script src="<?=base_url()?>js/metisMenu.min.js"></script>
<!-- SlimScroll Js -->
<script src="<?=base_url()?>js/jquery.slimscroll.min.js"></script>
<!-- Slick Nav -->
<script src="<?=base_url()?>js/jquery.slicknav.min.js"></script>
<!-- Fancy Box Js -->
<script src="<?=base_url()?>js/jquery.fancybox.pack.js"></script>
<!-- Main Js -->
<script src="<?=base_url()?>js/main.js"></script>
</body>

<!-- Mirrored from rtsolutz.com/vizzstudio/demo-yanyx/yanyx-html/yanyx-dark-theme/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Nov 2023 17:07:49 GMT -->
</html>