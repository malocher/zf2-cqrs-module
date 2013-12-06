<?php
/*
 * This file is part of the codeliner/zf2-cqrs-module package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace MalocherCqrsModuleTest\Mock;

use Malocher\Cqrs\Message\Message;
use Malocher\Cqrs\Command\CommandInterface;
/**
 *  TestCommand
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class TestCommand extends Message implements CommandInterface
{
    protected $invoked = false;
    
    public function setInvoked($flag)
    {
        $this->invoked = $flag; 
    }
    
    public function isInvoked()
    {
        return $this->invoked;
    }
}
