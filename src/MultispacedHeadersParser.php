<?php
namespace DominionEnterprises\ColumnParser;

use DominionEnterprises\ColumnParser\LineParser\StrictColumnWidthsParser;
use DominionEnterprises\ColumnParser\HeaderParser\MultispacedParser;

/**
 * This parses a string where there are at least two spaces between the columns.  The first line in the string is the headers.  Each header is
 * expected to be separated by at least two spaces.  A single space is treated as interior space of the header (i.e. multiple-word headers).
 */
class MultispacedHeadersParser implements HeaderColumnParser
{
    /**
     * @var array
     */
    private $_lines;

    /**
     * @var string
     */
    private $_headerLine;

    /**
     * @param string $contents The contents holding the data.
     */
    public function __construct($contents)
    {
        $allLines = array_filter(explode("\n", $contents));
        $this->_lines = array_slice($allLines, 1);
        $this->_headerLine = empty($allLines) ? '' : $allLines[0];
    }

    public function getRows()
    {
        $headers = (new MultispacedParser())->getMap($this->_headerLine);
        $lineParser = new StrictColumnWidthsParser(array_values($headers));

        $rows = [];
        foreach ($this->_lines as $line) {
            $rows[] = array_combine(array_keys($headers), $lineParser->getColumns($line));
        }

        return $rows;
    }

    public function getHeaders()
    {
        return array_keys((new MultispacedParser())->getMap($this->_headerLine));
    }
}
