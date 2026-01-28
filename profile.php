<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>QuerySocial • Profile</title>

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
      margin:0 auto;
      padding:22px 16px 64px;
    }

    /* NAV */
    .nav{
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:14px;
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
      min-width:0;
    }

    .nav-left img{
      height:34px;
      width:34px;
      border-radius:10px;
      border:1px solid rgba(255,255,255,.18);
      object-fit:cover;
      background: rgba(255,255,255,.05);
      flex:0 0 auto;
    }

    .nav-title{
      line-height:1.15;
      min-width:0;
    }
    .nav-title strong{ font-size:15px; display:block; }
    .nav-title span{ font-size:12px; color:var(--muted); display:block; }

    .nav a{
      padding:8px 12px;
      border-radius:999px;
      border:1px solid var(--border);
      text-decoration:none;
      color:var(--text);
      background:rgba(255,255,255,.05);
      margin-left:6px;
    }

    /* CARD */
    .card{
      border:1px solid var(--border);
      border-radius:var(--radius);
      background:linear-gradient(to bottom, rgba(255,255,255,.08), rgba(255,255,255,.04));
      box-shadow:var(--shadow);
      backdrop-filter: blur(10px);
      overflow:hidden;
    }
    .pad{ padding:16px; }

    /* COVER */
    .cover{
      margin-top:18px;
      height:240px;
      border-radius:var(--radius);
      border:1px solid var(--border);
      box-shadow:var(--shadow);
      background: url("uploads/sailing.jpg") center/cover no-repeat;
    }

    /* PROFILE CARD */
    .profile{
      margin-top:16px;
      display:flex;
      gap:16px;
      align-items:flex-start;
    }

    .pfp{
      height:120px;
      width:120px;
      border-radius:26px;
      object-fit:cover;
      border:1px solid rgba(255,255,255,.18);
      background: rgba(255,255,255,.05);
      flex:0 0 auto;
    }

    .p-main{ min-width:0; flex:1; }
    .p-main h1{ margin:0; font-size:22px; }
    .handle{ margin-top:6px; font-size:13px; color:var(--muted); }
    .bio{
      margin-top:10px;
      font-size:14px;
      line-height:1.55;
      max-width:72ch;
      color:rgba(255,255,255,.88);
    }

    .stats{
      margin-top:14px;
      display:flex;
      flex-wrap:wrap;
      gap:10px;
    }
    .stat{
      padding:8px 10px;
      border-radius:999px;
      border:1px solid rgba(255,255,255,.14);
      background:rgba(255,255,255,.05);
      font-size:12.5px;
    }
    .stat strong{ margin-right:6px; }

    .actions{
      margin-top:14px;
      display:flex;
      flex-wrap:wrap;
      gap:10px;
    }
    .btn{
      padding:10px 14px;
      border-radius:12px;
      border:none;
      cursor:pointer;
      font-weight:600;
      color:white;
      background:linear-gradient(90deg,var(--accent),#4f46e5);
      box-shadow:0 12px 30px rgba(124,58,237,.25);
    }
    .btn-secondary{
      background:rgba(255,255,255,.08);
      border:1px solid var(--border);
      box-shadow:none;
      color:var(--text);
    }

    /* MAIN GRID */
    .grid{
      margin-top:18px;
      display:grid;
      grid-template-columns: 1fr 340px;
      gap:18px;
    }
    @media(max-width:900px){
      .grid{ grid-template-columns:1fr; }
      .profile{ flex-direction:column; }
    }

    /* POSTS GRID */
    .posts{
      display:grid;
      grid-template-columns:repeat(3,1fr);
      gap:14px;
    }
    @media(max-width:900px){ .posts{ grid-template-columns:repeat(2,1fr); } }
    @media(max-width:520px){ .posts{ grid-template-columns:1fr; } }

    .tile{
      border-radius:16px;
      overflow:hidden;
      border:1px solid rgba(255,255,255,.14);
      background:rgba(0,0,0,.20);
    }
    .tile img{
      width:100%;
      height:190px;
      object-fit:cover;
      display:block;
      background: rgba(255,255,255,.05);
    }
    .tile .tpad{
      padding:10px 12px 12px;
      font-size:13px;
      color:rgba(255,255,255,.88);
    }
    .muted{ color:var(--muted); font-size:12px; margin-top:6px; }

    /* SIDEBAR */
    h2{ margin:0; font-size:16px; }
    .info-list{
      margin:12px 0 0;
      padding:0;
      list-style:none;
      display:flex;
      flex-direction:column;
      gap:10px;
    }
    .info-item{
      padding:10px 12px;
      border-radius:14px;
      border:1px solid rgba(255,255,255,.14);
      background:rgba(0,0,0,.18);
    }
    .info-item span{
      display:block;
      color:var(--muted);
      font-size:12px;
      margin-bottom:4px;
    }

    footer{
      margin-top:28px;
      text-align:center;
      font-size:12px;
      color:var(--muted);
    }
  </style>
</head>

<body>
  <div class="container">

    <header class="nav">
      <div class="nav-left">
        <img src="uploads/logo.png" alt="QuerySocial logo" onerror="this.style.display='none'">
        <div class="nav-title">
          <strong>QuerySocial</strong>
          <span>Profile</span>
        </div>
      </div>

      <div>
        <a href="index.html">Home</a>
        <a href="#">Team</a>
        <a href="#">About</a>
      </div>
    </header>

    <div class="cover" title="Cover photo"></div>

    <section class="card" style="margin-top:16px;">
      <div class="pad profile">
        <img class="pfp" src="uploads/headshot.jpeg" alt="Profile photo" onerror="this.style.display='none'">

        <div class="p-main">
          <h1>Walter</h1>
          <div class="handle">@walter</div>
          <div class="bio">Student at Christopher Newport University. Interested in product design, data, and mapping.</div>

          <div class="stats">
            <div class="stat"><strong>12</strong>Posts</div>
            <div class="stat"><strong>84</strong>Followers</div>
            <div class="stat"><strong>37</strong>Following</div>
          </div>

          <div class="actions">
            <button class="btn" type="button">Follow</button>
            <button class="btn btn-secondary" type="button">Message</button>
          </div>
        </div>
      </div>
    </section>

    <main class="grid">

      <section class="card">
        <div class="pad">
          <h2>Posts</h2>
          <div class="muted">Recent photos and updates</div>
        </div>

        <div class="pad">
          <div class="posts">
            <div class="tile"><img src="uploads/headshot.jpeg" alt="globe" onerror="this.style.display='none'"><div class="tpad">Media day!</div></div>
            <div class="tile"><img src="uploads/rolltack.jpg" alt="rolltack" onerror="this.style.display='none'"><div class="tpad">Roll Tack!</div></div>
            <div class="tile"><img src="uploads/skiing.jpg" alt="skiing" onerror="this.style.display='none'"><div class="tpad">slopes</div></div>
            <div class="tile"><img src="uploads/hike.jpeg" alt="hike" onerror="this.style.display='none'"><div class="tpad">Hike it out!</div></div>
            <div class="tile"><img src="uploads/crew.jpeg" alt="crew" onerror="this.style.display='none'"><div class="tpad">Crew life</div></div>
            <div class="tile"><img src="uploads/dive.jpeg" alt="dive" onerror="this.style.display='none'"><div class="tpad">Belly flop</div></div>
            <div class="tile"><img src="uploads/brian.jpeg" alt="brian" onerror="this.style.display='none'"><div class="tpad">Windy day</div></div>
            <div class="tile"><img src="uploads/switch.jpeg" alt="switch" onerror="this.style.display='none'"><div class="tpad">practicing the hand switch</div></div>
            <div class="tile"><img src="uploads/viper.jpeg" alt="viper" onerror="this.style.display='none'"><div class="tpad">viper 640</div></div>
          </div>
        </div>
      </section>

      <aside class="card">
        <div class="pad">
          <h2>About</h2>
          <ul class="info-list">
            <li class="info-item">
              <span>Location</span>
              Falls Church, Virginia
            </li>
            <li class="info-item">
              <span>Education</span>
              Christopher Newport University
            </li>
            <li class="info-item">
              <span>Skills</span>
              Product thinking • User flows • Visual hierarchy • Front-end fundamentals • GitHub
            </li>
            <li class="info-item">
              <span>Interests</span>
              Sailing • Data • Mapping
            </li>
          </ul>
        </div>
      </aside>

    </main>

    <footer>© QuerySocial</footer>
  </div>
</body>
</html>
