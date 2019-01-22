<?php declare(strict_types=1);

namespace Rector\Tests\Rector\Architecture\Factory\NewObjectToFactoryCreateRector;

use Rector\Testing\PHPUnit\AbstractRectorTestCase;

/**
 * @covers \Rector\Rector\Architecture\Factory\NewObjectToFactoryCreateRector
 * @covers \Rector\Rector\Architecture\DependencyInjection\ReplaceVariableByPropertyFetchRector
 */
final class NewObjectToFactoryCreateRectorTest extends AbstractRectorTestCase
{
    public function test(): void
    {
        $this->doTestFiles([__DIR__ . '/Fixture/fixture.php.inc']);
    }

    protected function provideConfig(): string
    {
        return __DIR__ . '/config.yml';
    }
}
