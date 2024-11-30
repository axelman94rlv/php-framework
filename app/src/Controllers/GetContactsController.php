<?php
namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Managers\ContactManager;

class GetContactsController extends AbstractController {

    public function process(Request $request): Response {
        if ($request->getMethod() !== "GET") {
            return new Response("Method not allowed", 405);
        }

        $contactManager = new ContactManager();
        $contacts = $contactManager->getAllContacts();

        return new Response(json_encode($contacts, JSON_PRETTY_PRINT), 200, ['Content-Type' => 'application/json']);
    }
}