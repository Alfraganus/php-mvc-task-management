<?php

use yidas\data\Pagination;

class tasks extends Controller
{
    private $db;
    private $dataPerPage;

    public function __construct()
    {
        $this->db = new Database;
        $this->dataPerPage =3;
        $this->taskModel = $this->model('Task');
        $this->userModel = $this->model('User');
    }

    public function checkOrder($order)
    {
        $orderValues = [
          'ASC',
          'DESC'
        ];
        if(!in_array($order,$orderValues)) {
            return 'ASC';
        } else {
            return $order;
        }
    }

    public function index()
    {
       /*pagination*/
        $this->db->query("SELECT * FROM tasks");
        $this->db->single();

        $pagination = new Pagination([
            'totalCount' => $this->db->rowCount(),
            'perPage'=> $this->dataPerPage,
        ]);
        $getKey =null;
        $getValue =null;
        if(isset($_GET['orderByName'])) {
            $getKey =  'name';
            $getValue = $this->checkOrder(trim($_GET['orderByName']));
        } elseif (isset($_GET['orderByEmail'])) {
            $getKey =  'email';
            $getValue = $this->checkOrder(trim($_GET['orderByEmail']));
        } elseif (isset($_GET['orderByStatus'])) {
            $getKey =  'status';
            $getValue = $this->checkOrder(trim($_GET['orderByStatus']));
        } else {
            $getKey =  'name';
            $getValue = 'ASC';
        }

        // Get range data for the current page
        $this->db->query("SELECT * FROM `tasks` ORDER BY $getKey $getValue LIMIT {$pagination->offset}, {$pagination->limit}");
        $paginationData = $this->db->resultSet();

        $data = [
            'tasks' => $paginationData,
            'pagination' => $pagination,
        ];
        $this->view('tasks/index', $data);
    }

    public function show($id)
    {
        $post = $this->taskModel->show($id);
        $user = $this->userModel->getUserbyId($post->user_id);
        $data = [
            'post' => $post,
            'user' => $user,
        ];
        $this->view('tasks/show', $data);
    }


    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'task_content' => trim($_POST['task_content']),
                'name_err' => '',
                'content_err' => '',
                'email_err' => '',
            ];

            //validate title
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter title';
            }
            if (empty($data['task_content'])) {
                $data['content_err'] = 'Please enter task text';
            }
            if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Please enter email';
            }
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Email is not valid';
            }

            if (empty($data['name_err']) && empty($data['content_err']) && empty($data['email_err'])) {
                // die('success');
                if ($this->taskModel->addTask($data)) {
                    flash('post_message', 'Task Added');
                    redirect('posts');
                } else {
                    die('something went wrong');
                }
            } else {
                $this->view('tasks/add', $data);
            }
        } else {
            $data = [
                'name' => '',
                'email' => '',
                'task_content' => ''
            ];
            $this->view('tasks/add', $data);
        }
    }

    public function adminTask()
    {
        $data =  $this->taskModel->getTasks();
        $this->view('tasks/admin_tasks', $data);
    }

    /*admin can edit status*/
    public function adminEdit($id)
    {
        if (!$_SESSION['user_id']) {
            redirect('users/login');
        }

        $task = $this->taskModel->show($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'task_content' => trim($_POST['task_content']),
                'status'=> trim($_POST['status']),
                'id'=> $task->id,
                'name_err' => '',
                'content_err' => '',
                'email_err' => '',
            ];

            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter title';
            }
            if (empty($data['task_content'])) {
                $data['content_err'] = 'Please enter task text';
            }
            if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Please enter email';
            }
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Email is not valid';
            }

            /*if error does not occur*/
            if (empty($data['name_err']) && empty($data['content_err']) && empty($data['email_err'])) {
                if ($this->taskModel->updateTask($data)) {
                    flash('post_message', 'Task Edited');
                    redirect("/");
                } else {
                    die('something went wrong');
                }
            } else {
                /*if error occurs*/
                $this->view('tasks/edit', $data);
            }
        } else {
            $data = [
                'id' => $task->id,
                'name' =>$task->name,
                'email' => $task->email,
                'task_content' => $task->task_content,
                'status' => $task->status,
            ];
            $this->view('tasks/edit', $data);
        }
    }

}
