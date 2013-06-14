<?php

namespace Imbc\WebsiteBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ImbcWebsiteExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load( array $configs, ContainerBuilder $container )
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration( $configuration, $configs );

        $container->setParameter( 'imbc.notify.message', $config['message'] );
        $container->setParameter( 'imbc.notify.title', $config['title'] );
        $container->setParameter( 'imbc.notify.class', $config['class'] );
        $container->setParameter( 'imbc.notify.type', $config['type'] );
        $container->setParameter( 'imbc.notify.lifetime', $config['lifetime'] );
        $container->setParameter( 'imbc.notify.click_to_close', $config['click_to_close'] );

        $loader = new Loader\YamlFileLoader( $container, new FileLocator( __DIR__ . '/../Resources/config' ) );
        $loader->load( 'services.yml' );
    }
}
