$(function() {
     showClientes();
    });

    function changeTitle(page_title){
      $("#page-title").text(page_title);
      document.title=page_title;
    }

    function load(page){
        var q= $("#q").val();
        var per_page = $("#per_page").val();
        $("#loader").fadeIn('slow');
        $.ajax({
           url:'readAll.php?action=ajax&page='+page+'&q='+q+'&per_page='+per_page,
           beforeSend: function(objeto){
           $('#loader').html('<img src="../../dist/img/ajax-loader.gif" width="30px"> Cargando...');
           },
           success:function(data){
                $(".main").html(data).fadeIn('slow');
                $('#loader').html('');
            }
        });
    }

    function per_page(valor){
      $("#per_page").val(valor);
      load(1);
      $('.dropdown-menu li' ).removeClass( "active" );
      $("#"+valor).addClass( "active" );
    }

    function showClientes(){ 
          changeTitle("Lista de Clientes");
          $("#loader-pages").show();  
          $("#btn-new").show();
          $("#btn-select").show();
          $("#btn-list").hide();      
          $('.other').fadeOut('slow', function(){
              $("#loader-pages").hide();               
              load(1);
              $(".main").fadeIn("slow"); 
              $("#cab").fadeIn("slow");     
          });
    }

    $(document).on('click', '#btn-new', function(){
        changeTitle("Registrar Cliente");
        $("#loader-pages").show();
        $("#btn-new").hide();
        $("#btn-select").hide();        
        $("#btn-list").show();
        $("#cab").fadeOut("slow");     
        $(".main").fadeOut("slow", function(){ 
          $("#loader-pages").hide();                    
          $(".other").load("create_form.php", function(){              
            $(".other").fadeIn("slow", function(){                
              $(".other").fadeIn("slow");
            }); 
          });
        });
    });

    $(document).on('click', '#btn-list', function(){
        showClientes();
    });

    $(document).on('submit', '#create-cliente-form', function(){
        $.post("registrar.php", $(this).serialize())
          .done(function(){
              showClientes();
          });
        return false;
    });

    $(document).on('click', '#btn-edit', function(){
      var idcliente = $(this).closest('tr').find('#cliente-id').text();
      $("#loader-pages").show();
      changeTitle("Editar Cliente");
      $("#btn-new").hide();
      $("#btn-select").hide();  
      $("#btn-list").show();
      $("#cab").fadeOut("slow");
      $(".main").fadeOut('slow', function() {
        $("#loader-pages").hide();  
        $(".other").load("update_form.php?idcliente="+idcliente, function(){
            $(".other").fadeIn("slow");
        });
      });
    });

    $(document).on('submit', '#update-cliente-form', function(){
        $.post("actualizar.php", $(this).serialize())
          .done(function(){
              showClientes();
        });
       return false;
    });

    $(document).on('click', '#btn-remove', function(){
        var categoria_id = $(this).closest('tr').find('#categoria-id').text();
        var categoria = $(this).closest('tr').find('#categoria').text();
        var data = "categoria_id="+categoria_id;
        var confirm =  alertify.confirm('Eliminar Cliente','¿Estás seguro que deseas eliminar éste cliente: '+categoria+"?", null, null).set('labels', {ok:'ok', cancel:'cancel'});    
        
        confirm.set('onok', function(){
          $.post("delete.php", data)
            .done(function(response){
              if(response == 'Y'){
                alertify.success("Se eliminó el cliente: "+categoria);
                showProveedores();
              }
              if(response == 'N'){
                alertify.warning("Lo siento algo ha salido mal, intenta nuevamente");
              }
              if(response == 'V')
                alertify.error("No se pudo eliminar ésta Categoria. Existen productos vinculados a esta categoria");
                
          });
        });

        confirm.set('oncancel', function(){ //callbak al pulsar botón negativo
            alertify.error('No has eliminado la categoria: '+categoria);
        });
    });

