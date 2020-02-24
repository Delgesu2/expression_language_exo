<?php

namespace App\Service;

use App\Repository\ProductRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

/**
 * Class Mailer
 *
 * @package App\Service
 */
final class Mailer
{
    /**
     * @param MailerInterface $mailer
     * @param ProductRepository $productRepository
     *
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function sendEmail(
        MailerInterface $mailer,
        ProductRepository $productRepository
    )
    {
        // Read data array
        $data = require __DIR__ . './../../config/mailer/mail_data.php';

        // Create and send mail
        $email = (new TemplatedEmail())
            ->from($data['from'])
            ->to($data['to'])
            ->subject('Liste des prix réduits')
            ->htmlTemplate('./../templates/mail.html.twig')
            ->context([
                'products' => $productRepository->getDiscountPrices()
            ]);

        $mailer->send($email);
    }
}