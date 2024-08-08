<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../moodlecontroller/MoodleController.php';

$apiUrl = 'https://demo.diklat.id/lms/webservice/rest/server.php';
$token = 'd203af738612dd97b1e248bfb229ddab'; // Ganti dengan token yang benar

$moodleController = new MoodleController($apiUrl, $token);

$action = $_GET['action'] ?? '';

if ($action) {
    try {
        switch ($action) {
            case 'get_users':
                $key = 'firstname';
                $value = '%';  // Wildcard untuk semua pengguna
                $response = $moodleController->getUsers($key, $value);
                echo json_encode($response);
                break;
            case 'get_courses':
                $courses = $moodleController->getCourses();
                echo json_encode($courses);
                break;
            case 'get_categories':
                $categories = $moodleController->getCategories();
                echo json_encode($categories);
                break;
            case 'create_user':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $user = [
                        'username' => $_POST['username'],
                        'password' => $_POST['password'],
                        'firstname' => $_POST['firstname'],
                        'lastname' => $_POST['lastname'],
                        'email' => $_POST['email']
                    ];
                    $response = $moodleController->createUser($user);
                    echo json_encode($response);
                } else {
                    echo json_encode(['error' => 'Invalid request method']);
                }
                break;
            case 'create_course':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $course = [
                        'fullname' => $_POST['fullname'],
                        'shortname' => $_POST['shortname'],
                        'categoryid' => $_POST['categoryid'],
                        'summary' => $_POST['summary']
                    ];
                    $response = $moodleController->createCourse($course);
                    echo json_encode($response);
                } else {
                    echo json_encode(['error' => 'Invalid request method']);
                }
                break;
            default:
                echo json_encode(['error' => 'Invalid action']);
                break;
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Moodle Exception: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Action not specified']);
}
