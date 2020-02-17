<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * Class HomeController
 *
 * @package App\Controller
 *
 * @Route(
 *     path="/",
 *     name="home",
 *     methods={"GET"}
 *     )
 */
class HomeController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * HomeController constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }


    /**
     * @param ProductRepository $productRepository
     *
     * @return Response
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(ProductRepository $productRepository)
    {
        return new Response(
            $this->twig->render('home.html.twig',[
                'products' => $productRepository->findAll()
            ])
        );
    }

}