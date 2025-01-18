<?php

declare(strict_types=1);

namespace Form\Type;
use Form;
use Form\GenericFormElement;

// use Form\Type\range;

final class range extends GenericFormElement {
    protected string $type = 'range'; 
}