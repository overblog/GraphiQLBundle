<?php

$finder = (new PhpCsFixer\Finder())
    ->exclude('vendor')
    ->name('*.php')
    ->in(__DIR__)
;

return (new PhpCsFixer\Config())
    ->setRules(
        [
            '@Symfony' => true,
            'ordered_imports' => true,
            'concat_space' => ['spacing' => 'none'],
            'phpdoc_no_alias_tag' => ['replacements' => ['type' => 'var']],
            'no_mixed_echo_print' => ['use' => 'echo'],
            'binary_operator_spaces' => ['operators' => ['=>' => 'single_space', '=' => 'single_space']],
            'no_superfluous_phpdoc_tags' => false,
        ]
    )
    ->setFinder($finder)
    ->setUsingCache(true)
;
