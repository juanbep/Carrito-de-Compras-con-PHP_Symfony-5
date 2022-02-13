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
    public function addProduct(Product $article)
    {
                
        $sessionVal = $this->get('session')->get('article');
        
        $sessionVal[] = $article;
        
        $this->get('session')->set('article', $sessionVal);
        
        return $this->redirectToRoute('home_user');
        
    }
    
    
     /**
     * @Route("/view/cart", name="view_cart")
     */
    public function product()
    {
        return $this->render('home_user/mostrarCarrito.html.twig');
    }
    
    
    /**
    * @Route ("/article/session/delete/{id}", name="delete_article_session")
    * Method ({"DELETE"})
    */
    public function delete(Product $article, $id){
    
        
        
 
      return $this->render('home_user/mostrarCarrito.html.twig');
}
    
    
    
  
}