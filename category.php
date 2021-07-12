<?php
include 'config/db_conn.php';
$page = "Book Categories";
include 'includes/header.php';

if (isset($_POST['submit'])) {
	$categoryName = $_POST['category_name'];
	$categoryDesc = $_POST['category_desc'];
	$time = time();

	$sql = "INSERT INTO categories(name,description,created_at) VALUES (?,?,?)";

	$bookCategory = $pdo->prepare($sql)->execute([
		$categoryName,
		$categoryDesc,
		$time
	]);

	if($bookCategory){
		?>
		<script type="text/javascript">
			window.alert('Book category saved');
		</script>
		<?php
	}
}
?>

<div class="row">
	<div class="col-md-8">
		<h1>
			Class BookShop Categories
		</h1>
	</div>

	<div class="col-md-4">
		<div class="container">
			<button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
			Add Book Category
		</button>
		</div>
		
	</div>
	
</div>
<div class="container">
	<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Date created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $fetchSql = $pdo->query("SELECT * FROM categories ORDER BY id DESC");

            foreach ($fetchSql as $res) {
            	?>
            	<tr>
	                <td><?php echo $res['name']; ?></td>
	                <td><?php echo $res['description']; ?></td>
	                <td><?php echo date('D-M-Y', $res['created_at']); ?></td>
	                <td>
	                	<a href="" class="btn btn-primary">Update</a>
	                	<a href="" class="btn btn-danger">Delete</a>
	                </td>
            	</tr>
            	<?php
            }
            ?>
            
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Date created</th>
            </tr>
        </tfoot>
    </table>
</div>

<!-- Add Book Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add a book Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST">
      		<div class="modal-body">
      			<div class="form-group">
      				<input type="text" name="category_name" class="form-control" placeholder="Book category name" required>
      			</div>
      			
      			<div class="form-group">
      				<textarea class="form-control" name="category_desc" cols="100" rows="10" placeholder="Book category description" required></textarea>
      			</div>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
	        	<input type="submit" name="submit" class="btn btn-success" value="Add book">
	      </div>
      </form>
    </div>
  </div>
</div>

<?php
include 'includes/footer.php';
?>