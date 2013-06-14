<?php

namespace Imbc\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Description of NotificationController
 *
 * @author touristtam
 */
class NotificationController extends Controller
{
    protected $defaults = array();
    protected $flashes = array();
    protected $session;

    /**
     * @param \Symfony\Component\HttpFoundation\Session\Session $session
     * @param array $defaults
     */
    public function __construct( \Symfony\Component\HttpFoundation\Session\Session $session, array $defaults )
    {
        $this->session = $session;
        $this->defaults = $defaults;
    }

    /**
     * Depending on the supplied type argument, add the values
     * to the session flashBag or $this->flashes
     *
     * @param string $name
     * @param array $arguments
     */
    public function add( $name, array $arguments = array() )
    {
        $arguments += $this->defaults;
        // If the type is flash then add the values to the session flashBag
        if( $arguments['type'] === 'flash' )
        {
            $this->session->getFlashBag()->add( $name, $arguments );
        }
        // Otherwise if its instant then add them to the class variable $flashes
        elseif( $arguments['type'] === 'instant' )
        {
            // We want to be able to have multiple notifications of the same name i.e "success"
            // so we need to add each new set of arguments into an array not overwrite the last
            // "success" value set
            if( !isset( $this->flashes[$name] ) )
            {
                $this->flashes[$name] = array();
            }
            $this->flashes[$name][] = $arguments;
        }
    }

    /**
     * Check the flashBag and $this->flashes for existence of $name
     *
     * @param $name
     *
     * @return bool
     */
    public function has( $name )
    {
        return ( $this->session->getFlashBag()->has( $name ) ) ? true : isset( $this->flashes[$name] );
    }

    /**
     * Search for a specific notification and return matches from flashBag and $this->flashes
     *
     * @param $name
     *
     * @return array
     */
    public function get( $name )
    {
        if( $this->session->getFlashBag()->has( $name ) && isset( $this->flashes[$name] ) )
        {
            return array_merge_recursive( $this->session->getFlashBag()->get( $name ), $this->flashes[$name] );
        }
        elseif( $this->session->getFlashBag()->has( $name ) )
        {
            return $this->session->getFlashBag()->get( $name );
        }
        else
        {
            return $this->flashes[$name];
        }
    }

    /**
     * Merge all flashBag and $this->flashes values and return the array
     *
     * @return array
     */
    public function all()
    {
        return array_merge_recursive( $this->session->getFlashBag()->all(), $this->flashes );
    }
}