<?php
namespace ZettonJsonSchemaTest\Validator;

use ZettonJsonSchema\Validator\JsonSchema;

class JsonSchemaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var JsonSchema
     */
    protected $validator;

    public function setUp()
    {
        $validator = new JsonSchema;
        $validator->setJsonSchemaUri('file://' . realpath(__DIR__.'/_files/schema.default.json'));

        $this->validator = $validator;
    }

    public function testValidatorShouldHaveMessagesWhenIsNotValid()
    {
        $this->assertFalse($this->validator->isValid(json_decode('{"foo":"bar"}')));
        $this->assertNotEmpty($this->validator->getMessages());
    }

    public function testValidatorShouldHaveNoMessagesWhenIsValid()
    {
        $this->assertTrue($this->validator->isValid(json_decode('{"name":"foobar"}')));
        $this->assertEmpty($this->validator->getMessages());
    }
}
