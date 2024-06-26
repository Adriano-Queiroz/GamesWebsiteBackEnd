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
        <!--==================================*
                   Main Section
        *====================================-->
        <div class="main-content-inner">



            <div class="row">
                <div class="col-lg-12 stretched_card mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card_title">
                                FILTRO DE USUÁRIOS
                            </h4>
                            <form action="<?=base_url()?>adm/usuarios/rel/3" method="post">
                                 <div class="form-group">
                                    <?
                                    $q = "";
                                    if(isset($_POST['q'])){
                                        $q = $this->input->post('q');
                                        if($q != ""){
                                            $where .= " AND nome LIKE '%".$q."%' ";
                                        }
                                    }
                                    ?>
                                    <input class="form-control" type="text" placeholder="Pesquisar por usuário" id="example-text-input" name="q" value="<?=$q?>">
                                </div>
                                <div class="row">
                                         <div class="form-group col-lg-4 stretched_card mt-4">
                                        <label class="col-form-label">Função:&nbsp;&nbsp;</label>
                                        <select class="custom-select" name="nivel">
                                            <option selected="selected" value="0">Todos</option>
                                            <? if($this->session->userdata('nivel') == 1){ ?>
                                                <option value="1">Adm</option>
                                                <option value="2">Cliente</option>
                                            <? } ?>
                                            <option value="3">Apostador</option>
                                            
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 stretched_card mt-4">
                                        <label class="col-form-label">Data:&nbsp;&nbsp;</label>
                                        <select class="custom-select" name="data">
                                            <option selected="selected">Todos</option>
                                            <option value="1">hoje</option>
                                            <option value="2">7 dias</option>
                                            <option value="3">30 dias</option>
                                        </select>
                                    </div>
                                      <div class="form-group col-lg-4 stretched_card mt-4">
                                        <label class="col-form-label">Status:&nbsp;&nbsp;</label>
                                        <select class="custom-select" name="status">
                                            <option selected="selected" value="0">Todos</option>
                                            <option value="1">Ativo</option>
                                            <option value="2">Inativo</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <hr>

                            <h4 class="card_title">
                                LISTA DE USUÁRIOS
                            </h4>

                            <!-- <a href="<?=base_url()?>adm/usuarios/cadastro" target="_blank"> <button type="button" class="btn btn-warning mb-3"><i class="ti-shine"></i> Novo cadastro</button></a>
                            <br> -->

                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                        <tr>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Telefone</th>
                                            <th scope="col">Chamar</th>
                                            <th scope="col">E-mail</th>
                                            <th scope="col">CPF</th>
                                            <th scope="col">Função</th>
                                            <th scope="col">Status</th>
                                            <!-- <th scope="col">Editar</th> -->
                                            <th scope="col">Excluir</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <? if($usuarios->num_rows() > 0){ ?>
                                                <? foreach($usuarios->result() as $usuario){ ?>
                                                    <tr>
                                                        <td><?=$usuario->nome?></td>
                                                        <td><?=$usuario->telefone?></td>
                                                        <td><a href="tel:+<?=$usuario->telefone?>" target="_blank"><img src="<?=base_url()?>images/telefone.png" title="Ligar"/></a>&nbsp;&nbsp;<a href="https://web.whatsapp.com/send?phone=55<?=$usuario->whatsapp?>" target="_blank"><img src="<?=base_url()?>images/whatsapp.png" title="Chamar Whatsapp" /></a></td>
                                                        
                                                        
                                                        <td><?=$usuario->email?></td>
                                                        
                                                        <td>*</td>
                                                        <td> 
                                                            <? if($usuario->nivel == 1){ ?>
                                                                <span class="badge badge-warning">admin</span>
                                                            <? } ?>

                                                            <? if($usuario->nivel == 2){ ?>
                                                                <span class="badge badge-danger">Cliente</span>
                                                            <? } ?>

                                                            <? if($usuario->nivel == 3){ ?>
                                                                <span class="badge badge-success">Usuário</span>
                                                            <? } ?>
                                                        </td>
                                                        <td> <span class="badge badge-success">-</span></td>
                                                         <!-- <td>
                                                            <ul class="d-flex justify-content-center">
                                                                <li class="mr-3"><button type="button" class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-edit"></i></button></li>
                                                            </ul>
                                                        </td> -->
                                                         <td>
                                                            <ul class="d-flex justify-content-center">
                                                                <!-- <li class="mr-3"><button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-excluir-modal-lg"><i class="fa fa-trash"></i></button></li> -->
                                                                <a href="<?=base_url()?>adm/usuarios/remover/<?=$usuario->id?>" class="btn btn-danger" >
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                            </ul>
                                                        </td>

                                                    </tr>
                                                <? } ?>
                                            <? } ?>
                                        
                                        </tbody>
                                    </table>
                                        <!-- Disabled and active states -->

                                  
                <div class="col-lg-4 stretched_card mt-mob-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card_title"></div>
                            <nav aria-label="...">
                                <ul class="pagination">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">
                                            <span class="ti-angle-left"></span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">
                                            <span class="ti-angle-right"></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
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
