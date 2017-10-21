<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Products
 *
 * @ORM\Table(name="products", indexes={@ORM\Index(name="fk_products_product_categories1_idx", columns={"product_category_id"}), @ORM\Index(name="fk_products_unit_measures1_idx", columns={"units_measure_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Application\Repository\ProductsRepository")
 */
class Products extends AbstractEntity
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
     * @var integer
     *
     * @ORM\Column(name="active", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $active;

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
     * @var \Application\Entity\ProductCategories
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ProductCategories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_category_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $productCategory;

    /**
     * @var \Application\Entity\UnitsMeasure
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\UnitsMeasure")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="units_measure_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $unitsMeasure;

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
     * @return Products
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
     * Set active
     *
     * @param integer $active
     *
     * @return Products
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set productCategory
     *
     * @param \Application\Entity\ProductCategories $productCategory
     *
     * @return Products
     */
    public function setProductCategory(\Application\Entity\ProductCategories $productCategory = null)
    {
        $this->productCategory = $productCategory;

        return $this;
    }

    /**
     * Get productCategory
     *
     * @return \Application\Entity\ProductCategories
     */
    public function getProductCategory()
    {
        return $this->productCategory;
    }

    /**
     * Set unitsMeasure
     *
     * @param \Application\Entity\UnitsMeasure $unitsMeasure
     *
     * @return Products
     */
    public function setUnitsMeasure(\Application\Entity\UnitsMeasure $unitsMeasure = null)
    {
        $this->unitsMeasure = $unitsMeasure;

        return $this;
    }

    /**
     * Get unitsMeasure
     *
     * @return \Application\Entity\UnitsMeasure
     */
    public function getUnitsMeasure()
    {
        return $this->unitsMeasure;
    }
}