<?php

declare(strict_types=1);

namespace Form\Type;
use Form;
use Form\GenericFormElement;

// use Form\Type\number;

final class number extends GenericFormElement {
    protected string $type = 'number'; 
}