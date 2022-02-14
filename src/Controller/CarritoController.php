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
        $band = False;
       
        
        if(!empty($sessionVal)){
            foreach ($sessionVal as $producto)
            {
                if($producto->getId() == $article->getId() ){
                    $cantidad = $producto->getCantidad() + 1;
                    $producto->setCantidad($cantidad);
                    $band = true;
                }
            }
        }
          
        if($band == false){
            $article->setCantidad(1);
            $sessionVal[] = $article;
        
            $this->get('session')->set('article', $sessionVal);
        }
        
        // Recuperar flashbag del controlador
        $flashbag = $this->get('session')->getFlashBag();

        // Agregar mensaje flash
        $flashbag->add("success", "Producto ". $article->getName()  ." agregado al carrito...");
        
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
       
        $sessionArticle = $this->get('session')->get('article');   
        $sessionVal = null;

        foreach ($sessionArticle as $value)
        {
            if( $value->getId() != $id){
                 $sessionVal[] = $value;
            }
        }
        $this->get('session')->clear();

        $this->get('session')->set('article', $sessionVal);

        return $this->redirectToRoute('view_cart');
    
    }
}
