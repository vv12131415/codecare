<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')->findAll();
        $categories = $em->getRepository('AppBundle:Category')->findAll();


        return $this->render('AppBundle:Index:index.html.twig', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/{category_name}", name="showCategory")
     */
    public function categoryAction(Request $request, $category_name)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('AppBundle:Category')->findOneByName($category_name);


        return $this->render('AppBundle:Index:category.html.twig', [
            'category' => $category,
        ]);
    }
}
