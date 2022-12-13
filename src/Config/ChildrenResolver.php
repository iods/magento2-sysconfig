use DOMNode;
use const XML_ELEMENT_NODE;

class ChildrenResolver
{
/**
* @param DOMNode $node
* @return DOMNode[]
*/
public function resolve(DOMNode $node): array
{
$items = [];

foreach ($node->childNodes as $item) {
$items[] = $item;
}

return array_filter(
$items,
static function (DOMNode $item) {
return $item->nodeType === XML_ELEMENT_NODE;
}
);
}
}