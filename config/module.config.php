<?php
return [
    'service_manager' => [
        'invokables' => [
            'JsonSchema\Uri\UriRetriever' => 'JsonSchema\Uri\UriRetriever',
            'JsonSchema\RefResolver' => function($sm){
                return new JsonSchema\RefResolver($sm->get('JsonSchema\\Uri\\UriRetriever'));
            },
            'JsonSchema\Validator' => 'JsonSchema\Validator',
        ]
    ]
];
