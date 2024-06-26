<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Raspadinha</title>
    <!-- Bootstrap CSS via CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-bottom: 70px; /* Ajuste para garantir que o footer não cubra o conteúdo */
        }
    </style>
</head>

<body>
    <!-- Small modal -->
    

    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal_deposito">
      <!-- <div class="modal-dialog modal-sm"> -->
      <div class="modal-dialog modal-lg">
        <div class="modal-content" style="padding: 2em;">
            <div class="modal-header">
                <h5 class="modal-title" id="gridModalLabel">Depositar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>            
            
                <div class="col-12 col-sm" id="form_dep">
                    <!-- <form action="<?=base_url()?>adm/usuarios/set_campo_rasp" method="post">
                        <input type="hidden" name="id_rasp" value="<? #=$rasp->id?>"> -->
                        <!-- <input type="hidden" name="campo" value="preco_cota"> -->

                        <p>
                            <a href="#" class="heading mb-2 d-inline-block">Pagamento via Mercado Pago</a>
                            <br>
                            <span class="text-small text-muted">Digite o valor do deposito</span>
                            <div class="mb-3 filled">
                                <i data-acorn-icon="money"></i>
                                <!-- <input class="form-control money" placeholder="R$ 10,00" name="valor" value="<? #=$rasp->api_mercado_pago?>"> -->
                                <input class="form-control" type="number" placeholder="R$ 10,00" name="valor" id="valor_pix" style="border: green 1px solid;background-color: #90ee90;color:#030;height: 80px;font-size: 60px;">
                                <input type="hidden" id="valor_modal" value="0">
                            </div>
                        </p>
                        <p id="calc_val">...</p>
                        <button type="button" class="btn btn-icon btn-icon-start btn-outline-success mt-1" id="bt_pix">
                            <i data-acorn-icon="edit-square"></i>
                            <span>Gerar PIX</span>
                        </button>
                    <!-- </form> -->
                </div>
            
          
        </div>        


        <!-- outra modal -->
        <div class="modal-content" style="padding: 2em;display: none;" id="dd_pix">
            <div class="modal-body text-center">
                <img id="load" src="https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif?20151024034921" alt="" style="max-width: 80px;">

                <section class="itens-group">
                    <div class="item">
                        <div id="dix-pix">
                            <section class="order-pix-payment-container">
                                <section class="order-pix-payment-content">
                                    <div id="err_pay"></div>
                                    <ul>
                                        <li> <span class="badge"> 1 </span> Copie o código PIX abaixo: </li>
                                        <li>
                                            <div class="row-pix">
                                                <input name="code-pix" class="form-control" id="code-pix" />
                                                <button id="bt_copia" class="btn btn-success"> Copiar </button>
                                            </div>
                                        </li>                                        
                                        <div class="row alert alert-success" id="alert_cop_pix" style="display: none;">
                                            PIX Copiado com sucesso!
                                        </div>
                                    </section>
                                </section>

                            <!-- <p class="alert alert-success" style="display: none;">
                                É necessário o pagamento no valor de <strong id="valor_modal"> 0,00</strong> para <strong>finalizar a compra</strong>.
                            </p> -->
                                
                            <section class="pix-payment">
                                <img class="img-fluid" src="" id="img-pix" alt="QRCODE">
                                <h5> QR Code </h5>
                                <!-- <p>
                                    Acesse o APP do seu banco e escolha a opção pagar com QR Code, escaneie o código acima e confirme o pagamento.
                                </p> -->
                            </section> <!--/.pix-payment -->

                        </div> <!--/.dix-pix -->
                    </div>
                </section> <!--/.itens-group -->

                <section class="itens-group pix-premio">
                    <div class="item">
                        <!-- <img src="<?=base_url('imagens/default-user.png')?>" class="img-fluid" alt="Rifa Passada"> -->
                        <div class="info">
                            <h5> Raspe e Ganhe </h5>
                            
                        </div>
                    </div> <!--/.item -->
                </section> <!--/.itens-group -->

                <section class="itens-group pix-user" id="dd_last_reserva">
                    
                </section> <!--/.itens-group -->

            </div> <!--/.modal-body -->

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <!-- <button type="button" class="btn btn-primary">Gerar PIX</button> -->
            </div>                    
        </div> <!--/.modal-content -->

    </div> <!--/.modal-dialog -->
</div>

        <!-- outra modal -->


      </div>
    </div>
    <header class="navbar navbar-dark bg-dark" style="line-height: 0px;">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="<?=base_url()?>logo.png" alt="Logomarca" height="30">
            </a>
            <?php if($this->session->userdata('id')) { ?>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $this->session->userdata('nome'); ?> <!-- Exibindo o nome do usuário -->
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="font-size: 14px;">
                        <a class="dropdown-item bt_deposito" href="#" style="color:red" >Depositar</a>
                        <a class="dropdown-item" href="#">Meu Perfil</a>
                        <a class="dropdown-item" href="#">Configurações</a>
                        <div class="dropdown-divider"></div>
                        
                        <span class="dropdown-item-text" style="font-size: 14px;">Saldo: <strong>R$ <? #=number_format($this->usuarios_model->saldo(0,1), 2, ',', '.')?> <?php  #echo number_format($this->usuarios_model->saldo(0,1), 2, ',', '.'); ?></strong> <?=str_replace(".",",",$this->usuarios_model->saldo(0,1))?></span>

                        <!-- <span class="dropdown-item-text">Saldo: R$ <?php echo $this->usuarios_model->saldo(0,1); ?></span> -->
                        <hr>
                        <a class="dropdown-item" href="<?=base_url()?>home/sair">Sair</a>


                    </div>
                </div>
            <?php } else { ?>
                <form class="form-inline" action="<?=base_url()?>admin/logar" method="post">
                    <input class="form-control mr-sm-2" type="email" placeholder="E-mail" aria-label="Login" name="email">
                    <input class="form-control mr-sm-2" type="password" placeholder="Senha" aria-label="Senha" name="senha">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logar</button> 
                    <a class="btn btn-outline-primary my-2 my-sm-0" href="<?=base_url()?>/home/cadastro">Cadastre-se</a>
                </form>
            <?php } ?>
        </div>
    </header>

    <? if($this->session->userdata('id')){ ?>
        <?php if($this->usuarios_model->saldo(0,0) < 50 ){ ?>

            <div class="container mt-5" style="display: none;">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary btn-lg bt_deposito" style="width: 100%;" data-toggle="modal" data-target=".bd-example-modal-sm">Depositar **</button>                
                        
                    </div>
                </div>
            </div>
        <? } ?>
    <? } ?>

    


    <div class="container mt-5">
        <div class="row justify-content-center">
            
            <div class="col-md-8">
                <div class="content">
                    <!-- Conteúdo da página -->
                    <? if(!$this->session->userdata('id')){ ?>
                        <h2>Raspadinha</h2>
                        <p>Faça login ou cadastre-se.</p>
                    <? }else{ ?>
                        <!-- <h2>Raspadinha</h2>

                        <br><hr> -->
                        <canvas id="canvas" width="400" height="300"></canvas>

                    <? } ?>
                </div>
            </div>
        </div>
    </div>
    <? if($this->session->userdata('id')){ ?>
        <?php if($this->usuarios_model->saldo(0,0) < 50 ){ ?>

            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary btn-lg bt_deposito" style="width: 100%;" data-toggle="modal" data-target=".bd-example-modal-sm">Depositar</button>                
                        
                    </div>
                </div>
            </div>
        <? } ?>
    <? } ?>

    <footer class="footer mt-auto py-3 bg-light fixed-bottom">
        <div class="container" style="font-size: 12px;">
            <span class="text-muted">Raspei Ganhei &copy 2024 - Todos os direitos reservados.</span>
        </div>
    </footer>

    <!-- jQuery via CDN -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <!-- Bootstrap JS via CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- MASK MONEY  -->
    <script src="<?php echo base_url()?>js/jquery.maskMoney.js" type="text/javascript"></script> 
    <script src='//alexgorbatchev.com/pub/sh/current/scripts/shCore.js' type='text/javascript'></script> 
    <script src='//alexgorbatchev.com/pub/sh/current/scripts/shBrushJScript.js' type='text/javascript'></script> 


    <script type="text/javascript">
        $(document).ready(function(){

            $(".money").maskMoney({symbol:'R$ ', showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
            $(".porcentagem").maskMoney({symbol:'% ', showSymbol:true, thousands:'.', decimal:',', symbolStay: true});



        })
    </script>

    <script>
        $(document).ready(function(){
            //alert("OK");
            $(".bt_deposito").click(function(){
                $("#modal_deposito").modal('show');
                $("#valor_pix").focus();

                var input = $('#modal_deposito #valor_pix');

               
                // Espere 500 milissegundos (ou ajuste conforme necessário) antes de focar no input
                setTimeout(function() {
                    input.focus();
                }, 500);


                console.log('FOCUS');
            })
        })
    </script>



    <script>
    function carregarImagem() {
        var canvas = document.getElementById('canvas');
        var ctx = canvas.getContext('2d');

        var imagem = new Image();
        imagem.src = 'fundo.jpg';

        imagem.onload = function() {
            ctx.drawImage(imagem, 0, 0, canvas.width, canvas.height);
        };
    }

    // Função para carregar e desenhar a imagem no canvas
    function carregarImagem() {
        var canvas = document.getElementById('canvas');
        var ctx = canvas.getContext('2d');

        var imagem = new Image();
        imagem.src = 'https://tradersize.com/rapadinha/fundo.jpg';

        imagem.onload = function() {
            ctx.drawImage(imagem, 0, 0, canvas.width, canvas.height);
        };
    }

    function carregarBorracha() {
        var borracha = new Image();
        borracha.src = 'https://tradersize.com/rapadinha/borracha.png';
        return borracha;
    }

    // Função para apagar a imagem no canvas
    <? #if(!$this->agent->is_mobile()){ ?>
        function apagar_pc(event) {
            var canvas = document.getElementById('canvas');
            var ctx = canvas.getContext('2d');

            // Obter as coordenadas do mouse
            var mouseX = event.clientX - canvas.offsetLeft;
            var mouseY = event.clientY - canvas.offsetTop;

            // Carregar a borracha
            var borracha = carregarBorracha();

            // Definir a posição da borracha
            var x = mouseX - borracha.width / 2;
            var y = mouseY - borracha.height / 2;

            // Desenhar a borracha no canvas
            ctx.globalCompositeOperation = 'destination-out'; // Definir o modo de composição para apagar
            ctx.drawImage(borracha, x, y);
            ctx.globalCompositeOperation = 'source-over'; // Restaurar o modo de composição padrão

            // Definir o tamanho do borrão
            var raio = 20;

            // Apagar pixels na área do borrão
            
            for (var x = mouseX - raio; x < mouseX + raio; x++) {
                for (var y = mouseY - raio; y < mouseY + raio; y++) {
                    ctx.clearRect(x, y, 1, 1);
                }
            }
        
        }
    <? #} ?>
    <? #if($this->agent->is_mobile()){ ?>
        // Função para apagar a imagem no canvas com a borracha
        function apagar(event) {
            var canvas = document.getElementById('canvas');
            var ctx = canvas.getContext('2d');

            // Obter as coordenadas do toque ou clique
            var touch = event.touches ? event.touches[0] : event;
            var mouseX = touch.clientX - canvas.offsetLeft;
            var mouseY = touch.clientY - canvas.offsetTop;

            // Carregar a borracha
            var borracha = carregarBorracha();

            // Definir a posição da borracha
            var x = mouseX - borracha.width / 2;
            var y = mouseY - borracha.height / 2;

            // Desenhar a borracha no canvas
            ctx.globalCompositeOperation = 'destination-out'; // Definir o modo de composição para apagar
            ctx.drawImage(borracha, x, y);
            ctx.globalCompositeOperation = 'source-over'; // Restaurar o modo de composição padrão
        }
    <? #} ?>


    <? #if($this->agent->is_mobile()){ ?>
        // Adicionar eventos de toque e clique ao canvas
        var canvas = document.getElementById('canvas');
        canvas.addEventListener('touchmove', function(event) {
            event.preventDefault(); // Evitar comportamentos padrão, como o scroll da página
            apagar(event);
        });
        canvas.addEventListener('touchstart', apagar);
    <? #} ?>

    <? #if(!$this->agent->is_mobile()){ ?>
    // Adicionar evento de clique e movimento do mouse ao canvas após carregar a imagem
    window.onload = function() {
        carregarImagem();
        var canvas = document.getElementById('canvas');
        canvas.addEventListener('mousemove', function(event) {
            if (event.buttons === 1) { // verifica se o botão do mouse está pressionado
                apagar(event);
            }
        });
        canvas.addEventListener('mousedown', apagar);
    };
    <? #} ?>
</script>


<script>
    // PAGAMENTO
    $("#bt_pix").click(function(event){
      event.preventDefault();
      //alert("ss");
      //return false;
      const base_url = "https://raspeiganhei.com/ci/";
      var id_user = 1; // depois pegar dinamicamente
      //var valor_dep = parseFloat($("#ipt_calc_val").val())
      var valor_dep = parseInt($("#valor_pix").val());
      var qtd_numeros = 1;
      var id_sorteio = 1;

      //console.log(valor_dep);
      //return false;



      if(valor_dep == "" || valor_dep == "0"){
        $("#valor_pix").focus();
        alert("Preencha o valor corretamente ("+valor_dep+")");
        //$("#modalPix").hide();
        //return false;
      }else{

        
        // valor_modal
        var formatoMoeda = valor_dep.toLocaleString('pt-BR', {
          style: 'currency',
          currency: 'BRL'
        });
        $("#valor_modal").html(formatoMoeda);
        //$.post('https://loterialternativa.com.br/ci/user/process_payment_gpt/<?=$this->session->userdata('id')?>',{pix:true ,'valor_dep' : valor_dep},function(response){
        $.get(base_url+"home/verifica_login/", function(response_login){
            var call_lg = parseInt(response_login);
            $("#calc_val").html("Aguarde...");
            if(call_lg == 0){

                $("#modalPix").modal('hide');
                $("#depositoModal").modal('show');         
                $("#calc_val").html("deposito mocal show e modalpix hide");



            }else{ //  x if == 0

                $("#depositoModal").modal('hide');                
                //$("#modalPix").modal('show');
                $("#calc_val").html("deposito mocal hide");

                $("#img-pix").attr('src', '');
                $("#code-pix").val("");

                console.log("base_url: "+base_url);
                
                $("#dd_pix").show();
                $("#form_dep").hide();

                $.post(base_url+"pay/process_payment/"+id_user+"/"+id_sorteio,{pix:true ,'valor_dep' : valor_dep, 'qtd_numeros' : qtd_numeros},function(response){
                    console.log(response);

                    //$("#err_pay").html("<span style='color:red'>"+msg+"</span>");
                    /*
                    if(response == "999"){
                        var msg = "Máximo de reserva atingido.";
                        $("#modalPix").modal('hide');                        
                        $("#bt_fechar_pix").click();
                        alert(msg);                        
                        return false;
                    }

                    if(response == "111"){
                        var msg = "Mínimo de reserva não atingida.";
                        $("#modalPix").modal('hide');                       
                        $("#bt_fechar_pix").click(); 
                        alert(msg);                        
                        return false;
                    }

                    if(response == "555"){
                        var msg = "Valor não validado.";
                        $("#modalPix").modal('hide');      
                        $("#bt_fechar_pix").click();
                        alert(msg);                        
                        return false;
                    }
                    */

                    $("#modalPix").modal('show');
                    $("#calc_val").html("R$ "+valor_dep);
                    //contador();

                    // inicia contagem

                  try {
                    
                    var obj = JSON.parse(response);
                    if(typeof obj.status != "undefined"){

                      if(obj.status){
                        alert(obj.message);
                      } // x id status

                    }else{

                      if(obj.transaction_data.qr_code_base64 == "NULL"){
                        alert("Error base64 NULL");
                        return false;
                      }

                      if(typeof obj.transaction_data.qr_code_base64 == "undefined"){
                        alert("Error typeof");
                        return false;
                      }

                      console.log(obj.transaction_data);

                      var base64 = obj.transaction_data.qr_code_base64;
                      var codePix = obj.transaction_data.qr_code;
                      //alert(codePix);

                      $("#load").hide();

                      $("#img-pix").attr('src', 'data:image/jpeg;base64,'+base64);
                      $("#img-pix").css('max-width','150px');
                      
                      $("#code-pix").val(codePix);
                      //
                      
                      //$("#code-pix").val(obj.transaction_data.qr_code_base64);

                      $("#dix-pix").show();

                      var intervalId = setInterval(function () {
                      // verifica_pagamento_mp
                      console.log("GET...");
                      $.post(base_url + "user/verifica_last_pay/" + id_sorteio, function(response_pay){
                          console.log("response_pay: ");
                          console.log(response_pay);
                          if (response_pay == "approved") {
                            console.log("aprovado------");
                              $("#modalPix").modal('hide');
                              $("#modalPixOk").modal('show');
                              // Pare o setInterval
                              clearInterval(intervalId);
                              // Redirecione após a requisição user/verifica_last_pay/ ser concluída
                              //window.location = base_url + "sorteio/meus_numeros/" + id_sorteio;
                          } else {
                              $.get(base_url + 'user/verifica_last_reserva/' + id_sorteio , function(last_dep) {
                                  $("#dd_last_reserva").html(last_dep);
                              });
                          }
                      });
                  }, 15000);

                      // // verifica pagamento imadiatamente
                      // setInterval(function () {
                      //       // verifica_pagamento_mp
                      //       console.log("GET...");
                      //       $.post(base_url+"user/verifica_last_pay/"+id_sorteio, function(response_pay){
                      //           console.log("response_pay: ");
                      //           console.log(response_pay);
                      //           if(response_pay == "approved"){
                      //               $("#modalPix").modal('hide');
                      //               $("#modalPixOk").modal('show');
                      //               // sorteio/meus_numeros/31
                      //               window.location = base_url+"sorteio/meus_numeros/"+id_sorteio;
                      //               return;
                                    

                      //           }else{

                      //             $.get(base_url+'user/verifica_last_reserva/'+id_sorteio , function(last_dep){
                      //               $("#dd_last_reserva").html(last_dep);
                      //             })

                      //           }
                                
                      //       })
                      //   }, 15000);





                    }

                  } catch(e) {
                    // statements
                    console.log(e);
                    //console.log("error");
                  } 
                      

                });

            } // x else == 0
            console.log(response_login);
        }); // x verifica_login
        return false;

        
        


      } // x else
    });

        $("#code-pix").focus(function(){
            //copiarTexto();
            let textoCopiado = document.getElementById("code-pix");
            textoCopiado.select();
            textoCopiado.setSelectionRange(0, 99999)
            document.execCommand("copy");
            console.log("Copiado:" + textoCopiado.value);
            $("#alert_cop_pix").show('show');
            $('#code-pix').blur();
            var intervalo = setInterval(function() {
              clearInterval(intervalo); // Parar o intervalo após 5 segundos
            }, 5000);

            setTimeout(esconderDiv, 5000);


        })

        $("#bt_copia").click(function(){

          let textoCopiado = document.getElementById("code-pix");
          textoCopiado.select();
          textoCopiado.setSelectionRange(0, 99999)
          document.execCommand("copy");
          console.log("Copiado:" + textoCopiado.value);
          $("#alert_cop_pix").show('show');

          var intervalo = setInterval(function() {
            clearInterval(intervalo); // Parar o intervalo após 5 segundos
          }, 5000);

          setTimeout(esconderDiv, 5000);

        })

        function esconderDiv() {
          var minhaDiv = document.getElementById('code-pix');
          //minhaDiv.style.display = 'none';
          $("#alert_cop_pix").hide('slow');
        }


</script>


</body>

</html>
