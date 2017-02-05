<?php

namespace HeticBundle\Controller;

use HeticBundle\Entity\Student;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends Controller
{
    /**
     * @Route("/student")
     */
    public function indexAction()
    {
        $service = $this->get('hetic.services.time_is_on_my_side');
        $em = $this->getDoctrine()->getManager();
        $students = $em->getRepository('HeticBundle:Student')->findAll();

        $ages = [];

        foreach ($students as $student) {
            /** @var Student $student */
            $ages[$student->getId()] = $age = $service->getAge($student->getDateOfBirth());
        }

        return $this->render('student/index.html.twig', array(
            'students' => $students,
            'ages' => $ages,
        ));
    }

    /**
     * @var string
     *
     * @Route("/student/new")
     * @Method({"GET", "POST"})
     */

    public function newAction(Request $request)
    {
        $student = new Student();
        $form = $this->createForm('HeticBundle\Form\StudentType', $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();

            return $this->redirectToRoute('student_show', array('id' => $student->getId()));
        }

        return $this->render('student/new.html.twig', array(
            'student' => $student,
            'form' => $form->createView(),
        ));

    }

    /**
     *
     * @Route("/{id}", name="student_show")
     * @Method("GET")
     */
    public function showAction(Student $student)
    {

        return $this->render('student/show.html.twig', array(
            'student' => $student,
        ));
    }

}
