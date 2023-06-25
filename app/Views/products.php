<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>
<body>
    <h1>Listado de Productos</h1>
    <table width="80%">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Existencia</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($products as $row) { ?>
        <tr>
            <td><?=$row["code"]?></td>
            <td><?=$row["title"]?></td>
            <td><?=$row["description"]?></td>
            <td><?=$row["price"]?></td>
            <td><?=$row["quantity"]?></td>

        </tr>
    <?php } ?>
        </tbody>
    </table>
    
</body>
</html>