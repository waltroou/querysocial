<?php
require 'connect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['username'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if ($name !== '' && $content !== '') {
        $stmt = $pdo->prepare("INSERT INTO posts (username, content) VALUES (:username, :content)");
        $stmt->execute([
            ':username' => $name,
            ':content'  => $content
        ]);
        header("Location: index.php");
        exit;
    } else {
        $error = "Both fields are required.";
    }
}

// Load posts
$stmt = $pdo->query("SELECT username, content, created_at FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>QuerySocial Wall</title>
</head>
<body>
    <h1>QuerySocial Wall</h1>

    <h2>New Post</h2>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Name:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Message:</label><br>
        <textarea name="content" rows="4" cols="40" required></textarea><br><br>

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
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>

