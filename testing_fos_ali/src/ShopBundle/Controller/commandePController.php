<?php

namespace ShopBundle\Controller;

use ShopBundle\Entity\commandeP;
use ShopBundle\Form\PanierType;
use ShopBundle\Entity\Panier;
use ShopBundle\Form\commandePType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;


/**
 * commandeP controller.
 *
 */
class commandePController extends Controller
{public function  countPromo()
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




    /**
     * Lists all commandeP entities.
     *
     */
    public function indexAction()
    {$countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $em = $this->getDoctrine()->getManager();

        $commandePs = $em->getRepository('ShopBundle:commandeP')->findAll();

        return $this->render('@Shop/CommandeP/frontindex.html.twig', array(
            'commandePs' => $commandePs,
        ));
    }

    /**
     * Creates a new commandeP entity.
     *
     */
    public function newAction(Request $request)
    {
        $commandeP = new commandeP();
        $form = $this->createForm('ShopBundle\Form\commandePType', $commandeP);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commandeP);
            $em->flush();

            return $this->redirectToRoute('comfront_index', array('idcm' => $commandeP->getIdcm()));
        }

        return $this->render('@Shop/CommandeP/frontnew.html.twig', array(
            'commandeP' => $commandeP,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a commandeP entity.
     *
     */
    public function showAction(commandeP $commandeP)
    {
        $deleteForm = $this->createDeleteForm($commandeP);

        return $this->render('@Shop/CommandeP/frontshow.html.twig', array(
            'commandeP' => $commandeP,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing commandeP entity.
     *
     */
    public function editAction(Request $request, commandeP $commandeP)
    {
        $deleteForm = $this->createDeleteForm($commandeP);
        $editForm = $this->createForm('ShopBundle\Form\commandePType', $commandeP);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comfront_edit', array('idcm' => $commandeP->getIdcm()));
        }

        return $this->render('@Shop/CommandeP/frontedit.html.twig', array(
            'commandeP' => $commandeP,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a commandeP entity.
     *
     */
    /**
     * Displays a form to edit an existing commandeP entity.
     *
     * @Route("/{idcm}", name="comfront_delete")
     * @Method({"GET"})
     */
    public  function deleteAction($idcm)
    {

        $em =$this->getDoctrine()->getManager();
        $form=$em->getRepository(commandeP::class)->find($idcm);
        $em->remove($form);
        $em->flush();
        return $this->redirectToRoute('comfront_index');

    }


    /**
     * Creates a form to delete a commandeP entity.
     *
     * @param commandeP $commandeP The commandeP entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(commandeP $commandeP)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comfront_delete', array('idcm' => $commandeP->getIdcm())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}