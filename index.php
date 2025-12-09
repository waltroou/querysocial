<?php
require 'connect.php';

$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['username'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $imagePath = null;

    // Basic validation for text fields
    if ($name === '' || $content === '') {
        $error = "Both fields are required.";
    }

    // Handle optional image upload if no prior error
    if ($error === '' && !empty($_FILES['image']['name'])) {
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $tmpPath = $_FILES['image']['tmp_name'];

            // Very basic mime/type check
            $allowedMime = ['image/jpeg', 'image/png', 'image/gif'];
            $mimeType = mime_content_type($tmpPath);

            if (in_array($mimeType, $allowedMime, true)) {
                $uploadDir = __DIR__ . '/uploads';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $fileName = date('YmdHis') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
                $destPath = $uploadDir . '/' . $fileName;

                if (move_uploaded_file($tmpPath, $destPath)) {
                    // Store relative path for use in <img src="">
                    $imagePath = 'uploads/' . $fileName;
                } else {
                    $error = "Failed to save uploaded image.";
                }
            } else {
                $error = "Invalid image type. Please upload a JPG, PNG, or GIF.";
            }
        } elseif ($_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
            // If there *was* an upload attempt but it errored (not simply 'no file chosen')
            $error = "Error while uploading image.";
        }
    }

    // If everything is OK, insert the post (with or without image)
    if ($error === '') {
        $stmt = $pdo->prepare(
            "INSERT INTO posts (username, content, image_path)
             VALUES (:username, :content, :image_path)"
        );
        $stmt->execute([
            ':username'   => $name,
            ':content'    => $content,
            ':image_path' => $imagePath
        ]);

        header("Location: index.php");
        exit;
    }
}

// Load posts (now including image_path)
$stmt = $pdo->query(
    "SELECT username, content, created_at, image_path
     FROM posts
     ORDER BY created_at DESC"
);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>QuerySocial Wall</title>
</head>
<body>
    <nav>
        <a href="index.php">Home</a> |
        <a href="team.html">Team Info</a>
    </nav>

    <div style="display:flex; align-items:center; gap:15px; padding:10px 0;">
        <img src="logo.png" alt="QuerySocial Logo" style="height:50px;">
        <h1>QuerySocial Wall</h1>
    </div>

    <h2>New Post</h2>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <!-- enctype added for file upload -->
    <form method="POST" enctype="multipart/form-data">
        <label>Name:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Message:</label><br>
        <textarea name="content" rows="4" cols="40" required></textarea><br><br>

        <label>Image (optional):</label><br>
        <input type="file" name="image" accept="image/*"><br><br>

        <button type="submit">Post</button>
    </form>

    <hr>

    <h2>Recent Posts</h2>
    <?php if (count($posts) === 0): ?>
        <p>No posts yet. Be the first!</p>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
                <strong><?php echo htmlspecialchars($post['username']); ?></strong><br>
                <small><?php echo htmlspecialchars($post['created_at']); ?></small>
                <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>

                <?php if (!empty($post['image_path'])): ?>
                    <img
                        src="<?php echo htmlspecialchars($post['image_path']); ?>"
                        alt="Post image"
                        style="max-width:400px; display:block; margin-top:10px;"
                    >
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
