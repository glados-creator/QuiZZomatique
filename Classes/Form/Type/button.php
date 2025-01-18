<?php

declare(strict_types=1);

namespace Form\Type;
use Form;
use Form\GenericFormElement;

// use Form\Type\button;

final class button extends GenericFormElement {
    protected string $type = 'button'; 
}