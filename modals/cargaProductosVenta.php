<div class="modal fade" id="listaProductos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Buscar Productos</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                  <div class="row">
                    <div class="col-md-6">
                    <input type="text" class="form-control fc" placeholder="Buscar Productos ..." ng-model="buscarProducto">
                    <span class="glyphicon glyphicon-search"></span>                  
                </div>
              </div>
            </form>
            <br>
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr class="warning">
                      <th ng-click="sort('codigo')">codigo
                        <span class="glyphicon sort-icon" ng-show="sortKey=='codigo'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                      </th>
                      <th ng-click="sort('producto')">producto
                        <span class="glyphicon sort-icon" ng-show="sortKey=='producto'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                      </th>
                      <th ng-click="sort('categoria')">Categoria
                        <span class="glyphicon sort-icon" ng-show="sortKey=='categoria'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                      </th>
                      <th ng-click="sort('unidad')">Unidad
                        <span class="glyphicon sort-icon" ng-show="sortKey=='unidad'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                      </th>
                      <th>Stock</th>
                      <th>Cantidad</th>
                      <th class="text-center">Precio Venta</th>
                      <th>Descuento</th>

                      <th class="text-center"><i class="fa fa-gear fa-fw"></i></th>
                    </tr>                         
                    <tr dir-paginate="prod in productos | orderBy:sortKey:reverse | filter:buscarProducto | itemsPerPage:7">
                      <td>{{ prod.codigo }}</td>
                      <td>{{ prod.producto }}</td>
                      <td>{{ prod.categoria }}</td>
                      <td>{{ prod.unidad }}</td>
                      <td>{{ prod.stock }}</td>
                      <td class="col-xs-1"><input type="text" class="form-control" style="text-align:right" value="1" id="cantidad_{{ prod.idproducto }}"></td>                      
                      <td class="text-center">{{ prod.precio_venta | currency:'S/.'}}</td>
                      <td class="col-xs-1"><input type="text" class="form-control" id="descuento_{{ prod.idproducto }}" required="required"></td>                      
                      <td class="text-center">
                        <span>
                          <a  href="javascript:void(0);" ng-click="seleccionarProducto(prod.idproducto)">
                            <i class="glyphicon glyphicon-shopping-cart" style="font-size:24px;color: #5CB85C;"></i>
                          </a>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="9">
                        <span class="pull-right"> <!-- style="height: 14px; margin-bottom: 10px; margin-top: -15px;" -->
                          <dir-pagination-controls
                            max-size="5"
                            direction-links="true"
                            boundary-links="true">
                          </dir-pagination-controls>
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                
                </div>
          </div>
        </div>
      </div>
