<?php

class CRUD
{
    
    public $conexao;

    public function __construct($conexao = null)
    {
        $this->conectar($conexao);
    }

    private function conectar($conexao = null)
    {
        if (is_array($conexao)) {
            $this->conexao = mysqli_connect(
                $conexao['host'],
                $conexao['username'],
                $conexao['pass'],
                $conexao['database']
            );

            if ($this->conexao === false) {
                die("Erro ao conectar à base de dados. Nº do erro: " . mysqli_connect_errno() . ". " . mysqli_connect_error());
            }
        } elseif ($conexao instanceof mysqli) {
            $this->conexao = $conexao;
        }
    }

    // Executar comandos SQL
    public function executarSQL($sql)
    {
        $resultado = mysqli_query($this->conexao, $sql);

        if ($resultado === false) {
            die("Erro ao executar o comando SQL. " . mysqli_errno($this->conexao) . ": " . mysqli_error($this->conexao));
        }

        return $resultado;
    }

    // Cadastrar
    public function cadastrar($tabela, $dados)
    {
        $coluna = implode(", ", array_keys($dados));
        $valores = implode(", ", array_map(fn($valor) => "'" . mysqli_real_escape_string($this->conexao, $valor) . "'", array_values($dados)));

        $sql = "INSERT INTO $tabela ($coluna) VALUES ($valores)";
        return $this->executarSQL($sql);
    }

    // Listar
    public function listar($tabela, $condicao = [], $coluna = "*")
    {
        $sql = "SELECT $coluna FROM $tabela";

        if (!empty($condicao)) {
            $clausulas = [];
            foreach ($condicao as $key => $value) {
                $clausulas[] = "$key = '" . mysqli_real_escape_string($this->conexao, $value) . "'";
            }
            $sql .= " WHERE " . implode(" AND ", $clausulas);
        }

        $result = $this->executarSQL($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Editar
    public function editar($tabela, $dados, $condicao)
    {
        $set = implode(", ", array_map(fn($key, $value) => "$key = '" . mysqli_real_escape_string($this->conexao, $value) . "'", array_keys($dados), $dados));
        $where = implode(" AND ", array_map(fn($key, $value) => "$key = '" . mysqli_real_escape_string($this->conexao, $value) . "'", array_keys($condicao), $condicao));

        $sql = "UPDATE $tabela SET $set WHERE $where";
        return $this->executarSQL($sql);
    }

    // Deletar
    public function deletar($tabela, $condicao)
    {
        $where = implode(" AND ", array_map(fn($key, $value) => "$key = '" . mysqli_real_escape_string($this->conexao, $value) . "'", array_keys($condicao), $condicao));
        $sql = "DELETE FROM $tabela WHERE $where";

        return $this->executarSQL($sql);
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
        $formHTML = "<form action='" . htmlspecialchars($this->action, ENT_QUOTES, 'UTF-8') . "' method='" . htmlspecialchars($this->method, ENT_QUOTES, 'UTF-8') . "' enctype='" . htmlspecialchars($this->enctype, ENT_QUOTES, 'UTF-8') . "' id='" . htmlspecialchars($this->id, ENT_QUOTES, 'UTF-8') . "' class='" . htmlspecialchars($this->class, ENT_QUOTES, 'UTF-8') . "'>\n";

        foreach ($this->rows as $row) {
            $formHTML .= "\t<div class='row'>\n";
            foreach ($row as $input) {
                $attributesString = $this->parseAttributes($input['attributes']);
                $formHTML .= "\t\t<div class='{$input['customClass']} {$input['colSize']}'>\n";

                if ($input['type'] !== 'hidden' && !empty($input['label'])) {
                    $formHTML .= "\t\t\t<label for='" . htmlspecialchars($input['name'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($input['label'], ENT_QUOTES, 'UTF-8') . "</label>\n";
                }

                $formHTML .= "\t\t\t<input type='" . htmlspecialchars($input['type'], ENT_QUOTES, 'UTF-8') . "' name='" . htmlspecialchars($input['name'], ENT_QUOTES, 'UTF-8') . "' value='" . htmlspecialchars($input['value'], ENT_QUOTES, 'UTF-8') . "' id='" . htmlspecialchars($input['name'], ENT_QUOTES, 'UTF-8') . "' {$attributesString}>\n";
                $formHTML .= "\t\t</div>\n";
            }
            $formHTML .= "\t</div>\n";
        }

        $formHTML .= "</form>\n";
        return $formHTML;
    }

    private function parseAttributes(array $attributes)
    {
        $attributesString = "";
        foreach ($attributes as $key => $value) {
            $attributesString .= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') . "='" . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . "' ";
        }
        return trim($attributesString);
    }
}

class MineralRochaForm extends Form
{
    private $crud;
    private $formtipo;

    public function __construct($formtipo, $idusuario, $action = "cadastrar.php")
    {
        $this->crud = new CRUD();
        $this->formtipo = $formtipo;
        // Configuração inicial do formulário
        parent::__construct($action, "POST", "multipart/form-data", "cad{$formtipo}", "col s12 m6");

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

        // Linha 2: Campos ocultos e Descrição
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
                "class" => "waves-effect waves-light btn green"
            ], "s12")
        ]);
    }
}
