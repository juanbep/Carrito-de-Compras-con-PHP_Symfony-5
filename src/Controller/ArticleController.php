<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class ArticleController extends AbstractController {
  /**
   * @Route("/admin/article", name="articles_list")
   */
    public function article(){
    
    $articles = $this->getDoctrine()->getRepository(Product::class)->findAll();

    return $this->render('articles/index.html.twig', array('articles' => $articles));
  }
  
  /**
 * @Route ("/admin/article/new", name="new_article")
 * Method ({"GET", "POST"})
 */
public function new(Request $request){
  $article = new Product();

  $form = $this->createFormBuilder($article)
    ->add('name', TextType::class, array('required' =>true,'attr' =>array('class' => 'form-control')))
    ->add('precio', NumberType::class, array('required' =>true,'invalid_message'=> 'Valor inválido','attr' =>array('class' => 'form-control', 'placeholder' => 'Sin puntos ni comas...')))      
    ->add('cantidad', NumberType::class, array('invalid_message'=> 'Valor inválido','attr' =>array('class' => 'form-control')))            
    ->add('descripcion', TextareaType::class, array('required' =>true,'attr' =>array('class' =>'form-control')))
    ->add('imagen', UrlType::class, array('required' =>false,'attr' =>array('class' =>'form-control', 'placeholder' => 'Url ...')))      
    ->add('save', SubmitType::class, array('label' =>'Create','attr' =>array('class'=>'btn btn-primary mt-3')))
    ->getForm();
  
    $form->handleRequest($request);
    
    if($form->isSubmitted() && $form->isValid()){
        $article = $form->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($article);
        $entityManager->flush();
        return $this->redirectToRoute('article_list');
    }
  
    return $this->render('articles/new.html.twig',array(
    'form'=>$form->createView()
  ));
}

/**
 * @Route ("/article/{id}", name= "article_show")
 * Method ({"GET"})
 */
public function show($id){
  $article = $this->getDoctrine()->getRepository(Product::class)->find($id);

  return $this->render('articles/show.html.twig', array('article' =>$article));

}

/**
 * @Route ("/article/update/{id}", name="update_article")
 * @Method ({"GET", "POST"})
 */
public function update(Request $request, $id){
    
    $article = $this->getDoctrine()->getRepository(Product::class)->find($id);

    $form = $this->createFormBuilder($article)
    ->add('name', TextType::class, array('required' =>true,'attr' =>array('class' => 'form-control')))
    ->add('precio', NumberType::class, array('required' =>true,'attr' =>array('class' => 'form-control', 'placeholder' => 'Sin puntos ni comas...')))      
    ->add('cantidad', NumberType::class, array('invalid_message'=> 'Valor inválido','attr' =>array('class' => 'form-control')))         
    ->add('descripcion', TextareaType::class, array('required' =>true,'attr' =>array('class' =>'form-control')))
    ->add('imagen', UrlType::class, array('required' =>false,'attr' =>array('class' =>'form-control', 'placeholder' => 'Url ...')))      
    ->add('save', SubmitType::class, array('label' =>'Update','attr' =>array('class'=>'btn btn-primary mt-3')))
    ->getForm();

    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('article_list');
    }

    return $this->render('articles/update.html.twig',array('form'=>$form->createView()));  
}

/**
 * @Route ("/article/delete/{id}", name="delete_article")
 * Method ({"DELETE"})
 */
public function delete(Product $article){
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($article);
    $entityManager->flush();
    return $this->redirectToRoute('article_list');
}

}
