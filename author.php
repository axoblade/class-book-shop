<?php
include 'config/db_conn.php';
$page = "Authors";
include 'includes/header.php';

if (isset($_POST['submit'])) {
	$arthorName = $_POST['arthor_name'];
	$arthorDob = $_POST['arthor_dob'];
	$arthorBio = $_POST['arthor_bio'];
	$time = time();

	$sql = "INSERT INTO authors(name,dob,bio,created_at) VALUES (?,?,?,?)";

	$bookCategory = $pdo->prepare($sql)->execute([
		$arthorName,
		$arthorDob,
		$arthorBio,
		$time
	]);

	if($bookCategory){
		?>
		<script type="text/javascript">
			window.alert('Book author saved');
		</script>
		<?php
	}
}
?>

<div class="row">
	<div class="col-md-8">
		<h1>
			Class BookShop Authors
		</h1>
	</div>

	<div class="col-md-4">
		<div class="container">
			<button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
			Add Author
		</button>
		</div>
		
	</div>
</div>

<div class="container">
	<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>DOB</th>
                <th>Biography</th>
                <th>Created at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        	<?php
        	$authorQuery = $pdo->query("SELECT * FROM authors ORDER BY id DESC");

        	foreach ($authorQuery as $aRes) {
        		?>
        		<tr>
	                <td><?php echo $aRes['name']; ?></td>
	                <td><?php echo $aRes['dob']; ?></td>
	                <td><?php echo $aRes['bio']; ?></td>
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
                <th>DOB</th>
                <th>Biography</th>
                <th>Created at</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
</div>


<!-- Add Author Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add a book author</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST">
      		<div class="modal-body">
      			<div class="form-group">
      				<input type="text" name="arthor_name" class="form-control" placeholder="Author name" required>
      			</div>
      			
      			<div class="form-group">
      				<input type="date" name="arthor_dob" class="form-control" placeholder="Author date of birth" required>
      			</div>

      			<div class="form-group">
      				<textarea class="form-control" cols="100" name="arthor_bio" rows="10" placeholder="Author Biography" required></textarea>
      			</div>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
	        	<input type="submit" class="btn btn-success" name="submit" value="Add author">
	      </div>
      </form>
    </div>
  </div>
</div>
<?php
include 'includes/footer.php';
?>