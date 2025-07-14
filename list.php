<?php
$metadataFile = 'data/metadata.json';
$files = [];

if (file_exists($metadataFile)) {
  $json = file_get_contents($metadataFile);
  $files = json_decode($json, true) ?? [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <head>
  <meta charset="UTF-8">
  <title>Uploaded Files - Secure Digital Ark</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/style.css">
</head>
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2 class="mb-4">Uploaded Files</h2>
    <a href="index.php" class="btn btn-secondary mb-3">← Back to Upload</a>

    <?php if (empty($files)): ?>
      <div class="alert alert-warning">No files uploaded yet.</div>
    <?php else: ?>
      <table class="table table-bordered table-hover">
        <thead class="table-dark">
          <tr>
            <th>Filename</th>
            <th>Upload Date</th>
            <th>Protected?</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($files as $file): ?>
            <tr>
              <td><?= htmlspecialchars($file['filename']) ?></td>
              <td><?= htmlspecialchars($file['date']) ?></td>
              <td><?= isset($file['password']) ? 'Yes' : 'No' ?></td>
              <td>
                <form action="download.php" method="POST" style="display: inline-block;">
                  <input type="hidden" name="filename" value="<?= htmlspecialchars($file['filename']) ?>">
                  <?php if (isset($file['password'])): ?>
                    <input type="password" name="password" placeholder="Enter password" required class="form-control mb-2">
                  <?php endif; ?>
                  <button type="submit" class="btn btn-sm btn-success">Download</button>
                </form>



              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
  <footer>
  <p>Secure Digital Ark &copy; <?= date('Y') ?> H.Rahmani Reserved</p>
</footer>
</body>
</html>