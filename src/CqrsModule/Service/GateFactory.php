<?php
/**
 * Description of GateFactory
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 * @copyright (c) 2013, Alexander Miertsch
 */
namespace CqrsModule\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Malocher\Cqrs\Gate;
use Malocher\Cqrs\Configuration\Setup;

class GateFactory implements FactoryInterface
{
    /**
     * 
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $configuration = $serviceLocator->get('configuration');
        
        if (!isset($configuration['cqrs'])) {
            throw new \Exception('CQRS config missing');
        }
        
        $cqrsConfig = $configuration['cqrs'];
        
        $gate = new Gate();
        
        $cqrsSetup = new Setup();
        
        $cqrsSetup->setGate($gate);
        $cqrsSetup->setCommandHandlerLoader($serviceLocator->get('cqrs.command_handler_loader'));
        $cqrsSetup->setQueryHandlerLoader($serviceLocator->get('cqrs.query_handler_loader'));
        $cqrsSetup->setEventListenerLoader($serviceLocator->get('cqrs.event_listener_loader'));
        $cqrsSetup->initialize($cqrsConfig);
        
        return $gate;
    }    
}
