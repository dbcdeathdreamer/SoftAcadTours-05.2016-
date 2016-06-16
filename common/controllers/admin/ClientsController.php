<?php

class ClientsController extends Controller
{
    public function __construct()
    {
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login');
        }
    }
    
    public function index()
    {

        $viewData = array();

        //В тази променлива пазим броя резултати които искаме да върне заявката
        $pageResults = 5;

        //В променливата $page присвояваме гет параметъра, който се придава. Ако няма гет параметър то тогава слагаме 1.
        $page = (isset($_GET['page']) && (int)$_GET['page'] > 0)? (int)$_GET['page'] : 1;

        //В тази променлива изчисляваме от кой точно резултат да започне броенето в заявката.
        $offset = ($page-1)*$pageResults;

        $clientsCollection = new ClientsCollection();
        $clients = $clientsCollection->get(array(), $offset, $pageResults);

        $totalRows = count($clientsCollection->get());
        $totalRows = ($totalRows == 0)? 1 : $totalRows;

        $paginator = new Pagination();
        $paginator->setPerPage($pageResults);
        $paginator->setTotalRows($totalRows);
        $paginator->setBaseUrl('index.php?c=clients');

        $viewData['clients'] = $clients;
        $viewData['paginator'] = $paginator;

        $this->loadView('clients/list.php', $viewData);
    }


    public function insert()
    {

    }

    public function update()
    {

    }

    public function delete()
    {
        if(!isset($_GET['id'])) {
            header('Location: index.php?c=clients');
            exit(0);
        }

        $clientsCollection = new ClientsCollection();
        $client = $clientsCollection->getOne($_GET['id']);

        if(is_null($client->getId())) {
            header('Location: index.php?c=clients');
            exit(0);
        }

        $clientsCollection->delete($client->getId());
        header('Location: index.php?c=clients');
        exit(0);

    }
}