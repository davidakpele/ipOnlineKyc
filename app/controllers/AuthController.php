<?php

use Request\Method\RequestHelper;
use Services\Validate\Request\User;

class AuthController extends Controller {

    private $smarty;
    private $store_db_model;

    public function __construct() {
        global $smarty;
        $this->smarty = $smarty;
        $this->store_db_model = $this->loadModel('UserRepository');
    }

    public function register(){
        //check method
        if (RequestHelper::isRequestMethod('POST')) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $response = array();
            $errors = array(
                'username' => '',
                'email' => '',
                'password' => ''
            );
            $username= isset($_POST['username'])? strip_tags(trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING))):'';
            $email= isset($_POST['email'])? strip_tags(trim(filter_var($_POST['email'], FILTER_SANITIZE_STRING))):'';
            $password= isset($_POST['password'])? strip_tags(trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING))):'';

            $user = new User($username, $email, $password);
            $validationErrors = $user->validate();

            if (empty($validationErrors['username']) && empty($validationErrors['email']) && empty($validationErrors['password'])) {
                //check if username and email already been used.

                if ($this->store_db_model->findUserByEmail($email)) {
                    $errors['email'] = "Email already in used by another user, please choose a different email address.";
                }
                if ($this->store_db_model->findUserByUsername($username)) {
                    $errors['username'] = "This username has already been taken by a user, please choose a different username.";
                }else{
                    //hash password using password_hash() Argon2i
                    $hash_password = password_hash($password, PASSWORD_ARGON2ID);
                    if($this->store_db_model->save_user($username, $email, $hash_password)){
                        $response['success'] = array('status' => 'success', 'details' => 'Registration successful! Welcome, ' . htmlspecialchars($user->username) . '.', http_response_code(201));
                    }else{
                        $errors['username'] = "Unable to register user at this time, please try again later.";
                    }
                }
            } else {
                $errors = array_merge($errors, $validationErrors);
            }
            $this->smarty->assign('errors', $errors);
            $this->smarty->assign('success', isset($response['success']) ? $response['success'] : null);
            $this->smarty->assign('submitted_username', isset($username) ? htmlspecialchars($username) : '');
            $this->smarty->assign('submitted_email', isset($email) ? htmlspecialchars($email) : '');
            $this->smarty->assign('submitted_password', isset($password) ? htmlspecialchars($password) : '');
        }else {
            $this->smarty->assign('errors', array('username' => '', 'email' => '', 'password' => ''));
            $this->smarty->assign('submitted_username', '');
            $this->smarty->assign('submitted_email', '');
        }
            $this->smarty->assign('page_title', 'Register Account');
            $this->smarty->assign('root_link', ROOT);
            $this->smarty->assign('assets_link', ASSETS);
            $this->smarty->display('auth/register.tpl');

    }


    public function login(){
        $this->smarty->assign('page_title', 'Login');
        $this->smarty->assign('root_link', ROOT);
        $this->smarty->assign('assets_link', ASSETS);
        $this->smarty->display('auth/login.tpl');

    }
}
