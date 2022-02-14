<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    /**
   * @ORM\Column(type="text", length=100)
   */
   private $Name;
   
    /**
   * @ORM\Column(type="decimal", precision=20, scale=2)
   */
   private $precio;
   
   
   /**
   * @ORM\Column(type="integer")
   */
   private $cantidad;
   

   /**
   * @ORM\Column(type="text")
   */
   private $Descripcion;
   
   /**
   * @ORM\Column(type="text",  length=255)
   */
   private $imagen;
   
   
   //Getters & Setters
  
   function getName()
   {
       return $this->Name;
   }

   function getPrecio()
   {
       return $this->precio;
   }

   function getDescripcion()
   {
       return $this->Descripcion;
   }

   function getImagen()
   {
       return $this->imagen;
   }

   function setName($Name): void
   {
       $this->Name = $Name;
   }

   function setPrecio($precio): void
   {
       $this->precio = $precio;
   }

   function setDescripcion($Descripcion): void
   {
       $this->Descripcion = $Descripcion;
   }

   function setImagen($imagen): void
   {
       $this->imagen = $imagen;
   }

   function getCantidad()
   {
       return $this->cantidad;
   }

   function setCantidad($cantidad): void
   {
       $this->cantidad = $cantidad;
   }
    
}
