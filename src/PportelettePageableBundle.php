<?php

namespace Pportelette\PageableBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Pierre Portelette <pierre@cloudnite.net>
 */
class PportelettePageableBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
