<?php
/*
 * This file is part of the codeliner/zf2-cqrs-module package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace MalocherCqrsModuleTest\Service;

use PHPUnit_Framework_TestCase;
/**
 * GateFactoryTest
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class GateFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testCreateFactory()
    {
        $serviceManager = \MalocherCqrsModuleTest\Bootstrap::getServiceManager();
        
        $defaultConfig = $serviceManager->get('config');
        
        $config = array(
            'cqrs' => array(
                'default_bus' => 'test-bus',
                'adapters' => array(
                    'Malocher\Cqrs\Adapter\ArrayMapAdapter' => array(
                        'buses' => array(
                            'MalocherCqrsModuleTest\Mock\TestBus' => array(
                                'MalocherCqrsModuleTest\Mock\TestCommand' => array(
                                    'alias' => 'testcommandhandler',
                                    'method' => 'handleTestCommand'
                                )
                            )
                        )
                    )
                )
            )
        );
        
        $config = \Zend\Stdlib\ArrayUtils::merge($defaultConfig, $config);
        
        $serviceManager->setAllowOverride(true);
        
        $serviceManager->setService('config', $config);
        $serviceManager->setService('testcommandhandler', new \MalocherCqrsModuleTest\Mock\TestCommandHandler());
        
        $gate = $serviceManager->get('malocher.cqrs.gate');
        
        $this->assertInstanceOf('Malocher\Cqrs\Gate', $gate);
        $this->assertEquals('test-bus', $gate->getBus()->getName());
        
        $command = new \MalocherCqrsModuleTest\Mock\TestCommand();
        
        $gate->getBus()->invokeCommand($command);
        
        $this->assertTrue($command->isInvoked());
    }
}
