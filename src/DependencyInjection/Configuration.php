<?php

namespace Pportelette\PageableBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('pportelette_pageable');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('default')
                    ->children()
                        ->integerNode('nb_per_page')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}