<?php

namespace Kitano\Bundle\PaymentBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration processer.
 * Parses/validates the extension configuration and sets default values.
 *
 * @author Benjamin Dulau <benjamin.dulau@anonymation.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('kitano_payment');

        $this->addServiceSection($rootNode);

        return $treeBuilder;
    }

    /**
     * Parses the kitano_payment config section
     * Example for yaml driver:
     * kitano_payment:
     *     service:
     *         payment_system:
     *
     * @param ArrayNodeDefinition $node
     * @return void
     */
    private function addServiceSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('service')
                    ->children()
                        ->scalarNode('payment_system')->isRequired()->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end();
    }
}