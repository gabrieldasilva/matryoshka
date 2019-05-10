<?php

namespace GDasilva\Matryoshka;

trait Cacheable
{

    /**
     * @return string
     */
    public function getCacheKey()
    {
        // App\Card/1-12345678
        return sprintf("%s/%s-%s",
            get_class($this),
            $this->id,
            $this->updated_at->timestamp
        );
    }

}