<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TotalReport
 *
 * @ORM\Table(name="total_report", indexes={@ORM\Index(name="product_id", columns={"product_id"})})
 * @ORM\Entity
 */
class TotalReport extends AbstractEntity
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
     * @ORM\Column(name="different", type="integer", nullable=false)
     */
    private $different;

    /**
     * @var integer
     *
     * @ORM\Column(name="sub_total", type="integer", nullable=false)
     */
    private $subTotal;

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
     * @var \Application\Entity\Products
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;

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
     * @return TotalReport
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
     * Set different
     *
     * @param integer $different
     *
     * @return TotalReport
     */
    public function setDifferent($different)
    {
        $this->different = $different;

        return $this;
    }

    /**
     * Get different
     *
     * @return integer
     */
    public function getDifferent()
    {
        return $this->different;
    }

    /**
     * Set subTotal
     *
     * @param integer $subTotal
     *
     * @return TotalReport
     */
    public function setSubTotal($subTotal)
    {
        $this->subTotal = $subTotal;

        return $this;
    }

    /**
     * Get subTotal
     *
     * @return integer
     */
    public function getSubTotal()
    {
        return $this->subTotal;
    }

    /**
     * Set product
     *
     * @param \Application\Entity\Products $product
     *
     * @return TotalReport
     */
    public function setProduct(\Application\Entity\Products $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Application\Entity\Products
     */
    public function getProduct()
    {
        return $this->product;
    }

}

