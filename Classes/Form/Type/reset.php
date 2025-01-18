<?php

declare(strict_types=1);

namespace Form\Type;
use Form;
use Form\GenericFormElement;

// use Form\Type\reset;

final class reset extends GenericFormElement {
    protected string $type = 'reset'; 
}