<?php
require_once 'config.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
    $stmt = $conn->prepare('DELETE FROM students WHERE id=?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
}
header('Location: index.php?msg=' . urlencode('Student deleted'));
exit;
?>
