<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuantityWarehouse
 *
 * @ORM\Table(name="quantity_warehouse", indexes={@ORM\Index(name="id_product_checked", columns={"id_product_checked"}), @ORM\Index(name="quantity_warehouse_ibfk_2", columns={"id_warehouses"})})
 * @ORM\Entity
 */
class QuantityWarehouse extends AbstractEntity
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
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    private $quantity;

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
     * @var \Application\Entity\ProductCheck
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ProductCheck")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_product_checked", referencedColumnName="id")
     * })
     */
    private $idProductChecked;

    /**
     * @var \Application\Entity\Warehouses
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Warehouses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_warehouses", referencedColumnName="id")
     * })
     */
    private $idWarehouses;

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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return QuantityWarehouse
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set idProductChecked
     *
     * @param \Application\Entity\ProductCheck $idProductChecked
     *
     * @return QuantityWarehouse
     */
    public function setIdProductChecked(\Application\Entity\ProductCheck $idProductChecked = null)
    {
        $this->idProductChecked = $idProductChecked;

        return $this;
    }

    /**
     * Get idProductChecked
     *
     * @return \Application\Entity\ProductCheck
     */
    public function getIdProductChecked()
    {
        return $this->idProductChecked;
    }

    /**
     * Set idWarehouses
     *
     * @param \Application\Entity\Warehouses $idWarehouses
     *
     * @return QuantityWarehouse
     */
    public function setIdWarehouses(\Application\Entity\Warehouses $idWarehouses = null)
    {
        $this->idWarehouses = $idWarehouses;

        return $this;
    }

    /**
     * Get idWarehouses
     *
     * @return \Application\Entity\Warehouses
     */
    public function getIdWarehouses()
    {
        return $this->idWarehouses;
    }
}

