<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Managers\ContactManager;

class UpdateContactController extends AbstractController {

    public function process(Request $request): Response {
        $uriCut = explode('/', trim($request->getUri(),'/'));
        $filename = $uriCut[1];

        if ($request->getMethod() !== 'PATCH') {
            return new Response('Method not allowed', 405);
        }

        $contactManager = new ContactManager();

        $contactData = $contactManager->getContact($filename);

        if(!$contactData){
            return new Response('Contact not found',404);
        }

        $body =json_decode(file_get_contents('php://input'), true);
        $validation = $contactManager->validate($body, ['email', 'subject', 'message']);

        if ($validation !== null) {
            return $validation;
        }

        $updateContact = $contactManager->updateContact($filename, $body);

        return new Response(json_encode($updateContact, JSON_PRETTY_PRINT),200, ['Content-Type' => 'application/json']);
    }
}