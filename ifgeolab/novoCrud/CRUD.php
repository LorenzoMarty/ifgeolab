<?php

class CRUD
{
    // Função para conexão
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
    private $rows = []; // Armazena as rows do formulário

    public function __construct($action = "", $method = "POST", $enctype = "", $id = "", $class = "")
    {
        $this->action = $action;
        $this->method = $method;
        $this->enctype = $enctype;
        $this->id = $id;
        $this->class = $class;
    }

    // Adiciona uma nova row ao formulário
    public function addRow($inputs = [])
    {
        $this->rows[] = $inputs;
    }

    // Cria e retorna um input para ser adicionado a uma row
    public function addInput($type, $name, $label = "", $value = "", $attributes = [], $colSize = "s12", $customClass = "input-field col")
    {
        return [
            "type" => $type,
            "name" => $name,
            "label" => $label,
            "value" => $value,
            "attributes" => $attributes,
            "customClass" => $customClass,
            "colSize" => $colSize
        ];
    }

    // Renderiza o formulário em HTML
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
                    // Adiciona o HTML diretamente
                    $formHTML .= "\t\t\t" . ($input['attributes']['html'] ?? '') . "\n";
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
            $formHTML .= "\t</div>\n"; // Fecha a div.row
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

    // Converte atributos adicionais em string
    private function parseAttributes($attributes)
    {
        $attributesString = "";
        foreach ($attributes as $key => $value) {
            if ($key !== 'options') { // Ignorar opções do select ao gerar atributos
                $attributesString .= "{$key}='" . htmlspecialchars($value) . "' ";
            }
        }
        return $attributesString;
    }
}





