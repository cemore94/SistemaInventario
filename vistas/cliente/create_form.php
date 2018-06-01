<form id='create-cliente-form' action='#' method='post' border='0'>
    <table class='table table-hover table-bordered'>
        <tr>
            <td>Cliente</td>
            <td><input type='text' name='nombres' class='form-control' required /></td>
        </tr>
        <tr>
            <td>Tipo de Documento</td>
            <td><input type='text' name='tipo_documento' class='form-control' required /></td>
        </tr>        
        <tr>
            <td>Num de Documento</td>
            <td><input type='text' name='num_documento' class='form-control' required /></td>
        </tr>
        <tr>
            <td>Direccion</td>
            <td><input type='text' name='direccion' class='form-control' required /></td>
        </tr>
        <tr>
            <td>Teléfono</td>
            <td><input type='text' name='telefono' class='form-control' required /></td>
        </tr>
        <tr>
            <td>E-Mail</td>
            <td><input type='text' name='email' class='form-control' required /></td>
        </tr>

        <tr>
            <td></td>
            <td>                
                <button type='submit' class='btn btn-primary btn-sm'>
                   <span class='glyphicon glyphicon-plus'></span> Registrar Cliente
                </button>
            </td>
        </tr>
    </table>
</form>