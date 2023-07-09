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
                        </div>
                        <div class="card-body ">
                            <?php if (!empty($mensaje)) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= $mensaje ?>
                                </div>
                            <?php } ?>
                            <?php if (session("error")) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session("error") ?>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="customer">Seleccione al cliente</label>
                                <select class="js-example-basic-single form-control" name="customer" id="selectCustomer"></select>
                            </div>
                            <hr> 
                            <form action="<?= base_url("/search/product")?>" method="POST">
                            <div class="row justify-content-between ">
                                <div class="col-12 col-md-4 justify-content-center align-self-center">
                                    <div class="form-group">
                                        <label for="product">Seleccione el Producto</label>
                                        <select class="js-example-basic-single form-control" name="product" id="selectProduct"></select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 justify-content-center align-self-center">
                                    <div class="form-group">
                                        <label for="quantity">Indique la cantidad</label>
                                        <input type="number" class="form-control" name="quantity">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 justify-content-center align-self-center">
                                    <button class='btn btn-primary'>Agregar Producto</button>
                                </div>
                            </div>
                            </form>
                            
                        </div>

                        <div class="row form-group card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Descripción</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Importe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach(session("carrito") as $row):
                                        $num++;
                                    ?>
                                    <tr>
                                        <td><?=$num?></td>
                                        <td><?= $row["title"]?></td>
                                        <td><?= $row["quantity"]?></td>
                                        <td><?= $row["price"]?></td>
                                        <td><?= $row["quantity"] * $row["price"]?></td>
                                    </tr>
                                   <?php endforeach;?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" class="text-right">
                                            <button class="btn btn-danger">Cancelar venta</button>
                                            <button class="btn btn-primary">Generar Venta</button>
                                        </td>
                                    </tr>
                                    
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <script src="<?= base_url("assets/js/sales.js")?>"></script>
    <?= $this->include("layout/footer.php") ?>
