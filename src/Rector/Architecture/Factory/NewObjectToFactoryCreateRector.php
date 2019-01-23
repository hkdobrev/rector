<?php declare (strict_types=1);

namespace Rector\Rector\Architecture\Factory;

use PhpParser\Node;
use PhpParser\Node\Expr\New_;
use Rector\Rector\AbstractRector;
use Rector\RectorDefinition\ConfiguredCodeSample;
use Rector\RectorDefinition\RectorDefinition;

final class NewObjectToFactoryCreateRector extends AbstractRector
{
    /**
     * @var string[][]
     */
    private $objectToFactoryMethod;

    /**
     * @param string[][] $objectToFactoryMethod
     */
    public function __construct(array $objectToFactoryMethod)
    {
        $this->objectToFactoryMethod = $objectToFactoryMethod;
    }

	/**
	 * @return string[]
	 */
	public function getNodeTypes(): array
	{
		return [New_::class];
	}


	public function refactor(Node $node): ?Node
	{
        foreach ($this->objectToFactoryMethod as $type => $factoryMethod) {
            if (! $this->isType($node, $type)) {
                continue;
            }

            // we got a match!
            dump($node);
            die;
        }

		return $node;
	}


	public function getDefinition(): RectorDefinition
	{
		return new RectorDefinition('Replaces creating object instances with "new" keyword with factory method.', [
			new ConfiguredCodeSample(
				<<<'CODE_SAMPLE'
class SomeClass
{
	public function example() {
		new MyClass($argument);
	}
}
CODE_SAMPLE
				,
				<<<'CODE_SAMPLE'
class SomeClass
{
	/**
	 * @var \MyClassFactory
	 */
	private $myClassFactory;

	public function example() {
		$this->myClassFactory->create($argument);
	}
}
CODE_SAMPLE
				,
				['MyClass' => ['MyClassFactory', 'create']]
			),
		]);
	}
}
