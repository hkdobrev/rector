<?php declare(strict_types=1);

namespace Rector\PhpParser\Node\Maintainer;

use PhpParser\Node;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Expr\StaticPropertyFetch;
use PhpParser\Node\Stmt\Property;
use Rector\NodeTypeResolver\Node\Attribute;
use Rector\PhpParser\Node\BetterNodeFinder;
use Rector\PhpParser\Node\Resolver\NameResolver;
use Rector\PhpParser\Printer\BetterStandardPrinter;

/**
 * "private $property"
 */
final class PropertyMaintainer
{
    /**
     * @var BetterNodeFinder
     */
    private $betterNodeFinder;

    /**
     * @var BetterStandardPrinter
     */
    private $betterStandardPrinter;

    /**
     * @var NameResolver
     */
    private $nameResolver;

    public function __construct(
        BetterNodeFinder $betterNodeFinder,
        BetterStandardPrinter $betterStandardPrinter,
        NameResolver $nameResolver
    ) {
        $this->betterNodeFinder = $betterNodeFinder;
        $this->betterStandardPrinter = $betterStandardPrinter;
        $this->nameResolver = $nameResolver;
    }

    /**
     * @return PropertyFetch[]
     */
    public function getAllPropertyFetch(Property $propertyNode): array
    {
        $classNode = $propertyNode->getAttribute(Attribute::CLASS_NODE);

        return $this->betterNodeFinder->find($classNode, function (Node $node) use ($propertyNode) {
            // itself
            if ($this->betterStandardPrinter->areNodesEqual($node, $propertyNode)) {
                return null;
            }

            // property + static fetch
            if (! $node instanceof PropertyFetch && ! $node instanceof StaticPropertyFetch) {
                return null;
            }

            // is it the name match?
            if ($this->nameResolver->resolve($node) !== $this->nameResolver->resolve($propertyNode)) {
                return null;
            }

            return $node;
        });
    }
}
