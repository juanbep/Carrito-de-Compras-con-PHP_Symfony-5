<?php

namespace App\Controller;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class HomeUserController extends AbstractController
{
    /**
     * @Route("/home/user", name="home_user")
     */
    public function product()
    {
    
        $articles = $this->getDoctrine()->getRepository(Product::class)->findAll();
        
        return $this->render('home_user/index.html.twig',array('articles' => $articles));
    }
    
    
    
    
    
    
    
}
