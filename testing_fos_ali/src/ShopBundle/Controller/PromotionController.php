<?php


namespace ShopBundle\Controller;


use ShopBundle\Entity\Promotion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PromotionController extends  Controller
{


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
    public function AjouterPromotionAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $countLivr=$this->countLivr();
        $countPromo=$this->countPromo();

        $em = $this->getDoctrine()->getManager();
        $promo= new Promotion();
        $form = $this->createForm('ShopBundle\Form\PromotionType', $promo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($promo);
            $em->flush();
            return $this->redirectToRoute('Promotion_Affiche');
        }

        return $this->render('ShopBundle:Promotion:AjouterPromotion.html.twig', array(
            'promo' => $promo,
            'form' => $form->createView(),
            'countPromo' => $countPromo,
            'countLivr' => $countLivr,

        ));

    }


    public function AffichePromotionAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $countLivr=$this->countLivr();
        $countPromo=$this->countPromo();

        $em = $this->getDoctrine()->getManager();
        $promo = $em->getRepository('ShopBundle:Promotion')->findAll();
        return $this->render('ShopBundle:Promotion:AffichePromotion.html.twig', array(
            'promotions' => $promo,
            'countPromo' => $countPromo,
            'countLivr' => $countLivr,


        ));
    }


    public function SupprimerPromotionAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $promo = $em->getRepository('ShopBundle:Promotion')->find(array("id" => $id));
        $em->remove($promo);
        $em->flush();
        return $this->redirectToRoute('Promotion_Affiche');
    }


    public function ModifierPromotionAction(Request $request, $id)
    {$countLivr=$this->countLivr();
        $countPromo=$this->countPromo();

        $em = $this->getDoctrine()->getManager();

        $promo = $em->getRepository('ShopBundle:Promotion')->find($id);
        $editForm = $this->createForm('ShopBundle\Form\PromotionType', $promo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em->persist($promo);
            $em->flush();

            return $this->redirectToRoute('Promotion_Affiche');
        }

        return $this->render('ShopBundle:Promotion:ModifierPromotion.html.twig', array(
            'promo' => $promo,
            'form' => $editForm->createView(),
            'countPromo' => $countPromo,
            'countLivr' => $countLivr,

        ));
    }


    public function AffichePromotionFrontAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('ShopBundle:Categorie')->findAll();
        $promo = $em->getRepository('ShopBundle:Promotion')->findAll();
        return $this->render('ShopBundle:Categorie:AffichePromotionFront.html.twig', array(
            'promotions' => $promo,
            'countPromo' => $countPromo,
            'countLivr' => $countLivr,
            'categories' => $categories,



        ));
    }

}