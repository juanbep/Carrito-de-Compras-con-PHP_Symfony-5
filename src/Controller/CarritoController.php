<?php


namespace App\Controller;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class CarritoController extends AbstractController
{
    
    
    /**
     * @Route("/add/product/{id}", name="add_product")
     *  Method ({"GET", "POST"})
     */
    public function addProduct(Request $request, $id)
    {
        $article = $this->getDoctrine()->getRepository(Product::class)->find($id);
                
        $sessionVal = $this->get('session')->get('article');
        
        $sessionVal[] = $article;
        
        $this->get('session')->set('article', $sessionVal);
        
        return $this->redirectToRoute('home_user');
        
    }
  
}
