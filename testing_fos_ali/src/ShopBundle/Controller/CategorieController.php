<?php


namespace ShopBundle\Controller;


use ShopBundle\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategorieController extends Controller
{

    public function ParentAction()
    {

        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('ShopBundle:Categorie')->findAll();
        $produit = $em->getRepository('ShopBundle:Produit')->findAll();
        return $this->render('ShopBundle:Categorie:index.html.twig', array(
            'produit' => $produit,
            'categories' => $categories,

        ));    }

    public function  countPromo()
    {
        $rest=0;
        $em = $this->getDoctrine()->getManager();
        $promo = $em->getRepository('ShopBundle:Promotion')->findAll();
        foreach ($promo as $p)
        {
            $rest= $rest+1;
        }

        return $rest;
    }
    public function  countLivr()
    {
        $rest=0;
        $em = $this->getDoctrine()->getManager();
        $promo = $em->getRepository('ShopBundle:Livr')->findAll();
        foreach ($promo as $p)
        {
            $rest= $rest+1;
        }

        return $rest;
    }
    public function createcategorieAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $em = $this->getDoctrine()->getManager();
        $categorie = new Categorie();
        $form = $this->createForm('ShopBundle\Form\CategorieType', $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('Categorie_Affiche');
        }

        return $this->render('ShopBundle:Categorie:AjouterCategories.html.twig', array(
            'categorie' => $categorie,
            'form' => $form->createView(),
            'countPromo' => $countPromo,
            'countLivr' => $countLivr,


        ));

    }

    public function AfficheCategoriesAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $countLivr=$this->countLivr();
        $countPromo=$this->countPromo();

        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('ShopBundle:Categorie')->findAll();
        return $this->render('ShopBundle:Categorie:AfficheCategories.html.twig', array(
            'categories' => $categories,
            'countPromo' => $countPromo,
            'countLivr' => $countLivr,


        ));
    }

    public function SupprimerCategoriesAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository('ShopBundle:Categorie')->find(array("id" => $id));
        $em->remove($cat);
        $em->flush();
        return $this->redirectToRoute('Categorie_Affiche');
    }

    public function AfficheCategorieProduitAction(\Symfony\Component\HttpFoundation\Request $request,$id)
    {
        $countLivr=$this->countLivr();
        $countPromo=$this->countPromo();

        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('ShopBundle:Produit')->findBy(array("id"=>$id));
        $categories = $em->getRepository('ShopBundle:Categorie')->findAll();
        return $this->render('ShopBundle:Categorie:AfficheFrontCategories.html.twig', array(
            'produit' => $produit,
            'categories' => $categories,
            'countPromo' => $countPromo,
            'countLivr' => $countLivr,


        ));
    }

}