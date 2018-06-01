var ventaApp = angular.module("ventaApp",['angularUtils.directives.dirPagination']);

ventaApp.controller('ventaController', ['$scope','$http','$filter', function ($scope, $http, $filter) {
	
	$scope.productos = [];
	$scope.productosAdd = [];
	$scope.producto = {};
	$scope.cargarProductos = function(){

		$http.get("productos.php").then(function($request){
			$scope.productos = $request.data;			
		});

			$scope.sort = function(keyname){
			$scope.sortKey = keyname;
			$scope.reverse = !$scope.reverse;
			}		
	};	

	$scope.seleccionarProducto = function($id_producto){
		var prod = $filter("filter")($scope.productos,{
			idproducto:$id_producto
		})[0];

		var cant=document.getElementById('cantidad_'+$id_producto).value;
		var nc = parseInt(cant);
		var agregar = true;

		if($scope.productosAdd.length == 0){
			$scope.agregarProducto(prod);
			agregar = false;
		}else{
			angular.forEach($scope.productosAdd, function(value, key){
				if(value["idproducto"] == $id_producto){
					value.cantidad = value.cantidad + nc;
					value.subtotal = (value.cantidad * value.precio_venta) - value.descuento ;
					agregar = false;
				}
			});
		}
		if(agregar){
			$scope.agregarProducto(prod);
		}

		$('#listaProductos').modal('hide');

	}

	$scope.agregarProducto = function(prod){
		var cant=document.getElementById('cantidad_'+prod.idproducto).value;
		var nc = parseInt(cant);
		var desc=document.getElementById('descuento_'+prod.idproducto).value;
		var nd = parseInt(desc);
		$scope.producto = { 
			idproducto:prod.idproducto,
			producto:prod.producto,
			cantidad:nc,
			stock:prod.unidades * prod.paquetes,
			precio_venta:prod.precio_venta,
			descuento: nd,
			subtotal:prod.precio_venta * nc - nd
		};

		$scope.productosAdd.push($scope.producto);
	}

	$scope.eliminarProducto = function(index){
		$scope.productosAdd.splice(index,1);

	}



	$scope.getTotal = function(){

		var total = 0;
		angular.forEach($scope.productosAdd, function(value, key){
				total += parseInt(value.subtotal);
		});
		return total;
	}

	$scope.getCantidadTotal = function(){

		var total = 0;
		angular.forEach($scope.productosAdd, function(value, key){
				total += value.cantidad;
		});
		return total;
	}


	
}]);