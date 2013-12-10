<?php
return [
    'service_manager' => [
        'invokables' => [
            'JsonSchema\Uri\UriRetriever' => 'JsonSchema\Uri\UriRetriever',
            'JsonSchema\Validator' => 'JsonSchema\Validator',
        ],
        'factories' => [
            'JsonSchema\RefResolver' => function($sm) {
                return new JsonSchema\RefResolver($sm->get('JsonSchema\Uri\UriRetriever'));
            },
            'ZettonJsonSchema\Validator\JsonSchema' => function($sm) {
                $validator = new ZettonJsonSchema\Validator\JsonSchema;
                $validator->setValidator($sm->get('JsonSchema\Validator'));
                return $validator;
            }
        ]
    ]
];
