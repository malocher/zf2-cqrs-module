<?php
/*
 * This file is part of the codeliner/zf2-cqrs-module package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace MalocherCqrsModuleTest\Mock;

use Malocher\Cqrs\Bus\AbstractBus;
/**
 *  TestBus
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class TestBus extends AbstractBus
{
    public function getName()
    {
        return 'test-bus';
    }

}
