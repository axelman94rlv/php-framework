<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Managers\ContactManager;

class GetContactController extends AbstractController{

    public function process(Request $request): Response {
        $uriCut = explode('/', trim($request->getUri(),'/'));
        $filename = $uriCut[1];
        if ($request->getMethod() !== 'GET') {
            return new Response('Method not allowed', 405);
        }

        $contactManager = new ContactManager();
        $contact = $contactManager->getContact($filename);

        if (!$contact) {
            return new Response('Contact not found', 404);
        }

        return new Response(json_encode($contact, JSON_PRETTY_PRINT), 200, ['Content-Type' => 'application/json']);
    }
}