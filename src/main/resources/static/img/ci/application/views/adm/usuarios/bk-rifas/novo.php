<!DOCTYPE html>
<html class="no-js" lang="zxx">


<!-- Mirrored from rtsolutz.com/vizzstudio/demo-yanyx/yanyx-html/yanyx-dark-theme/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Nov 2023 17:05:02 GMT -->
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

    <? include("includes/adm/css.php"); ?>


</head>

<body class="darker">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!--=========================*
         Page Container
*===========================-->
<div class="page-container">

    <!--=========================*
             Side Bar Menu
    *===========================-->
    <? include("includes/adm/sidebar.php"); ?>

    <!--=========================*
           End Side Bar Menu
    *===========================-->

    <!--==================================*
               Main Content Section
    *====================================-->
    <div class="main-content page-content">

        <!--==================================*
                   Header Section
        *====================================-->
        
        <? include("includes/adm/header.php"); ?>
        <!--==================================*
                   End Header Section
        *====================================-->

        <!--==================================*
                   Main Section
        *====================================-->
        <div class="main-content-inner">
             



             <div class="row">
                <!-- Textual inputs -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card_title">Novo Usuário</h4>
                            <!--<p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>-->

                            <form action="<?=base_url()?>adm/usuarios/cadastrar" method="post" enctype="multipart/form-data">
                                <input type="text" value="<?=$id_setor?>" name="nivel">

                                <div class="form-group">

                                    <label for="example-text-input" class="col-form-label">Imagem</label>

                                    <input type="file" name="img1" class="short" >

                                  


                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mt-4">

                                        <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Responsável</label>
                                            <input class="form-control" type="text" value="" id="" placeholder="Nome do resposável" name="nome">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mt-4">
                                        <div class="form-group">
                                            <label for="example-email-input" class="col-form-label">Empresa</label>
                                            <input class="form-control" type="text" value="" id="" placeholder="Site/Empresa" name="nome_empresa">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mt-4">

                                        <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">E-mail</label>
                                            <input class="form-control" type="email" value="" id="" placeholder="@.com" name="email">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mt-4">
                                        <div class="form-group">
                                            <label for="example-email-input" class="col-form-label">Senha</label>
                                            <input class="form-control" type="password" value="" id="" placeholder="" name="senha">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mt-4">

                                        <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Whatsapp</label>
                                            <input class="form-control" type="text" value="" id="" placeholder="(99) 9 9999-9999" name="whatsapp">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mt-4">
                                        <div class="form-group">
                                            <label for="example-email-input" class="col-form-label">Telefone</label>
                                            <input class="form-control" type="text" value="" id="" placeholder="(99) 9 9999-9999" name="telefone">
                                        </div>
                                    </div>
                                    
                                </div>

                               
                                



                                <div class="row">
                                    <!-- Radios start -->
                                    <div class="col-lg-12 mt-4 stretched_card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card_title">Digite a descrição do seu negócio</h4>

                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Apresentação</span>
                                                    </div>
                                                    <textarea class="form-control" aria-label="With textarea" rows="20" placeholder="Fale sobre seu negócio" name="apresentacao"></textarea>
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Radios end -->
                                    <!-- Checkboxes start -->
                                    
                                    <!-- Checkboxes end -->
                                </div>

                                 <div class="row">
                                    <!-- Radios start -->
                                    <div class="col-lg-12 mt-4 stretched_card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card_title">Link Grupo Whatsapp e Telegram</h4>

                                                <div class="form-group has-primary">
                                                    <label>Whatsapp</label><input type="text" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="whatsapp" name="link_whatsapp">
                                                </div>
                                                   <div class="form-group has-primary">
                                                    <label>Telegram</label><input type="text" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="telegram" name="link_telegram">
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Radios end -->
                                    <!-- Checkboxes start -->
                                    
                                    <!-- Checkboxes end -->
                                </div>







                                <div class="form-group">
                                    
                                    <input class="btn btn-success" type="submit" value="Salvar" >
                                </div>

                            </form>

                            <!--<div class="form-group">
                                <label class="col-form-label">Select</label>
                                <select class="form-control">
                                    <option>Select</option>
                                    <option>Large select</option>
                                    <option>Small select</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Custom Select</label>
                                <select class="custom-select">
                                    <option selected="selected">Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>-->
                        </div>
                    </div>
                </div>
                <!-- Textual inputs -->

            </div>
          


            
          
            

            
            
            
        </div>
        <!--==================================*
                   End Main Section
        *====================================-->
    </div>
    <!--=================================*
           End Main Content Section
    *===================================-->

    <!--=================================*
                  Footer Section
    *===================================-->
    
    <? include("includes/adm/footer.php"); ?>
    <!--=================================*
                End Footer Section
    *===================================-->

</div>
<!--=========================*
        End Page Container
*===========================-->


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
<!-- ========== This Page js ========== -->

<!-- start amchart js -->
<script src="<?=base_url()?>vendors/am-charts/js/ammap.js"></script>
<script src="<?=base_url()?>vendors/am-charts/js/worldLow.js"></script>
<script src="<?=base_url()?>vendors/am-charts/js/continentsLow.js"></script>
<script src="<?=base_url()?>vendors/am-charts/js/light.js"></script>
<!-- maps js -->
<script src="<?=base_url()?>js/am-maps.js"></script>

<!--Float Js-->
<script src="<?=base_url()?>vendors/charts/float-bundle/jquery.flot.js"></script>
<script src="<?=base_url()?>vendors/charts/float-bundle/jquery.flot.pie.js"></script>
<script src="<?=base_url()?>vendors/charts/float-bundle/jquery.flot.resize.js"></script>

<!--Easy pie chart Js-->
<script src="<?=base_url()?>vendors/charts/sparkline/easy-pie-chart.js"></script>

<!--Sparkline Js-->
<script src="<?=base_url()?>vendors/charts/sparkline/sparklines.js"></script>

<!--Apex Chart-->
<script src="<?=base_url()?>vendors/apex/js/apexcharts.min.js"></script>

<!--Home Script-->
<script src="<?=base_url()?>js/home.js"></script>

<!-- ========== This Page js ========== -->

<!-- Main Js -->
<script src="<?=base_url()?>js/main.js"></script>



    
    <!-- <script src="<?php echo base_url(); ?>js/adm/libs/jquery-1.8.3.min.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>js/adm/libs/jquery.mousewheel.min.js"></script>
    <script src="<?php echo base_url(); ?>js/adm/libs/jquery.placeholder.min.js"></script>
    <script src="<?php echo base_url(); ?>custom-plugins/fileinput.js"></script>

    <script src="<?php echo base_url(); ?>jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="<?php echo base_url(); ?>jui/jquery-ui.custom.min.js"></script>
    <script src="<?php echo base_url(); ?>jui/js/jquery.ui.touch-punch.js"></script>

    
    <script src="<?php echo base_url(); ?>js/demo/demo.formelements.js"></script>

    <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <script src="<?=base_url()?>js/jquery.form.js"></script> -->

    <script type="text/javascript" src="<?php echo base_url(); ?>plugins/tinymce/tinymce.min.js"></script>
        
    <script type="text/javascript">
        $(document).ready(function() { 


              //upload e preview da imagem
            // $('#photoimg').live('change', function() { 
            //     $("#preview").html('');
            //     $("#preview").html('<img src="<?php echo base_url(); ?>images/ajax-loader.gif" alt="Uploading...."/>'); //
                
            //     $("#form").attr('action', '<?php echo base_url(); ?>adm/sorteios/upImgPost');            
            //     $("#form").validate().cancelSubmit = true;
                
            //     var options = { 
            //                 target:        '#preview',   // target element(s) to be updated with server response 
            //                 //beforeSubmit:  showRequest('oi'),  // pre-submit callback 
            //                 success: function() { 
            //                                         $('#preview').fadeIn('slow'); 
            //                                     }  
            //             }; 
            //     $("#form").ajaxSubmit(options);     
                        
            //     $("#form").attr('action', '<?php echo base_url(); ?>adm/sorteios/cadastrar');
            //     $("#form").validate().cancelSubmit = false;
                
            // });

        });
    </script>


</body>

<!-- Mirrored from rtsolutz.com/vizzstudio/demo-yanyx/yanyx-html/yanyx-dark-theme/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Nov 2023 17:05:25 GMT -->
</html>
