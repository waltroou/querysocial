<?php
// post.php - create a new post
session_start();
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: /login.php');
  exit;
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $content = trim($_POST['content'] ?? '');

  if ($content === '') {
    $error = "Post can't be empty.";
  } elseif (mb_strlen($content) > 500) {
    $error = "Post is too long (max 500 characters).";
  } else {
    $stmt = $pdo->prepare("
      INSERT INTO posts (user_id, content, created_at)
      VALUES (:user_id, :content, NOW())
    ");
    $stmt->execute([
      ':user_id' => $_SESSION['user_id'],
      ':content' => $content,
    ]);

    header('Location: /index.php');
    exit;
  }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <title>New Post</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body style="margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;">
  <?php include __DIR__ . '/logo.php'; ?>

  <main style="max-width:720px;margin:0 auto;padding:16px;">
    <h1 style="margin:12px 0 8px;">Create a post</h1>

    <?php if ($error): ?>
      <div style="padding:10px 12px;border:1px solid #f0b4b4;background:#ffecec;border-radius:10px;color:#8a1f1f;">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <form method="POST" style="margin-top:12px;">
      <label for="content" style="display:block;font-weight:600;margin-bottom:6px;">What's on your mind?</label>
      <textarea id="content" name="content" rows="6"
        style="width:100%;padding:10px;border-radius:10px;border:1px solid #ddd;"
        maxlength="500"
      ><?= htmlspecialchars($_POST['content'] ?? '') ?></textarea>

      <div style="display:flex;gap:10px;margin-top:12px;">
        <button type="submit"
          style="padding:10px 14px;border-radius:10px;border:0;background:#111;color:#fff;font-weight:600;cursor:pointer;">
          Post
        </button>
        <a href="/index.php" style="align-self:center;text-decoration:none;color:#111;">Cancel</a>
      </div>
    </form>
  </main>
</body>
</html>

