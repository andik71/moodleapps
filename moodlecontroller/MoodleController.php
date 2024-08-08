<?php

class MoodleController
{
    private $apiUrl;
    private $token;

    public function __construct($apiUrl, $token)
    {
        $this->apiUrl = $apiUrl;
        $this->token = $token;
    }

    private function makeRequest($params)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->apiUrl,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded'
            ]
        ]);
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        curl_close($curl);

        if (isset($error_msg)) {
            throw new Exception('cURL Error: ' . $error_msg);
        }

        if ($httpCode !== 200) {
            throw new Exception('HTTP Error: ' . $httpCode . ' Response: ' . $response);
        }

        $decodedResponse = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('JSON Decode Error: ' . json_last_error_msg());
        }

        if (isset($decodedResponse['exception'])) {
            throw new Exception('Moodle Exception: ' . $decodedResponse['message']);
        }

        return $decodedResponse;
    }

    public function getUsers($key = '', $value = '')
    {
        $params = [
            'wstoken' => $this->token,
            'wsfunction' => 'core_user_get_users',
            'moodlewsrestformat' => 'json',
            'criteria' => [
                ['key' => $key, 'value' => $value]
            ]
        ];
        return $this->makeRequest($params);
    }

    public function getCourses()
    {
        $params = [
            'wstoken' => $this->token,
            'wsfunction' => 'core_course_get_courses',
            'moodlewsrestformat' => 'json'
        ];
        return $this->makeRequest($params);
    }

    public function getCategories()
    {
        $params = [
            'wstoken' => $this->token,
            'wsfunction' => 'core_course_get_categories',
            'moodlewsrestformat' => 'json'
        ];
        return $this->makeRequest($params);
    }

    public function createUser(array $user)
    {
        $requiredFields = ['username', 'password', 'firstname', 'lastname', 'email'];
        foreach ($requiredFields as $field) {
            if (empty($user[$field])) {
                throw new Exception('Missing required user field: ' . $field);
            }
        }

        $params = [
            'wstoken' => $this->token,
            'wsfunction' => 'core_user_create_users',
            'moodlewsrestformat' => 'json',
            'users' => [$user]
        ];
        return $this->makeRequest($params);
    }

    public function createCourse(array $course)
    {
        $requiredFields = ['fullname', 'shortname', 'categoryid', 'summary'];
        foreach ($requiredFields as $field) {
            if (empty($course[$field])) {
                throw new Exception('Missing required course field: ' . $field);
            }
        }

        $params = [
            'wstoken' => $this->token,
            'wsfunction' => 'core_course_create_courses',
            'moodlewsrestformat' => 'json',
            'courses' => [$course]
        ];
        return $this->makeRequest($params);
    }
}
?>
