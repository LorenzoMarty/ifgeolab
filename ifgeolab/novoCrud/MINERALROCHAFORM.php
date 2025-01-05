<?php

include "CRUD.php";
include "Form.php";
class MineralRochaForm extends Form
{
    private $crud;
    private $formtipo;
    private $action;

    public function __construct($formtipo, $id = null, $action = "")
    {
        $this->crud = new CRUD();
        $this->formtipo = $formtipo;
        $this->action = $action;
        // Configuração inicial do formulário
        parent::__construct($action, "POST", "multipart/form-data", "{$formtipo}", "col s12 m6");

        // Construir o formulário
        $this->buildForm($id);
    }

    private function getCategoriaOptions()
    {
        $categoriaTable = ($this->formtipo == 'rocha') ? 'catrocha' : 'catmineral';
        $categorias = $this->crud->listar($categoriaTable);

        $options = [];
        foreach ($categorias as $dados) {
            $options[$dados['idcat']] = htmlspecialchars($dados['nome']);
        }

        return $options;
    }

    public function buildForm($id)
    {
        $dados = [];
        if ($id) {
            $tabela = ($this->formtipo == 'rocha') ? 'rocha' : 'mineral';
            $colunaId = ($this->formtipo == 'rocha') ? 'idrocha' : 'idmineral';
            $dados = ($this->crud->listar($tabela, [$colunaId => $id]))[0];
        }

        // Linha 1: Nome e Categoria
        $this->addRow([
            $this->addInput("text", "nome", "Nome", !empty($dados['nome']) ? $dados['nome'] : "", ["class" => "validate", "id" => "nome"], "s6"),
            $this->addInput("select", "cat", "Categoria", !empty($dados['idcat']) ? $dados['idcat'] : "", [
                "options" => $this->getCategoriaOptions(),
                "class" => "select-dropdown",
                "id" => "cat"
            ], "s6")
        ]);



        // Linha 2: Campo hidden para sugestão, id do usuário e Descrição (editor)
        $this->addRow([
            $this->addInput("hidden", "sugestao", "", !empty($dados['sugestao']) ? $dados['sugestao'] : ""),
            $this->addInput("hidden", "idusuario", "", !empty($dados['idusuario']) ? $dados['idusuario'] : ""),
            //$this->addInput("hidden", "descricao", "", !empty($dados['descricao']) ?   $dados['descricao']  : ""  , ["id" => "descricao"]),
            $this->addInput("custom", 'descricao', "", !empty($dados['descricao']) ? $dados['descricao'] : "", [
                "html" => '<div id="editor-container"> {{content_value}} </span></div>'
            ], "s12")
        ]);

        // Linha 3: Foto de Perfil e Objeto 3D
        $this->addRow([
            $this->addInput("custom", "", "", "", [
                "html" => '
                <div class="img-area" data-img="">
                    <i class="bx bxs-cloud-upload icon"></i>
                    <h3>Envie uma Foto de Perfil</h3>
                    <p>A Imagem não pode ser maior que <span>20MB</span></p>
                    <input name="arquivo" type="file" id="Capa" style="display: none;">
                </div>'
            ], "s6"),
            $this->addInput("file", "3d", "Objeto 3D:", "", ["id" => "3d"], "s6")
        ]);

        // Linha 4: Imagem Carrossel (upload múltiplo)
        $this->addRow([
            $this->addInput("custom", "", "Imagem Carrossel:", "", [
                "html" => '
                <div class="MultiFile-wrap input-field col s12">
                    <label>Imagem Carrossel:</label><br><br>
                    <input type="file" multiple="multiple" class="multi with-preview" name="multifile-test[]" id="upload_files">
                    <ul id="F9-Log" class="row"></ul>
                </div>'
            ], "s12")
        ]);

        // Linha 5: Botão de envio
        $this->addRow([
            $this->addInput("submit", "cadastrar" . ucfirst($this->formtipo), "", "Cadastrar", [
                "class" => "waves-effect waves-light btn green white-text"
            ], "s12")
        ]);
    }
}