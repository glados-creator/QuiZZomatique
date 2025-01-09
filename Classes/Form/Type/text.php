<?php

declare(strict_types=1);

namespace Form\Type;
use Form;
use Form\GenericFormElement;

// use Form\Type\text;

final class text extends GenericFormElement {
    protected string $type = 'text'; 
}