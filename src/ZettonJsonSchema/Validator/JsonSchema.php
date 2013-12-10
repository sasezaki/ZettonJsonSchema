<?php
namespace ZettonJsonSchema\Validator;

use JsonSchema\Validator as JsonSchemaValidator;
use JsonSchema\Uri\UriRetriever;
use Zend\Validator\AbstractValidator;

class JsonSchema extends AbstractValidator
{
    private $messageKeyPrefix = 'JsonSchema';

    private $uriRetriever;
    private $validator;

    private $jsonSchemaUri;
    private $jsonSchemaBaseUri = null;

    private $formatter;

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

    public function getErrorFormatter()
    {
        if (!is_callable($this->formatter)) {
            $this->formatter = function($error) { 
                return $error['property']. ' ' . $error['message'];
            };
        }

        return $this->formatter;
    }

    public function setErrorFormatter(callable $formatter)
    {
        $this->formatter = $formatter;
    }

    protected function errorsToMessages($errors)
    {
        $formatter = $this->getErrorFormatter();
        foreach ($errors as $error) {
            $this->abstractOptions['messages'][$this->messageKeyPrefix.ucfirst($error['property'])] 
                = call_user_func($formatter, $error);
        }
    }

    public function isValid($value)
    {
        $schema = $this->getUriRetriever()->retrieve($this->jsonSchemaUri);
        $validator = $this->getValidator();
        $validator->check($value, $schema);
        $isValid = $validator->isValid();

        if (!$isValid) {
            $this->errorsToMessages($validator->getErrors());
        }

        return $isValid;
    }
}
