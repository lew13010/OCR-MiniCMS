<?php

namespace Loic\CMSBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Loic\CMSBundle\Entity\Advert;
use Loic\CMSBundle\Form\AdvertType;

/**
 * Advert controller.
 *
 */
class AdvertController extends Controller
{
    /**
     * Lists all Advert entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $adverts = $em->getRepository('LoicCMSBundle:Advert')->findAll();

        return $this->render('LoicCMSBundle:advert:index.html.twig', array(
            'adverts' => $adverts,
        ));
    }

    /**
     * Creates a new Advert entity.
     *
     */
    public function newAction(Request $request)
    {
        $advert = new Advert();
        $form = $this->createForm('Loic\CMSBundle\Form\AdvertType', $advert, array(
            'extra_fields_message' => array(
                'primary' => array(
                    $this->container->getParameter('role_default')
                ))
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($advert);
            $em->flush();

            return $this->redirectToRoute('advert_show', array('id' => $advert->getId()));
        }

        return $this->render('LoicCMSBundle:advert:new.html.twig', array(
            'advert' => $advert,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Advert entity.
     *
     */
    public function showAction(Advert $advert)
    {
        $deleteForm = $this->createDeleteForm($advert);

        return $this->render('LoicCMSBundle:advert:show.html.twig', array(
            'advert' => $advert,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Advert entity.
     *
     */
    public function editAction(Request $request, Advert $advert)
    {
        $deleteForm = $this->createDeleteForm($advert);
        $editForm = $this->createForm('Loic\CMSBundle\Form\AdvertType', $advert, array(
            'extra_fields_message' => array(
                'primary' => array(
                    $this->container->getParameter('role_default')
                ))
        ));
        $editForm->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $gedmo = $em->getRepository('Gedmo\Loggable\Entity\LogEntry');
        $logs = $gedmo->getLogEntries($advert);

        //die(var_dump($logs));

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($advert);
            $em->flush();

            return $this->redirectToRoute('advert_edit', array('id' => $advert->getId()));
        }

        return $this->render('LoicCMSBundle:advert:edit.html.twig', array(
            'advert'        => $advert,
            'edit_form'     => $editForm->createView(),
            'delete_form'   => $deleteForm->createView(),
            'logs'          => $logs,
        ));
    }

    /**
     * Deletes a Advert entity.
     *
     */
    public function deleteAction(Request $request, Advert $advert)
    {
        $form = $this->createDeleteForm($advert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($advert);
            $em->flush();
        }

        return $this->redirectToRoute('advert_index');
    }

    /**
     * Creates a form to delete a Advert entity.
     *
     * @param Advert $advert The Advert entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Advert $advert)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('advert_delete', array('id' => $advert->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function viewAction(Advert $advert)
    {
        return $this->render('LoicCMSBundle:Default:advert.html.twig', array(
           'advert'     =>  $advert,
        ));
    }

    public function revertAction(Advert $advert, $version)
    {
        $em = $this->getDoctrine()->getManager();
        $gedmo = $em->getRepository('Gedmo\Loggable\Entity\LogEntry');
        $gedmo->revert($advert,$version);

        $em->persist($advert);
        $em->flush();

        return $this->redirectToRoute('advert_index');
    }
}
