use DOMNode;

class AttributeValueResolver
{
public function resolve(DOMNode $node, string $attributeName, $default = null)
{
$attributeNode = $node->attributes->getNamedItem($attributeName);

return $attributeNode->nodeValue ?? $default;
}
}