<?php

namespace ShopBundle\Controller;

use ShopBundle\Entity\commandeF;
use ShopBundle\Form\SocieteType;
use ShopBundle\Entity\Societe;
use ShopBundle\Form\commandeFType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

/**
 * commandeF controller.
 *
 */
class commandeFController extends Controller
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


   public function indexpdfAction() {

       $em = $this->getDoctrine()->getManager();

       $commandeFs = $em->getRepository('ShopBundle:commandeF')->findAll();
       $html = $this->renderView('@Shop/CommandeF/pdf.html.twig', array(
           'commandeFs'  => $commandeFs
       ));

       return new PdfResponse(
           $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
           'file.pdf'
       );
   }


    /**
     * Lists all commandeF entities.
     *
     */
    public function indexAction()
    {$countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $em = $this->getDoctrine()->getManager();

        $commandeFs = $em->getRepository('ShopBundle:commandeF')->findAll();

        return $this->render('@Shop/CommandeF/index.html.twig', array(
            'commandeFs' => $commandeFs,
            'countPromo' => $countPromo,
            'countLivr' => $countLivr,
        ));
    }

    /**
     * Creates a new commandeF entity.
     *
     */
    public function newAction(Request $request)
    {$countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $commandeF = new Commandef();
        $form = $this->createForm('ShopBundle\Form\commandeFType', $commandeF);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commandeF);
            $em->flush();

            return $this->redirectToRoute('commandef_index', array('idm' => $commandeF->getIdm()));
        }

        return $this->render('@Shop/CommandeF/new.html.twig', array(
            'commandeF' => $commandeF,
            'form' => $form->createView(),
            'countPromo' => $countPromo,
            'countLivr' => $countLivr,
        ));
    }

    /**
     * Finds and displays a commandeF entity.
     *
     */
    public function showAction(commandeF $commandeF)
    {
        $jour=0;
        $mois=0;
        $year=0;
        $current=new \DateTime("now");

        $countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $deleteForm = $this->createDeleteForm($commandeF);
        $jour= $commandeF->getDate()->diff($current, true)->d;
        $mois= $commandeF->getDate()->diff($current, true)->m;
        $year= $commandeF->getDate()->diff($current, true)->y;
        return $this->render('@Shop/CommandeF/show.html.twig', array(
            'commandeF' => $commandeF,
            'jour' => $jour,
            'mois' => $mois,
            'year' => $year,
            'delete_form' => $deleteForm->createView(),
            'countPromo' => $countPromo,
            'countLivr' => $countLivr,
        ));
    }

    /**
     * Displays a form to edit an existing commandeF entity.
     *
     */
    public function editAction(Request $request, commandeF $commandeF)
    {$countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $Form = $this->createForm('ShopBundle\Form\commandeFType', $commandeF);
        $Form->handleRequest($request);

        if ($Form->isSubmitted() && $Form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commandef_index', array('idm' => $commandeF->getIdm(),
                'countPromo' => $countPromo,
                'countLivr' => $countLivr,));
        }

        return $this->render('@Shop/CommandeF/edit.html.twig', array(
            'commandeF' => $commandeF,
            'form' => $Form->createView(),
            'countPromo' => $countPromo,
            'countLivr' => $countLivr,
        ));
    }

    /**
     * Deletes a commandeF entity.
     *
     */
    /**
     * Displays a form to edit an existing commandeF entity.
     *
     * @Route("/{idm}", name="commandef_delete")
     * @Method({"GET"})
     */
    public  function deleteAction($idm)
    {

        $em =$this->getDoctrine()->getManager();
        $form=$em->getRepository(commandeF::class)->find($idm);
        $em->remove($form);
        $em->flush();
        return $this->redirectToRoute('commandef_index');

    }


    /**
     * Creates a form to delete a commandeF entity.
     *
     * @param commandeF $commandeF The commandeF entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(commandeF $commandeF)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commandef_delete', array('idm' => $commandeF->getIdm())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}