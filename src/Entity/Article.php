<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
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
   * @ORM\Column(type="text")
   */
   private $Descripcion;
   
   //Getters & Setters
  
   function getName()
   {
       return $this->Name;
   }

   function getDescripcion()
   {
       return $this->Descripcion;
   }

   function setName($Name): void
   {
       $this->Name = $Name;
   }

   function setDescripcion($Descripcion): void
   {
       $this->Descripcion = $Descripcion;
   }
   
   
}
