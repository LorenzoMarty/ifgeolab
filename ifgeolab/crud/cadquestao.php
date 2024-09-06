<?php session_start(); 
include "quilljs.php";
include "include.php"; ?>

<body>
    <?php
    require_once '../conecta.php';
    $conexao = conectar();
    $breadcrumb = "";
    navbar($breadcrumb);
    
    ?>
    <div class="container">
        <h4>Cadastrar Questões</h4>
        <hr>
        <form enctype="multipart/form-data" method="post" action="cadastrar.php" class="col s12 m6">
            <div class="row">
                <div class="input-field col s6">
                    <input id="nome" name="nome" type="text" class="validate">
                    <label for="nome">Nome</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <label for="descricao"> Descrição</label>
                    <div id="editor-container"></div>
                    <input type="hidden" id="descricao" name="descricao">
                </div>
            </div>
            <div class="row">
                <input type="radio" id="1" name="alternativas" value="A">
                <label for="1">Alternativa A</label>
                <input type="radio" id="2" name="alternativas" value="B">
                <label for="2">Alternativa B</label>
                <input type="radio" id="3" name="alternativas" value="C">
                <label for="3">Alternativa C</label>
                <input type="radio" id="4" name="alternativas" value="D">
                <label for="4">Alternativa D</label>
                <input type="radio" id="5" name="alternativas" value="E">
                <label for="5">Alternativa E</label>
                <div class="row">
                    <div class="input-field">
                        <label>Alternativa A:
                            <input type="text" name="alternativa1" />
                        </label><br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <label>Alternativa B:
                            <input type="text" name="alternativa2" />
                        </label><br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <label>Alternativa C:
                            <input type="text" name="alternativa3" />
                        </label><br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <label>Alternativa D:
                            <input type="text" name="alternativa4" />
                        </label><br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <label>Alternativa E:
                            <input type="text" name="alternativa5" />
                        </label><br><br>
                    </div>
                </div>
                <br><br>
                <div class="input-field col s12">
                    <button class="waves-effect waves-light btn green" type="submit" name="cadastrarQuestao">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>

    <?php
    include 'footer.php';
    ?>
    <script src="../js/quill.js"></script>