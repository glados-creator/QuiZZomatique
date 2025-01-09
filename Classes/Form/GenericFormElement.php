<?php

declare(strict_types=1);

namespace Form;

abstract class GenericFormElement implements InputRenderInterface
{
    protected string $name;
    protected string $tag = "input";
    protected string $type;
    protected bool $required = false;
    protected string $value = '';
    protected string $innerhtml = '';
    protected string $answer = '';
    protected string $label = '';

    protected mixed $options;

    public function __construct(
        string $name,
        $required = false,
        string $defaultValue = '',
        string $label = '',
        string $innerhtml = '',
        string $answer = '',
        ...$options
    ) {
        $this->name = $name;
        $this->answer = $answer;
        $this->label = $label;
        $this->required = $required;
        $this->value = $defaultValue;
        $this->innerhtml = $innerhtml;
        $this->options = $options;
    }

    public function __toString(): string
    {
        return $this->render();
    }

    function getId(): string
    {
        return sprintf('form_%s', $this->name);
    }

    function getName(): string
    {
        return $this->name;
    }

    function getValue(): array|string
    {
        return $this->value;
    }

    function isRequired(): bool
    {
        return $this->required;
    }

    function is_correct(string $value): bool
    {
        // print_r(
        //     $this->answer." : ".$value." : ".
        //     strtoupper(strval($this->answer)) == strtoupper(strval($value))
        // );
        return (!$this->required ? true : ($this->answer ? strtoupper(strval($this->answer)) == strtoupper(strval($value)) : true));
    }

    protected function renderOptions(): string
    {
        $output = " ";
        if (!empty($this->options)) {
            foreach ($this->options as $key => $value) {
                // "options" => [1,2,3]
                // print_r("". $key ."". $value ."");
                if (gettype($value) == "array") {
                    foreach ($value as $k => $v) {
                        if (gettype($k) == "integer") {
                            $output .= $k . " ";
                        } else {
                            $output .= $k . "='" . htmlspecialchars(strval($v)) . "' ";
                        }
                    }
                } else {
                    if (gettype($key) == "integer") {
                        $output .= $key . " ";
                    } else {
                        $output .= $key . "='" . htmlspecialchars(strval($value)) . "' ";
                    }
                }
            }
        }
        // print_r($output);
        return $output;
    }

    function getopts(): array
    {
        return $this->options;
    }

    public function render(): string
    {
        return ($this->label ? "<label>" . $this->label . "</label>" : "") . "<" . $this->tag . " type='" . $this->type . "' "
            . ($this->name ? "name='" . $this->name . "' " : "")
            . ($this->required ? "required " : "")
            . ($this->value ? "value='" . $this->value . "' " : "")
            . $this->renderOptions() // Handle options array
            . "> " . $this->innerhtml . "</" . $this->tag . ">";

    }
}