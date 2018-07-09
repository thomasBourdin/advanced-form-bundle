<?php

namespace Sherlockode\AdvancedFormBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $tb = new TreeBuilder();
        $root = $tb->root('sherlockode_advanced_form');

        $this->addStorageSection($root);
        $this->addUploaderSection($root);

        $root
            ->children()
                ->scalarNode('tmp_uploaded_file_class')->end()
                ->scalarNode('tmp_uploaded_file_dir')->end()
            ->end()
        ;

        return $tb;
    }

    private function addStorageSection(ArrayNodeDefinition $node)
    {
        $node
            ->fixXmlConfig('storage')
            ->children()
                ->arrayNode('storages')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                    ->children()
                        ->arrayNode('filesystem')
                            ->children()
                                ->scalarNode('path')->isRequired()->cannotBeEmpty()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    /**
     * @param ArrayNodeDefinition $node
     */
    private function addUploaderSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('uploader_mappings')
                    ->useAttributeAsKey('id')
                    ->prototype('array')
                    ->children()
                        ->scalarNode('class')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('file_property')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('storage')->cannotBeEmpty()->end()
                        ->arrayNode('route')
                            ->children()
                                ->scalarNode('name')->end()
                                ->variableNode('parameters')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
