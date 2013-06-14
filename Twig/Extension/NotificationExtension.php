<?php

namespace Imbc\WebsiteBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of NotificationExtension
 * implementation of a notification service
 * see http://lrotherfield.com/blog/symfony2-tutorial-creating-and-using-a-service/
 * && http://lrotherfield.com/blog/symfony2-tutorial-twig-extensions-and-dependency-injection/
 * @author touristtam
 */
class NotificationExtension extends \Twig_Extension
{
    protected $container;
    protected $notify;

    public function __construct( ContainerInterface $container = null )
    {
        $this->container = $container;
        $this->notify = $container->get( 'imbc.notify' );
    }

    public function getFunctions()
    {
        return array(
            'notify_resources'  => new \Twig_Function_Method($this, 'renderResources', array(
                'is_safe' => array( 'html' )
            )),
            'notify_all'        => new \Twig_Function_Method( $this, 'renderAll', array(
                'is_safe' => array( 'html' )
            )),
            'notify_one'        => new \Twig_Function_Method( $this, 'renderOne', array(
                'is_safe' => array( 'html' )
            ))
        );
    }

    public function renderResources()
    {
        return $this->container->get( 'templating' )->render(
                'ImbcWebsiteBundle:Notification:resources.html.twig'
        );
    }

    public function renderAll( $container = false )
    {
        $notifications_array = $this->notify->all();

        if( count( $notifications_array ) > 0 )
        {
            return $this->container->get( 'templating' )->render(
                    'ImbcWebsiteBundle:Notification:multiple.html.twig', compact( 'notifications_array', 'container' )
            );
        }

        return null;
    }

    public function renderOne( $name, $container = false )
    {
        if( !$this->notify->has( $name ) )
        {
            return false;
        }
        $notifications = $this->notify->get( $name );

        if( count( $notifications ) > 0 )
        {
            return $this->container->get( 'templating' )->render(
                    'ImbcWebsiteBundle:Notification:multiple.html.twig', compact( 'notifications', 'container' )
            );
        }

        return null;
    }

    public function getName()
    {
        return 'imbc_notification_extension';
    }
}