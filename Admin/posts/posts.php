<?php
include '../layout/nav_sidebar.php';

include '../dbconnection.php';

$sql = "SELECT posts.*, categories.name as c_name, users.name as u_name FROM posts INNER JOIN categories on posts.category_id = categories.id INNER JOIN users on posts.user_id = users.id ORDER BY posts.id DESC";
$stm = $conn->prepare($sql);
$stm->execute();
// var_dump($stmt);
$posts = $stm->fetchAll();
// var_dump($posts);
?>
<main>
    <div class="container-fluid px-4">
        <div class="mt-5 d-inline">
        <h1 class="mt-4 ">Posts</h1>
        <a href="create.php" class="btn btn-primary float-end">Create Post</a>
        </div>
        
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Posts</li>
        </ol>
        
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Action</th>

                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($posts as $post) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $no++; ?>
                                </td>
                                <td><?php echo $post['title']; ?>
                            </td>
                            <td>
                                <?php echo $post['c_name']; ?>
                            </td>
                            <td>
                                <?php echo $post['u_name']; ?>
                            </td>
                            <td>
                                <button class="btn btn-danger">Delete</button>
                                <button class="btn btn-warning">Edit</button>
                            </td>


                            </tr>



                            <?php
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        
    </div>
</main>

<?php include '../layout/footer.php' ?>