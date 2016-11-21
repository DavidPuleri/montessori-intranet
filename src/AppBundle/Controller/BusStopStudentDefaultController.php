<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BusStopStudentDefault;
use AppBundle\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Busstopstudentdefault controller.
 *
 * @Route("bus/student-default")
 */
class BusStopStudentDefaultController extends Controller
{
    /**
     * Lists all busStopStudentDefault entities.
     *
     * @Route("/", name="bug_student-default_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $busStopStudentDefaults = $em->getRepository('AppBundle:BusStopStudentDefault')->createQueryBuilder('bus_stop_student_default')
            ->select("u")
            ->from("AppBundle:BusStopStudentDefault","u")
            ->join("bus_stop_student_default.student","student")
            ->orderBy("bus_stop_student_default.student")
            ->getQuery()
            ->getResult()
        ;

        $breakDownPerTrajet = [];

        foreach ($busStopStudentDefaults as $busStopStudentDefault) {
            $breakDownPerTrajet[$busStopStudentDefault->getBusStop()->getBusJourney()->getId()][] = $busStopStudentDefault;
        }

        return $this->render('busstopstudentdefault/index.html.twig', array(
            'breakDownPerTrajet' => $breakDownPerTrajet,
        ));
    }

    /**
     * Creates a new busStopStudentDefault entity.
     *
     * @Route("/new", name="bug_student-default_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $busStopStudentDefault = new Busstopstudentdefault();
        $form = $this->createForm('AppBundle\Form\BusStopStudentDefaultType', $busStopStudentDefault);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($busStopStudentDefault);
            $em->flush($busStopStudentDefault);

            return $this->redirectToRoute('bug_student-default_index', array('id' => $busStopStudentDefault->getId()));
        }

        return $this->render('busstopstudentdefault/new.html.twig', array(
            'busStopStudentDefault' => $busStopStudentDefault,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing busStopStudentDefault entity.
     *
     * @Route("/{id}/edit", name="bug_student-default_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, BusStopStudentDefault $busStopStudentDefault)
    {
        $deleteForm = $this->createDeleteForm($busStopStudentDefault);
        $editForm = $this->createForm('AppBundle\Form\BusStopStudentDefaultType', $busStopStudentDefault);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bug_student-default_edit', array('id' => $busStopStudentDefault->getId()));
        }

        return $this->render('busstopstudentdefault/edit.html.twig', array(
            'busStopStudentDefault' => $busStopStudentDefault,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a busStopStudentDefault entity.
     *
     * @Route("/{id}", name="bug_student-default_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, BusStopStudentDefault $busStopStudentDefault)
    {
        $form = $this->createDeleteForm($busStopStudentDefault);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($busStopStudentDefault);
            $em->flush($busStopStudentDefault);
        }

        return $this->redirectToRoute('bug_student-default_index');
    }

    /**
     * Creates a form to delete a busStopStudentDefault entity.
     *
     * @param BusStopStudentDefault $busStopStudentDefault The busStopStudentDefault entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BusStopStudentDefault $busStopStudentDefault)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bug_student-default_delete', array('id' => $busStopStudentDefault->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
