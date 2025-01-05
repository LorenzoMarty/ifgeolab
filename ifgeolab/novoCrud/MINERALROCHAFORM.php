<?php
class MineralRochaForm extends Form
{
    private $crud;
    private $formtipo;

    public function __construct($formtipo, $idusuario, $action = "cadastrar.php")
    {
        $this->crud = new CRUD();
        $this->formtipo = $formtipo;
        // Configuração inicial do formulário
        parent::__construct($action, "POST", "multipart/form-data", "{$formtipo}", "col s12 m6");

        // Construir o formulário
        $this->buildForm($idusuario);
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

    public function buildForm($idusuario)
    {
        // Linha 1: Nome e Categoria
        $this->addRow([
            $this->addInput("text", "nome", "Nome", "", ["class" => "validate", "id" => "nome"], "s6"),
            $this->addInput("select", "cat", "Categoria", "", [
                "options" => $this->getCategoriaOptions(),
                "class" => "select-dropdown",
                "id" => "cat"
            ], "s6")
        ]);

        // Linha 2: Campo hidden para sugestão, id do usuário e Descrição (editor)
        $this->addRow([
            $this->addInput("hidden", "sugestao", "", "0"),
            $this->addInput("hidden", "idusuario", "", $idusuario),
            $this->addInput("hidden", "descricao", "", "", ["id" => "descricao"]),
            $this->addInput("custom", "", "", "", [
                "html" => '<div id="editor-container"></div>'
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