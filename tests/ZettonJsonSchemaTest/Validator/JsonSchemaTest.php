<?php
namespace ZettonJsonSchemaTest\Validator;

use ZettonJsonSchema\Validator\JsonSchema;

class JsonSchemaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Digits
     */
    protected $validator;

    public function setUp()
    {
        $validator = new JsonSchema;
        //$validator->setUriRetriever();
        //$validator->setValidator();
        $validator->setJsonSchemaUri('file://' . realpath('schema.json'));

        $this->validator = $validator;
    }

    public function testA()
    {
        $this->assertFalse($this->validator->isValid(json_decode('{"value":"Abacate"}')));
    }


    /**
    public function testEqualsMessageTemplates()
    {
        $validator = $this->validator;
        $this->assertAttributeEquals($validator->getOption('messageTemplates'),
                                     'messageTemplates', $validator);
    }*/
}
