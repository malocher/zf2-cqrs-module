<?php
return array(
    'service_manager' => array(
        'invokables' => array(
            'malocher.cqrs.service_loader_proxy' => 'MalocherCqrsModule\Service\ServiceLoaderProxy'
        ),
        'factories' => array(
            'malocher.cqrs.gate' => 'MalocherCqrsModule\Service\GateFactory',
        ),
        'aliases' => array(
            'malocher.cqrs.command_handler_loader' => 'malocher.cqrs.service_loader_proxy',
            'malocher.cqrs.query_handler_loader'   => 'malocher.cqrs.service_loader_proxy',
            'malocher.cqrs.event_listener_loader'  => 'malocher.cqrs.service_loader_proxy',
        )
    ),
);