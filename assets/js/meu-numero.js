var user_id;
var interval;

jQuery( document ).ready(function( $ ) {

  user_id = $('#user_id').val();

  carregaNumero();

});

var carregaNumero = function() {
  $('#dadosNumero').html('');

  document.body.style.cursor = "wait";

  $.post(ajaxurl,{'action': 'meus_numeros','id': user_id },function( response ){
    response = JSON.parse(response);
    let data1 = new Date();
    let data2 = new Date(response.data.codigo_data);
    let diff = (data1-data2)/1000;

    let reenviotext = '<small id="reenviotext">Não recebeu o código? Clique para <a href="#" id="reenviar-codigo">reenviar sms</a>.</small>';

    if (diff < 3600) {
      let conta = 3600 - diff;
      let minutos = Math.floor(conta/60);
      let segundos = Math.floor((Math.ceil(conta/60) * 60) - (conta/60 * 60));

      minutos = minutos == 60 ? 59 : minutos;

      reenviotext = '<small id="reenviotext">Não recebeu o código? Aguarde <span id="minutos">'+(minutos < 10 ? '0'+minutos : minutos)+'</span>:<span id="segundos">'+(segundos < 10 ? '0'+segundos : segundos)+'</span> para pedir o reenvio.</small>';
      relogioStart();
    }

    if (response.success == true) {
      if (response.data.status == 0) {
        $('#dadosNumero').html('<div class="form-group"> \
                                  <label>Digite seu número: </label> \
                                  <input type="hidden" id="hfid" value="'+response.data.id+'" /> \
                                  <input type="text" id="txnumero" placeholder="+55 (99) 99999-9999" class="form-control" maxlength="13" /> \
                                </div> \
                                <input type="button" class="btn btn-success" value="Cadastrar número" id="cadastrar-numero">');
      }
      else if (response.data.status == 1) {
        $('#dadosNumero').html('<div class="form-group"> \
                                  <label>Seu número: </label> '+response.data.numero+'<br/> \
                                  <span style="color: Gray;"><i class="fa fa-circle"></i> INATIVO</span> \
                                </div> \
                                <p>Um SMS foi enviado para o seu número com o código para autorizar. Prencha o código abaixo:</p>\
                                <div class="form-group"> \
                                  <input type="hidden" id="hfid" value="'+response.data.id+'" /> \
                                  <input type="text" id="txcodigo" class="form-control" maxlength="6" /> <br/>\
                                  '+reenviotext+'\
                                </div> \
                                <input type="button" class="btn btn-success" value="Confirmar" id="confirmar-codigo"> <input type="button" class="btn btn-danger" value="Excluir número" id="excluir-numero">');
      }
      else if (response.data.status == 2) {
        $('#dadosNumero').html('<div class="form-group"> \
                                  <label>Seu número: </label> '+response.data.numero+'<br/> \
                                  <span style="color: Green;"><i class="fa fa-circle"></i> ATIVO</span> \
                                </div> \
                                <input type="hidden" id="hfid" value="'+response.data.id+'" /> \
                                <input type="button" class="btn btn-danger" value="Excluir número" id="excluir-numero">');
      }

      montaBotoes();
    }

    document.body.style.cursor = "default";
  });


}

var relogioStart = function() {

  var interval = setInterval(function() {

    let segundos = parseInt($('#segundos').html());
    let minutos = parseInt($('#minutos').html());
    segundos = segundos - 1;

    if (minutos > 0 && segundos < 0) {
      segundos = 59;
      minutos = minutos - 1;
    }

    if (minutos < 1 && segundos < 0) {
      clearInterval(interval);
      $('#reenviotext').html('Não recebeu o código? Clique para <a href="#" id="reenviar-codigo">reenviar sms</a>.');
      montaBotoes();
    }
    else {
      $('#segundos').html(segundos < 10 ? '0'+segundos : segundos);
      $('#minutos').html(minutos < 10 ? '0'+minutos : minutos);
    }
  }, 1000);
}

var montaBotoes = function() {

  $('#txnumero').mask('+55 (99) 99999-9999', {clearIfNotMatch: true, placeholder: "+55 (__) _____-____"});

  $("#cadastrar-numero").off('click');
  $("#cadastrar-numero").on('click', function(){
    document.body.style.cursor = "wait";
    let numero = $('#txnumero').val().replace(/\D/g,'');
    console.log(numero);
    if(numero.length < 13){
      alert("Número inválido");
    }else{
      let id = $('#hfid').val();

      let data = {
        id: id,
        numero: numero
      }

      $.post(ajaxurl,{'action': 'cadastrar_numero','data': data },function( response ){
        response = JSON.parse(response);
        if(response.success == true){

        }

        carregaNumero();

        document.body.style.cursor = "default";
      });
    }

  });

  $("#reenviar-codigo").off('click');
  $("#reenviar-codigo").on('click', function(){
    document.body.style.cursor = "wait";
    let id = $('#hfid').val();

    let data = {
      id: id
    }

    $.post(ajaxurl,{'action': 'reenviar_codigo','data': data },function( response ){
      response = JSON.parse(response);
      if(response.success == true){

      }

      carregaNumero();

      document.body.style.cursor = "default";
    });
  });

  $("#confirmar-codigo").off('click');
  $("#confirmar-codigo").on('click', function(){
    document.body.style.cursor = "wait";
    let id = $('#hfid').val();
    let codigo = $('#txcodigo').val();

    let data = {
      id: id,
      codigo: codigo
    }

    $.post(ajaxurl,{'action': 'confirmar_numero','data': data },function( response ){
      response = JSON.parse(response);
      if(response.success == true){

      }

      carregaNumero();

      document.body.style.cursor = "default";
    });
  });

  $("#excluir-numero").off('click');
  $("#excluir-numero").on('click', function(){
    if (confirm('Tem certeza que deseja excluir?')) {
      document.body.style.cursor = "wait";
      let id = $('#hfid').val();

      $.post(ajaxurl,{'action': 'excluir_numero','id': id },function( response ){
        response = JSON.parse(response);
        if(response.success == true){

        }

        carregaNumero();

        document.body.style.cursor = "default";
      });
    }
  });

}

/*0 - nao cadastrado
1 - cadastrado/nao autorizado
2 - autorizado

numero
user_id
status
codigo
codigo_data
*/
