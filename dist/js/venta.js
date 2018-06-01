
    $(function() {
      showVentas();
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

    // Mostramos la lista de Categorias
    function showVentas(){ 
          changeTitle("Lista de Ventas");
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


    $(document).on('click', '#btn-list', function(){
        showVentas();
    });

    $(document).on('submit', '#create-ingreso-form', function(){
        $.post("registrar.php", $(this).serialize())
          .done(function(){
              showVentas();
          });
        return false;
    });

    $(document).on('click', '#btn-edit', function(){
      var idventa = $(this).closest('tr').find('#idventa').val();
      $("#loader-pages").show();
      changeTitle("Detalles de Venta");
      $("#btn-new").hide();
      $("#btn-select").hide();  
      $("#btn-list").show();
      $("#cab").fadeOut("slow");
      $(".main").fadeOut('slow', function() {
        $("#loader-pages").hide();  
        $(".other").load("show.php?idventa="+idventa, function(){
            $(".other").fadeIn("slow");
        });
      });
    });

    $(document).on('submit', '#update-category-form', function(){
        $.post("actualizar.php", $(this).serialize())
          .done(function(){
              showIngresos();
        });
       return false;
    });

    $(document).on('click', '#btn-remove', function(){
        var categoria_id = $(this).closest('tr').find('#categoria-id').text();
        var categoria = $(this).closest('tr').find('#categoria').text();
        var data = "categoria_id="+categoria_id;
        var confirm =  alertify.confirm('Eliminar Categoria','¿Estás seguro que deseas eliminar ésta categoria: '+categoria+"?", null, null).set('labels', {ok:'ok', cancel:'cancel'});    
        
        confirm.set('onok', function(){
          $.post("delete.php", data)
            .done(function(response){
              if(response == 'Y'){
                alertify.success("Se eliminó la categoria: "+categoria);
                showIngresos();
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

