<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prodution
 *
 * @ORM\Table(name="prodution", indexes={@ORM\Index(name="prodution_ibfk_1", columns={"product_id"})})
 * @ORM\Entity
 */
class Prodution
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
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \Application\Entity\Products
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;


}
