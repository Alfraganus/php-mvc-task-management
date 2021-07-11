<?php
// namespace App\Models;
class User
{
    private $db;

    /**
     * User constructor.
     * @param null $data
     */
    public function __construct()
    {
        $this->db = new Database;
    }
    //find user through email
    public function findUserByLogin($login)
    {
        $this->db->query('SELECT * FROM users WHERE login= :login');
        $this->db->bind(':login', $login);

       $this->db->execute();
        //check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (login, password) VALUES(:login, :password)');
        $this->db->bind(':login', $data['login']);
        $this->db->bind(':password', $data['password']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function login($login,  $password)
    {
        $this->db->query('SELECT *FROM users WHERE login=:login');
        $this->db->bind(':login', $login);
        $row = $this->db->single();
        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }
    public function getUserbyId($user_id)
    {
        $this->db->query('SELECT * FROM users WHERE id= :user_id');
        $this->db->bind(':user_id', $user_id);

        $row = $this->db->single();
        return $row;
    }
}
