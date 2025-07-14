<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Secure Digital Ark - Upload</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/style.css">

</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2 class="mb-4">Upload a File</h2>

    <!-- Success/Error Messages -->
    <?php if (isset($_GET['status'])): ?>
      <div class="alert alert-<?= $_GET['status'] === 'success' ? 'success' : 'danger' ?>">
        <?= htmlspecialchars($_GET['message']) ?>
      </div>
    <?php endif; ?>

    <form action="upload.php" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="file" class="form-label">Choose File</label>
        <input type="file" class="form-control" name="file" id="file" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Optional Password</label>
        <input type="password" class="form-control" name="password" id="password">
      </div>

      <div class="mb-3">
        <label for="group" class="form-label">Optional Group Name</label>
        <input type="text" class="form-control" name="group" id="group">
      </div>

      <button type="submit" class="btn btn-primary">Upload</button>
    </form>

    <hr class="my-4">
    <a href="list.php" class="btn btn-secondary">View Uploaded Files</a>
  </div>
    <footer>
  <p>Secure Digital Ark &copy; <?= date('Y') ?> H.Rahmani Reserved</p>
</footer>
</body>
</html>