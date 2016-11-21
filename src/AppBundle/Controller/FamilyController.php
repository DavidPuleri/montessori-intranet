<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Family;
use FOS\UserBundle\Form\Type\RegistrationFormType;
use FOS\UserBundle\Form\Type\UsernameFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Family controller.
 *
 * @Route("school/family")
 */
class FamilyController extends Controller
{
    /**
     * Lists all family entities.
     *
     * @Route("/", name="school_family_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $families = $em->getRepository('AppBundle:Family')->findAll();

        return $this->render('family/index.html.twig', array(
            'families' => $families,
        ));
    }

    /**
     * Creates a new family entity.
     *
     * @Route("/new", name="school_family_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $family = new Family();
        $form = $this->createForm(RegistrationFormType::class, $family);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($family);
            $em->flush($family);

            return $this->redirectToRoute('school_family_index', array('id' => $family->getId()));
        }

        return $this->render('family/new.html.twig', array(
            'family' => $family,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing family entity.
     *
     * @Route("/{id}/edit", name="school_family_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Family $family)
    {
        $deleteForm = $this->createDeleteForm($family);
        $editForm = $this->createForm(RegistrationFormType::class, $family);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('school_family_edit', array('id' => $family->getId()));
        }

        return $this->render('family/edit.html.twig', array(
            'family' => $family,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a family entity.
     *
     * @Route("/{id}", name="school_family_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Family $family)
    {
        $form = $this->createDeleteForm($family);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($family);
            $em->flush($family);
        }

        return $this->redirectToRoute('school_family_index');
    }

    /**
     * Creates a form to delete a family entity.
     *
     * @param Family $family The family entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Family $family)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('school_family_delete', array('id' => $family->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
