<form id='create-category-form' action='#' method='post' border='0'>
    <table class='table table-hover table-bordered'>
        <tr>
            <td>Nombre</td>
            <td><input type='text' name='categoria' class='form-control' required /></td>
        </tr>
        <tr>
            <td>Descripción</td>
            <td><textarea name='descripcion' class='form-control' required></textarea></td>
        </tr>
        
        <tr>
            <td></td>
            <td>                
                <button type='submit' class='btn btn-primary btn-sm'>
                   <span class='glyphicon glyphicon-plus'></span> Registrar Categoria
                </button>
            </td>
        </tr>
    </table>
</form>