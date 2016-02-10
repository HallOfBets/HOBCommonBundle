<?php
namespace HOB\CommonBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * Class CommonBundleConfiguration
 * @package HOB\CommonBundle\DependencyInjection
 */
class CommonConfiguration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder    = new TreeBuilder();
        $rootNode       = $treeBuilder->root('hob_common_bundle');

        $rootNode->children()
        ->end();

        return $treeBuilder;
    }
}
