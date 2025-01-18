<?php

declare(strict_types=1);

namespace Form\Type;
use Form;
use Form\GenericFormElement;

// use Form\Type\textarea;

final class textarea extends GenericFormElement {
    protected string $tag = 'textarea'; 

    public function render():string{
        return "<" . $this->tag . " "
        . $this->renderOptions() // Handle options array
        . "> " . $this->innerhtml . "</" . $this->tag . ">";

    }
}