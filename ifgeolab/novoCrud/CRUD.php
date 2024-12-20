<?php

class CRUD
{

    private function conectar()
    {
        $conexao = mysqli_connect("localhost", "root", "", "ifgeolab");
        if ($conexao === false) {
            echo "Erro ao conectar à base de dados. Nº do erro: " . mysqli_connect_errno() . ". " . mysqli_connect_error();
            die();
        }
        return $conexao;
    }

    // Função para executar comandos SQL
    private function executarSQL($conexao, $sql)
    {
        $resultado = mysqli_query($conexao, $sql);
        if ($resultado === false) {
            echo "Erro ao executar o comando SQL. " . mysqli_errno($conexao) . ": " . mysqli_error($conexao);
            die();
        }
        return $resultado;
    }

    // cadastrar: Insere um novo registro na tabela
    public function cadastrar($tabela, $comando)
    {
        $conexao = $this->conectar();

        $coluna = implode(", ", array_keys($comando));
        $valores = implode(", ", array_map(fn($valores) => "'" . mysqli_real_escape_string($conexao, $valores) . "'", array_values($comando)));

        $sql = "INSERT INTO $tabela ($coluna) VALUES ($valores)";
        return $this->executarSQL($conexao, $sql);
    }

    // listar: Busca registros na tabela com base em condições
    public function listar($tabela, $condicao = [], $coluna = "*")
    {
        $conexao = $this->conectar();
        $sql = "SELECT $coluna FROM $tabela";

        if (!empty($condicao)) {
            $clausulas = [];
            foreach ($condicao as $key => $value) {
                $clausulas[] = "$key = '" . mysqli_real_escape_string($conexao, $value) . "'";
            }
            $sql .= " WHERE " . implode(" AND ", $clausulas);
        }
        $result = $this->executarSQL($conexao, $sql);

        if (!$result) {
            die("Erro ao executar consulta: " . mysqli_error($conexao));
        }

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }


    // editar: Atualiza registros na tabela
    public function editar($tabela, $comando, $condicao)
    {
        $conexao = $this->conectar();

        $set = implode(", ", array_map(fn($key, $value) => "$key = '" . mysqli_real_escape_string($conexao, $value) . "'", array_keys($comando), $comando));
        $where = implode(" AND ", array_map(fn($key, $value) => "$key = '" . mysqli_real_escape_string($conexao, $value) . "'", array_keys($condicao), $condicao));

        $sql = "UPDATE $tabela SET $set WHERE $where";
        return $this->executarSQL($conexao, $sql);
    }

    public function deletar($tabela, $condicao)
    {
        $conexao = $this->conectar();

        $where = implode(" AND ", array_map(fn($key, $value) => "$key = '" . mysqli_real_escape_string($conexao, $value) . "'", array_keys($condicao), $condicao));
        $sql = "DELETE FROM $tabela WHERE $where";

        return $this->executarSQL($conexao, $sql);
    }
}

class Form
{
    private $action;
    private $method;
    private $enctype;
    private $id;
    private $class;
    private $rows = [];
    private $formtipo;

    public function __construct($action = "", $method = "POST", $enctype = "multipart/form-data", $formtipo = "", $class = "col s12 m6")
    {
        $this->action = $action;
        $this->method = $method;
        $this->enctype = $enctype;
        $this->formtipo = $formtipo;
        $this->id = "cad{$formtipo}";
        $this->class = $class;
    }

    public function addRow(array $inputs = [])
    {
        $this->rows[] = $inputs;
    }

    public function addInput($type, $name, $label = "", $value = "", $attributes = [], $colSize = "s12", $customClass = "input-field col")
    {


                        
        return [
            'type' => $type,
            'name' => $name,
            'label' => $label,
            'value' => htmlspecialchars($value, ENT_QUOTES, 'UTF-8'),
            'attributes' => $attributes,
            'customClass' => $customClass,
            'colSize' => $colSize
        ];
    }

    public function render()
    {
        $formHTML = "<form action='{$this->action}' method='{$this->method}' enctype='{$this->enctype}' id='{$this->id}' class='{$this->class}'>\n";

        foreach ($this->rows as $row) {
            $formHTML .= "\t<div class='row'>\n";
            foreach ($row as $input) {
                // Define a classe personalizada e o tamanho da coluna
                $customClass = $input['customClass'];
                $colSize = $input['colSize'];

                // Não aplica a classe input-field para inputs do tipo hidden
                if ($input['type'] !== 'hidden') {
                    $formHTML .= "\t\t<div class='{$customClass} {$colSize}'>\n";
                }

                if ($input['type'] === 'custom') {

                   $customHtml = str_replace("{{content_value}}", $input['value'] , $input['attributes']['html'] );

                    // Adiciona o HTML diretamente
                   // $formHTML .= "\t\t\t" . ($input['attributes']['html'] ?? '') . "\n";
                   $formHTML .= "\t\t\t" . $customHtml . "\n";
                } else {
                    if (!empty($input['label'])) {
                        $formHTML .= "\t\t\t<label for='{$input['name']}'>{$input['label']}</label>\n";
                    }

                    $attributesString = $this->parseAttributes($input['attributes']);

                    switch ($input['type']) {
                        case "select":
                            $formHTML .= $this->renderSelect($input['name'], $input['value'], $attributesString, $input['attributes']);
                            break;
                        case "textarea":
                            $formHTML .= "\t\t\t<textarea name='{$input['name']}' id='{$input['name']}' {$attributesString}>{$input['value']}</textarea>\n";
                            break;
                        case "hidden":
                            // Renderiza o campo hidden sem a div.input-field
                            $formHTML .= "\t\t\t<input type='{$input['type']}' name='{$input['name']}' value='{$input['value']}' id='{$input['name']}' {$attributesString}>\n";
                            break;
                        default:
                            $formHTML .= "\t\t\t<input type='{$input['type']}' name='{$input['name']}' value='{$input['value']}' id='{$input['name']}' {$attributesString}>\n";
                    }
                }

                // Fecha a div.input-field apenas para inputs que não sejam do tipo hidden
                if ($input['type'] !== 'hidden') {
                    $formHTML .= "\t\t</div>\n"; // Fecha a div.input-field
                }
            }
            $formHTML .= "\t</div>\n";
        }

        $formHTML .= "</form>\n";
        return $formHTML;
    }

    // Gera o HTML para um campo select
    private function renderSelect($name, $selectedValue, $attributesString, $attributes)
    {
        $html = "<select name='{$name}' id='{$name}' {$attributesString}>\n";

        if (isset($attributes['options']) && is_array($attributes['options'])) {
            foreach ($attributes['options'] as $value => $label) {
                $selected = ($value == $selectedValue) ? "selected" : "";
                $html .= "<option value='{$value}' {$selected}>{$label}</option>\n";
            }
        }

        $html .= "</select>\n";
        return $html;
    }

    private function parseAttributes($attributes)
    {
        $attributesString = "";
        if (is_array($attributes)) { // Verifica se $attributes é um array
            foreach ($attributes as $key => $value) {
                if ($key !== 'options') {
                    $attributesString .= "{$key}='" . htmlspecialchars($value) . "' ";
                }
            }
        }
        return $attributesString;
    }
}

class MineralRochaForm extends Form
{
    private $crud;
    private $formtipo;

    public function __construct($formtipo, $id = null, $action = "cadastrar.php")
    {
        $this->crud = new CRUD();
        $this->formtipo = $formtipo;
        parent::__construct($action, "POST", "multipart/form-data", "{$formtipo}", "col s12 m6");

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
            $this->addInput("text", "nome", "Nome", !empty($dados['nome']) ?  $dados['nome'] :  "", ["class" => "validate", "id" => "nome"], "s6"),
            $this->addInput("select", "cat", "Categoria", !empty($dados['idcat']) ?  $dados['idcat'] : "", [
                "options" => $this->getCategoriaOptions(),
                "class" => "select-dropdown",
                "id" => "cat"
            ], "s6")
        ]);

        

        // Linha 2: Campo hidden para sugestão, id do usuário e Descrição (editor)
        $this->addRow([
            $this->addInput("hidden", "sugestao", "", !empty($dados['sugestao']) ?   $dados['sugestao'] : ""),
            $this->addInput("hidden", "idusuario", "", !empty($dados['idusuario']) ?    $dados['idusuario'] : ""),
            //$this->addInput("hidden", "descricao", "", !empty($dados['descricao']) ?   $dados['descricao']  : ""  , ["id" => "descricao"]),
            $this->addInput("custom", 'descricao',  "",  !empty($dados['descricao']) ?   $dados['descricao']  : "",  [
                "html" => '<div id="editor-container"> <span style="color:red"> {{content_value}} </span></div>'
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


class UsuarioForm extends Form
{
    private $crud;
    private $formtipo;

    public function __construct($formtipo, $action = "cadastrar.php")
    {
        $this->crud = new CRUD();
        $this->formtipo = $formtipo;
        parent::__construct($action, "POST", "multipart/form-data", "{$formtipo}", "col s12 m6");

        $this->buildForm();
    }

    public function buildForm()
    {
        $this->addRow([
            $this->addInput(
                "text",
                "nome",
                "Nome",
                $dados['nome'] ?? '',
                ["class" => "validate", "required" => true],
                "s12"
            ),
            $this->addInput(
                "text",
                "matricula",
                "Matrícula",
                $dados['matricula'] ?? '',
                ["class" => "validate", "required" => true],
                "s12"
            ),
            $this->addInput(
                "text",
                "inst",
                "Instituição",
                $dados['instituto'] ?? '',
                ["class" => "validate", "required" => true],
                "s12"
            )
        ]);

        $this->addRow([
            $this->addInput(
                "custom",
                "",
                "Foto de Perfil",
                "",
                [
                    "html" => '<div class="img-area" data-img="">
                        <i class="bx bxs-cloud-upload icon"></i>
                        <h3>Envie uma Foto de Perfil</h3>
                        <p>A imagem não pode ser maior que <span>20MB</span></p>
                        <input name="arquivo" type="file" id="Capa" style="display: none;">
                        <img src="../img/usuarios/' . ($img ?? 'default.jpg') . '" class="minha-imagem materialboxed circle">
                        <h6>Foto atual</h6>
                     </div>'
                ],
                "s12"
            )
        ]);

        $this->addRow([
            $this->addInput(
                "submit",
                "cadastrarUsuario",
                "",
                "Cadastrar",
                ["class" => "waves-effect waves-light btn green"],
                "s12"
            )
        ]);
    }
}

class QuestionarioForm extends Form
{
    private $crud;
    private $formtipo;

    public function __construct($formtipo, $action = "cadastrar.php")
    {
        $this->crud = new CRUD();
        $this->formtipo = $formtipo;
        parent::__construct($action, "POST", "multipart/form-data", "{$formtipo}", "col s12 m6");

        $this->buildForm();
    }

    public function buildForm()
    {
        $this->addRow([
            $this->addInput("text", "nome", "Nome", "", ["class" => "validate"], "s6"),
            $this->addInput("hidden", "descricao", "", "", ["id" => "descricao"]),
            $this->addInput("custom", "", "", "", [
                "html" => '<div id="editor-container"></div>'
            ], "s12")
        ]);
        
        $this->addRow([
            $this->addInput("radio", "alternativas", "Alternativa A", "A", ["id" => "1"], ""),
            $this->addInput("radio", "alternativas", "Alternativa B", "B", ["id" => "2"], ""),
            $this->addInput("radio", "alternativas", "Alternativa C", "C", ["id" => "3"], ""),
            $this->addInput("radio", "alternativas", "Alternativa D", "D", ["id" => "4"], ""),
            $this->addInput("radio", "alternativas", "Alternativa E", "E", ["id" => "5"], "")
        ]);

        $this->addRow([
            $this->addInput("text", "alternativa1", "Alternativa A:", "", "", "s2")
        ]);
        $this->addRow([
            $this->addInput("text", "alternativa2", "Alternativa B:", "", "", "s2")
        ]);
        $this->addRow([
            $this->addInput("text", "alternativa3", "Alternativa C:", "", "", "s2")
        ]);
        $this->addRow([
            $this->addInput("text", "alternativa4", "Alternativa D:", "", "", "s2")
        ]);
        $this->addRow([
            $this->addInput("text", "alternativa5", "Alternativa E:", "", "", "s2")
        ]);

        $this->addRow([
            $this->addInput(
                "submit",
                "cadastrarQuestao",
                "",
                "Cadastrar",
                ["class" => "waves-effect waves-light btn green"],
                "s12"
            )
        ]);
    }
}