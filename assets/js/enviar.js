jQuery( document ).ready(function( $ ) {

  window.emojiPicker = new EmojiPicker({
    emojiable_selector: '[data-emojiable=true]',
    assetsPath: assetsPath,
    popupButtonClasses: 'fa fa-smile-o'
  });

  window.emojiPicker.discover();

  listGrupos('importados');

  $('.tipo').on('click', function() {

    if ($(this).prop('checked')) {
      listGrupos($(this).val());
    }

  });

  $('#mensagem_salva').on('click', function() {

    if ($(this).prop('checked')) {
      $('.mensagem-div').addClass('d-none');
      listMsgs();
    }
    else {
      $('#sl_mensagem_salva').addClass('d-none');
      $('.mensagem-div').removeClass('d-none');
    }

  });
  
  $('#sl_mensagem_salva').on('change', function() {
    if ($(this).val() != '' && $(this).val() != undefined) {

    }
  });

  $('#enviar_mensagem').on('click', function(e) {
    e.preventDefault();

    if ($('#grupos').val() == null || $('#grupos').val().length < 1) {
      alert('Selecione pelo menos um grupo.');
      return false;
    }
    else if ($('#mensagem_salva').prop('checked') && $('#sl_mensagem_salva').val() == '') {

    }
    else if ($('#mensagem').val() == '') {
      alert('Preencha a mensagem.');
      return false;
    }

    $('#enviar_mensagem').val('Enviando..');
    $('#enviar_mensagem').prop('disabled', true);

    let grupos = $('#grupos').val().join(';');
    let mensagem = $('#mensagem_salva').prop('checked') ? $('#sl_mensagem_salva').val() : $('#mensagem').val();
    let salvar_msg = $('#mensagem_salva').prop('checked') ? false : $('#salvar_mensagem').prop('checked');
    let emoji_aleatorio = $('#emoji_aleatorio').prop('checked');
    let tempo_espera = $('#tempo_espera').val();

    document.body.style.cursor = "wait";
    let data = {
      'grupos': grupos,
      'msg' : mensagem,
      'salvar_msg' : salvar_msg,
      'emoji_aleatorio': emoji_aleatorio,
      'tempo_espera': tempo_espera
    }

    $.ajax({
      type: 'POST',
      url: ajaxurl,
      data: {'action': 'send_mensagem','data': data },
      async: true,
      success: function (response) {
        response = JSON.parse(response);
        if(response.success == true){
          //atualizamos a lista
          alert('Mensagem enviada!');
        }else{
          alert(response.message);
        }

        document.body.style.cursor = "default";

        $('#enviar_mensagem').val('Enviar');
        $('#enviar_mensagem').prop('disabled', false);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(thrownError);
        console.log(xhr);
        console.log(ajaxOptions);

        document.body.style.cursor = "default";

        $('#enviar_mensagem').val('Enviar');
        $('#enviar_mensagem').prop('disabled', false);
      }
    });
  });

});

var listGrupos = function(tipo){

  $('.grupos-div').html('<select multiple class="form-control" data-actions-box="true" data-selected-text-format="count > 3" data-live-search="true" id="grupos" name="grupos[]"></select>');

  if (tipo == 'resultados') {

    $.post(ajaxurl,{'action': 'find_all_pesquisas', },function( response ){
      response = JSON.parse(response);
      if(response.success == true ){

        let content = '';
        response.data.map( (record, index) => {

          content += '<option value="r#'+record.id+'">'+record.termo+'</option>';

        } );
        
        $("#grupos").append(content);
        $('#grupos').selectpicker();
      }

    });

  }
  else {

    $.post(ajaxurl,{'action': 'find_all_grupos', },function( response ){
      response = JSON.parse(response);
      if(response.success == true ){

        let content = '';
        response.data.map( (record, index) => {
          content += '<option value="i#'+record.id+'">'+record.nome+'</option>';

        } );

        $("#grupos").append(content);
        $('#grupos').selectpicker();
      }
    });

  }
}

var listMsgs = function(){

  $('#sl_mensagem_salva').html('');

  $.post(ajaxurl,{'action': 'find_all_mensagens', },function( response ){
    response = JSON.parse(response);
    if(response.success == true ){

      let content = '<option>SELECIONE</option>';
      response.data.map( (record, index) => {

        content += '<option value="'+record.msg+'">'+record.msg+'</option>';

      } );
      
      $("#sl_mensagem_salva").append(content);
      $('#sl_mensagem_salva').removeClass('d-none');

    }

  });

}


