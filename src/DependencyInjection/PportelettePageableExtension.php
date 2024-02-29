<?php

namespace Pportelette\PageableBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Pportelette\PageableBundle\Repository\AbstractRepository;

class PportelettePageableExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if(isset($config['default']['nb_per_page'])) {
            AbstractRepository::setNbPerPage($config['default']['nb_per_page']);
        }
    }
}