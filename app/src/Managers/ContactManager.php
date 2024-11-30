<?php

namespace App\Managers;

use App\Entities\Contact;
use App\Http\Request;
use App\Http\Response;

class ContactManager {
    private string $filepath;

    public function __construct(){
        $this->filepath = __DIR__ .'/../../var/contacts';
    }

    

    function validate(array $body, array $requiredFields): ?Response {
        if (empty($body)) {
            return new Response(
                json_encode(['error' => 'Your contact is empty']),
                400,
                ['Content-Type' => 'application/json']
            );
        }
        $missingFields = array_diff($requiredFields, array_keys($body));
        if (!empty($missingFields)) {
            return new Response(
                json_encode(['error' => 'Missing fields: ' . implode(', ', $missingFields)]),
                400,
                ['Content-Type' => 'application/json']
            );
        }
        if (count($body) !== count($requiredFields)) {
            return new Response(
                json_encode(['error' => 'Too much fields']),
                400,
                ['Content-Type' => 'application/json']
            );
        }
        return null;
    }
    public function saveContact(Contact $contact): string {
        $timestamp = time();
        $filename = sprintf('%s_%s.json', $timestamp, $contact->getEmail());

        $contact->setDateOfCreation($timestamp);
        $contact->setDateOfLastUpdate($timestamp);

        $filePath = $this->filepath . '/' . $filename;

        file_put_contents($filePath, json_encode($contact->toArray(), JSON_PRETTY_PRINT));

        return $filename;
    }

    public function getAllContacts():array {
        $contacts = [];

        foreach (scandir($this->filepath) as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                $filePath = $this->filepath .'/'. $file;
                $contactData = json_decode(file_get_contents($filePath), true);

                if ($contactData) {
                    $contacts[] = $contactData;
                }
            }
        }

        return $contacts;
    }
}