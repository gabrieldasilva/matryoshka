<?php

use \GDasilva\Matryoshka\BladeDirective;
use \GDasilva\Matryoshka\RussianCaching;
use \Illuminate\Cache\Repository;
use \Illuminate\Cache\ArrayStore;

class BladeDirectiveTest extends TestCase
{

    protected $doll;

    /** @test */
    public function it_sets_up_the_opening_cache_directive()
    {
        $directive = $this->createNewCacheDirective();

        $isCached = $directive->setUp($post = $this->makePost());

        $this->assertFalse($isCached);

        // create a html fragment
        echo '<div>fragment</div>';

        $cachedFragment = $directive->tearDown();

        $this->assertEquals('<div>fragment</div>', $cachedFragment);
        $this->assertTrue($this->doll->has($post));

    }

    public function createNewCacheDirective()
    {
        $cache = new Repository(
            new ArrayStore()
        );

        $this->doll = new RussianCaching($cache);

        return new BladeDirective($this->doll);

    }

}
