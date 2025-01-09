<?php

declare(strict_types=1);

namespace Form\Type;
use Form;
use Form\GenericFormElement;

// use Form\Type\password;

final class password extends GenericFormElement {
    protected string $type = 'password'; 
}