<?php
require_once 'config.php';
$msg = '';
if (isset($_GET['msg'])) { $msg = htmlspecialchars($_GET['msg']); }
$result = $conn->query("SELECT * FROM students ORDER BY id DESC");
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Record Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Student Record Manager</h2>
    <a href="add.php" class="btn btn-primary">Add Student</a>
  </div>
  <?php if ($msg): ?>
    <div class="alert alert-success"><?php echo $msg; ?></div>
  <?php endif; ?>
  <div class="card">
    <div class="card-body">
      <table class="table table-striped">
        <thead>
          <tr><th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Phone</th><th>Actions</th></tr>
        </thead>
        <tbody>
        <?php if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['course']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td>
                  <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                  <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this student?');">Delete</a>
                </td>
              </tr>
        <?php  }
        } else { ?>
          <tr><td colspan="6">No students found.</td></tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
