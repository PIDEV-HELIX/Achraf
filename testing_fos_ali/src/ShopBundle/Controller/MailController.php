<?php

namespace ShopBundle\Controller;

use Doctrine\DBAL\Types\TextType;
use ShopBundle\Entity\Mail;
use ShopBundle\Entity\Soc;
use ShopBundle\Form\MailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class MailController extends Controller
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

   public function inboxAction()
    {$countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $em = $this->getDoctrine()->getManager();

        $mails = $em->getRepository('ShopBundle:Mail')->findAll();
        return $this->render('@Shop/Mail/admin_inbox.html.twig', array(
            'mails' => $mails,
            'countPromo' => $countPromo,
            'countLivr' => $countLivr,
        ));

    }


    public function sendAction(Request $request, $ids)
    {$countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $mail = new Mail();
        $em = $this->getDoctrine()->getManager();
        $soc = $em->getRepository('ShopBundle:Soc')->find($ids);
        $mail->setMailto($soc->getEmail());

        $form = $this->createForm(MailType::class, $mail);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $subject = $mail->getSubject();
            $mailto = $mail->getMailto();
            $object = $mail->getObject();
            $username = 'ach.thamri@gmail.com';
            $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom($username)
                ->setTo($mailto)
                ->setBody($object, 'text/html');
            $this->get('mailer')->send($message);


            $mail->setMailfrom($username);
            $mail->setTime(new \DateTime());
            $mail->setIds($soc);

            $em->persist($mail);
            $em->flush();

            $mails = $em->getRepository('ShopBundle:Mail')->findAll();
            return $this->render('@Shop/Mail/admin_inbox.html.twig', array(
                'mails' => $mails,
                'countPromo' => $countPromo,
                'countLivr' => $countLivr,));

        }


        return $this->render('@Shop/Mail/send.html.twig', array(
            'form' => $form->createView(),
            'countPromo' => $countPromo,
            'countLivr' => $countLivr,
        ));
    }


    public function composeAction(Request $request)
    {
        $mail = new Mail();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(MailType::class, $mail);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $subject = $mail->getSubject();
            $mailto = $mail->getMailto();
            $object = $mail->getObject();
            $username = 'ach.thamri@gmail.com';
            $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom($username)
                ->setTo($mailto)
                ->setBody($object, 'text/html');

            //  $message->attach(Swift_Attachment::fromPath('full-path-with-attachment-name'));
            $this->get('mailer')->send($message);


            $mail->setMailfrom($username);
            $mail->setTime(new \DateTime());


            $em->persist($mail);
            $em->flush();

            $mails = $em->getRepository('ShopBundle:Mail')->findAll();
            return $this->render('@Shop/Mail/admin_inbox.html.twig', array('mails' => $mails));
        }

    }

    /*public function searchBarAction()
    {
        $form=$this->createFormBuilder(null)
        ->add('recherche', TextType::class)
            ->getForm();
        return $this->render('@Shop/Mail/admin_inbox.html.twig', [
            'form'=> $form->createView()]);
    }*/


    public function searchAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $mails=$em->getRepository(Mail::class)->findAll();
        if($request->isMethod("POST"))
        {
            $subject=$request->get('subject');
            $mails=$em->getRepository('ShopBundle:Mail')->findBy(array('subject'=>$subject));
        }
        return $this->render('@Shop/Mail/admin_inbox.html.twig',array('mails'=>$mails));

    }

}
