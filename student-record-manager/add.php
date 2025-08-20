<?php
require_once 'config.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $course = trim($_POST['course']);
    $phone = trim($_POST['phone']);
    if ($name === '') { $errors[] = 'Name is required.'; }
    if ($email === '') { $errors[] = 'Email is required.'; }
    if (empty($errors)) {
        $stmt = $conn->prepare('INSERT INTO students (name,email,course,phone) VALUES (?,?,?,?)');
        $stmt->bind_param('ssss', $name, $email, $course, $phone);
        $stmt->execute();
        $stmt->close();
        header('Location: index.php?msg=' . urlencode('Student added successfully'));
        exit;
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3>Add New Student</h3>
  <?php if ($errors): ?>
    <div class="alert alert-danger">
      <ul><?php foreach ($errors as $e) { echo '<li>'.htmlspecialchars($e).'</li>'; } ?></ul>
    </div>
  <?php endif; ?>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Course</label>
      <input type="text" name="course" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Phone</label>
      <input type="text" name="phone" class="form-control">
    </div>
    <button class="btn btn-success">Save</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>
