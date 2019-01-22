<?php

namespace Rector\Tests\Rector\Architecture\Factory\NewObjectToFactoryCreateRector\Fixture;

use Rector\Tests\Rector\Architecture\Factory\NewObjectToFactoryCreateRector\Source\MyClass;

final class SomeController
{
    public function default()
    {
        new MyClass('abcd');
    }
}

?>
-----
<?php

namespace Rector\Tests\Rector\Architecture\Factory\NewObjectToFactoryCreateRector\Fixture;

use Rector\Tests\Rector\Architecture\Factory\NewObjectToFactoryCreateRector\Source\MyClass;

final class SomeController
{
    /**
     * @var \Rector\Tests\Rector\Architecture\Factory\NewObjectToFactoryCreateRector\Source\MyClassFactory
     */
    private $myClassFactory;

    public function default()
    {
        $this->myClassFactory->create('abcd');
    }
}

?>
