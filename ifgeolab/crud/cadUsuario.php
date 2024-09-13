<?php include "include.php"; ?>

<link rel="stylesheet" href="../css/image.css">
<link rel="stylesheet" href="../css/login.css">
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet' />

<body>
    <div class="container">
        <div class="login-section">
            <h1>Cadastrar</h1>
            <!-- <hr class="divider"> -->
            <form action="cadastrar.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="input-field">
                        <label for="nome">Nome</label> <i class="fas fa-user"></i>
                        <input type="text" name="nome" id="nome" required />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="email">Email</label> <i class="fas fa-envelope"></i>
                        <input type="email" name="email" id="email" required />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="senha">Senha</label> <i class="fas fa-lock"></i>
                        <input type="password" name="senha" id="senha" required />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="matricula">Matrícula</label> <i class="fas fa-id-card"></i>
                        <input type="text" name="matricula" id="matricula" required />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="inst">Instituição</label> <i class="fas fa-school"></i>
                        <input type="text" name="inst" id="inst" required />
                    </div>
                </div>
                <div class="form-group">
                    <div class="img-area" data-img="">
                        <i class='bx bxs-cloud-upload icon'></i>
                        <h3>Envie uma Foto de Perfil</h3>
                        <p>A Imagem não pode ser maior que <span>20MB</span></p>
                        <input name="arquivo" type="file" id="Capa" style="display: none;">
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="cadastrarUsuario">Cadastrar</button>
                </div>
            </form>
            <!-- <div class="center">
                <a href="../login.php">Login</a>
            </div> -->
        </div>
        <div class="image-section"></div>
    </div>
</body>

<script src="../js/image.js"></script>