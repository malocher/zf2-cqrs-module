<?php
/**
 * Description of ServiceLoaderProxy
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 * @copyright (c) 2013, Alexander Miertsch
 */
namespace CqrsModule\Service;

use Malocher\Cqrs\Command\CommandHandlerLoaderInterface;
use Malocher\Cqrs\Event\EventListenerLoaderInterface;
use Malocher\Cqrs\Query\QueryHandlerLoaderInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class ServiceLoaderProxy 
    implements CommandHandlerLoaderInterface, 
        EventListenerLoaderInterface, 
        QueryHandlerLoaderInterface,
        ServiceLocatorAwareInterface
{
    /**
     *
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;


    public function getCommandHandler($alias)
    {
        return $this->getServiceLocator()->get($alias);
    }
    
    public function getQueryHandler($alias)
    {
        return $this->getServiceLocator()->get($alias);
    } 

    public function getEventListener($alias)
    {
        return $this->getServiceLocator()->get($alias);
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }
}
