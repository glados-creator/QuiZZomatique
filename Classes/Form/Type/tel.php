<?php

declare(strict_types=1);

namespace Form\Type;
use Form;
use Form\GenericFormElement;

// use Form\Type\tel;

final class tel extends GenericFormElement {
    protected string $type = 'tel'; 
}