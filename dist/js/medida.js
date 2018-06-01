   
    $(function() {
      showUnidades();
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
    function showUnidades(){ 
          changeTitle("Lista de Unidades de Medida");
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
        changeTitle("Registrar Unidad de Medida");
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
        showUnidades();
    });

    $(document).on('submit', '#create-medida-form', function(){
        $.post("registrar.php", $(this).serialize())
          .done(function(){
             showUnidades();
          });
        return false;
    });

    $(document).on('click', '#btn-edit', function(){
      var medida_id = $(this).closest('tr').find('#medida-id').text();
      $("#loader-pages").show();
      changeTitle("Editar Unidad de Medida");
      $("#btn-new").hide();
      $("#btn-select").hide();  
      $("#btn-list").show();
      $("#cab").fadeOut("slow");
      $(".main").fadeOut('slow', function() {
        $("#loader-pages").hide();  
        $(".other").load("update_form.php?medida_id="+medida_id, function(){
            $(".other").fadeIn("slow");
        });
      });
    });

    $(document).on('submit', '#update-medida-form', function(){
        $.post("actualizar.php", $(this).serialize())
          .done(function(){
              showUnidades();
        });
       return false;
    });

    $(document).on('click', '#btn-remove', function(){
        var medida_id = $(this).closest('tr').find('#medida-id').text();
        var medida = $(this).closest('tr').find('#medida').text();
        var data = "medida_id="+medida_id;
        var confirm =  alertify.confirm('Eliminar Unidad de Medida','¿Estás seguro que deseas eliminar ésta Unidad de Medida: '+medida+"?", null, null).set('labels', {ok:'ok', cancel:'cancel'});    
        
        confirm.set('onok', function(){
          $.post("delete.php", data)
            .done(function(response){
              if(response == 'Y'){
                alertify.success("Se eliminó la Unidad de Medida: "+unidad);
                showUnidades();
              }
              if(response == 'N'){
                alertify.warning("Lo siento algo ha salido mal, intenta nuevamente");
              }
              if(response == 'V')
                alertify.error("No se pudo eliminar ésta Unidad de Medida. Existen productos vinculados a ésta.");
                
          });
        });

        confirm.set('oncancel', function(){ //callbak al pulsar botón negativo
            alertify.error('No has eliminado la Unidad de Medida: '+medida);
        });
    });

