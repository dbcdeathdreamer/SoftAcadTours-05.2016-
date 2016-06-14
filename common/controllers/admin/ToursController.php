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

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}