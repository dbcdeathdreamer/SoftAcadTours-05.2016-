<?php
require_once('common/header.php');
if (!loggedIn()) {
    header('Location: login.php');
}
require_once('common/sidebar.php');
?>
<!-- start: Content -->
<div id="content" class="span10">
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.php">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Dashboard</a></li>
    </ul>


    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header">
                <h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Striped Table</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <?php
                if (isset($_SESSION['flashMessage'])) {
                    echo $_SESSION['flashMessage'];
                    unset($_SESSION['flashMessage']);
                }
                ?>

                <a href="addClient.php" class="btn btn-large btn-success pull-right">Create new client</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    //В тази променлива пазим броя резултати които искаме да върне заявката
                    $pageResults = 5;

                    //В променливата $page присвояваме гет параметъра, който се придава. Ако няма гет параметър то тогава слагаме 1.
                    $page = (isset($_GET['page']) && (int)$_GET['page'] > 0)? (int)$_GET['page'] : 1;

                    //В тази променлива изчисляваме от кой точно резултат да започне броенето в заявката.
                    $offset = ($page-1)*$pageResults;

                    $clientsCollection = new ClientsCollection();
                    $clients = $clientsCollection->get(array(), $offset, $pageResults);

                    $totalRows = count($clientsCollection->get());

                    $paginator = new Pagination();
                    $paginator->setPerPage($pageResults);
                    $paginator->setTotalRows($totalRows);
                    $paginator->setBaseUrl('clients.php');



                    foreach($clients as $client): ?>
                        <tr>
                            <td><?php echo $client->getUsername(); ?></td>
                            <td class="center"><?php echo $client->getEmail(); ?></td>
                            <td class="center">
                                <a class="btn btn-info" href="editClient.php?id=<?php echo $client->getId(); ?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" href="deleteClient.php?id=<?php echo $client->getId(); ?>">
                                    <i class="halflings-icon white trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo $paginator->create(); ?>
            </div>
        </div><!--/span-->
    </div><!--/row-->




</div><!--/.fluid-container-->
<?php require_once('common/footer.php'); ?>
