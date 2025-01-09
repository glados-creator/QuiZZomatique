<?php

declare(strict_types=1);

namespace Form\Type;
use Form;
use Form\GenericFormElement;

// use Form\Type\email;

final class email extends GenericFormElement {
    protected string $type = 'email'; 
}