<?= $this->include("layout/header.php")?>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!--aqui va el sidebar-->
        <?= $this->include("layout/partials/sidebar")?>
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
                        <h1 class="h3 mb-0 text-gray-800"><?=$title?></h1>
                        
                    </div>
                    <div class="card shadow">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary"><?= $title?></h6>
                            <?php if(session("error")){?>
                                <div class="alert alert-danger" role="alert">
                                <?= session("error")?>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(session("errors")){?>
                                <div class="alert alert-danger" role="alert">
                                <?= print_r(session("errors"))?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="card-body">
                        <form action="<?= base_url("/products")?>" method="POST">
                            <div class="row">
                                <div class="form-group col-12 col-md-5">
                                    <label for="">Código</label>
                                    <input type="text" class="form-control form-control-user" name="code" placeholder="Ingrese el código del producto" value="<?=old("code")?>">
                                
                                </div>
                            
                                <div class="form-group col-12 col-md-5">
                                    <label for="">Titulo</label>
                                    <input type="text" class="form-control form-control-user" name="title" placeholder="Ingrese el titulo del producto" value="<?=old("title")?>">
                                </div>
                           
                         
                                <div class="form-group col-12 col-md-6">
                                    <label for="">Descripcion</label>
                                    <input type="text" class="form-control form-control-user" name="description" placeholder="Ingrese la descripción del producto" value="<?=old("description")?>">
                                </div>
                        
                           
                                <div class="form-group col-12 col-md-3">
                                    <label for="">Precio</label>
                                    <input type="number" class="form-control form-control-user" name="price" placeholder="Ingrese el precio del producto" value="<?=old("price")?>">
                                </div>
                       
                       
                                <div class="form-group col-12 col-md-3">
                                    <label for="">Existencia</label>
                                    <input type="number" class="form-control form-control-user" name="quantity" placeholder="Ingrese la cantidad del producto" value="<?=old("quantity")?>">
                                </div>
                                
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                            </form>
                        </div>
                    </div>
                  
                </div>
            </div>
    </div>
    </div>
    <?= $this->include("layout/footer.php") ?>