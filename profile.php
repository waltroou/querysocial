<?php
// profile.php - view a user's profile and their posts
session_start();
require_once __DIR__ . '/config.php';

$userId = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0;
if ($userId <= 0) {
  http_response_code(400);
  echo "Missing or invalid user_id.";
  exit;
}

// Fetch user
$userStmt = $pdo->prepare("
  SELECT id, username, full_name, bio, created_at
  FROM users
  WHERE id = :id
  LIMIT 1
");
$userStmt->execute([':id' => $userId]);
$user = $userStmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
  http_response_code(404);
  echo "User not found.";
  exit;
}

// Fetch posts for user
$postsStmt = $pdo->prepare("
  SELECT id, content, created_at
  FROM posts
  WHERE user_id = :user_id
  ORDER BY created_at DESC
  LIMIT 50
");
$postsStmt->execute([':user_id' => $userId]);
$posts = $postsStmt->fetchAll(PDO::FETCH_ASSOC);

$isOwner = isset($_SESSION['user_id']) && ((int)$_SESSION['user_id'] === (int)$user['id']);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <title><?= htmlspecialchars($user['username']) ?> · Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body style="margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;">
  <?php include __DIR__ . '/logo.php'; ?>

  <main style="max-width:720px;margin:0 auto;padding:16px;">
    <section style="border:1px solid #eee;border-radius:14px;padding:14px;">
      <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;">
        <div>
          <h1 style="margin:0 0 4px;line-height:1.1;">
            <?= htmlspecialchars($user['full_name'] ?: $user['username']) ?>
          </h1>
          <div style="color:#666;margin-bottom:8px;">@<?= htmlspecialchars($user['username']) ?></div>

          <?php if (!empty($user['bio'])): ?>
            <div style="white-space:pre-wrap;"><?= htmlspecialchars($user['bio']) ?></div>
          <?php else: ?>
            <div style="color:#666;">No bio yet.</div>
          <?php endif; ?>

          <div style="color:#888;font-size:12px;margin-top:10px;">
            Joined: <?= htmlspecialchars(date('M j, Y', strtotime($user['created_at']))) ?>
          </div>
        </div>

        <div style="display:flex;flex-direction:column;gap:8px;">
          <?php if ($isOwner): ?>
            <a href="/edit_profile.php"
               style="text-decoration:none;text-align:center;padding:10px 12px;border-radius:10px;border:1px solid #ddd;color:#111;">
              Edit profile
            </a>
            <a href="/post.php"
               style="text-decoration:none;text-align:center;padding:10px 12px;border-radius:10px;border:0;background:#111;color:#fff;font-weight:600;">
              New post
            </a>
          <?php else: ?>
            <a href="/index.php"
               style="text-decoration:none;text-align:center;padding:10px 12px;border-radius:10px;border:1px solid #ddd;color:#111;">
              Back to feed
            </a>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <section style="margin-top:14px;">
      <h2 style="margin:10px 0;">Posts</h2>

      <?php if (!$posts): ?>
        <div style="color:#666;">No posts yet.</div>
      <?php endif; ?>

      <?php foreach ($posts as $p): ?>
        <article style="border:1px solid #eee;border-radius:14px;padding:12px;margin-bottom:10px;">
          <div style="white-space:pre-wrap;"><?= htmlspecialchars($p['content']) ?></div>
          <div style="color:#888;font-size:12px;margin-top:8px;">
            <?= htmlspecialchars(date('M j, Y g:i A', strtotime($p['created_at']))) ?>
            · <a href="/view_post.php?post_id=<?= urlencode((string)$p['id']) ?>" style="color:#111;text-decoration:none;">View</a>
          </div>
        </article>
      <?php endforeach; ?>
    </section>
  </main>
</body>
</html>

