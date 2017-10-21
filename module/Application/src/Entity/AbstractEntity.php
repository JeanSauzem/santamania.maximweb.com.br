<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Crypt\BlockCipher;
use Zend\Hydrator\ClassMethods;

/**
 * @ORM\HasLifecycleCallbacks
 */
abstract class AbstractEntity
{
    public function __construct(Array $options = [])
    {
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");

        (new ClassMethods())->hydrate($options, $this);
    }

    public function getEncryptKey()
    {
        return 'MaximWebSantaMania';
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

    /**
     * @return array
     */
    public function toArray()
    {
        return (new ClassMethods())->extract($this);
    }

    /**
     * Set createdAt
     *
     * @ORM\PrePersist
     *
     * @return $this
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime("now");

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @ORM\PreUpdate
     *
     * @return $this
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime("now");

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}