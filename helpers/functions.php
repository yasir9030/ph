<?php
function sanitize($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

function validatePhone($phone) {
    return preg_match('/^01[3-9]\d{8}$/', $phone);
}

function getBloodGroups() {
    return ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
}

function getDistricts() {
    return [
        'Dhaka', 'Chittagong', 'Rajshahi', 'Sylhet', 'Khulna', 'Barisal',
        'Rangpur', 'Mymensingh', 'Cumilla', 'Narayanganj', 'Pabna', 'Bogura',
        'Jessore', 'Noakhali', 'Gazipur', 'Tangail', 'Brahmanbaria', 'Dinajpur',
        'Cox\'s Bazar', 'Faridpur', 'Narsingdi', 'Kishoreganj', 'Manikganj',
        'Munshiganj', 'Shariatpur', 'Madaripur', 'Gopalganj', 'Jashore',
        'Meherpur', 'Chuadanga', 'Kushtia', 'Magura', 'Narail', 'Satkhira',
        'Bagerhat', 'Pirojpur', 'Jhalokathi', 'Patuakhali', 'Bhola', 'Barguna',
        'Feni', 'Lakshmipur', 'Chandpur', 'Khagrachhari', 'Rangamati',
        'Bandarban', 'Moulvibazar', 'Habiganj', 'Sunamganj', 'Netrokona',
        'Jamalpur', 'Sherpur', 'Gaibandha', 'Kurigram', 'Lalmonirhat',
        'Nilphamari', 'Panchagarh', 'Thakurgaon', 'Joypurhat', 'Naogaon',
        'Chapai Nawabganj', 'Natore', 'Sirajganj'
    ];
}

function formatDate($date) {
    return date('d/m/Y', strtotime($date));
}

function showAlert($message, $type = 'success') {
    $_SESSION['alert'] = [
        'message' => $message,
        'type' => $type
    ];
}

function getAlert() {
    if (isset($_SESSION['alert'])) {
        $alert = $_SESSION['alert'];
        unset($_SESSION['alert']);
        return $alert;
    }
    return null;
}