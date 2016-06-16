<?php

class ToursController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    
    
    public function index()
    {
        $viewData = array();

        $search = (isset($_GET['search']))? htmlspecialchars(trim($_GET['search'])) : '';

        $toursCollection = new ToursCollection();

        //$pageResults = (isset($_GET['perPage']))? (int)$_GET['perPage']: 5;
        $pageResults = (isset($_GET['perPage'])) ? (int)$_GET['perPage'] : 0;
        switch ($pageResults) {
            case 1:
                $pageResults = 1;
                break;
            case 5:
                $pageResults = 5;
                break;
            case 10:
                $pageResults = 10;
                break;
            default:
                $pageResults = 5;
        }


        $orderBy = (isset($_GET['orderBy'])) ? (int)$_GET['orderBy'] : 0;
        switch ($orderBy) {
            case 0:
                $order = array('id', 'DESC');
                break;
            case 1:
                $order = array('name', 'ASC');
                break;
            case 2:
                $order = array('name', 'DESC');
                break;
            case 3:
                $order = array('category_id', 'ASC');
                break;
            case 4:
                $order = array('category_id', 'DESC');
                break;
            default:
                $order = array('id', 'DESC');
        }

        //В променливата $page присвояваме гет параметъра, който се придава. Ако няма гет параметър то тогава слагаме 1.
        $page = (isset($_GET['page']) && (int)$_GET['page'] > 0)? (int)$_GET['page'] : 1;

        //В тази променлива изчисляваме от кой точно резултат да започне броенето в заявката.
        $offset = ($page-1)*$pageResults;
        $tours = $toursCollection->get(array(), $offset, $pageResults, $search, $order);

        $totalRows = count($toursCollection->get(array(), -1, 0, $search));
        $totalRows = ($totalRows == 0)? 1 : $totalRows;

        $paginator = new Pagination();
        $paginator->setPerPage($pageResults);
        $paginator->setTotalRows($totalRows);
        $paginator->setBaseUrl("index.php?c=tours&perPage={$pageResults}&orderBy={$orderBy}&search={$search}");


        $viewData['tours'] = $tours;
        $viewData['paginator'] = $paginator;
        $viewData['pageResults'] = $pageResults;
        $viewData['search'] = $search;
        $viewData['orderBy'] = $orderBy;

        $this->loadView('tours/list.php', $viewData);
    }


    public function insert()
    {
        $viewData = array();

        $categoriesCollection = new CategoriesCollection();
        $categories = $categoriesCollection->get();


        $errors = array();
        $data = array(
            'category_id' => '',
            'name'        => '',
            'description' => '',
            'image'       => '',
        );

        if (isset($_POST['submit'])) {
            $data = array(
                'category_id' => $_POST['category'],
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'image'       => ''
            );

            if (strlen(trim($_POST['name'])) < 3 || strlen(trim($_POST['name']) > 255) ) {
                $errors['name'] = 'Invalid name length';
            }

            if (strlen(trim($_POST['description'])) < 3 || strlen(trim($_POST['description']) > 500) ) {
                $errors['description'] = 'Invalid description length';
            }

            $imageErrors = array();
            if (isset($_FILES['image'])) {
                $imageName = $_FILES['image']['name'];

                $imageType = $_FILES['image']['type'];
                $imageSize = $_FILES['image']['size'];
                $imagePath = $_FILES['image']['tmp_name'];
                $extension = strtolower(end(explode('/', $imageType)));
                $imageName = sha1(sha1(time())+sha1($imageName)).'.'.$extension;
                $allow = array('gif', 'jpg', 'jpeg', 'png');

                if (!in_array($extension, $allow)) {
                    $imageErrors['extension'] = 'Wrong extension';
                }
                if ($imageSize > 100000) {
                    $imageErrors['size'] = 'Image is too big!';
                }
            }

            if (empty($errors) && empty($imageErrors)) {
                if (isset($_FILES['image'])) {
                    $data['image'] = $imageName;
                }

                $toursCollection = new ToursCollection();
                $entity = new TourEntity();
                $entity->init($data);
                $toursCollection->save($entity);

                if (isset($_FILES['image'])) {
                    move_uploaded_file($imagePath, __DIR__.'/../../../admin/uploads/' . $imageName);
                }

                header('Location: index.php?c=tours');
            }
        }

        $viewData['categories'] = $categories;
        $viewData['data'] = $data;
        $viewData['errors'] = $errors;

        $this->loadView('tours/insert.php', $viewData);
    }

    public function update()
    {

    }

    public function delete()
    {
        if(!isset($_GET['id'])) {
            header('Location: index.php?c=tours');
            exit;
        }

        $toursCollection = new ToursCollection();
        $tour = $toursCollection->getOne($_GET['id']);

        if(is_null($tour->getId())) {
            header('Location: index.php?c=tours');
            exit;
        }

        $toursCollection->delete($tour->getId());
        header('Location: index.php?c=tours');
        exit;

    }

    public function tourImages()
    {
        $viewData = array();

        if (!isset($_GET['id'])) {
            header('Location: index.php?c=tours');
        }

        $toursCollection = new ToursCollection();
        $where = array('t.id' => (int)$_GET['id']);
        $tour = $toursCollection->get($where);

        if (empty($tour)) {
            header('Location: index.php?c=tours');
        }

       
        $where = array('tours_id' => $_GET['id']);
        $tourImagesCollection = new TourImagesCollection();
        $images = $tourImagesCollection->get($where);


        $imageErrors = array();
        if (isset($_FILES['image'])) {
            $imageName = $_FILES['image']['name'];

            $imageType = $_FILES['image']['type'];
            $imageSize = $_FILES['image']['size'];
            $imagePath = $_FILES['image']['tmp_name'];
            $extension = strtolower(end(explode('/', $imageType)));
            $imageName = sha1(sha1(time())+sha1($imageName)).'.'.$extension;
            $allow = array('gif', 'jpg', 'jpeg', 'png');

            if (!in_array($extension, $allow)) {
                $imageErrors['extension'] = 'Wrong extension';
            }
            if ($imageSize > 100000) {
                $imageErrors['size'] = 'Image is too big!';
            }

            if (empty($imageErrors)) {
                $data = array(
                    'tours_id' => $_GET['id'],
                    'image'    => $imageName
                );

                
                $entity = new TourImageEntity();
                $entity->init($data);
                $tourImagesCollection->save($entity);
                move_uploaded_file($imagePath, 'uploads/tours/' . $imageName);
                header("Location: index.php?c=tours&m=tourImages&id={$_GET['id']}");
            }

        }
        $viewData['images'] = $images;

        $this->loadView('tours/tourImages.php', $viewData);
    }

    public function tourImageDelete()
    {
        //proverka dali ima podadeno ID
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=tours');
        }

        //Proverka dali ima Image s takova id
        $toursImagesCollection = new TourImagesCollection();
        $image = $toursImagesCollection->getOne(array('id' => (int)$_GET['id']));
        if(empty($image)) {
            header('Location: index.php?c=tours');
        }

        //Iztriwane na Image ot bazata kato zapis
        $toursImagesCollection->delete((int)$_GET['id']);

        //Iztrivane na Image Fizicheski
        unlink("uploads/tours/{$image->getImage()}");
        header("Location: index.php?c=tours&m=tourImages&id={$image->getToursId()}");
    }
}