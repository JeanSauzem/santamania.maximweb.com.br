<?php

namespace Application\Fixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Zend\Math\Rand;

abstract class AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function getCodeHash()
    {
        $bytes = Rand::getBytes(32);

        return substr(md5($bytes), 0, 15);
    }
}