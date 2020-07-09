jQuery( document ).ready(function( $ ) {

    listGrupos();
    $.fn.dataTable.moment( 'DD/MM/YYYY HH:mm:ss' );

    $("#importar").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('action','importar_numeros');

            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: formData,
                success: function(data) {
                    table.draw();
                    console.log(data);
                },
                cache: false,
                contentType: false,
                processData: false,
                xhr: function() { // Custom XMLHttpRequest
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                        myXhr.upload.addEventListener('progress', function() {
                            /* faz alguma coisa durante o progresso do upload */
                        }, false);
                    }
                    return myXhr;
                }
            });
    });

    $("#salvar-grupo").click( function(){
      document.body.style.cursor = "wait";
      let data = {
          'Grupo': {
            'nome': $('#grupoNome').val(),
          }
      }
      $.post(ajaxurl,{'action': 'add_grupo','data': data, },function( response ){
          response = JSON.parse(response);
          if(response.success == true){
              //atualizamos a lista
              listGrupos();
              $('#grupoNome').val('');
          }
          document.body.style.cursor = "default";


      });
    });

    $("#delete-grupo").click( function(){

      document.body.style.cursor = "wait";
      let ids = $("#grupoConfig").val();

      if( ids.includes("0") ){

        alert("este grupo não pode ser deletado. Grupo Padrão");
        document.body.style.cursor = "default";

      }else{

            ids.map( ( id ) => {

                  $.post(ajaxurl,{'action': 'delete_grupo','id': id },function( response ){
                      response = JSON.parse(response);
                      if(response.success == true){
                          //atualizamos a lista
                          listGrupos();
                      }
                      document.body.style.cursor = "default";

                  });

            } );

      }

    });

    function listGrupos(){

      $.post(ajaxurl,{'action': 'find_all_grupos', },function( response ){
          response = JSON.parse(response);
          if(response.success == true ){
              $("#grupoConfig").html("");
              $("#grupoConfig").append("<option value='0'>Grupo Padrão</option>");
              $("#listaGrupos").html("");
              $("#listaGrupos").append("<option value='0'>Grupo Padrão</option>");

              response.data.map( (record, index) => {
                $("#grupoConfig").append("<option value='"+record.id+"'>"+record.nome+"</option>");
                $("#listaGrupos").append("<option value='"+record.id+"'>"+record.nome+"</option>");

              } );

          }


      });

    }

    var table = jQuery('#listaNumerosTabela').DataTable({

        "processing": true,
        "serverSide": true,
        "autoWidth": false,
        "order": [[ 0, "desc" ]],
        'ajax':{
            "url":ajaxurl+'?action=find_all_numeros',
            "type": "POST",
            "data" : {
            }

        },
        "columns": [
            { className: "numero", "data": "numero",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {

                  let whatsapp = /*'55'+*/oData.numero;
                  whatsapp = whatsapp.replace("(","").replace(")","").replace("-","").replace(" ","");

                  var whatsapp_number = '<a href="https://api.whatsapp.com/send?phone='+
                  whatsapp+
                  '" target="_blank">'+oData.numero+'</a>';

                  jQuery(nTd).html(whatsapp_number);
                }
           },
            {className: "grupo", "data": "grupo"},


        ],
        "language":{
            "url":"//cdn.datatables.net/plug-ins/1.10.11/i18n/Portuguese-Brasil.json",
        },
    });

});
