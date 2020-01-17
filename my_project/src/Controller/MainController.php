<?php

namespace App\Controller;

use App\Entity\TrekkingRoutes;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function search(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(TrekkingRoutes::class);
        $query = (int)($request->request->get('query'));
        $txtquery = $request->request->get('query');

        $products = $repository->findBy(['distance' => $query]);
        $products = array_merge($products,$repository->findBy(['difficultylevel' => $query]));
        $products = array_merge($products,$repository->findBy(['price' => $query]));
        $products = array_merge($products,$repository->findBy(['title' => $txtquery]));
        return $this->render('main/show.html.twig',[
            'products' => $products
        ]);
    }

    /**
     * @Route("", name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig');
    }
    /**
     * @Route("/show", name="show")
     */
    public function show()
    {
        $repository = $this->getDoctrine()->getRepository(TrekkingRoutes::class);
        $products = $repository->findAll();

        return $this->render('main/show.html.twig',[
            'products' => $products
        ]);
    }
    /**
     * @Route("/add", name="add")
     */
    public function add()
    {
        return $this->render('main/add.html.twig');
    }
    /**
     * @Route("/change", name="change")
     */
    public function change()
    {
        $repository = $this->getDoctrine()->getRepository(TrekkingRoutes::class);
        $products = $repository->findAll();

        return $this->render('main/change.html.twig',[
            'products' => $products
        ]);
    }
    /**
     * @Route("/changed/{product}", name="changed")
     */
    public function changed($product)
    {
        $repository = $this->getDoctrine()->getRepository(TrekkingRoutes::class);
        $product = $repository->find((int)$product);


        return $this->render('main/update.html.twig',[
            'product' => $product,
        ]);
    }
    /**
     * @Route("/updated/{id}", name="updated")
     */
    public function updated(Request $request,$id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(TrekkingRoutes::class)->find((int)$id);

        $product->setTitle($request->request->get('title'));

        if ($request->request->get('distance') == null)
            $product->setDistance(0);
        else
            $product->setDistance($request->request->get('distance'));

        if ($request->request->get('level') == null)
            $product->setDifficultylevel(0);
        else
            $product->setDifficultylevel($request->request->get('level'));

        if ($request->request->get('price') == null)
            $product->setPrice(0);
        else
            $product->setPrice($request->request->get('price'));

        $entityManager->flush();

        return $this->change();
    }
    /**
     * @Route("/delete", name="delete")
     */
    public function delete()
    {
        $repository = $this->getDoctrine()->getRepository(TrekkingRoutes::class);
        $products = $repository->findAll();

        return $this->render('main/delete.html.twig',[
            'products' => $products
        ]);
    }
    /**
     * @Route("/deleted/{product}", name="deleted")
     */
    public function deleted($product)
    {
        $repository = $this->getDoctrine()->getRepository(TrekkingRoutes::class);
        $prod = $repository->find((int)$product);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($prod);
        $entityManager->flush();

        $products = $repository->findAll();

        return $this->render('main/delete.html.twig',[
            'products' => $products
        ]);
    }

    /**
     * @Route("/inserted", name="insert")
     */
    public function insert(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $routes = new TrekkingRoutes();

        $routes->setTitle($request->request->get('title'));

        if ($request->request->get('distance') == null)
            $routes->setDistance(0);
        else
            $routes->setDistance($request->request->get('distance'));

        if ($request->request->get('level') == null)
            $routes->setDifficultylevel(0);
        else
            $routes->setDifficultylevel($request->request->get('level'));

        if ($request->request->get('price') == null)
            $routes->setPrice(0);
        else
            $routes->setPrice($request->request->get('price'));


        $entityManager->persist($routes);

        $entityManager->flush();

        return $this->render('main/add.html.twig');
    }
}