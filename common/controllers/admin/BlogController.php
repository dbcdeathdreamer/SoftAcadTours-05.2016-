<?php 

class BlogController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $viewData = array();

        $blogCollection = new BlogCollection();

        //В тази променлива пазим броя резултати които искаме да върне заявката
        $pageResults = 5;

        //В променливата $page присвояваме гет параметъра, който се придава. Ако няма гет параметър то тогава слагаме 1.
        $page = (isset($_GET['page']) && (int)$_GET['page'] > 0)? (int)$_GET['page'] : 1;

        //В тази променлива изчисляваме от кой точно резултат да започне броенето в заявката.
        $offset = ($page-1)*$pageResults;

        $blogResults = $blogCollection->get(array(), $offset, $pageResults);
        $totalRows = count($blogCollection->get());
        $totalRows = ($totalRows == 0)? 1 : $totalRows;

        $paginator = new Pagination();
        $paginator->setPerPage($pageResults);
        $paginator->setTotalRows($totalRows);
        $paginator->setBaseUrl('index.php?c=blog');




        $viewData['blogResults'] = $blogResults;
        $viewData['paginator']   = $paginator;

       $this->loadView('blog/list.php', $viewData);
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
            header('Location: index.php?c=blog');
            die;
        }
        
        $blogCollection = new BlogCollection();
        $blog = $blogCollection->getOne($_GET['id']);
        
        if(is_null($blog->getId())) {
            header('Location: index.php?c=blog');
            die;
        }
        
        $blogCollection->delete($blog->getId());
        header('Location: index.php?c=blog');
        die;

    }
}