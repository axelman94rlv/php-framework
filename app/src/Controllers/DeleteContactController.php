<?php
namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Managers\ContactManager;

class DeleteContactController extends AbstractController {
    public function process(Request $request): Response {
        $uriCut = explode('/', trim($request->getUri(),'/'));
        $filename = $uriCut[1];

        if($request->getMethod() !== 'DELETE') {
            return new Response('Method not allowed', 405);
        }

        $contactManager = new ContactManager();

        $contactData= $contactManager->getContact($filename);

        if (!$contactData) {
            return new Response('File not found', 404);
        }
        $delete = $contactManager->deleteContact($filename);
        if ($delete) {
            return new Response('File deleted sucessfully',204);}
        else {
            return new Response('Failed to delete file', 404);
        }
    }
}
