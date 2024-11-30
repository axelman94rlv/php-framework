<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Entities\Contact;
use App\Managers\ContactManager;

class PostContactController extends AbstractController {

    
    public function process(Request $request): Response {
        if ($request->getMethod() !== 'POST') {
            return new Response('Method not allowed', 405);
        }

        $requestData = json_decode(file_get_contents('php://input'), true);

        $contactManager = new ContactManager();
        $validation = $contactManager->validate($requestData, ['email', 'subject', 'message']);

        if ($validation) {
            return $validation;
        }

        $contact = new Contact($requestData['email'], $requestData['subject'], $requestData['message']);
        $filename = $contactManager->saveContact($contact);

        return new Response(  json_encode(['file' => $filename]),
        201,
        ['Content-Type' => 'application/json']
    );
    
    }
}