<?php

namespace Application\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Application\Entity\Users;
use Zend\Crypt\Password\Bcrypt;

class UsersLoad extends AbstractFixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        date_default_timezone_set('America/Sao_Paulo');

        $user = new Users();
        $user->setFirstName('Marcelo')
            ->setLastname('Corrêa')
            ->setEmail('marcelo')
            ->setPassword('Marsc2014')
            ->setEmail('marcelocorrea229@gmail.com')
            ->setLevel(1)
            ->setActive(1)
            ->setActivationKey('asdfa9s8df76gs98df76gs9');

        $manager->persist($user);
        $manager->flush();

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 1;
    }

}