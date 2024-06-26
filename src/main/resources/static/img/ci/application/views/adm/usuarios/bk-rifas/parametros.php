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


        <div class="modal fade bd-excluir-modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="main-content-inner">
                        <div class="row">
                            <!-- Textual inputs -->
                            <div class="col-12">
                                <div class="card" style="margin-bottom: -5%;">
                                    <div class="card-body">
                                     
                                        <div class="form-group">
                                            <div style="text-align: -webkit-center;">Tem certeza que gostaria de excluir?</div>
                                        </div>
                                         <div class="modal-footer">
                                              <button type="button" class="btn btn-danger">Excluir</button>
                                              <button type="button" class="btn btn-light" data-dismiss="modal">Sair</button>
                                         </div>
                                    </div>

                                </div>

                            </div>
                            
                        </div>

                    </div>
                  
                </div>
            </div>
        </div>


        <!--==================================*
                   Main Section
        *====================================-->
        <div class="main-content-inner">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-header card mb-4">
                            <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#geral" role="tab" aria-expanded="true">Geral</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#front" role="tab">Front</a>
                                    <div class="slide"></div>
                                </li>
                                <? if($this->session->userdata('nivel') == 1){ ?>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#raspadinha" role="tab">Raspadinha</a>
                                    <div class="slide"></div>
                                </li>
                               <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                        Gestor Admin 1
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" id="dropdown1-tab" href="#dropdown1" data-toggle="tab" aria-controls="dropdown1" aria-expanded="true">Principal</a>
                                        <a class="dropdown-item" id="dropdown2-tab" href="#dropdown2" data-toggle="tab" aria-controls="dropdown2" aria-expanded="true">Secundário</a>
                                    </div>
                                </li>
                                 <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                        Gestor Trafego
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" id="dropdown1-tab" href="#gestortrafego" data-toggle="tab" aria-controls="dropdown1" aria-expanded="true">Gestores</a>
                                        <a class="dropdown-item" id="dropdown2-tab" href="#gestortrafegoextrato" data-toggle="tab" aria-controls="dropdown2" aria-expanded="true">Extrato Geral</a>
                                         <a class="dropdown-item" id="dropdown2-tab" href="#gestortrafegomescorrente" data-toggle="tab" aria-controls="dropdown2" aria-expanded="true">Extrato mês Corrente</a>
                                    </div>
                                </li>
                                <? } ?>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#contasemaberto" role="tab">Contas em aberto</a>
                                    <div class="slide"></div>
                                </li>

                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="geral" role="tabpanel" aria-expanded="true">
                                <div class="card mb-4">
                                   <form action="<?=base_url()?>adm/usuarios/set_parametros" method="post" enctype="multipart/form-data">
                                        <div class="col-12 mt-4">
                                             <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card_title">CONFIGURAÇÃO DO SISTEMA</h4>

                                                    <div class="row">
                                                        <div class="col-lg-6 mt-6">
                                                              <div class="form-group">
                                                                    <label for="example-text-input" class="col-form-label">Nome do Site</label>
                                                                    <input class="form-control" type="text" placeholder="Nome do site" name="nome_site"  value="<?=$parametros->nome_site?>">
                                                             </div>
                                                        </div>
                                                        <div class="col-lg-6 mt-6">
                                                            <div class="form-group">
                                                                <label for="example-email-input" class="col-form-label">Descrição</label>
                                                                <input class="form-control" type="text"  id="example-email-input" name="descricao_site" value="<?=$parametros->descricao_site?>">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    
                                                    <div class="row">
                                                        <div class="col-lg-6 mt-6">
                                                    
                                                            <div class="form-group">
                                                                <label for="example-tel-input" class="col-form-label">Pixel Facebook ID</label>
                                                                <input class="form-control" type="text"  id="example-tel-input" name="pixel_facebook" value="<?=$parametros->pixel_facebook?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mt-6">
                                                    
                                                            <div class="form-group">
                                                                <label for="example-tel-input" class="col-form-label">TOKEN Facebook</label>
                                                                <input class="form-control" type="text"  id="example-tel-input" name="token_facebook" value="<?=$parametros->token_facebook?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                        

                                                        
                                                    

                                                    <div class="row">
                                                        <div class="col-lg-6 mt-6">
                                                                <div class="form-group">
                                                                    <label for="example-tel-input" class="col-form-label">Whatsapp Suporte</label>
                                                                    <input class="form-control" type="text"  id="example-tel-input" name="link_suporte_whatsapp" value="<?=$parametros->link_suporte_whatsapp?>"><br>
                                                                    <a href="https://api.chatpro.com.br/gerador-de-links" target="_blank" >Criar link do Whatsapp</a>
                                                                </div>
                                                        </div>                 

                                                        <div class="col-lg-6 mt-6">                                                        

                                                            <div class="form-group">
                                                                <label for="example-tel-input" class="col-form-label">Google Analytics ID</label>
                                                                <input class="form-control" type="text"  id="example-tel-input" name="google_analytics" value="<?=$parametros->google_analytics?>">
                                                            </div>

                                                        </div>                                       
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-lg-12 mt-6">
                                                                <div class="form-group">
                                                                    <label for="example-tel-input" class="col-form-label">API Mercado Pago</label>
                                                                    <input class="form-control" type="text"  id="example-tel-input" name="api_mercado_pago" value="<?=$parametros->api_mp?>"><br>
                                                                    <!-- <a href="https://api.chatpro.com.br/gerador-de-links" target="_blank" >Criar API Mercado Pago</a> -->
                                                                </div>
                                                        </div>                                                        
                                                    </div>

                                                    


                                                    

                                                    <!-- NOVOS CAMPOS -->

                                                    


                                                    <!-- <div class="row">
                                   
                                                        <div class="col-lg-6 mt-4 stretched_card">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h4 class="card_title">Botões números</h4>

                                                                        <div class="form-control-feedback">Digite os números de atalho para a compra de cotas</div><br>
                                                                    <div class="form-group has-primary">
                                                                         <label></label><input type="number" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="+50" name="nm_bts[]" value="<?=$bt[1]?>">
                                                                         <label></label><input type="number" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="+100" name="nm_bts[]" value="<?=$bt[2]?>">
                                                                         <label></label><input type="number" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="+250" name="nm_bts[]" value="<?=$bt[3]?>">
                                                                         <label></label><input type="number" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="+500" name="nm_bts[]" value="<?=$bt[4]?>">
                                                                         <label></label><input type="number" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="+500" name="nm_bts[]" value="<?=$bt[5]?>">
                                                                         <label></label><input type="number" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="+500" name="nm_bts[]" value="<?=$bt[6]?>">

                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mt-4 stretched_card">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h4 class="card_title">Número inicial padrão</h4>

                                                                        <div class="form-control-feedback">Digite o número para cota minima</div><br>
                                                                    <div class="form-group has-primary">
                                                                        <input type="number" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="50" name="numero_inicial" value="<?=$parametros->numero_inicial?>">
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                     
                                                    <div class="row" style="display: none;">
                                                        <!-- Radios start -->
                                                        <div class="col-lg-6 mt-4 stretched_card">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h4 class="card_title">Título valor a pagar</h4>

                                                                    <div class="form-group has-primary">
                                                                        <input type="text" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="Participar do sorteio" name="tit_valor_a_pagar" value="<?=$parametros->tit_valor_a_pagar?>">
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mt-4 stretched_card">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h4 class="card_title">Valor a pagar</h4>

                                                                    <div class="form-group has-primary">
                                                                        <input type="text" class="form-control form-control-primary money" id="inputHorizontalPrimary" placeholder="Participar do sorteio" name="valor_a_pagar" value="<?=$parametros->valor_a_pagar?>">
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Radios end -->
                                                        <!-- Checkboxes start -->
                                                        
                                                        <!-- Checkboxes end -->
                                                    </div>



                                                    <!-- X CAMPOS -->
                                                   
                                                      <button type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Salvar</button>

                                                </div>

                                            </div>

                                        </div>
                                    </form>


                                </div>

                           
                            </div>
                           

                            <div class="tab-pane" id="front" role="tabpanel" aria-expanded="false">
                                <div class="card mb-4">
                                    <form action="<?=base_url()?>adm/usuarios/set_parametros_front" method="post" enctype="multipart/form-data">
                                        <div class="col-12 mt-4">
                                             <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card_title">Configuração Frontal Site</h4>

                                                     <!-- <div class="form-group">
                                                        <label for="example-text-input" class="col-form-label">Título Sorteio</label>
                                                        <input class="form-control" type="text" value="Prêmios" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="example-email-input" class="col-form-label">Subtitulo Sorteio</label>
                                                        <input class="form-control" type="email" value="Escolha sua sorte" id="example-email-input">
                                                    </div> -->

                                                    <div class="form-group">
                                                        <label for="example-tel-input" class="col-form-label">Quantos últimos sorteios</label>
                                                          <div class="form-group">
                                                        <select class="form-control" name="qtd_ultimos_sorteios">
                                                            <? if($parametros->qtd_ultimos_sorteios != ''){ ?>
                                                                <option value="<?=$parametros->qtd_ultimos_sorteios?>"><?=$parametros->qtd_ultimos_sorteios?></option>    
                                                            <? } ?>
                                                            <option>6</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                            <option>7</option>
                                                            <option>8</option>
                                                            <option>9</option>
                                                            <option>10</option>
                                                        </select>
                                                    </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="col-form-label">Título Ganhadores</label>
                                                        <input class="form-control" type="text" placeholder="Ganhadores"  name="titulo_ganhadores" value="<?=$parametros->titulo_ganhadores?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="example-email-input" class="col-form-label">Subtitulo Ganhadores</label>
                                                        <input class="form-control" type="text" placeholder="sortudos" id="example-email-input" name="subtitulo_ganhadores" value="<?=$parametros->subtitulo_ganhadores?>">
                                                    </div>
                                                       <div class="form-group">
                                                        <label for="example-tel-input" class="col-form-label">Quantos últimos Ganhadores</label>
                                                          <div class="form-group">
                                                        <select class="form-control" name="qtd_numeros_ganhadores">
                                                            <? if($parametros->qtd_numeros_ganhadores != ''){ ?>
                                                                <option value="<?=$parametros->qtd_numeros_ganhadores?>"><?=$parametros->qtd_numeros_ganhadores?></option>    
                                                            <? } ?>
                                                            <option>4</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>5</option>
                                                            <option>6</option>
                                                            <option>7</option>
                                                            <option>8</option>
                                                            <option>9</option>
                                                            <option>10</option>
                                                        </select>
                                                    </div>
                                                    </div>
                                                      <div class="form-group">
                                                        <label for="example-text-input" class="col-form-label">Grupo Whatsapp</label>
                                                        <input class="form-control" type="text"   name="link_whatsapp" value="<?=$parametros->link_whatsapp?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="example-email-input" class="col-form-label">Grupo Telegram</label>
                                                        <input class="form-control" type="text" placeholder="telegram.com" id="example-email-input" name="link_telegram" value="<?=$parametros->link_telegram?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="example-tel-input" class="col-form-label">Campos requeridos para realizar reserva</label>
                                                    </div>
                                                    
                                                    <div class="custom-control custom-checkbox primary-checkbox form-group" >
                                                        <div class="row">

                                                            <div class="col-3 mt-4">
                                                                <input type="checkbox" checked class="custom-control-input" id="customChecki1">
                                                                <label class="custom-control-label" for="customChecki1"> Nome</label>
                                                            </div>

                                                            <div class="col-3 mt-4">
                                                                <input type="checkbox" checked class="custom-control-input" id="customChecki2">
                                                                <label class="custom-control-label" for="customChecki2"> Telefone</label>
                                                            </div>

                                                            <div class="col-3 mt-4">
                                                                <? if($parametros->cad_dt_nascimento == '1'){ $sel_nasc = 'checked'; }else{ $sel_nasc = ''; } ?>
                                                                <input type="checkbox" <?=$sel_nasc?> class="custom-control-input" name="cad_dt_nascimento" value="1" id="customCheckidt_nascimento">
                                                                <label class="custom-control-label" for="customCheckidt_nascimento"> Data Nascimento</label>
                                                            </div>

                                                            <div class="col-3 mt-4">
                                                                <? if($parametros->cad_cpf == '1'){ $sel_cpf = 'checked'; }else{ $sel_cpf = ''; } ?>
                                                                <input type="checkbox" <?=$sel_cpf?> class="custom-control-input" name="cad_cpf" value="1" id="customCheckicpf">
                                                                <label class="custom-control-label" for="customCheckicpf"> CPF</label>
                                                            </div>
                                                            
                                                        </div>
                                                            

                                                    </div>
                                                    




                                                     <button type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Salvar</button>

                                                </div>

                                            </div>
                                        </div>

                                        </form>
                                    </div>

                           
                            </div>



                             

                <div class="tab-pane" id="raspadinha" role="tabpanel" aria-expanded="false">
                                <div class="card mb-4">
                                   
                                    <div class="col-12 mt-4">
                     <div class="card">
                        <div class="card-body">
                            <h4 class="card_title">CONFIGURAÇÃO RASPADINHA</h4>
                            <div class="form-group">
                                <label for="example-text-input" class="col-form-label">Porcentagem de faturamento para o sorteio</label>
                                <input class="form-control" type="text" value="Sino da Sorte" >
                            </div>
                            <div class="form-group">
                                <label for="example-email-input" class="col-form-label">Ganhadores</label>
                                 <div class="custom-control custom-radio primary-radio">
                                    <input type="radio" checked id="customRadio1" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Melhores Compradores</label>
                                </div>
                                 <div class="custom-control custom-radio primary-radio">
                                    <input type="radio" checked id="customRadio1" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Piores Compradores</label>
                                </div>
                                 <div class="custom-control custom-radio primary-radio">
                                    <input type="radio" checked id="customRadio1" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Variado</label>
                                </div>
                            </div>
                          
                           
                              <button type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Salvar</button>

                        </div>

                    </div>
                </div>


                                </div>

                           
                            </div>


                        <div class="tab-pane" id="dropdown1" role="tabpanel" aria-expanded="false">
                                <div class="card mb-4">
                                   
                                    <div class="col-12 mt-4">
                     <div class="card">
                        <div class="card-body">
                             
                          
                            <h4 class="card_title">
                                JONAS FERREIRA
                            </h4>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                        <tr>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Telefone</th>
                                            <th scope="col">E-mail</th>
                                            <th scope="col">CPF</th>
                                            <th scope="col">Função</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Porcentagem</th>
                                            <th scope="col">Editar</th>
                                            <th scope="col">Excluir</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Augusto Cezar</td>
                                            <td>(81) 99999-9999</td>
                                            <td>sinodasorte@gmail.com</td>
                                            <td>039.918.928-88</td>
                                            <td> <span class="badge badge-warning">Amin 1</span></td>
                                            <td> <span class="badge badge-success">Ativo</span></td>
                                            <td> <span class="badge badge-info">20%</span></td>
                                             <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-edit"></i></button></li>
                                                </ul>
                                            </td>
                                             <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-excluir-modal-lg"><i class="fa fa-trash"></i></button></li>
                                                </ul>
                                            </td>

                                        </tr>
                                        
                                    
                                       
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
                            <div class="tab-pane" id="dropdown2" role="tabpanel" aria-expanded="false">
                                <div class="card mb-4">
                                   
                                    <div class="col-12 mt-4">
                     <div class="card">
                        <div class="card-body">
                             
                          
                            <h4 class="card_title">
                                LISTA DE USUÁRIOS JONAS FERREIRA
                            </h4>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                        <tr>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Telefone</th>
                                            <th scope="col">E-mail</th>
                                            <th scope="col">CPF</th>
                                            <th scope="col">Função</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Porcentagem</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Augusto Cezar</td>
                                            <td>(81) 99999-9999</td>
                                            <td>sinodasorte@gmail.com</td>
                                            <td>039.918.928-88</td>
                                            <td> <span class="badge badge-warning">Gestor Trafego</span></td>
                                            <td> <span class="badge badge-success">Ativo</span></td>
                                            <td> <span class="badge badge-info">1%</span></td>
                                            
                                            

                                        </tr>
                                        <tr>
                                            <td>Augusto Cezar</td>
                                            <td>(81) 99999-9999</td>
                                            <td>sinodasorte@gmail.com</td>
                                            <td>039.918.928-88</td>
                                            <td> <span class="badge badge-warning">Gestor Trafego</span></td>
                                            <td> <span class="badge badge-success">Ativo</span></td>
                                            <td> <span class="badge badge-info">1%</span></td>
                                            
                                          
                                        </tr>
                                        <tr>
                                            <td>Augusto Cezar</td>
                                            <td>(81) 99999-9999</td>
                                            <td>sinodasorte@gmail.com</td>
                                            <td>039.918.928-88</td>
                                            <td> <span class="badge badge-warning">Gestor Trafego</span></td>
                                            <td> <span class="badge badge-success">Ativo</span></td>
                                            <td> <span class="badge badge-info">1%</span></td>
                                             
                                           
                                        </tr>
                                        <tr>
                                            <td>Augusto Cezar</td>
                                            <td>(81) 99999-9999</td>
                                            <td>sinodasorte@gmail.com</td>
                                            <td>039.918.928-88</td>
                                            <td> <span class="badge badge-warning">Gestor Trafego</span></td>
                                            <td> <span class="badge badge-success">Ativo</span></td>
                                            <td> <span class="badge badge-info">1%</span></td>
                                           
                                            
                                        </tr>
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

                              <div class="tab-pane" id="gestortrafego" role="tabpanel" aria-expanded="false">
                                <div class="card mb-4">
                                   
                                    <div class="col-12 mt-4">
                     <div class="card">
                        <div class="card-body">
                             <div class="form-group">
                                <input class="form-control" type="text" placeholder="Pesquisar por usuário" >
                            </div>
                            <div class="row">
                                
                            <div class="form-group col-lg-4 stretched_card mt-4">
                                <label class="col-form-label">Data:&nbsp;&nbsp;</label>
                                <select class="custom-select">
                                    <option selected="selected">Todos</option>
                                    <option value="1">hoje</option>
                                    <option value="2">7 dias</option>
                                    <option value="3">30 dias</option>
                                </select>
                            </div>
                             <div class="form-group col-lg-4 stretched_card mt-4">
                                <label class="col-form-label">Específica:&nbsp;&nbsp;</label>
                                 <input class="form-control" type="datetime-local" value="2018-07-19T15:30:00" id="example-datetime-local-input">

                            </div>
                              <div class="form-group col-lg-4 stretched_card mt-4">
                                <label class="col-form-label">Ordenar:&nbsp;&nbsp;</label>
                                <select class="custom-select">
                                    <option selected="selected">Data Cadastro Crescente</option>
                                    <option selected="selected">Data Cadastro Decrescente</option>
                                    <option value="1">Maiores Vendas</option>
                                    <option value="2">Menores Vendas</option>
                                </select>
                            </div>
                        </div><br>
                            <h4 class="card_title">
                                LISTA DE GESTORES DE TRAFEGO
                            </h4>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                        <tr>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Telefone</th>
                                            <th scope="col">E-mail</th>
                                            <th scope="col">CPF</th>
                                            <th scope="col">Função</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Porcentagem</th>
                                            <th scope="col">Editar</th>
                                            <th scope="col">Excluir</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Augusto Cezar</td>
                                            <td>(81) 99999-9999</td>
                                            <td>sinodasorte@gmail.com</td>
                                            <td>039.918.928-88</td>
                                            <td> <span class="badge badge-warning">Gestor Trafego</span></td>
                                            <td> <span class="badge badge-success">Ativo</span></td>
                                            <td> <span class="badge badge-info">1%</span></td>
                                             <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-edit"></i></button></li>
                                                </ul>
                                            </td>
                                             <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-excluir-modal-lg"><i class="fa fa-trash"></i></button></li>
                                                </ul>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Augusto Cezar</td>
                                            <td>(81) 99999-9999</td>
                                            <td>sinodasorte@gmail.com</td>
                                            <td>039.918.928-88</td>
                                            <td> <span class="badge badge-warning">Gestor Trafego</span></td>
                                            <td> <span class="badge badge-success">Ativo</span></td>
                                            <td> <span class="badge badge-info">1%</span></td>
                                             <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-edit"></i></button></li>
                                                </ul>
                                            </td>
                                             <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-excluir-modal-lg"><i class="fa fa-trash"></i></button></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Augusto Cezar</td>
                                            <td>(81) 99999-9999</td>
                                            <td>sinodasorte@gmail.com</td>
                                            <td>039.918.928-88</td>
                                            <td> <span class="badge badge-warning">Gestor Trafego</span></td>
                                            <td> <span class="badge badge-success">Ativo</span></td>
                                            <td> <span class="badge badge-info">1%</span></td>
                                             <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-edit"></i></button></li>
                                                </ul>
                                            </td>
                                             <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-excluir-modal-lg"><i class="fa fa-trash"></i></button></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Augusto Cezar</td>
                                            <td>(81) 99999-9999</td>
                                            <td>sinodasorte@gmail.com</td>
                                            <td>039.918.928-88</td>
                                            <td> <span class="badge badge-warning">Gestor Trafego</span></td>
                                            <td> <span class="badge badge-success">Ativo</span></td>
                                            <td> <span class="badge badge-info">1%</span></td>
                                             <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-edit"></i></button></li>
                                                </ul>
                                            </td>
                                             <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-excluir-modal-lg"><i class="fa fa-trash"></i></button></li>
                                                </ul>
                                            </td>
                                        </tr>
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
                            <div class="tab-pane" id="gestortrafegomescorrente" role="tabpanel" aria-expanded="false">
                                 <div class="card mb-4">
                                   
                                    <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                           <div class="form-group">
                                <input class="form-control" type="text" placeholder="Pesquisar por usuário" >
                            </div><br>

                             <div class="form-group stretched_card">
                                <label class="col-form-label">Vendas:&nbsp;&nbsp;</label>
                                 <input class="form-control" type="datetime-local" value="2018-07-19T15:30:00" id="example-datetime-local-input">

                            </div>

                            <div class="row">
                                
                            <div class="form-group col-lg-4 stretched_card mt-4">
                                <label class="col-form-label">Data:&nbsp;&nbsp;</label>
                                <select class="custom-select">
                                    <option selected="selected">Todos</option>
                                    <option value="1">hoje</option>
                                    <option value="2">7 dias</option>
                                    <option value="3">30 dias</option>
                                </select>
                            </div>
                             <div class="form-group col-lg-4 stretched_card mt-4">
                                <label class="col-form-label">Específica:&nbsp;&nbsp;</label>
                                 <input class="form-control" type="datetime-local" value="2018-07-19T15:30:00" id="example-datetime-local-input">

                            </div>
                              <div class="form-group col-lg-4 stretched_card mt-4">
                                <label class="col-form-label">Ordenar:&nbsp;&nbsp;</label>
                                <select class="custom-select">
                                    <option selected="selected">Data Cadastro Crescente</option>
                                    <option selected="selected">Data Cadastro Decrescente</option>
                                    <option value="1">Maiores Vendas</option>
                                    <option value="2">Menores Vendas</option>
                                </select>
                            </div>
                        </div>
                            <h4 class="card_title"><br>
                                EXTRATO GESTORES DE TRÁFEGO
                            </h4>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                        <tr>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Telefone</th>
                                            <th scope="col">E-mail</th>
                                            <th scope="col">CPF</th>
                                            <th scope="col">Cadastro</th>
                                            <th scope="col">%</th>
                                            <th scope="col">Vendas</th>
                                            <th scope="col">Comissão</th>
                                            <th scope="col">Editar</th>
                                            <th scope="col">Excluir</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                         <td><a href="indicado.html" target="_blank"> Stanley C. Owens</a></td>
                                            <td>(81) 999707073</td>
                                            <td>augustoqueiroz2008@hotmail.com</td>
                                            <td>111.222.333.444-883</td>
                                            <td>14-06-2023</td>
                                            <td> <span class="badge badge-info">1%</span></td>
                                            <td>R$ 3.700,00</td>
                                            <td>R$ 3.700,00</td>
                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-secondary"  title="Editar Comissão"><i class="fa fa-edit"></i></button></li>
                                                   <!-- <li><button type="button" class="btn btn-danger"><i class="ti-trash"></i></button></li>-->
                                                </ul>
                                            </td> <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-excluir-modal-lg"><i class="fa fa-trash"></i></button></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                         <td><a href="indicado.html" target="_blank"> Stanley C. Owens</a></td>
                                            <td>(81) 999707073</td>
                                            <td>augustoqueiroz2008@hotmail.com</td>
                                            <td>111.222.333.444-883</td>
                                            <td>24-08-2023</td>
                                            <td> <span class="badge badge-info">1%</span></td>
                                            <td>R$ 3.700,00</td>
                                            <td>R$ 3.700,00</td>
                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-secondary"  title="Editar Comissão"><i class="fa fa-edit"></i></button></li>
                                                   <!-- <li><button type="button" class="btn btn-danger"><i class="ti-trash"></i></button></li>-->
                                                </ul>
                                            </td>
                                             <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-excluir-modal-lg"><i class="fa fa-trash"></i></button></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                         <td><a href="indicado.html" target="_blank"> Stanley C. Owens</a></td>
                                            <td>(81) 999707073</td>
                                            <td>augustoqueiroz2008@hotmail.com</td>
                                            <td>111.222.333.444-883</td>
                                            <td>26-07-2023</td>
                                            <td> <span class="badge badge-info">1%</span></td>
                                            <td>R$ 3.700,00</td>
                                            <td>R$ 3.700,00</td>
                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-secondary"  title="Editar Comissão"><i class="fa fa-edit"></i></button></li>
                                                   <!-- <li><button type="button" class="btn btn-danger"><i class="ti-trash"></i></button></li>-->
                                                </ul>
                                            </td> <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-excluir-modal-lg"><i class="fa fa-trash"></i></button></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                         <td><a href="indicado.html" target="_blank"> Stanley C. Owens</a></td>
                                            <td>(81) 999707073</td>
                                            <td>augustoqueiroz2008@hotmail.com</td>
                                            <td>111.222.333.444-883</td>
                                            <td>26-09-2023</td>
                                            <td> <span class="badge badge-info">1%</span></td>
                                            <td>R$ 3.700,00</td>
                                            <td>R$ 3.700,00</td>
                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-secondary"  title="Editar Comissão"><i class="fa fa-edit"></i></button></li>
                                                   <!-- <li><button type="button" class="btn btn-danger"><i class="ti-trash"></i></button></li>-->
                                                </ul>
                                            </td> <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-excluir-modal-lg"><i class="fa fa-trash"></i></button></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                                </div>

                           
                            </div>


                             <div class="tab-pane" id="gestortrafegoextrato" role="tabpanel" aria-expanded="false">
                                  <div class="card mb-4">
                                   
                                    <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                           <div class="form-group">
                                <input class="form-control" type="text" placeholder="Pesquisar por usuário" >
                            </div><br>

                             <div class="form-group stretched_card">
                                <label class="col-form-label">Vendas:&nbsp;&nbsp;</label>
                                 <input class="form-control" type="datetime-local" value="2018-07-19T15:30:00" id="example-datetime-local-input">

                            </div>

                            <div class="row">
                                
                            <div class="form-group col-lg-4 stretched_card mt-4">
                                <label class="col-form-label">Data:&nbsp;&nbsp;</label>
                                <select class="custom-select">
                                    <option selected="selected">Todos</option>
                                    <option value="1">hoje</option>
                                    <option value="2">7 dias</option>
                                    <option value="3">30 dias</option>
                                </select>
                            </div>
                             <div class="form-group col-lg-4 stretched_card mt-4">
                                <label class="col-form-label">Específica:&nbsp;&nbsp;</label>
                                 <input class="form-control" type="datetime-local" value="2018-07-19T15:30:00" id="example-datetime-local-input">

                            </div>
                              <div class="form-group col-lg-4 stretched_card mt-4">
                                <label class="col-form-label">Ordenar:&nbsp;&nbsp;</label>
                                <select class="custom-select">
                                    <option selected="selected">Data Cadastro Crescente</option>
                                    <option selected="selected">Data Cadastro Decrescente</option>
                                    <option value="1">Maiores Vendas</option>
                                    <option value="2">Menores Vendas</option>
                                </select>
                            </div>
                        </div>
                            <h4 class="card_title"><br>
                                EXTRATO GESTORES DE TRÁFEGO
                            </h4>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                        <tr>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Telefone</th>
                                            <th scope="col">E-mail</th>
                                            <th scope="col">CPF</th>
                                            <th scope="col">Cadastro</th>
                                            <th scope="col">%</th>
                                            <th scope="col">Vendas</th>
                                            <th scope="col">Comissão</th>
                                            <th scope="col">Editar</th>
                                            <th scope="col">Excluir</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                         <td><a href="indicado.html" target="_blank"> Stanley C. Owens</a></td>
                                            <td>(81) 999707073</td>
                                            <td>augustoqueiroz2008@hotmail.com</td>
                                            <td>111.222.333.444-883</td>
                                            <td>14-06-2023</td>
                                            <td> <span class="badge badge-info">1%</span></td>
                                            <td>R$ 3.700,00</td>
                                            <td>R$ 3.700,00</td>
                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-secondary"  title="Editar Comissão"><i class="fa fa-edit"></i></button></li>
                                                   <!-- <li><button type="button" class="btn btn-danger"><i class="ti-trash"></i></button></li>-->
                                                </ul>
                                            </td> <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-excluir-modal-lg"><i class="fa fa-trash"></i></button></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                         <td><a href="indicado.html" target="_blank"> Stanley C. Owens</a></td>
                                            <td>(81) 999707073</td>
                                            <td>augustoqueiroz2008@hotmail.com</td>
                                            <td>111.222.333.444-883</td>
                                            <td>24-08-2023</td>
                                            <td> <span class="badge badge-info">1%</span></td>
                                            <td>R$ 3.700,00</td>
                                            <td>R$ 3.700,00</td>
                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-secondary"  title="Editar Comissão"><i class="fa fa-edit"></i></button></li>
                                                   <!-- <li><button type="button" class="btn btn-danger"><i class="ti-trash"></i></button></li>-->
                                                </ul>
                                            </td>
                                             <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-excluir-modal-lg"><i class="fa fa-trash"></i></button></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                         <td><a href="indicado.html" target="_blank"> Stanley C. Owens</a></td>
                                            <td>(81) 999707073</td>
                                            <td>augustoqueiroz2008@hotmail.com</td>
                                            <td>111.222.333.444-883</td>
                                            <td>26-07-2023</td>
                                            <td> <span class="badge badge-info">1%</span></td>
                                            <td>R$ 3.700,00</td>
                                            <td>R$ 3.700,00</td>
                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-secondary"  title="Editar Comissão"><i class="fa fa-edit"></i></button></li>
                                                   <!-- <li><button type="button" class="btn btn-danger"><i class="ti-trash"></i></button></li>-->
                                                </ul>
                                            </td> <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-excluir-modal-lg"><i class="fa fa-trash"></i></button></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                         <td><a href="indicado.html" target="_blank"> Stanley C. Owens</a></td>
                                            <td>(81) 999707073</td>
                                            <td>augustoqueiroz2008@hotmail.com</td>
                                            <td>111.222.333.444-883</td>
                                            <td>26-09-2023</td>
                                            <td> <span class="badge badge-info">1%</span></td>
                                            <td>R$ 3.700,00</td>
                                            <td>R$ 3.700,00</td>
                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-secondary"  title="Editar Comissão"><i class="fa fa-edit"></i></button></li>
                                                   <!-- <li><button type="button" class="btn btn-danger"><i class="ti-trash"></i></button></li>-->
                                                </ul>
                                            </td> <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-excluir-modal-lg"><i class="fa fa-trash"></i></button></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                                </div>
                                   <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                        <tr>
                                            <th scope="col">Vendas</th>
                                            <th scope="col">R$ 102.800,00</th>
                                            <th scope="col"></th>
                                            <th scope="col">Comissão</th>
                                            <th scope="col">R$ 14.800,00</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                      
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                           
                            </div>


                            <div class="tab-pane" id="contasemaberto" role="tabpanel" aria-expanded="false">
                                 <div class="card mb-4">
                                   
                                    <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                           <div class="form-group">
                                <input class="form-control" type="text" placeholder="Pesquisar por usuário" >
                            </div>

                        

                            <div class="row">
                                
                            <div class="form-group col-lg-2 stretched_card mt-4">
                                <label class="col-form-label">Data:&nbsp;&nbsp;</label>
                                <select class="custom-select">
                                    <option selected="selected">Todos</option>
                                    <option value="1">hoje</option>
                                    <option value="2">7 dias</option>
                                    <option value="3">30 dias</option>
                                </select>
                            </div>
                             <div class="form-group col-lg-4 stretched_card mt-4">
                                <label class="col-form-label">Específica:&nbsp;&nbsp;</label>
                                 <input class="form-control" type="datetime-local" value="Todas datas" id="example-datetime-local-input">

                            </div>
                              <div class="form-group col-lg-3 stretched_card mt-4">
                                <label class="col-form-label">Ordenar:&nbsp;&nbsp;</label>
                                <select class="custom-select">
                                    <option selected="selected">Data Criação Crescente</option>
                                    <option selected="selected">Data Criação Decrescente</option>
                                    <option value="1">Maiores Vendas</option>
                                    <option value="2">Menores Vendas</option>
                                </select>
                            </div>
                              <div class="form-group col-lg-3 stretched_card mt-4">
                                <label class="col-form-label">Status:&nbsp;&nbsp;</label>
                                <select class="custom-select">
                                    <option selected="selected">Todos</option>
                                    <option selected="selected">Aberto</option>
                                    <option value="1">Finalizada</option>
                                </select>
                            </div>
                        </div>
                            <h4 class="card_title"><br>
                                EXTRATO GESTORES DE TRÁFEGO
                            </h4>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                        <tr>
                                            <th scope="col">Sorteio</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Telefone</th>
                                            <th scope="col">Criada</th>
                                            <th scope="col">Números</th>
                                            <th scope="col">N. Vendidos</th>
                                            <th scope="col">N. em Falta</th>
                                            <th scope="col">Cotas</th>
                                            <th scope="col">Vendas</th>
                                            <th scope="col">Comissão</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Finalizar</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                         <td><a href="indicado.html" target="_blank"> 096754</a></td>
                                         <td><a href="usuarios-info.html" target="_blank"> Sonho de Rifa</a></td>
                                            <td>(81) 999707073</td>
                                            <td>14-06-2023</td>
                                            <td>1.000.000</td>
                                            <td>854.049</td>
                                            <td>145.951</td>
                                            <td>R$ 0,05</td>
                                            <td>R$ 102.645</td>
                                            <td>R$ 4.105,80</td>
                                            <td> <span class="badge badge-warning">Finalizado</span></td> <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-light" data-toggle="modal" data-target=".bd-excluir-modal-lg"><i class="fa fa-dollar"></i></button></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                         <td><a href="indicado.html" target="_blank"> 09435</a></td>
                                         <td><a href="indicado.html" target="_blank"> Chega Mais Rifa</a></td>
                                            <td>(81) 999707073</td>
                                            <td>14-06-2023</td>
                                            <td>1.000.000</td>
                                            <td>854.049</td>
                                            <td>145.951</td>
                                            <td>R$ 0,05</td>
                                            <td>R$ 102.645</td>
                                            <td>R$ 4.105,80</td>
                                            <td> <span class="badge badge-success">Aberto</span></td>
                                             <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-light" data-toggle="modal" data-target=".bd-excluir-modal-lg"><i class="fa fa-dollar"></i></button></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                         <td><a href="indicado.html" target="_blank"> 09867</a></td>
                                         <td><a href="indicado.html" target="_blank"> Rifa da Sorte</a></td>
                                            <td>(81) 999707073</td>
                                            <td>14-06-2023</td>
                                            <td>1.000.000</td>
                                            <td>854.049</td>
                                            <td>145.951</td>
                                            <td>R$ 0,05</td>
                                            <td>R$ 102.645</td>
                                            <td>R$ 4.105,80</td>
                                            <td> <span class="badge badge-success">Aberto</span></td>
                                            <td> <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-light" data-toggle="modal" data-target=".bd-excluir-modal-lg"><i class="fa fa-dollar"></i></button></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                         <td><a href="indicado.html" target="_blank"> 09098</a></td>
                                         <td><a href="indicado.html" target="_blank"> Rifando bem</a></td>
                                            <td>(81) 999707073</td>
                                            <td>14-06-2023</td>
                                            <td>1.000.000</td>
                                            <td>854.049</td>
                                            <td>145.951</td>
                                            <td>R$ 0,05</td>
                                            <td>R$ 102.645</td>
                                            <td>R$ 4.105,80</td>
                                            <td> <span class="badge badge-success">Aberto</span></td>
                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><button type="button" class="btn btn-light" data-toggle="modal" data-target=".bd-excluir-modal-lg"><i class="fa fa-dollar"></i></button></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                                </div>

                           
                            </div>


                        </div>
                    </div>
                </div>

            <div class="row">
              
                <div class="col-12 mt-4">
                    
                </div>
            </div>

        </div>




        <!--==================================*
                   Main Section
        *====================================-->
        <div class="main-content-inner">
             



             <div class="row" style="display: none;">
                <!-- Textual inputs -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card_title">Parametros</h4>
                            <!--<p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>-->

                            <form action="<?=base_url()?>adm/usuarios/set_parametros" method="post" enctype="multipart/form-data">

                                <div class="form-group">

                                    <label for="example-text-input" class="col-form-label">Imagem</label>

                                    <input type="file" name="img1" class="short" >


                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mt-6">
                                        <div class="form-group">
                                            <label for="example-datetime-local-input" class="col-form-label">Título Promoção</label>
                                            <input class="form-control" type="form-control"   placeholder="Promoção" name="tit_promocao" value="<?=$parametros->tit_promocao?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-6">
                                          <div class="form-group">
                                            <label for="example-datetime-local-input" class="col-form-label">Subtitulo Promoção</label>
                                            <input class="form-control" type="form-control"   placeholder="Compre mais barato!"  name="subtit_promocao" value="<?=$parametros->subtit_promocao?>">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-6 mt-6">

                                      <div class="form-group">
                                        <label for="example-datetime-local-input" class="col-form-label">Título Cotas</label>
                                        <input class="form-control" type="form-control"   placeholder="Cotas"  name="tit_cotas" value="<?=$parametros->tit_cotas?>">
                                    </div>
                                </div>
                                    <div class="col-lg-6 mt-6">
                                      <div class="form-group">
                                        <label for="example-datetime-local-input" class="col-form-label">Subtitulo Cotas</label>
                                        <input class="form-control" type="form-control"   placeholder="Escolha a quantidade da sua sorte"  name="subtit_cotas" value="<?=$parametros->subtit_cotas?>">
                                    </div>
                                </div>

                                </div>




                                <div class="row">
                                    <div class="col-lg-6 mt-6">
                                          <div class="form-group">
                                            <label for="example-datetime-local-input" class="col-form-label">Ver meus números</label>
                                            <input class="form-control" type="form-control"   placeholder="Ver meus números"  name="ver_numeros" value="<?=$parametros->ver_numeros?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-6">
                                        <div class="form-group">
                                            <label for="example-datetime-local-input" class="col-form-label">Subtítulo Números</label>
                                            <input class="form-control" type="form-control"   placeholder="Selecione a quantidade de números"  name="subtit_numeros" value="<?=$parametros->subtit_numeros?>">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
               
                                    <div class="col-lg-6 mt-4 stretched_card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card_title">Botões números</h4>

                                                    <div class="form-control-feedback">Digite os números de atalho para a compra de cotas</div><br>
                                                <div class="form-group has-primary">
                                                     <label></label><input type="number" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="+50" name="nm_bts[]" value="<?=$bt[1]?>">
                                                     <label></label><input type="number" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="+100" name="nm_bts[]" value="<?=$bt[2]?>">
                                                     <label></label><input type="number" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="+250" name="nm_bts[]" value="<?=$bt[3]?>">
                                                     <label></label><input type="number" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="+500" name="nm_bts[]" value="<?=$bt[4]?>">
                                                     <label></label><input type="number" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="+500" name="nm_bts[]" value="<?=$bt[5]?>">
                                                     <label></label><input type="number" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="+500" name="nm_bts[]" value="<?=$bt[6]?>">

                                                </div>
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-4 stretched_card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card_title">Número inicial padrão</h4>

                                                    <div class="form-control-feedback">Digite o número para cota minima</div><br>
                                                <div class="form-group has-primary">
                                                    <input type="number" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="50" name="numero_inicial" value="<?=$parametros->numero_inicial?>">
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 
                                <div class="row">
                                    <!-- Radios start -->
                                    <div class="col-lg-12 mt-4 stretched_card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card_title">Título valor a pagar</h4>

                                                <div class="form-group has-primary">
                                                    <input type="text" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="Participar do sorteio" name="tit_valor_a_pagar" value="<?=$parametros->tit_valor_a_pagar?>">
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
                                                    <label>Whatsapp</label><input type="text" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="whatsapp" name="link_whatsapp" value="<?=$parametros->link_whatsapp?>">
                                                </div>
                                                   <div class="form-group has-primary">
                                                    <label>Telegram</label><input type="text" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="telegram" name="link_telegram" value="<?=$parametros->link_telegram?>">
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

    <!-- MASK MONEY  -->
    <script src="<?php echo base_url()?>js/jquery.maskMoney.js" type="text/javascript"></script> 
    <script src='//alexgorbatchev.com/pub/sh/current/scripts/shCore.js' type='text/javascript'></script> 
    <script src='//alexgorbatchev.com/pub/sh/current/scripts/shBrushJScript.js' type='text/javascript'></script> 

    <script type="text/javascript" src="<?php echo base_url(); ?>plugins/tinymce/tinymce.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            $(".money").maskMoney({symbol:'R$ ', showSymbol:true, thousands:'.', decimal:',', symbolStay: true});

            //alert("FOI!");
            $(".remover_dd").click(function(){

                if (window.confirm("Você realmente deseja remover essa informação?")) {
                      
                    }else{
                        return false;
                    }

            })
        })
    </script>
        
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
