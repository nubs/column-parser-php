<?php
namespace DominionEnterprises\ColumnParser\HeaderParser;

/**
 * @coversDefaultClass \DominionEnterprises\ColumnParser\HeaderParser\MultispacedParser
 */
class MultispacedParserTest extends \PHPUnit_Framework_TestCase
{
    private $_parser;

    public function setUp()
    {
        $this->_parser = new MultispacedParser();
    }

    /**
     * This tests the basic getMap behavior.
     *
     * @test
     * @covers ::getMap
     */
    public function getMapFromSampleLine()
    {
        $this->assertSame(['Name' => 6, 'Age' => 5, 'City of Birth' => 13], $this->_parser->getMap('Name  Age  City of Birth'));
    }

    /**
     * This tests the getMap behavior for an empty row.
     *
     * @test
     * @covers ::getMap
     */
    public function getMapFromEmptyLine()
    {
        $this->assertSame([], $this->_parser->getMap(''));
    }
}
