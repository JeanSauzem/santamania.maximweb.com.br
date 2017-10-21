<?php

namespace Application\View\Helper;

use Interop\Container\ContainerInterface;
use Zend\View\Helper\AbstractHelper;

class Status extends AbstractHelper
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Status constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke($status, $label = true)
    {
        $html = '';

        if ($label) {

            if ($status == 2)
                $html = '<span class="badge badge badge-danger">Suspenso</span>';
            if ($status == 1)
                $html = '<span class="badge badge badge-success">Ativo</span>';
            if ($status == 0)
                $html = '<span class="badge badge-danger">Desativado</span>';

        } else {

            if ($status == 2)
                $html = 'Suspenso';
            if ($status == 1)
                $html = 'Ativo';
            if ($status == 0)
                $html = 'Desativado';

        }

        return $html;
    }
}