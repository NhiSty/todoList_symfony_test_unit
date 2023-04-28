<?php

namespace App\Service;

use phpDocumentor\Reflection\Types\Boolean;

class EmailSender
{
    public function sendEmail(string $email, string $content): bool
    {
        // Not implemented
        return new Exception('Not implemented');
    }

}
