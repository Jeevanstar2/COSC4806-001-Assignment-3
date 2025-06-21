<?php
require_once 'app/core/config.php';
require_once 'app/models/User.php';
class RegisterController 
{
    public function showForm() 
    {
        include 'app/views/register/index.php';
    }
    public function create() 
    {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $confirm = trim($_POST['confirm_password']);
        $error_message = '';
        if (empty($username) || empty($password) || empty($confirm)) 
        {
            $error_message = "All fields are required.";
        } 
        elseif (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) 
        {
            $error_message = "Password must be 8+ chars, 1 uppercase, 1 number.";
        } 
        elseif ($password !== $confirm) 
        {
            $error_message = "Passwords do not match.";
        } 
        elseif (User::findByUsername($username)) 
        {
            $error_message = "Username already exists.";
        } 
        else 
        {
            User::create($username, $password);
            header("Location: index.php?action=login&success=" . urlencode("Account created. Please log in."));
            exit();
        }
        include 'app/views/register/index.php';
    }
}
?>