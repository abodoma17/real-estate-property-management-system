<?php

namespace App\Service;

use Symfony\Component\Form\FormInterface;

class FormErrorFormatter
{
    public function getErrorMessages(FormInterface $form): array
    {
        $errors = [];

        foreach ($form->getErrors(true) as $error) {
            $errors[] = [
                'field' => $error->getOrigin()->getName(),
                'message' => $error->getMessage()
            ];
        }

        return $errors;
    }
}