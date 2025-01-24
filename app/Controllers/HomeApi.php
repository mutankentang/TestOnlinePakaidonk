<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;

class HomeApi extends ResourceController
{
    protected $format = 'json';

    public function create_api()
    {
        $data = $this->request->getJSON(true);
        
        // Parse and clean data
        $name = strtoupper(trim($data['name']));
        $city = strtoupper(trim($data['city']));
        $age = $this->extractAge($data['age']);

        // Validate input data
        if (!$name || !$age || !$city) {
            return $this->fail('Invalid input data');  // Send failure response
        }

        // Insert into database
        $db = \Config\Database::connect();
        $builder = $db->table('bio');
        $builder->insert([
            'name' => $name,
            'age' => $age,
            'city' => $city,
        ]);

        // Send success response with inserted data
        return $this->respondCreated([
            'id' => $db->insertID(),
            'name' => $name,
            'age' => $age,
            'city' => $city
        ]);
    }

    private function extractAge($ageInput)
    {
        $cleanedAge = preg_replace('/\\s*(tahun|thn|th)\\s*/i', '', $ageInput);
        return (int)$cleanedAge;
    }
}
