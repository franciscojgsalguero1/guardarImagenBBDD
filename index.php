<?php

    // include database and object files
    include_once 'config/database.php';
    include_once 'objects/Imagen.php';
    
    // titulo página web
    $page_title = "Read Images";

    // instantiate database and product object
    $database = new Database();
    $db = $database->getConnection();
?>

<form action="<?php echo "grabar.php";?>" method="post" enctype="multipart/form-data">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Photo</td>
            <td><input type="file" name="imagen" id="imagen" /></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Subir</button>
            </td>
        </tr>
    </table>
</form>

<form action="<?php echo "mostrar.php";?>" method="GET" enctype="multipart/form-data">
    <table class='table table-hover table-responsive table-bordered'>
        <tr><th>Photo</th></tr>
        <tr>
            <td>
                <label for="id">ID: </label>
                <input id="id" type="number" name="id">
            </td>
            <td>
                <button type="submit" class="btn btn-primary">Ver</button>
            </td>
        </tr>
    </table>
</form>