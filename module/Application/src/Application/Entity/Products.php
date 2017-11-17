<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Products
 *
 * @ORM\Table(name="products", indexes={@ORM\Index(name="fk_products_product_categories1_idx", columns={"product_category_id"}), @ORM\Index(name="fk_products_unit_measures1_idx", columns={"units_measure_id"})})
 * @ORM\Entity
 */
class Products
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer", nullable=false)
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \Application\Entity\ProductCategories
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ProductCategories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_category_id", referencedColumnName="id")
     * })
     */
    private $productCategory;

    /**
     * @var \Application\Entity\UnitsMeasure
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\UnitsMeasure")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="units_measure_id", referencedColumnName="id")
     * })
     */
    private $unitsMeasure;


}
