<?php
require 'db.php';
$sql = 'SELECT * FROM users';
$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);
 ?>
<?php require 'header.php'; ?>
<!-- <div class="container"> -->
  <div class="card mt-5">
    <div class="card-header">
      <h2>All people</h2>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>ID</th>
          <th>Item number</th>
          <th>Email</th>
          <th>Password</th>
          <th>Mobile</th>
          <th>Birthday</th>
          <th>image</th>
          <th>date created</th>
          <th>Last Login</th>
          <th>Action</th>
        </tr>
        <?php $i = 1; 
        foreach($people as $person): ?>
          <tr>
            <td><?= $i; ?></td>
            <td><?= $person->full_name; ?></td>
            <td><?= $person->email; ?></td>
            <td><?= $person->password; ?></td>
            <td><?= $person->mobile; ?></td>
            <td><?= $person->date_birth; ?></td>
            <td> <img src="<?= $person->image; ?>" width="50px" height="50px"> </td>
            <td><?= $person->date_created; ?></td>
            <td><?= $person->last_login; ?></td>
            <td>
              <a href="edit.php?id=<?= $person->id ?>" class="btn btn-info">Edit</a>
              <a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete.php?id=<?= $person->id ?>" class='btn btn-danger'>Delete</a>
            </td>
          </tr>
        <?php $i++; endforeach; ?>
      </table>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
