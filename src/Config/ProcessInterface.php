<?php declare(strict_types=1);

use DOMNode;

interface ProcessorInterface
{
    /**
     * @param \DOMNode $node
     * @return array
     */
    public function process(DOMNode $node): array;
}