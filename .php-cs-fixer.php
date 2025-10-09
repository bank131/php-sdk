<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__ . '/src')
    ->path([
        'DTO/PaymentDetails',
        'DTO/Tax',
        'PaymentMethod/Enum',
        'PaymentMethod/TaxFullPaymentMethod',
        'PaymentMethod/TaxShortPaymentMethod'
    ])
;

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setCacheFile(__DIR__ . '/var/cache/.php-cs-fixer.cache')
    ->setRules([
        '@PhpCsFixer' => true,

        'date_time_immutable' => true,
        'nullable_type_declaration_for_default_null_value' => true,
        'php_unit_test_class_requires_covers' => false,
        'ordered_imports' => true,
        'yoda_style' => ['equal' => false, 'identical' => false, 'less_and_greater' => false],
        'global_namespace_import' => ['import_classes' => true],
        'declare_strict_types' => true,
        'blank_line_before_statement' => [
            'statements' => ['return'],
        ],
        'concat_space' => ['spacing' => 'one'],

        'phpdoc_line_span' => true,
        'phpdoc_summary' => false,
        'phpdoc_types_order' => ['null_adjustment' => 'always_last'],
    ])
    ->setFinder($finder);
