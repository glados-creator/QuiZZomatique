<?php

declare(strict_types=1);

namespace Form\Type;
use Form;
use Form\GenericFormElement;

// use Form\Type\hidden;

final class hidden extends GenericFormElement {
    protected string $type = 'hidden'; 
}