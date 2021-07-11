<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //process form 

            //sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'login' => trim($_POST['login']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'login_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            // validate name


            //Validate Email
            if (empty($data['login'])) {
                $data['login_err'] = 'Please enter login';
            } else {
                // check email
                if ($this->userModel->findUserByLogin($data['login'])) {
                    $data['login_err'] = 'Login already taken';
                }
            }

            //Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 3) {
                $data['password_err'] = 'Password must have 3 characters';
            }

            // Validate Confirm Password

            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            //Make sure errors are empty
            if (empty($data['login_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                //validated
                // die('success');
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register User
                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are Registered Successfully');
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }
                #..
            } else {
                //load view with errors
                $this->view('users/register', $data);
            }
        } else {
            //Load Form
            $data = [
                'login' => '',
                'password' => '',
                'confirm_password' => '',
                'login_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'login' => trim($_POST['login']),
                'password' => trim($_POST['password']),
                'login_err' => '',
                'password_err' => '',
            ];

            //Validate Email
            if (empty($data['login'])) {
                $data['login_err'] = 'Please enter login';
            }

            //Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }
            //Check for user/email
            if ($this->userModel->findUserByLogin($data['login'])) {
                //user found
            } else {
                $data['login_err'] = 'no user found';
            }

            //Make sure errors are empty
            if (empty($data['login_err']) && empty($data['password_err'])) {
                //validated
                //check and set logged in user
                $loggedInUser = $this->userModel->login($data['login'], $data['password']);

                if ($loggedInUser) {
                    //create session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password Incorrect';

                    $this->view('users/login', $data);
                }
                #..
            } else {
                //load view with errors
                $this->view('users/login', $data);
            }
            #..
        } else {
            //Load Form
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];
            $this->view('users/login', $data);
        }
    }
    public function  createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_login'] = $user->login;
        redirect('/');
    }
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_login']);
        session_destroy();
        redirect('users/login');
    }
}
