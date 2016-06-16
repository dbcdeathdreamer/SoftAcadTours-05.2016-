<?php

class CategoriesController extends Controller
{

    public function __construct()
    {
       parent::__construct();
    }

    public function index()
    {
        $viewData = array();

        //Get all existing categories
        $categoriesCollection = new CategoriesCollection();

        //В тази променлива пазим броя резултати които искаме да върне заявката
        $pageResults = 5;

        //В променливата $page присвояваме гет параметъра, който се придава. Ако няма гет параметър то тогава слагаме 1.
        $page = (isset($_GET['page']) && (int)$_GET['page'] > 0)? (int)$_GET['page'] : 1;

        //В тази променлива изчисляваме от кой точно резултат да започне броенето в заявката.
        $offset = ($page-1)*$pageResults;

        $categories = $categoriesCollection->get(array(), $offset, $pageResults);
        $totalRows = count($categoriesCollection->get());
        $totalRows = ($totalRows == 0)? 1 : $totalRows;

        $paginator = new Pagination();
        $paginator->setPerPage($pageResults);
        $paginator->setTotalRows($totalRows);
        $paginator->setBaseUrl('index.php?c=categories');



        $viewData['paginator']  = $paginator;
        $viewData['categories'] = $categories;
        $this->loadView('categories/list.php', $viewData);
    }


    public function insert()
    {
        $viewData = array();

        $data = array(
            'name' => '',
            'description' => ''
        );

        $errors = array();
        if (isset($_POST['submit'])) {
            if(strlen(trim($_POST['name'])) < 3 || strlen(trim($_POST['name'])) > 255) {
                $errors['name'] = 'Invalid category name length';
            }
            if(strlen(trim($_POST['description'])) < 3 || strlen(trim($_POST['description'])) > 500) {
                $errors['description'] = 'Invalid category description length';
            }
            $data = array(
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
            );

            if (empty($errors)) {
                $categoriesCollection = new CategoriesCollection();
                $entity = new CategoryEntity();
                $entity->init($data);

                $categoriesCollection->save($entity);

                header('Location: index.php?c=categories');
            }

        }

        $viewData['errors'] =$errors;
        $viewData['data'] = $data;

        $this->loadView('categories/insert.php', $viewData);
    }

    public function update()
    {

    }

    public function delete()
    {
        if(!isset($_GET['id'])) {
            header('Location: index.php?c=categories');
            die;
        }

        $categoriesCollection = new CategoriesCollection();
        $category = $categoriesCollection->getOne($_GET['id']);

        if(is_null($category->getId())) {
            header('Location: index.php?c=categories');
            die;
        }

        $categoriesCollection->delete($category->getId());
        header('Location: index.php?c=categories');
        die;

    }
}