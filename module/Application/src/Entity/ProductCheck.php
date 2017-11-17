<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductCheck
 *
 * @ORM\Table(name="product_check", indexes={@ORM\Index(name="id_counter", columns={"id_counter"}), @ORM\Index(name="id_product", columns={"id_product"})})
 * @ORM\Entity
 */
class ProductCheck extends AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="total", type="integer", nullable=false)
     */
    private $total;

    /**
     * @var integer
     *
     * @ORM\Column(name="checked", type="integer", nullable=false)
     */
    private $checked;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;

    /**
     * @var \Application\Entity\Counter
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Counter")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_counter", referencedColumnName="id")
     * })
     */
    private $idCounter;

    /**
     * @var \Application\Entity\Products
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_product", referencedColumnName="id")
     * })
     */
    private $idProduct;

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
     * Set total
     *
     * @param integer $total
     *
     * @return ProductCheck
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return integer
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set checked
     *
     * @param integer $checked
     *
     * @return ProductCheck
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;

        return $this;
    }

    /**
     * Get checked
     *
     * @return integer
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * Set idCounter
     *
     * @param \Application\Entity\Counter $idCounter
     *
     * @return ProductCheck
     */
    public function setIdCounter(\Application\Entity\Counter $idCounter = null)
    {
        $this->idCounter = $idCounter;

        return $this;
    }

    /**
     * Get idCounter
     *
     * @return \Application\Entity\Counter
     */
    public function getIdCounter()
    {
        return $this->idCounter;
    }

    /**
     * Set idProduct
     *
     * @param \Application\Entity\Products $idProduct
     *
     * @return ProductCheck
     */
    public function setIdProduct(\Application\Entity\Products $idProduct = null)
    {
        $this->idProduct = $idProduct;

        return $this;
    }

    /**
     * Get idProduct
     *
     * @return \Application\Entity\Products
     */
    public function getIdProduct()
    {
        return $this->idProduct;
    }
}

