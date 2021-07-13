<?php

use yidas\data\Pagination;
class Task
{
    private $db;

    /**
     * Post constructor.
     * @param null $data
     */
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getTasks()
    {
        $this->db->query('SELECT * FROM tasks');
        $results = $this->db->resultSet();
        return $results;
    }

    public function addTask($data)
    {
        $this->db->query('INSERT INTO tasks (name, email, task_content) VALUES(:name, :email, :task_content)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':task_content', $data['task_content']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function show($id)
    {
        $this->db->query("SELECT *
                          FROM tasks      
                          WHERE id=:id
                          ");
        $this->db->bind(':id', $id);
        $results = $this->db->single();
        return $results;
    }

    public function updateTask($data)
    {
        $this->db->query('UPDATE tasks SET name=:name, email=:email,task_content=:task_content,status=:status WHERE id =:id');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':task_content', $data['task_content']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':id', $data['id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /*in case delete could be used*/
    public function deletePost($id)
    {
        $this->db->query('DELETE FROM tasks where id=:id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
