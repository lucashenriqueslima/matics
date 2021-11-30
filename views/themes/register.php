<div class="container">
<div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Cadastrar-se!</h1>
                            </div>
                            <form class="user" action="<?= route("/auth/register") ?>" method="post">
                            <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="name" name="name"
                                        placeholder="Seu Nome">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="Email" class="form-control form-control-user" id="email" name="email"
                                            placeholder="Email">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="cpf" name="cpf"
                                            placeholder="CPF (Apenas Números)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="passwd" name="passwd" placeholder="Senha">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="repeat_passwd" name="repeat_passwd"  placeholder="Repita a Senha">
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-user btn-block">Cadastre-se</button>

   

                            </form>
                            <hr>

                            <div class="text-center">
                                <a class="small" href="<?= route("") ?>">Voltar para página de login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>