<?php require_once 'common/header.php'?>
<?php require_once 'common/sidebar.php'?>

<?php
if (!loggedIn()) {
    header('Location: login.php');
}
?>

    <!-- start: Content -->
    <div id="content" class="span10">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="index.html">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">Dashboard</a></li>
        </ul>

        <?php
        $users = getAllUsers($connection);
        ?>

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
            <a href="addUser.php" class="btn btn-large btn-success pull-right">Create new user</a>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach($users as $user) { ?>
                    <tr>
                        <td>
                            <?php echo $user['username']; ?>
                        </td>
                        <td>
                            <?php echo $user['email']; ?>
                        </td>
                        <td>
                            <?php echo $user['description']; ?>
                        </td>
                        <td>
                            <a href="editUser.php?id=<?php echo $user['id'];?>">Edit</a> |
                            <a href="deleteUser.php?id=<?php echo $user['id']; ?>">DELETE</a>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
            <div class="pagination pagination-centered">
                <ul>
                    <li><a href="#">Prev</a></li>
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">Next</a></li>
                </ul>
            </div>
        </div>
        </div>


    </div><!--/.fluid-container-->

<?php require_once 'common/footer.php'?>