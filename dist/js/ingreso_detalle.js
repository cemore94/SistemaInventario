
var ventaApp = angular.module("compraApp",['angularUtils.directives.dirPagination']);

ventaApp.controller('compraController', ['$scope','$http','$filter', function ($scope, $http, $filter) {
	
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
					value.subtotal = value.cantidad * value.precio;
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
		var nc=parseInt(cant);
		var precioventa=document.getElementById('precioventa_'+prod.idproducto).value;
		var npv=parseInt(precioventa);
		$scope.producto = { 
			idproducto:prod.idproducto,
			producto:prod.producto,
			cantidad:nc,
			stock:prod.unidades * prod.paquetes,
			precio:prod.precio,
			precioventa:npv,
			subtotal:prod.precio * nc
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