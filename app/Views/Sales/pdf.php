<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report de ventas</title>
    <link href="<?= base_url("assets/css/sb-admin-2.min.css") ?>" rel="stylesheet">
</head>

<body>
    <table width="80%" class="table table-border flex justify-content-center align-content-center">
        <thead>
            <tr>
                <th>N°. Venta</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Empleado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $idVenta = 0;
            foreach ($ventas as $venta) :
                if ($venta["id"] != $idVenta) :
            ?>
                    <tr class="bg-primary text-white">
                        <td><?= $venta["id"] ?></td>
                        <td><?= $venta["created_at"] ?></td>
                        <td><?= $venta["customer_id"] ?></td>
                        <td><?= $venta["total"] ?></td>
                        <td><?= $venta["employee_id"] ?></td>
                    </tr>
                <?php
                    $idVenta = $venta["id"];
                endif;
                ?>
                <tr>
                    <td colspan="2"><?= $venta["product_id"] ?></td>
                    <td><?= $venta["quantity"] ?></td>
                    <td><?= $venta["price"] ?></td>
                    <td><?= ($venta["quantity"] * $venta["price"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>