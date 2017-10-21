<?php

namespace Application\Service;

use Interop\Container\ContainerInterface;
use Zend\Crypt\BlockCipher;

class EncryptDecryptService
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * EncryptDecryptService constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getEncryptKey()
    {
        $config = $this->container->get('Config');

        return $config['key'];
    }

    public function getBlockCipher()
    {
        $blockCipher = BlockCipher::factory('openssl', ['algo' => 'aes']);
        $blockCipher->setKey($this->getEncryptKey());

        return $blockCipher;
    }

    public function encrypt($encrypt)
    {
        $filter = new \Zend\Filter\Encrypt([
            'adapter' => 'BlockCipher',
            'key'     => $this->getEncryptKey(),
        ]);

        return $filter->filter($encrypt);
    }

    public function decrypt($decrypt)
    {
        $filter = new \Zend\Filter\Decrypt([
            'adapter' => 'BlockCipher',
            'key'     => $this->getEncryptKey(),
        ]);

        return $filter->filter($decrypt);
    }
}