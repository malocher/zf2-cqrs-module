<?php
return array(
    'service_manager' => array(
        'invokables' => array(
            'cqrs.service_loader_proxy' => 'CqrsModule\Service\ServiceLoaderProxy'
        ),
        'factories' => array(
            'cqrs.gate' => 'CqrsModule\Service\GateFactory',
        ),
        'aliases' => array(
            'cqrs.command_handler_loader' => 'cqrs.service_loader_proxy',
            'cqrs.event_listener_loader'  => 'cqrs.service_loader_proxy',
        )
    ),
);