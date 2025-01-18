<?php

declare(strict_types=1);

namespace Form\Type;
use Form;
use Form\GenericFormElement;

// use Form\Type\checkbox;

final class checkbox extends GenericFormElement
{
    protected string $type = 'checkbox';
    private bool $checked = false;
    public function render(): string
    {

        $this->checked = false;
        if (array_key_exists("checked", $this->options)) {
            $this->checked = $this->options['checked'];
            unset($this->options['checked']);
        }
        $ret = ($this->label? "<label>".$this->label."</label>" : ""). "<" . $this->tag . " type='" . $this->type . "' " 
        . ($this->name ? "name='" . $this->name . "' " : "") 
        . ($this->required ? "required " : "") 
        . ($this->value ? "value='" . $this->value . "' " : "")
        . ($this->checked ? "checked " : "")
        . $this->renderOptions() // Handle options array
        . "> " . $this->innerhtml . "</" . $this->tag . ">";

        
        $this->options["checked"] = $this->checked;
        return $ret;
    }
}