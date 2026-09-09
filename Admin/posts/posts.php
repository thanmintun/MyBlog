<?php
session_start();
if($_SESSION['user_id']){
    include '../layouts/nav_sidebar.php';
   

    include "../dbconnect.php";

    $sql = "SELECT posts.*, categories.name as c_name, users.name as u_name FROM posts INNER JOIN categories ON posts.category_id = categories.id INNER JOIN users ON posts.user_id  = users.id ORDER BY posts.id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    // var_dump($stmt);
    $posts = $stmt->fetchAll();
    // var_dump($posts);


?>


                <main>
                    <div class="container-fluid px-4">
                        <div class="mt-5">
                             <h1 class="mt-4 d-inline">Posts</h1>
                             <a href="create.php" class="btn btn-primary float-end">Create Post</a>
                        </div>
                        
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Posts</li>
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
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Author</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Author</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                             $no = 1;
                                             foreach($posts as $post) {
                                        ?>
                                        
                                             <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?php echo $post['title']; ?></td>
                                                <td><?php echo $post['c_name']; ?></td>
                                                <td><?php echo $post['u_name']; ?></td>
                                                <td>
                                                    <button class="btn btn-danger delete" data-id="<?= $post['id'] ?>">Delete</button>
                                                    <a href="edit.php?id=<?= $post['id'] ?>" class="btn btn-warning">Edit</a>
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



                

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-light">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Modal</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <h3>Are You Sure Delete?</h3>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>">

        <input type="text" name="id" id="p-id">
        <button type="button" class="btn btn-primary">Delete</button>

        </form>
      </div>
    </div>
  </div>
</div>


<script>
    $(document).ready(function(){
        $('tbody').on('click','.delete',function(){
            // alert("hello")
            let id = $(this).data('id');
            console.log(id);
            $('#p-id').val(id);
            
            $('#deleteModal').modal('show');
        })
    })
</script>






<?php
    include '../layouts/footer.php';
}else{
    header('location: ../login.php');
}
?>