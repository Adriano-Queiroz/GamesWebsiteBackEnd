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
                            <h4 class="card_title">Termos de Utilização</h4>
                            <!--<p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>-->

                            <form action="<?=base_url()?>adm/usuarios/set_termo" method="post" >      
                            
                            
                            <div class="col-lg-12 mt-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card_title">Editor Termos de Utilização</h4>
                                        <textarea class="summer_note_editor" name="termo" id="termo" placeholder="Escreve os Termos de Utilização" rows="15" cols="80" style="background-color: #fff;border:white 1px solid;padding:1em"><?=$usuario->termo?></textarea>
                                        <!-- <button type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Salvar</button> -->

                                    </div>

                                </div>
                            </div>

                               
<!-- 
                                <div class="row">
                                    <div class="col-lg-12 mt-4">

                                        <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Digite o Termo de Utilização</label>
                                            <textarea class="form-control" type="text" value="" id="" placeholder="Pergunta...?" name="termo"><?=$usuario->termo?></textarea>
                                        </div>
                                    </div>
                                    
                                    
                                </div> -->

                                <div class="rows">
                                    <div class="col-lg-12 mt-4">
                                            <div class="form-group">
                                                
                                                <input class="btn btn-success" type="submit"  value="Salvar">
                                            </div>
                                        </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
        </div>
        <!-- x row -->

        
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
<!-- Ck Editor Js -->
<!-- <script src="<?=base_url()?>vendors/ck-editor/js/ckeditor.js"></script> -->
<!-- Tinymce Editor Js -->
<!-- <script src="<?=base_url()?>vendors/tinymce/js/tinymce.min.js"></script>
<script src="<?=base_url()?>vendors/tinymce/js/themes/modern/theme.js"></script> -->

<!-- Summernote Editor Js -->
<script src="<?=base_url()?>vendors/summernote/dist/summernote-bs4.min.js"></script>

<!-- Editor init Js -->
<!-- <script src="<?=base_url()?>js/init/editors.js"></script> -->

<!-- Main Js -->
<script src="<?=base_url()?>js/main.js"></script>


<script type="text/javascript" src="<?php echo base_url(); ?>plugins/tinymce/tinymce.min.js"></script>

    <script type="text/javascript">
    tinymce.init({
        selector: "textarea#termo",
        //para queseja inserida a url completa da imagem, do contrario não sera carregada na ediçao nem sera exibida corretamente
        relative_urls: false, 
        convert_urls: false, 
        remove_script_host : false,
        
        plugins: [
             "advlist autolink link image lists print preview hr anchor pagebreak spellchecker",
             "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
             "save table contextmenu directionality paste textcolor"
       ],
       toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | code",
       menubar: false,
     });

 </script>
 

</body>

<!-- Mirrored from rtsolutz.com/vizzstudio/demo-yanyx/yanyx-html/yanyx-dark-theme/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Nov 2023 17:05:25 GMT -->
</html>
