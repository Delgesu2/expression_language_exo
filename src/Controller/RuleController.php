<?php

namespace App\Controller;

use App\Entity\Rules;
use App\Form\RuleHandler;
use App\Form\Ruletype;
use App\Repository\RuleRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * Class RuleController
 *
 * @package App\Controller
 *
 * @Route(path="/rule")
 */
class RuleController
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var RuleHandler
     */
    private $ruleHandler;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var RuleRepository
     */
    private $ruleRepository;

    /**
     * RuleController constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param RuleHandler $ruleHandler
     * @param UrlGeneratorInterface $urlGenerator
     * @param Environment $twig
     * @param RuleRepository $ruleRepository
     */
    public function __construct(
        FormFactoryInterface  $formFactory,
        RuleHandler           $ruleHandler,
        UrlGeneratorInterface $urlGenerator,
        Environment           $twig,
        RuleRepository        $ruleRepository
    ) {
        $this->formFactory    = $formFactory;
        $this->ruleHandler    = $ruleHandler;
        $this->urlGenerator   = $urlGenerator;
        $this->twig           = $twig;
        $this->ruleRepository = $ruleRepository;
    }


    /**
     * @Route(
     *     path="/create",
     *     name="create"
     *     )
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function addRule(Request $request)
    {
        $rule = new Rules();

        $form = $this->formFactory->create(Ruletype::class, $rule)
            ->handleRequest($request);

        if ($this->ruleHandler->handle($form, $rule)){
            return new RedirectResponse($this->urlGenerator->generate('rules'));
        }

        return new Response(
            $this->twig->render('create_rule.html.twig', [
                'form' => $form->createView()
            ])
        );


    }

    /**
     * @Route(
     *     path="/list",
     *     name="rules",
     *     methods={"GET"}
     *     )
     *
     * @return Response
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function rules()
    {
        return new Response(
            $this->twig->render(
                'rules.html.twig', [
                    'rules' => $this->ruleRepository->findAll()
                ])
        );
    }

}