<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Imagen</title>
</head>
<body>
    <form>
        <input id="id" type="number" name="id" value="<?php echo $_GET['id'] ?>" hidden>
    </form>
    <img <?php echo "src='leer.php?id={$_GET['id']}'" ?> border='0'>
</body>
</html>