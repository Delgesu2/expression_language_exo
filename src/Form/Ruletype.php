<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 14/02/20
 * Time: 16:43
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class Ruletype
 *
 * @package App\Form
 */
class Ruletype extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rule_expression', TextType::class, [
                "label" => "Expression :",
                "help"  => "Forme obligatoire de l'expression: product.type = 'catégorie' and product.price > nombre. Tout 
                en minuscules et le nombre entre 1 et 3 chiffres. Les espaces sont facultatifs."
            ])

            ->add('discount_percent', PercentType::class, [
                "label" => "Pourcentage :",
                "type"  => "integer"
            ])

            ->add('submit', SubmitType::class, [
                "label" => "Soumettre"
            ])
            ;
    }

}