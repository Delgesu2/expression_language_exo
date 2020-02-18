<?php

namespace App\Form;

use App\Entity\Rules;
use App\Repository\RuleRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RuleHandler
{
    /**
     * @var RuleRepository
     */
    private $ruleRepository;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var ValidatorInterface $validator
     */
    private $validator;

    /**
     * RuleHandler constructor.
     *
     * @param RuleRepository $ruleRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     */
    public function __construct(
        RuleRepository       $ruleRepository,
        SessionInterface     $session,
        ValidatorInterface   $validator
)
    {
        $this->ruleRepository = $ruleRepository;
        $this->session        = $session;
        $this->validator      = $validator;
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

            $constraints = $this->validator->validate($rule);

            /**
             * Validation
             */
            if (count($constraints) > 0) {
                return false;
            }

            $this->ruleRepository->save($rule);

            $this->session->getFlashbag()->add('success', 'La règle a bien été enregistrée.');

            return true;
        }

        return false;
    }
}