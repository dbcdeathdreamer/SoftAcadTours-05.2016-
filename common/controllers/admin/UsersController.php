<?php

class UsersController extends Controller
{

    public function __construct()
    {
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login');
        }
    }
    
    public function index() {
        $data =array();

        //В тази променлива пазим броя резултати които искаме да върне заявката
        $pageResults = 5;

        //В променливата $page присвояваме гет параметъра, който се придава. Ако няма гет параметър то тогава слагаме 1.
        $page = (isset($_GET['page']) && (int)$_GET['page'] > 0)? (int)$_GET['page'] : 1;

        //В тази променлива изчисляваме от кой точно резултат да започне броенето в заявката.
        $offset = ($page-1)*$pageResults;

        $usersCollection = new UsersCollection();
        $users = $usersCollection->get(array(), $offset, $pageResults);
        $totalRows = count($usersCollection->get());

        $paginator = new Pagination();
        $paginator->setPerPage($pageResults);
        $paginator->setTotalRows($totalRows);
        $paginator->setBaseUrl('index.php?c=users');
        
        $data['users'] = $users;
        $data['paginator'] = $paginator;

        $this->loadView('users/list.php', $data);
    }

    public function insert()
    {
        $viewData = array();

        $errors = array();
        $data = array(
            'username' => '',
            'password' => '',
            'email'    => '',
            'description' => '',
        );
        if (isset($_POST['submit'])) {
            $data = array(
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'repeatPassword' => $_POST['repeatPassword'],
                'email'    => $_POST['email'],
                'description' => $_POST['description'],
            );
            //Podavame dannite na funkciq
            // validate za da moje tq da gi proveri
            // i da ni vurne masiv s greshki ako ima takiva.
            // Ako nqma greshki vrushta prazen masiv.
            $errors = $this->validate($data);

            if (empty($errors)) {
                $usersCollection = new UsersCollection();
                $entity = new UserEntity();
                unset($data['repeatPassword']);
                $entity->init($data);

                $usersCollection->save($entity);

                //insertUser($data, $connection);
                header('Location: index.php?c=users');
                die;
            }
        }

        $viewData['data'] =  $data;
        $viewData['errors'] = $errors;

        $this->loadView('users/insert.php', $viewData);
    }

    private function validate($data)
    {
        $errors = array();

        if (strlen(trim($data['username'])) < 5 || strlen(trim($data['username'])) > 50) {
            $errors['username'] = 'Username must be between 5 and 50 chars';
        }

        if (strlen(trim($data['password'])) < 5 || strlen(trim($data['password'])) > 50) {
            $errors['password'] = 'Password must be between 5 and 50 chars';
        }

        if (strlen(trim($data['password'])) !=  strlen(trim($data['repeatPassword']))) {
            $errors['repeatPassword'] = 'Password must be same value as password';
        }

        if (strlen(trim($data['email'])) < 5 || strlen(trim($data['email'])) > 100) {
            $errors['email'] = 'Email must be between 5 and 100 chars';
        }

        if (strlen(trim($data['description'])) < 5 || strlen(trim($data['description'])) > 5000) {
            $errors['description'] = 'Description must be between 5 and 5000 chars';
        }

        return $errors;
    }


    private function validateUpdate($data)
    {
        $errors = array();

        if (strlen(trim($data['username'])) < 5 || strlen(trim($data['username'])) > 50) {
            $errors['username'] = 'Username must be between 5 and 50 chars';
        }

        if (strlen(trim($data['email'])) < 5 || strlen(trim($data['email'])) > 100) {
            $errors['email'] = 'Email must be between 5 and 100 chars';
        }

        if (strlen(trim($data['description'])) < 5 || strlen(trim($data['description'])) > 5000) {
            $errors['description'] = 'Description must be between 5 and 5000 chars';
        }

        return $errors;
    }

    public function update()
    {
        $viewParameters = array();

        if (!isset($_GET['id'])) {
            header('Location: index.php?c=users');
            die;
        }
        $userCollection = new UsersCollection();
        $user = $userCollection->getOne($_GET['id']);

        if (empty($user)) {
            header('Location: index.php?c=users');
        }

        $data = array(
            'id'    => $user->getId(),
            'username' => $user->getUsername(),
            'email'    => $user->getEmail(),
            'description' => $user->getDescription(),
        );

        $errors = array();

        if (isset($_POST['submit'])) {
            $data = array(
                'id'    => $_GET['id'],
                'username' => $_POST['username'],
                'email'    => $_POST['email'],
                'description' => $_POST['description'],
            );

            $errors = $this->validateUpdate($data);

            if (empty($errors)) {
                $entity = new UserEntity();
                $entity->init($data);
                $userCollection->save($entity);
                header('Location: index.php?c=users');
            }
        }

        $viewParameters['data'] = $data;
        $viewParameters['errors'] = $errors;

        $this->loadView('users/update.php', $viewParameters);
    }

    public function delete()
    {
        if(!isset($_GET['id'])) {
            $_SESSION['message']['warning'] = 'Something went wrong!';
            header('Location: index.php?c=users');
            die;
        }
       
        $usersCollection = new UsersCollection();
        $user = $usersCollection->getOne($_GET['id']);

        if(is_null($user->getId())) {
            $_SESSION['message']['warning'] = 'Something went wrong!';
            header('Location: index.php?c=users');
            die;
        }

        $usersCollection->delete($user->getId());
        $_SESSION['message']['success'] = 'Users was deleted.';
        header('Location: index.php?c=users');
        die;
    }
}