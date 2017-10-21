<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UnitsMeasure
 *
 * @ORM\Table(name="units_measure")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Application\Repository\UnitsMeasureRepository")
 */
class UnitsMeasure extends AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="symbol", type="string", length=5, precision=0, scale=0, nullable=false, unique=false)
     */
    private $symbol;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    protected $updatedAt;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return UnitsMeasure
     */
    public function setName($name)
    {
        $this->name = $this->encrypt($name);

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->decrypt($this->name);
    }

    /**
     * Set symbol
     *
     * @param string $symbol
     *
     * @return UnitsMeasure
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $this->encrypt($symbol);

        return $this;
    }

    /**
     * Get symbol
     *
     * @return string
     */
    public function getSymbol()
    {
        return $this->decrypt($this->symbol);
    }
}