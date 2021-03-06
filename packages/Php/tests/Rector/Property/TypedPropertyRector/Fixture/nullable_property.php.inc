<?php

namespace Rector\Php\Tests\Rector\Property\TypedPropertyRector\Fixture;

use Rector\Php\Tests\Rector\Property\TypedPropertyRector\Source\AnotherClass;

final class ClassWithNullableProperty
{
    /**
     * @var AnotherClass|null
     */
    private $anotherClass = null;

    /**
     * @var null|AnotherClass
     */
    private $yetAnotherClass;
}

?>
-----
<?php

namespace Rector\Php\Tests\Rector\Property\TypedPropertyRector\Fixture;

use Rector\Php\Tests\Rector\Property\TypedPropertyRector\Source\AnotherClass;

final class ClassWithNullableProperty
{
    /**
     * @var AnotherClass|null
     */
    private ?AnotherClass $anotherClass = null;

    /**
     * @var null|AnotherClass
     */
    private ?AnotherClass $yetAnotherClass;
}

?>
