<?php

namespace source\core\view;

class View implements ContainerInterface, TemplateInterface, ViewInterface
{
    const DEFAULT_TEMPLATE = "default.php";
    const DEFAULT_PATH = __DIR__ . "/../../../source/views/";

    protected $template = self::DEFAULT_TEMPLATE;
    protected $fields = [];

    public function __construct($template = null, array $fields = []) {
        if ($template !== null) {
            $this->setTemplate($template);
        }

        if (!empty($fields)) {
            foreach ($fields as $name => $value) {
                $this->$name = $value;
            }
        }
    }

    public function setTemplate($template) {
        $template = $template . ".php";
        $templatePath = $this->getFullTemplatePath($template);

        if (!is_file($templatePath) || !is_readable($templatePath)) {
            throw new \InvalidArgumentException("The template '$templatePath' is invalid.");
        }

        $this->template = $template;

        return $this;
    }

    public function getTemplate() {
        return $this->template;
    }


    public function setField($name, $value)
    {
        $this->fields[$name] = $value;

        return $this;
    }

    public function getField($name) {
        if (!isset($this->fields[$name])) {
            throw new \InvalidArgumentException("Unable to get the field '$name'.");
        }

        $field = $this->fields[$name];

        return $field instanceof \Closure ? $field($this) : $field;
    }

    public function issetField($name) {
        return isset($this->fields[$name]);
    }

    public function unsetField($name) {
        if (!isset($this->fields[$name])) {
            throw new \InvalidArgumentException("Unable to unset the field '$name'.");
        }

        unset($this->fields[$name]);

        return $this;
    }

    public function render() {
        extract($this->fields);
        ob_start();

        include $this->getFullTemplatePath();

        return ob_get_clean();
    }

    protected function getFullTemplatePath($template = null)
    {
        if ($template === null) {
            $template = $this->template;
        }

        return self::DEFAULT_PATH . $template;
    }
}