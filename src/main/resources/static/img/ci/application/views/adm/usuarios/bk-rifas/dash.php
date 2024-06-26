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
                <div class="col-md-6 mb-4">
                    <div class="card_with_image">
                        <div class="blog_card_image">
                            <a href="javascript:void(0);">
                                <img src="<?=base_url()?>images/blog-listing/03.jpg" alt="" class="img-responsive ">
                            </a>
                        </div>
                       
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card_with_image">
                        <div class="blog_card_image">
                            <a href="javascript:void(0);">
                                <img src="<?=base_url()?>images/blog-listing/04.jpg" alt="" class="img-responsive ">
                            </a>
                        </div>
                      
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-md-6 col-lg-12 stretched_card">
                    <div class="card mb-mob-4">
                        <!-- Card body -->
                        <div class="card-body card_icon_right">
                            <div class="row">
                                <div class="col">
                                    <h6 class="card_title text-uppercase text-muted mb-0">Total de Participantes</h6>
                                    <span class="font-weight-bold mb-0"><?=$total_participantes?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon_rounded mb-3 icon_primary">
                                        <i class="feather ft-bar-chart-2" aria-hidden="true"></i>

                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-success mr-2"><i class="feather ft-arrow-up-circle"></i> <?=$total_participantes_hj?></span>
                                <span class="text-nowrap">Participantes hoje</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-12 stretched_card">
                    <div class="card mb-mob-4">
                        <!-- Card body -->
                        <div class="card-body card_icon_right">
                            <div class="row">
                                <div class="col">
                                    <h6 class="card_title text-uppercase text-muted mb-0">Quantidade de compras</h6>
                                    <span class="font-weight-bold mb-0"><?=$total_compras->num_rows()?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon_rounded mb-3 icon_success">
                                        <i class="feather ft-briefcase" aria-hidden="true"></i>

                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-success mr-2"><i class="feather ft-arrow-up-circle"></i> <?=$total_compras_hj?></span>
                                <span class="text-nowrap">Compras hoje</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-12 stretched_card">
                    <div class="card mb-mob-4">
                        <!-- Card body -->
                        <div class="card-body card_icon_right">
                            <div class="row">
                                <div class="col">
                                    <h6 class="card_title text-uppercase text-muted mb-0">Ticket médio</h6>
                                    <span class="font-weight-bold mb-0">R$ <?=number_format($ticket_medio, 2, ',', '.')?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon_rounded mb-3 icon_danger">
                                        <i class="feather ft-dollar-sign" aria-hidden="true"></i>

                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-danger mr-2"><i class="feather ft-arrow-down-circle"></i> R$ 0,00 <? #=number_format($ticket_medio_hj, 2, ',', '.')?></span>
                                <span class="text-nowrap">Ticket médio hoje *</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-12 stretched_card">
                    <div class="card mb-mob-4">
                        <!-- Card body -->
                        <div class="card-body card_icon_right">
                            <div class="row">
                                <div class="col">
                                    <h6 class="card_title text-uppercase text-muted mb-0">Rifa mais vendida</h6>
                                    <span class="font-weight-bold mb-0">R$ <?=number_format($rifa_mais_vendida->valor_total, 2, ',', '.')?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon_rounded mb-3 icon_warning">
                                        <i class="feather ft-package" aria-hidden="true"></i>

                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-nowrap">Premiação</span>
                                <span class="text-success mr-2"><?=$rifa_mais_vendida->titulo?></span>
                            </p>
                        </div>
                    </div>
                </div>


            </div>


            <div class="row">
                <div class="col-lg-8 stretched_card mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card_title">
                                Últimas Vendas
                            </h4>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                        <tr>
                                            <th scope="col">Sorteio</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Participante</th>
                                            <th scope="col">Data</th>
                                            <th scope="col">Quantidade</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <? foreach($total_compras->result() as $last_compra){ ?>
                                            <?
                                            $qr_img = $this->padrao_model->get_by_matriz('id_sorteio',$last_compra->id_sorteio,'sorteios_imagens');
                                            if($qr_img->num_rows() == 0){

                                                $img_sort = "sorteios/mini-01.jpg";

                                            }else{
                                                $dd_img = $qr_img->row();
                                                $img_sort = "imagens/sorteios/min/".$dd_img->img;
                                            }

                                            ?>
                                            <tr>
                                                <td class="d-flex align-items-center justify-content-center">
                                                    <span class="dot_vz dot_vz_success"></span>
                                                    <div class="text-left">
                                                        <div class="text-success">  <img src="<?=base_url().$img_sort?>" alt="" style="padding: 13%;"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="card-body">
                                                         <? if($last_compra->status == 0){ ?>
                                                             <span class="badge badge-warning">Aguardando</span>
                                                         <? } ?>
                                                         <? if($last_compra->status == 1){ ?>
                                                             <span class="badge badge-success">Aprovado</span>
                                                         <? } ?>
                                                         <? if($last_compra->status == 3){ ?>
                                                             <span class="badge badge-danger">Cancelado</span>
                                                         <? } ?>
                                                    </div>
                                                </td>
                                                <td><?=$this->padrao_model->get_by_id($last_compra->id_user,'usuarios')->row()->nome?></td>
                                                <td><?=$this->padrao_model->converte_data(substr($last_compra->dt_reg,0,10))?></td>
                                                <td><?=$last_compra->qtd_numeros?></td>
                                                <td>R$ <?=number_format($last_compra->valor, 2, ',', '.')?></td>
                                            </tr>
                                        <? } ?>
                                        
                                        </tbody>
                                    </table>
                                </div>
                                <p align="right">
                                    <a href="<?=base_url()?>adm/sorteios/vendas" class="btn btn-light">Ver todas</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
              <div class="col-lg-4 stretched_card mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card_title">
                                Últimos Cadastros
                            </h4>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                        <tr>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Data</th>
                                            <th scope="col">Participante</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <? foreach($ultimos_cadastro->result() as $last){ ?>
                                            <?
                                            $qr_dep = $this->db->query("SELECT * FROM depositos WHERE id_user = ".$last->id." AND status = 1");
                                            ?>
                                            <tr>
                                                <td><?=$last->nome?></td>                                            
                                                <td><?=$this->padrao_model->converte_data(substr($last->dt_cadastro,0,10))?></td>
                                                <td>
                                                    <div class="card-body">
                                                        <? if($qr_dep->num_rows() > 0){ ?>
                                                         <span class="badge badge-success">Sim</span>
                                                        <? }else{ ?>
                                                            <span class="badge badge-danger">Não</span>
                                                        <? } ?>
                                                    </div></td>
                                            </tr>              
                                        <? } ?>                          
                                       
                                        </tbody>
                                    </table>
                                </div>

                                <p align="right">
                                    <a href="<?=base_url()?>adm/usuarios/rel/3" class="btn btn-light">Ver todos</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<div class="row" style="display: none;">
                <div class="col-xl-12">
                    <div class="card mt-4 widget-pie">
                        <div class="col-6 col-sm-3 col-md-6 col-lg-3 widget-pie__item">
                            <div class="easy-pie-chart" data-percent="50" data-size="80"
                                 data-track-color="rgba(0,0,0,0.08)" data-bar-color="#fff">
                                <span class="easy-pie-chart__value"
                                      style="line-height: 80px; font-size: 20px; color: rgb(255, 255, 255);">72</span>
                            </div>
                            <div class="widget-pie__title">R$ 0,00<br> Faturamento de hoje</div>
                        </div>

                        <div class="col-6 col-sm-3 col-md-6 col-lg-3 widget-pie__item">
                            <div class="easy-pie-chart" data-percent="11" data-size="80"
                                 data-track-color="rgba(0,0,0,0.08)" data-bar-color="#fff">
                                <span class="easy-pie-chart__value"
                                      style="line-height: 80px; font-size: 20px; color: rgb(255, 255, 255);">21</span>
                            </div>
                            <div class="widget-pie__title">R$ 0,00<br> Faturamento 7 dias</div>
                        </div>

                        <div class="col-6 col-sm-3 col-md-6 col-lg-3 widget-pie__item">
                            <div class="easy-pie-chart" data-percent="52" data-size="80"
                                 data-track-color="rgba(0,0,0,0.08)" data-bar-color="#fff">
                                <span class="easy-pie-chart__value"
                                      style="line-height: 80px; font-size: 20px; color: rgb(255, 255, 255);">66</span>
                            </div>
                            <div class="widget-pie__title">R$ 0,00<br> Faturamento 30 dias</div>
                        </div>

                        <div class="col-6 col-sm-3 col-md-6 col-lg-3 widget-pie__item">
                            <div class="easy-pie-chart" data-percent="52" data-size="80"
                                 data-track-color="rgba(0,0,0,0.08)" data-bar-color="#fff">
                                <span class="easy-pie-chart__value"
                                      style="line-height: 80px; font-size: 20px; color: rgb(255, 255, 255);">66</span>
                            </div>
                            <div class="widget-pie__title">R$ 0,00<br> Faturamento total</div>
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
