zf2-cqrs-module
===============

Zend Framework 2 Module that integrates the [Malocher CQRS + Service Bus](https://github.com/malocher/cqrs-esb)

## Installation

Installation of MalocherCqrsModule uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/). Add following requirement to your composer.json


```sh
"malocher/zf2-cqrs-module" : "dev-master"
```

and set `minimum-stability` to `dev`

Then add `MalocherCqrsModule` to your `config/application.config.php``

Installation without composer is not officially supported, and requires you to install and autoload
the dependencies specified in the `composer.json`.

## Setup


Setup the CQRS System using your module or application configuration. Put all CQRS options under the key cqrs. 
```php
  'cqrs' => array(
        'adapters' => array(
            'Malocher\Cqrs\Adapter\ArrayMapAdapter' => array(
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
The ZF2 ServiceManager acts as Handler- and EventListenerLoader. That means, you can use your ServiceManager aliases
to pipe your commands, queries and events to your repositories, services and whatever you use in your application.

##Usage

You can request the Malocher CQRS Gate from the ServiceManager. The hole setup of the CQRS and Service Bus System is done in the background.
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
    
    $this->getServiceLocator()
      ->get('malocher.cqrs.gate')
      ->getBus(DomainBus::NAME)
      ->invokeCommand($addEntityCommand);
  }
}
```
Sample Application
-------------------
You can find a sample application with annotated sourcecode on [malocher/zf2-cqrs-sample](https://github.com/malocher/zf2-cqrs-sample)


