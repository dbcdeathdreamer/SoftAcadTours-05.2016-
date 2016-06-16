<?php

class ToursController extends Controller
{

    public function index()
    {

    }

    public function toursByCategory()
    {
        $viewData = array();

        $categoryId = (isset($_GET['categoryId']))? (int)$_GET['categoryId'] : 0;

        $toursCollection = new ToursCollection();

        $where = array();
        if ($categoryId != 0) {
            $where = array(
                'category_id' => $categoryId
            );
        }


        //В тази променлива пазим броя резултати които искаме да върне заявката
        $pageResults = 5;

        //В променливата $page присвояваме гет параметъра, който се придава. Ако няма гет параметър то тогава слагаме 1.
        $page = (isset($_GET['page']) && (int)$_GET['page'] > 0)? (int)$_GET['page'] : 1;

        //В тази променлива изчисляваме от кой точно резултат да започне броенето в заявката.
        $offset = ($page-1)*$pageResults;

        $tours = $toursCollection->get($where, $offset, $pageResults);

        $totalRows = count($toursCollection->get($where));
        $totalRows = ($totalRows == 0)? 1 : $totalRows;

        $paginator = new Pagination();
        $paginator->setPerPage($pageResults);
        $paginator->setTotalRows($totalRows);
        $paginator->setBaseUrl('index.php?c=tours&m=toursByCategory&categoryId='.$categoryId);

        $viewData['paginator'] = $paginator;
        $viewData['tours'] = $tours;

        $this->loadFrontView('tours/listing.php', $viewData);
    }
    
    public function show()
    {
        $viewData = array();

        if (!isset($_GET['id'])) {
            header('Location: index.php');
            exit;
        }

        $id = (int)($_GET['id']);

        $toursCollection = new ToursCollection();
        $tour = $toursCollection->getOne($id);

        if ($tour == null) {
            header('Location: index.php');
            exit;
        }

        $toursImageCollection = new TourImagesCollection();
        $where = array(
            'tours_id' => $id
        );
        $toursImages = $toursImageCollection->get($where);

        $randomResults = $toursCollection->getRandomTours(4);

        $viewData['tour'] = $tour;
        $viewData['toursImages'] = $toursImages;
        $viewData['randomResults'] = $randomResults;

        $this->loadFrontView('tours/show.php', $viewData);
    }
}