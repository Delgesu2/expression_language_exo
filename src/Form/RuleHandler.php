<?php

namespace App\Form;

use App\Entity\Rules;
use App\Repository\RuleRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class RuleHandler
{
    /**
     * @var RuleRepository
     */
    private $ruleRepository;

    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    /**
     * RuleHandler constructor.
     *
     * @param RuleRepository $ruleRepository
     * @param FlashBagInterface $flashBag
     */
    public function __construct(
        RuleRepository       $ruleRepository,
        FlashBagInterface    $flashBag
)
    {
        $this->ruleRepository = $ruleRepository;
        $this->flashBag       = $flashBag;
    }


    /**
     * @param FormInterface $form
     * @param Rules $rule
     *
     * @return bool
     */
    public function handle(
        FormInterface $form,
        Rules         $rule
    )
    {
        if (($form->isSubmitted() && $form->isValid())) {

            $this->ruleRepository->save($rule);

            $this->flashBag->add('success', 'La règle a bien été enregistrée.');

            return true;
        }

        return false;
    }
}