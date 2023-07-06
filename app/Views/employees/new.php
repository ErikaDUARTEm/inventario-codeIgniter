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
                        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
                        
                    </div>
                    <div class="card shadow">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
                        </div>
                        <?php if(session("error")){?>
                                <div class="alert alert-danger" role="alert">
                                <?= session("error")?>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(session("errors")){?>
                                <div class="alert alert-danger" role="alert">
                                <?php foreach(session("errors") as $errors){?>
                                    <li><?=$errors?></li>
                                <?php } ?>
                                </div>
                                <?php } ?>
                            </div>
                            
                        <div class="card-body">
                            <form action="<?= base_url("/employees")?>" method="POST">
                                <div class="form-group">
                                    <label for="">Nombre del empleado</label>
                                    <input type="text" class="form-control form-control-user" name="name" placeholder="Ingrese el nombre del empleado" value="<?=old("name")?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control form-control-user" name="email" placeholder="Ingrese el email" value="<?=old("email")?>">
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