<?= $this->include("layout/header.php") ?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!--aqui va el sidebar-->
        <?= $this->include("layout/partials/sidebar") ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!--Aqui va el topbar-->
                <?= $this->include("layout/partials/topbar") ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
                    </div>
                    <div class="card shadow">
                        <div class="card-header d-sm-flex justify-content-between mb-4">
                            <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
                            <!--aqui va el boton -->
                            <a href="<?= base_url("/products/new") ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Nuevo Producto</a>
                        </div>
                        <div class="card-body ">
                            <?php if (session("success")) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session("success") ?>
                                </div>
                            <?php } ?>
                            <?php if (session("error")) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session("error") ?>
                                </div>
                            <?php } ?>
                            <table width="80%" class="table table-border">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Titulo</th>
                                        <th>Descripcion</th>
                                        <th>Precio</th>
                                        <th>Existencia</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                    <?php foreach ($products as $row) { ?>
                                        <tr>
                                            <td><?= $row["code"] ?></td>
                                            <td><?= $row["title"] ?></td>
                                            <td><?= $row["description"] ?></td>
                                            <td><?= $row["price"] ?></td>
                                            <td><?= $row["quantity"] ?></td>
                                            <td>
                                                <a href="<?= base_url("/products/edit/{$row["id"]}") ?>" class="btn btn-primary">Editar</a>
                                            </td>
                                            <td>
                                                <form action="<?= base_url("/products/{$row["id"]}") ?>" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" onclick="javascript:return confirm('¿Quieres eliminar este producto?')" class="btn btn-danger">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->include("layout/footer.php") ?>