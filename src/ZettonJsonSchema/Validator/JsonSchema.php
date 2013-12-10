<?php
namespace ZettonJsonSchema\Validator;

use JsonSchema\Validator as JsonSchemaValidator;
use JsonSchema\Uri\UriRetriever;
use Zend\Validator\AbstractValidator;

class JsonSchema extends AbstractValidator
{
    private $uriRetriever;
    private $validator;

    private $jsonSchemaUri;
    private $jsonSchemaBaseUri = null;

    public function setUriRetriever(UriRetriever $uriRetriever)
    {
        $this->uriRetriever = $uriRetriever;
    }

    public function getUriRetriever()
    {
        if (!$this->uriRetriever instanceof UriRetriever) {
            $this->uriRetriever = new uriRetriever;
        }

        return $this->uriRetriever;
    }

    public function setValidator(JsonSchemaValidator $validator)
    {
        $this->validator = $validator;
    }

    public function getValidator()
    {
        if (!$this->validator instanceof JsonSchemaValidator) {
            $this->validator = new JsonSchemaValidator;
        }

        return $this->validator;
    }

    public function setJsonSchemaUri($uri)
    {
        $this->jsonSchemaUri = $uri;
    }

    public function isValid($value)
    {
        //$schema = $this->uriRetriever->retrieve('file://' . realpath('schema.json'));
        //$schema = $this->getUriRetriever()->retrieve($this->jsonSchemaUri);
        $schema = '{
                    "type":"object",
                        "properties":{
                            "value":{"type":"string","enum":["Abacate","Manga","Pitanga"]}
                        },
                    "additionalProperties":false
                   }';

        $validator = $this->getValidator();
        $validator->check($value, json_decode($schema));
        var_dump($validator->isValid());

        return false;
    }
}
