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
                            <h4 class="card_title">Nova pergunta frequente</h4>
                            <!--<p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>-->

                            <form action="<?=base_url()?>adm/usuarios/set_pergunta" method="post" >                                

                               

                                <div class="row">
                                    <div class="col-lg-12 mt-4">

                                        <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Pergunta</label>
                                            <input class="form-control" type="text" value="" id="" placeholder="Pergunta...?" name="pergunta">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-4">
                                        <div class="form-group">
                                            <label for="example-email-input" class="col-form-label">Resposta</label>
                                            <input class="form-control" type="text" value="" id="" placeholder="Resposta..." name="resposta">
                                        </div>
                                    </div>
                                    
                                </div>

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

        <div class="row">
                <div class="col-lg-12 stretched_card mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card_title">
                                LISTA DE PERGUNTAS FREQUENTES
                            </h4>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                        <tr>
                                            <th scope="col">Pergunta</th>
                                            <th scope="col">Resposta</th>                                            
                                            <th scope="col">Ação</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <? if($perguntas->num_rows() > 0){ ?>
                                                <? foreach($perguntas->result() as $pergunta){ ?>

                                                    <?
                                                    // $qr_img = $this->padrao_model->get_by_matriz('id_sorteio',$sorteio->id,'sorteios_imagens');
                                                    // if($qr_img->num_rows() == 0){

                                                    //     $img_sort = "sorteios/mini-01.jpg";

                                                    // }else{
                                                    //     $dd_img = $qr_img->row();
                                                    //     $img_sort = "imagens/sorteios/min/".$dd_img->img;
                                                    // }
                                                    ?>
                                                    <tr>
                                                        <td><?=$pergunta->pergunta?></td>
                                                        <td><?=$pergunta->resposta?></td>
                                                         <td>
                                                            <ul class="d-flex justify-content-center">
                                                                <li class="mr-3"><a href="<?=base_url()?>adm/usuarios/rem_perg/<?=$pergunta->id?>" class="btn btn-secondary" ><i class="fa fa-trash"></i></a></li>
                                                            </ul>
                                                        </td>

                                                    </tr>
                                                    
                                        <? } } ?>
                                        </tbody>
                                    </table>
                                        <!-- Disabled and active states -->
                              
                <!-- Disabled and active states -->
                                </div>
                             
                            </div>
                        </div>

                    </div>
                </div>
               
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


</body>

<!-- Mirrored from rtsolutz.com/vizzstudio/demo-yanyx/yanyx-html/yanyx-dark-theme/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Nov 2023 17:05:25 GMT -->
</html>
