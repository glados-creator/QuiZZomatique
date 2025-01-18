<?php

declare(strict_types=1);

namespace Form\Type;
use Form;
use Form\GenericFormElement;

// use Form\Type\url;

final class url extends GenericFormElement {
    protected string $type = 'url'; 
}