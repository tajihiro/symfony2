<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Members;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class MemberController extends Controller
{
    /**
     * @Route("/member")
     * @Method ("get")
     */
    public function indexAction(){
        return $this->render('AppBundle:Member:index.html.twig',
            ['form' => $this -> createMemberForm()-> createView()]
        );
    }

    /**
     * @Route("/member")
     * @Method ("post")
     */
    public function indexPostAction(Request $request){
        $form = $this->createMemberForm();
        $form->handleRequest($request);

        dump($form->get('name')->getData());
        dump($form->get('email')->getData());
        dump($form->get('sex')->getData());

        if ($form->isValid()){
            $data = $form->getData();
            $members = new Members();
            $members->setName($data['name']);
            $members->setEmail($data['email']);
            $members->setSex($data['sex']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($members);
            $em->flush();

            return $this->redirect($this->generateUrl('app_member_complete'));
        }
        return $this->redirect($this->generateUrl('app_member_index'));
    }

    /**
     * @Route ("/complete")
     * @return \Symfony\Component\HttpFoundation\Response|null
     */
    public function completeAction(){
        return $this -> render('AppBundle:Member:complete.html.twig');
    }

    private function createMemberForm(){
        return $this->createFormBuilder()
            ->add('name', 'text')
            ->add('email', 'text')
            ->add('sex', 'choice',
                ['choices' =>[
                    '男性',
                    '女性'
                ],
                    'expanded' => true
                ])
            ->add('submit', 'submit',['label' => '送信'])
            ->getForm();
    }
}

