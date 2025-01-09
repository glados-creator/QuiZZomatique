<?php

declare(strict_types=1);

namespace Form\Type;
use Form;
use Form\GenericFormElement;

// use Form\Type\radio;

final class radio extends GenericFormElement
{
    protected string $type = 'radio';

    public function render(): string
    {
        $ret = '';
        if ($this->label) {
            $ret .= "<p>" . $this->label . "</p>";
        }
        $ret .= "<div>";
        foreach ($this->options["choices"] as $key => $val) {
            $ret .= (gettype($key) == "string" ? "<label>" . $this->$val . "</label>" : "") . "<" . $this->tag . " type='" . $this->type . "' "
                . ($this->name ? "name='" . $this->name . "' " : "")
                . ($this->required ? "required " : "")
                . ("value='" . $val . "' ")
                . $this->renderOptions() // Handle options array
                . "> " . $this->innerhtml . "</" . $this->tag . ">";
        }
        return $ret . "</div>";
    }
}