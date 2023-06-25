<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Providers</title>
</head>
<body>
<h1>Listado de Proveedores</h1>
    <table width="50%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre del proveedor</th>
                <th>Direccion</th>
                <th>Telefono</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data as $row) { ?>
        <tr>
            <td><?=$row["id"]?></td>
            <td><?=$row["name"]?></td>
            <td><?=$row["address"]?></td>
            <td><?=$row["phone"]?></td>
        </tr>
    <?php } ?>
        </tbody>
    </table>
    
</body>
</html>