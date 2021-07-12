<?php
include 'config/db_conn.php';
$page = "Books";
include 'includes/header.php';

if (isset($_POST['submit'])) {
	$bookName = $_POST['bookName'];
	$bookCategory = $_POST['bookCategory'];
	$bookAuthor = $_POST['bookAuthor'];
	$bookDesc = $_POST['bookDesc'];

	$time = time();

	$sql = "INSERT INTO books(book_name,book_desc,book_author_id,book_category_id,created_at) VALUES (?,?,?,?,?)";

	$bookCategory = $pdo->prepare($sql)->execute([
		$bookName,
		$bookDesc,
		$bookAuthor,
		$bookCategory,
		$time
	]);

	if($bookCategory){
		?>
		<script type="text/javascript">
			window.alert('Book successfully saved');
		</script>
		<?php
	}
}
?>


<div class="row">
	<div class="col-md-8">
		<h1>
			Class BookShop
		</h1>
	</div>

	<div class="col-md-4">
		<div class="container">
			<button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
			Add Book
		</button>
		</div>
		
	</div>
	
</div>
<div class="container">
	<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
    </table>
</div>

<!-- Add Book Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add a book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form>
      		<div class="modal-body">
      			<div class="form-group">
      				<input type="text" name="bookName" class="form-control" placeholder="Book name" required>
      			</div>
      			
      			<div class="form-group">
      				<select name="bookAuthor" class="form-control" required>
      					<option selected>Select author</option>
      					<?php
      						$authors = $pdo->query("SELECT * FROM authors ORDER BY id DESC");
      						foreach ($authors as $author) {
      						 	?>
      						 		<option value="<?php echo $author['id']; ?>"> <?php echo $author['name']; ?> </option>
      						 	<?php
      						 } 
      					?>
      				</select>
      			</div>

      			<div class="form-group">
      				<select name="bookCategory" class="form-control" required>
      					<option selected>Select book category</option>
      					<?php
      						$categories = $pdo->query("SELECT * FROM categories ORDER BY id DESC");
      						foreach ($categories as $category) {
      						 	?>
      						 		<option value="<?php echo $category['id']; ?>"> <?php echo $category['name']; ?> </option>
      						 	<?php
      						 } 
      					?>
      				</select>
      			</div>

      			<div class="form-group">
      				<textarea name="bookDesc" class="form-control" cols="100" rows="10" placeholder="Book description" required></textarea>
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


<script type="text/javascript">
        	$(document).ready(function() {
			    $('#example').DataTable();
			} );
        </script>

<?php
include 'includes/footer.php';
?>