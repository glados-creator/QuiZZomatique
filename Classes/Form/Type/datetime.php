<?php

declare(strict_types=1);

namespace Form\Type;
use Form;
use Form\GenericFormElement;

// use Form\Type\datetime;

final class datetime extends GenericFormElement {
    protected string $type = 'datetime'; 
}