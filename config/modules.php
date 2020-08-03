<?php

use App\Shell\Module\Decorator\AssociationLabelsDecorator;
use App\Shell\Module\Decorator\FieldNameDecorator;
use App\Shell\Module\Decorator\TableAliasDecorator;

return [
    'Module' => [
        'decorators' => [
            FieldNameDecorator::class,
            TableAliasDecorator::class,
            AssociationLabelsDecorator::class,
        ],
    ],
];
