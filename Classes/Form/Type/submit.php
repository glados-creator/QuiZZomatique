<?php

declare(strict_types=1);

namespace Form\Type;
use Form;
use Form\GenericFormElement;

// use Form\Type\submit;

final class submit extends GenericFormElement {
    protected string $type = 'submit'; 

    function is_correct(string $value): bool
    {
        return true;
    }
}