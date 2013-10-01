zf2-cqrs-module
===============

Zend Framework 2 Module that integrates the [crafics CQRS + Events System](https://github.com/crafics/cqrs-php)

## Setup


Setup the CQRS System using your module or application configuration. Put all CQRS options under the key cqrs. 
```php
  'cqrs' => array(
        'adapters' => array(
            array(
                'class' => 'Cqrs\Adapter\ArrayMapAdapter',
                'buses' => array(
                    'My\Bus\DomainBus' => array(
                        'My\Command\AddEntityCommand' => array(
                            'alias'  => 'my_add_entity_command_handler',
                            'method' => 'addEntity' 
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'my_add_entity_command_handler' => 'My\Repository\EntityRepository',
        ),
    ),
```
The ZF2 ServiceManager acts as CommandHandler- and EventListenerLoader. That means, you can use your ServiceManager aliases
to pipe your commands and events to your repositories, services and whatever you use in your application.

##Usage

You can request the CQRS Gate from the ServiceManager. The hole setup of the CQRS System is done in the background.
Here is a simple example that invokes the AddEntityCommand on the DomainBus from within a controller:

```php
<?php
namespace My\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use My\Command\AddEntityCommand;
use My\Bus\DomainBus;

class MyController extends AbstractActionController {

  public function addEntityAction() {
  
    $entityName = $this->getEvent()->getRouteMatch()->getParam('entityname');
    
    $addEntityCommand = new AddEntityCommand();
    
    $addEntityCommand->setName($entityName);
    
    $this->getServiceLocator()->get('cqrs.gate')->getBus(DomainBus::NAME)->invokeCommand($addEntityCommand);
  }
}
```

