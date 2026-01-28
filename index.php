<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>QuerySocial</title>

  <style>
    :root{
      --bg:#0b1220;
      --border:rgba(255,255,255,.14);
      --text:rgba(255,255,255,.92);
      --muted:rgba(255,255,255,.65);
      --accent:#7c3aed;
      --radius:18px;
      --shadow:0 18px 60px rgba(0,0,0,.35);
    }

    *{ box-sizing:border-box; }

    body{
      margin:0;
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial;
      color:var(--text);
      background:
        radial-gradient(1000px 600px at 15% 10%, rgba(124,58,237,.35), transparent 55%),
        radial-gradient(900px 600px at 85% 15%, rgba(34,197,94,.25), transparent 55%),
        var(--bg);
    }

    .container{
      max-width:1100px;
      margin:auto;
      padding:22px 16px 64px;
    }

    /* NAV */
    .nav{
      display:flex;
      justify-content:space-between;
      align-items:center;
      padding:14px;
      border:1px solid var(--border);
      border-radius:var(--radius);
      background:linear-gradient(to bottom, rgba(255,255,255,.10), rgba(255,255,255,.05));
      box-shadow:var(--shadow);
      backdrop-filter: blur(10px);
      position:sticky;
      top:14px;
      z-index:10;
    }

    .nav-left{
      display:flex;
      align-items:center;
      gap:10px;
    }

    .nav-left img{
      height:34px;
      width:34px;
      border-radius:10px;
      border:1px solid rgba(255,255,255,.18);
      object-fit:cover;
    }

    .nav-title strong{ font-size:15px; }
    .nav-title span{ font-size:12px; color:var(--muted); }

    .nav a{
      padding:8px 12px;
      border-radius:999px;
      border:1px solid var(--border);
      text-decoration:none;
      color:var(--text);
      background:rgba(255,255,255,.05);
      margin-left:6px;
    }

    /* HERO LOGO */
    .hero{
      margin:18px 0 22px;
      padding:22px;
      border:1px solid var(--border);
      border-radius:var(--radius);
      background:linear-gradient(to bottom, rgba(255,255,255,.08), rgba(255,255,255,.04));
      box-shadow:var(--shadow);
      backdrop-filter: blur(10px);
      display:flex;
      align-items:center;
      gap:18px;
    }

    .hero img{
      height:140px;
      border-radius:24px;
      border:1px solid rgba(255,255,255,.18);
      box-shadow:0 20px 60px rgba(0,0,0,.35);
    }

    .hero h1{
      margin:0;
      font-size:22px;
    }

    /* GRID */
    .grid{
      display:grid;
      grid-template-columns:360px 1fr;
      gap:18px;
    }

    @media(max-width:900px){
      .grid{ grid-template-columns:1fr; }
      .hero{ flex-direction:column; }
    }

    .card{
      border:1px solid var(--border);
      border-radius:var(--radius);
      background:linear-gradient(to bottom, rgba(255,255,255,.08), rgba(255,255,255,.04));
      box-shadow:var(--shadow);
      backdrop-filter: blur(10px);
    }

    .pad{ padding:16px; }

    h2{ margin:0; font-size:16px; }
    .sub{ font-size:12.5px; color:var(--muted); margin-top:6px; }

    /* FORM */
    label{ font-size:12px; color:var(--muted); }

    input, textarea{
      width:100%;
      margin-top:6px;
      padding:10px 12px;
      border-radius:12px;
      border:1px solid var(--border);
      background:rgba(0,0,0,.25);
      color:var(--text);
    }

    textarea{ min-height:120px; }

    .btn{
      margin-top:12px;
      padding:10px 14px;
      border-radius:12px;
      border:none;
      font-weight:600;
      color:white;
      background:linear-gradient(90deg,var(--accent),#4f46e5);
    }

    /* POSTS */
    .post{
      padding:14px;
      border-radius:16px;
      border:1px solid var(--border);
      background:rgba(0,0,0,.2);
      margin-bottom:14px;
    }

    .post-top{
      display:flex;
      justify-content:space-between;
      align-items:center;
    }

    .who{
      display:flex;
      align-items:center;
      gap:10px;
    }

    .avatar{
      height:40px;
      width:40px;
      border-radius:50%;
      object-fit:cover;
      border:1px solid rgba(255,255,255,.18);
    }

    .name strong{ font-size:13.5px; }
    .name span{ font-size:12px; color:var(--muted); }

    .badge{
      font-size:12px;
      padding:6px 10px;
      border-radius:999px;
      border:1px solid rgba(255,255,255,.14);
      background:rgba(255,255,255,.06);
    }

    .post p{
      margin:10px 0 0;
      line-height:1.55;
      font-size:14px;
    }

    .post img{
      width:100%;
      margin-top:12px;
      border-radius:14px;
      border:1px solid var(--border);
      max-height:420px;
      object-fit:cover;
    }

    .actions{
      margin-top:10px;
      display:flex;
      gap:10px;
      font-size:12px;
      color:var(--muted);
    }

    .actions span{
      padding:6px 10px;
      border-radius:999px;
      border:1px solid var(--border);
      background:rgba(255,255,255,.05);
    }

    footer{
      margin-top:24px;
      text-align:center;
      font-size:12px;
      color:var(--muted);
    }
  </style>
</head>

<body>
  <div class="container">

    <!-- NAV -->
    <header class="nav">
      <div class="nav-left">
        <img src="uploads/logo.png" alt="QuerySocial">
        <div class="nav-title">
          <strong>QuerySocial</strong>
          <span>Wall</span>
        </div>
      </div>
      <div>
        <a href="#">Home</a>
        <a href="#">Team</a>
        <a href="#">About</a>
      </div>
    </header>

    <!-- LOGO -->
    <section class="hero">
      <img src="uploads/logo.png" alt="QuerySocial Logo">
      <h1>QuerySocial</h1>
    </section>

    <main class="grid">

      <!-- LEFT -->
      <section class="card">
        <div class="pad">
          <h2>New Post</h2>

          <label>Name</label>
          <input placeholder="Walter Roou">

          <label style="margin-top:10px">Message</label>
          <textarea placeholder="Write something…"></textarea>

          <label style="margin-top:10px">Image</label>
          <input type="file">

          <button class="btn">Post</button>
        </div>
      </section>

      <!-- FEED -->
      <section class="card">
        <div class="pad">
          <h2>Recent Posts</h2>
        </div>

        <div class="pad">

          <div class="post">
            <div class="post-top">
              <div class="who">
                <img class="avatar" src="uploads/sailing.jpg">
                <div class="name">
                  <strong>Walter</strong>
                  <span>Just now</span>
                </div>
              </div>
              <div class="badge">Update</div>
            </div>
            <p>Sinking Earth</p>
            <img src="uploads/globe.jpg">
            <div class="actions">
              <span>Like</span>
              <span>Comment</span>
              <span>Share</span>
            </div>
          </div>

          <div class="post">
            <div class="post-top">
              <div class="who">
                <img class="avatar" src="uploads/sailing.jpg">
                <div class="name">
                  <strong>Walter</strong>
                  <span>Earlier today</span>
                </div>
              </div>
              <div class="badge">Photo</div>
            </div>
            <p>Out sailing this weekend</p>
            <img src="uploads/rolltack.jpg">
            <div class="actions">
              <span>Like</span>
              <span>Comment</span>
              <span>Share</span>
            </div>
          </div>

          <div class="post">
            <div class="post-top">
              <div class="who">
                <img class="avatar" src="uploads/sailing.jpg">
                <div class="name">
                  <strong>Walter</strong>
                  <span>Yesterday</span>
                </div>
              </div>
              <div class="badge">Photo</div>
            </div>
            <p>Quick trip to the mountains</p>
            <img src="uploads/skiing.jpg">
            <div class="actions">
              <span>Like</span>
              <span>Comment</span>
              <span>Share</span>
            </div>
          </div>

        </div>
      </section>

    </main>

    <footer>© QuerySocial</footer>

  </div>
</body>
</html>
