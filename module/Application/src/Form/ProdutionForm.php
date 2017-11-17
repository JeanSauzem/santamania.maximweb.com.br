<?php

namespace Application\Form;

use Interop\Container\ContainerInterface;
use Zend\Form\Form;
use Zend\Form\Element;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Form\Element\ObjectSelect;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;

class ProdutionForm extends Form implements ObjectManagerAwareInterface
{
    protected $objectManager;

    public function __construct(ContainerInterface $container,ObjectManager $objectManager)
    {
        parent::__construct('prodution-form');
        $this->setObjectManager($objectManager);
       // $this->setInputFilter($container->get(\Application\Filter\ProductsFilter::class));

        $this->add([
            'name' => 'id',
            'type' => Element\Hidden::class,
        ]);

        $this->add([
            'name' => 'quantity',
            'type' => Element\Number::class,
        ]);

        $this->add([
            'name'    => 'product',
            'type'    => ObjectSelect::class,
            'options' => [
                'disable_inarray_validator' => true,
                'object_manager'            => $this->getObjectManager(),
                'target_class'              => \Application\Entity\Products::class,
                'property'                  => 'name',
                'is_method'                 => true,
                'find_method'               => [
                    'name'   => 'findBy',
                    'params' => [
                        'criteria' => [],
                        'orderBy'  => [
                            'id' => 'DESC',
                        ],
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => Element\Submit::class,
        ]);
    }


    /**
     * Get the object manager
     *
     * @return ObjectManager
     */
    public function getObjectManager()
    {
        return $this->objectManager;
    }

    /**
     * Set the object manager
     *
     * @param ObjectManager $objectManager
     */
    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }
}