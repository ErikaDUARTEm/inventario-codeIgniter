<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        body{
            font-family:'Courier New', Courier, monospace;
        }
        table thead{
            background-color: black;
            color:white;
        }
        .text-end{
            text-align: right;
        }
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
    <p>Cliente: <?=$cliente?></p>
    <table width="100%">
        <thead>
            <tr>
                <td>Código</td>
                <td>Descripción</td>
                <td>Cantidad</td>
                <td>Precio</td>
                <td>Importe</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($carrito as $row):?>
            <tr>
                <td><?=$row["code"]?></td>
                <td><?= $row["description"]?></td>
                <td class="text-center"><?= $row["quantity"]?></td>
                <td class="text-end"><?=number_format($row["price"],2)?></td>
                <td class="text-end"><?= number_format($row["quantity"] * $row["price"],2)?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>