   
    $(function() {
      showProductos();
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
    function showProductos(){ 
          changeTitle("Lista de Productos");
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
        changeTitle("Registrar Producto");
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
        showProductos();
    });


    function change(){
      initial =  $("#btn-change").attr("data-click");
      if(initial == "0"){
          selectestado = $("#btn-change").html();
          $("#btn-change").html("P");
          $("#btn-change").attr("data-click", "1");
      }
      if(initial == "1"){
          selectestado = $("#btn-change").html();
          $("#btn-change").html("U");
          $("#btn-change").attr("data-click", "0");
      }
      return selectestado;
    }

    $(document).on('submit', '#create-product-form', function(){
        codigo = $("#codigo").val();
        product = $("#product").val();
        idcategoria = $("#idcategoria").val();
        idunidad_medida = $("#idunidad_medida").val();
        unidades = $("#unidades").val();
        precio = $("#precio").val();
        stock = $("#stock").val();
        estado = $("#estado").val();

        change();
        $data = "codigo="+codigo+"&product="+product+"&idcategoria="+idcategoria+"&idunidad_medida="+idunidad_medida+"&select_unidad="+selectestado+"&unidades="+unidades+"&precio="+precio+"&stock="+stock+"&estado="+estado;         

        $.post("registrar.php", $data)
          .done(function(){
              showProductos();
          });
        return false;
    });

    $(document).on('click', '#btn-edit', function(){
      var idproducto = $(this).closest('tr').find('#producto-id').text();
      $("#loader-pages").show();
      changeTitle("Editar Producto");
      $("#btn-new").hide();
      $("#btn-select").hide();  
      $("#btn-list").show();
      $("#cab").fadeOut("slow");
      $(".main").fadeOut('slow', function() {
        $("#loader-pages").hide();  
        $(".other").load("update_form.php?idproducto="+idproducto, function(){
            $(".other").fadeIn("slow");
        });
      });
    });

    $(document).on('submit', '#update-producto-form', function(){
        $.post("actualizar.php", $(this).serialize())
          .done(function(){
              showProductos();
        });
       return false;
    });

    $(document).on('click', '#btn-remove', function(){
        var idproducto = $(this).closest('tr').find('#producto-id').text();
        var producto = $(this).closest('tr').find('#producto').text();
        var data = "idproducto="+idproducto;
        var confirm =  alertify.confirm('Eliminar Producto','¿Estás seguro que deseas eliminar éste Producto: '+producto+"?", null, null).set('labels', {ok:'ok', cancel:'cancel'});    
        
        confirm.set('onok', function(){
          $.post("delete.php", data)
            .done(function(response){
              if(response == 'Y'){
                alertify.success("Se eliminó el Producto: "+producto);
                showProductos();
              }
              if(response == 'N'){
                alertify.error("Lo siento algo ha salido mal, intenta nuevamente");
              }
                
          });
        });

        confirm.set('oncancel', function(){ //callbak al pulsar botón negativo
            alertify.error('No has eliminado el producto: '+producto);
        });
    });

