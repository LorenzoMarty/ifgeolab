<?php
class QuestionarioForm extends Form
{
    private $crud;
    private $formtipo;

    public function __construct($formtipo, $action = "cadastrar.php")
    {
        $this->crud = new CRUD();
        $this->formtipo = $formtipo;
        // Configuração inicial do formulário
        parent::__construct($action, "POST", "multipart/form-data", "{$formtipo}", "col s12 m6");

        // Construir o formulário
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