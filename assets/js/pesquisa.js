jQuery( document ).ready(function( $ ) {

    getResultados();

    $("#buscarGrupos").click(function ( event ) {
        //alert("estamos no caminho certo");
        event.preventDefault();
        let max_page = $('#limite').val();
        let page = 1;
        let pagina = 1;
        let resultados = 0;
        let prev_resultados = 0;
        let results = [];
        let number_requests = [];
        let init = true;
        $("#loader-background").removeClass('hide');

        $("#load-message-1").text("A busca está sendo efetuada.");
        $("#load-message-2").text("Por gentileza, aguarde...");
        $("#load-message-3").text("Página "+page+"/"+max_page+"   -   "+resultados+" resultados encontrados");

        $('.nav-tabs a[href="#resultado"]').tab('show');

        document.body.style.cursor = "wait";
        //console.log(data);
        for(page=1; page <= parseInt(max_page); page++){
            number_requests.push(page);
        }
        number_requests = number_requests.reverse();
        page = 1;

        try {

                var x = setInterval(function(){ 
                    if( init ){
                        let tmp_page = number_requests.pop();
                        let data = {
                            'Busca': {
                            'nome': $('#query').val(),
                            'page': tmp_page,
                            'limite': $('#limite').val(),
                            'origem': $("input[name='origem']:checked").val()
                            }
                        }

                        $.post(ajaxurl,{'action': 'pesquisa_grupos_whatsapp','data': data, },function( response ){

                            try{
                                response = JSON.parse(response);
                            
                                if(response.success == true){
                                    //atualizamos a lista
                                    //console.log(response.data);
                                    let tmp = response.data.filter((v, i, a) => a.indexOf(v) === i);
                                    resultados += tmp.length;
                                    let tmp_pagina = pagina;
    
                                    let tmp_i = [];
                
                                    for( i = prev_resultados; i <= resultados;i++ ){  
                                            //console.log("i: "+i);
                                            if(i>0){
                                                tmp_i.push(i);
                                            }            
                                            prev_resultados = i;
                                    }
                
                                    tmp_i = tmp_i.reverse();
                                    var myVar = setInterval(function(){ 
                                        $("#load-message-3").text("Página "+tmp_pagina+"/"+max_page+"   -   "+tmp_i.pop()+" resultados encontrados");
                                        if( tmp_i.length == 0 ){
                                            page++;
                                            clearInterval(myVar);
                                        }
                                    }, 100);
                
                                    response.data.map( (record) => {
                                        results.push(record);
                                    } );
                                }else{
                                    page++; 
                                }
                            }catch( e ){
                                page++;
                            }
                   
                
                        });

                        init = false;

                    }else if( page != pagina) {
                        pagina++;

                        if( page > max_page ){

                            clearInterval(x);

                            if( results.length > 0 ) {

                                    let data = {
                                        'Busca': {
                                        'nome': $('#query').val(),
                                        },
                                        'Resultados': {
                                            grupos: results
                                        }
                                    }

                                    $.post(ajaxurl,{'action': 'save_resultados','data': data },function( response ){

                                            getResultados();
                                            setTimeout(() => {                        
                                                    document.body.style.cursor = "default";
                                                    $("#loader-background").addClass('hide');
                                                    $("#load-message-1").text("");
                                                    $("#load-message-2").text("");
                                                    $("#load-message-3").text("");
                                            }, 2000);

                                            $('#query').val('');

                                    });
                            }else{
                                alert("Nenhum resultado encontrado");
                                setTimeout(() => {                        
                                        document.body.style.cursor = "default";
                                        $("#loader-background").addClass('hide');
                                        $("#load-message-1").text("");
                                        $("#load-message-2").text("");
                                        $("#load-message-3").text("");
                                }, 1000);

                                $('#query').val('');
                            }

                        }else {

                            let tmp_page = number_requests.pop();
                            let data = {
                                'Busca': {
                                'nome': $('#query').val(),
                                'page': tmp_page,
                                'limite': $('#limite').val(),
                                'origem': $("input[name='origem']:checked").val()
                                }
                            }
            
                            $.post(ajaxurl,{'action': 'pesquisa_grupos_whatsapp','data': data, },function( response ){
            
                                try{

                                    response = JSON.parse(response);
                                
                                    if(response.success == true){
                                        //atualizamos a lista
                                        //console.log(response.data);
                                        let tmp = response.data.filter((v, i, a) => a.indexOf(v) === i);
                                        resultados += tmp.length;
                    
                                        //console.log(pagina);
                                        let tmp_pagina = pagina;
                                        let tmp_i = [];
                    
                                        for( i = prev_resultados; i <= resultados;i++ ){  
                                            //setTimeout(() => {  
                                                console.log("i: "+i);
                                                tmp_i.push(i);            
                                                prev_resultados = i;
                                            //}, 500);          
                                        }
                    
                                        tmp_i = tmp_i.reverse();
                                        var myVar = setInterval(function(){ 
                                            $("#load-message-3").text("Página "+tmp_pagina+"/"+max_page+"   -   "+tmp_i.pop()+" resultados encontrados");
                                            if( tmp_i.length == 0 ){
                                                page++;
                                                clearInterval(myVar);
                                            }
                                        }, 100);
                    
                                        response.data.map( (record) => {
                                            results.push(record);
                                        } );
                                    }else{
                                        page++;
                                    } 

                                }catch( e ){
                                    page++;
                                }                
                    
                            });

                        }

                    }

                }, 10);

        }catch(e){
            $("#loader-background").addClass('hide');
            $("#load-message-1").text("");
            $("#load-message-2").text("");    
            $("#load-message-3").text("");  
            alert("Erro na busca");
        }

    });

    jQuery("#linkExportar").click(function(){

        let resultados_csv = "";
        $("#resultado_buscas tbody tr").each(function(index, tr) {
            let grupos = $(tr).data('grupos');
            let data = $(tr).find('td.data').html();
            let termo = $(tr).find('td.busca').html();
            let total = $(tr).find('td.total').html();
            resultados_csv = resultados_csv+termo+";"+total+";"+data+";"+grupos+"\n";
        });

        downloadContent("resultados.csv",resultados_csv);
    });

    $("body").on('click', '.excluir_resultado', function(){
        let r = confirm("Deseja realmente excluir este resultado?");
        if (r){
            $("#load-message-1").text("A operação está sendo processada.");
            $("#load-message-2").text("Por gentileza, aguarde...");
            $("#load-message-3").text("");    

            $("#loader-background").removeClass('hide');

          let id = $(this).data('id');
          let data = {
              'Resultado': {
                'id': id,
              },
              'Pesquisa': {
                'id': $(this).data('pesquisa_id')
              }
          }
  
          $.post(ajaxurl,{'action': 'apagar_resultado_pesquisa', 'data': data},function( response ){
              response = JSON.parse(response);
              if(response.success == true ){
                    getResultados();
              }else{
                  alert(response.message);
              }
              setTimeout(() => {
                $("#loader-background").addClass('hide');
                $("#load-message-1").text("");
                $("#load-message-2").text("");    
                $("#load-message-3").text("");                  
              }, 2000);
          });
        }
  
  
      });

    function downloadContent(name, content) {
        var atag = document.createElement("a");
        var file = new Blob([content], {type: 'text/plain'});
        atag.href = URL.createObjectURL(file);
        atag.download = name;
        atag.click();
      }

    function getResultados() {

        $.post(ajaxurl,{'action': 'find_all_resultados' },function( response ){

            document.body.style.cursor = "default";
            response = JSON.parse(response);
            if(response.success == true){
                //atualizamos a lista
                console.log(response.data);
                $("#resultado_buscas tbody").html("");
                response.data.map( (record, index) => resultadoItem( {record, index} ) );
            }else{
                alert("Erro: a busca não encontrou resultados");
            }

        });

    }

    function resultadoItem( {record, index} ){
        let data = record.data.substr(0, 10).split('-').reverse().join('/');
        let button = "<button data-id='"+record.id+"' data-pesquisa_id='"+record.pesquisa_id+"' class='btn btn-danger excluir_resultado'>Excluir</button>";
  
        $("#resultado_buscas tbody").append("<tr data-grupos='"+JSON.stringify(record.grupos)+"'>"+
                "<td class='data'>"+data+"</td>"+
                "<td class='busca'>"+record.termo+"</td>"+
                "<td class='total' >"+record.grupos.length+"</td>"+
                "<td class='acoes' >"+button+"</td>"+
        "</tr>");
      }

});
