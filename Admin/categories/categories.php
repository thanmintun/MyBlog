<?php
    include '../layouts/nav_sidebar.php';
    include "../dbconnect.php";

    $sql = "SELECT * FROM categories ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();
?>

                <main>
                    <div class="container-fluid px-4">
                        <div class="mt-5">
                             <h1 class="mt-4 d-inline">Categories</h1>
                             <a href="create.php" class="btn btn-primary float-end">Create Category</a>
                        </div>
                        
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                             $no = 1;
                                             foreach($categories as $category) {
                                        ?>
                                        
                                             <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?php echo $category['name']; ?></td>
                                                <td><?php echo $category['created_at']; ?></td>
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
                    </div>
                </main>

<?php
    include '../layouts/footer.php';
?>
