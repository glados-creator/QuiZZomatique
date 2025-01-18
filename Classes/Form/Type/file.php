<?php

declare(strict_types=1);

namespace Form\Type;
use Form;
use Form\GenericFormElement;

// use Form\Type\file;

final class file extends GenericFormElement {
    protected string $type = 'file'; 
}