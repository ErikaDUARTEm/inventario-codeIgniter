<?= $this->include("layout/header.php")?>

<body id="page-top">

<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Bienvenid@!</h1>
                            </div>
                            <?php if(session("errors")){?>
                                <div class="alert alert-danger" role="alert">
                                <?php foreach(session("errors") as $errors){?>
                                    <li><?=$errors?></li>
                                <?php } ?>
                                </div>
                                <?php } ?>
                            <form class="user" action="<?=base_url("/auth")?>" method="POST">
                            <div class="form-group">
                                    <input type="email" class="form-control form-control-user"
                                        id="email" name="email" aria-describedby="emailHelp"
                                        placeholder="Ingrese su correo electronico..." value="<?=(!empty($email))? $email : null?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                        id="password" name="password" placeholder="Ingrese la contraseña" value="<?=(!empty($password))? $password : null?>">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="remenber" name="remenber" value="1" <?=(!empty($email))? "checked" : null ?>>
                                        <label class="custom-control-label" for="remenber">Remember
                                            Me</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Iniciar sesión
                                </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>


<?= $this->include("layout/footer.php") ?>