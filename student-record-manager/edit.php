<?php
require_once 'config.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) { header('Location: index.php'); exit; }

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $course = trim($_POST['course']);
    $phone = trim($_POST['phone']);
    if ($name === '') { $errors[] = 'Name is required.'; }
    if ($email === '') { $errors[] = 'Email is required.'; }
    if (empty($errors)) {
        $stmt = $conn->prepare('UPDATE students SET name=?,email=?,course=?,phone=? WHERE id=?');
        $stmt->bind_param('ssssi', $name, $email, $course, $phone, $id);
        $stmt->execute();
        $stmt->close();
        header('Location: index.php?msg=' . urlencode('Student updated successfully'));
        exit;
    }
} else {
    $stmt = $conn->prepare('SELECT * FROM students WHERE id=?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $student = $res->fetch_assoc();
    $stmt->close();
    if (!$student) { header('Location: index.php'); exit; }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3>Edit Student</h3>
  <?php if ($errors): ?>
    <div class="alert alert-danger">
      <ul><?php foreach ($errors as $e) { echo '<li>'.htmlspecialchars($e).'</li>'; } ?></ul>
    </div>
  <?php endif; ?>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($student['name']); ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($student['email']); ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Course</label>
      <input type="text" name="course" class="form-control" value="<?php echo htmlspecialchars($student['course']); ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Phone</label>
      <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($student['phone']); ?>">
    </div>
    <button class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>
