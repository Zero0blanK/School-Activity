<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard — UMAttend</title>
  <style>
    :root {
      --yellow: #ffea00;
      --orange: #ff8904;
      --brandStart: #fffbeb;
      --brandMid: #fdc700;
      --brandEnd: #fff7ed;
      --textPrimary: #1e2939;
      --textSecondary: #4a5565;
      --muted: #6a7282;
      --cardBg: rgba(255,255,255,0.8);
      --cardBorder: rgba(255,255,255,0.2);
      --shadowSm: 0px 1px 3px rgba(0,0,0,0.1), 0px 1px 2px -1px rgba(0,0,0,0.1);
      --shadowLg: 0px 10px 15px -3px rgba(0,0,0,0.1), 0px 4px 6px -4px rgba(0,0,0,0.1);
    }
    * { box-sizing: border-box; }
    html, body { height: 100%; }
    body { margin:0; font-family: Arimo, Arial, sans-serif; color: var(--textPrimary); background: linear-gradient(142.7deg, #fffbeb 0%, #fefce8 50%, #fff7ed 100%); }

    .header {
      position: sticky; top:0; left:0; width:100%; height: 88.8px;
      background: rgba(255,255,255,0.8);
      box-shadow: var(--shadowSm);
      border-bottom: 0.8px solid var(--cardBorder);
      padding: 16px 136px 0 136px;
      z-index: 10;
    }
    .header-inner { display:flex; align-items:center; justify-content:space-between; height:56px; }
    .brand { display:flex; align-items:center; gap:12px; }
    .brand-icon { width:40px; height:40px; border-radius:14px; box-shadow: var(--shadowLg); background: linear-gradient(135deg, #ffea00 0%, #ffec1bff 100%); display:flex; align-items:center; justify-content:center; }
    .brand-logo { width:24px; height:24px; background-image:url('https://www.figma.com/api/mcp/asset/35e9a586-28e4-4cfc-b09d-68ec8aba75d2'); background-size:contain; background-repeat:no-repeat; }
    .brand-text { line-height:1; }
    .brand-title { font-size:24px; color:#1e2939; }
    .brand-sub { font-size:12px; color:#6a7282; }

    .user { display:flex; align-items:center; gap:12px; }
    .bell { position:relative; width:40px; height:40px; border-radius:14px; }
    .bell-icon { position:absolute; left:8px; top:8px; width:24px; height:24px; background-image:url('https://www.figma.com/api/mcp/asset/5c648cb6-9e61-4824-b3c0-f28118fd45de'); background-size:cover; }
    .bell-dot { position:absolute; left:28px; top:4px; width:8px; height:8px; border-radius:50%; background:#fb2c36; }
    .avatar { display:flex; align-items:center; gap:12px; padding-left:8px; height:56px; border-radius:14px; }
    .avatar-circle { width:40px; height:40px; border-radius:14px; box-shadow: var(--shadowLg); background: linear-gradient(135deg, #ffea00 0%, #ffec1bff 100%); display:flex; align-items:center; justify-content:center; color:#fff; font-size:16px; }
    .avatar-name { font-size:14px; color:#1e2939; }
    .avatar-role { font-size:12px; color:#6a7282; }
    .avatar-menu { width:20px; height:20px; background-image:url('https://www.figma.com/api/mcp/asset/4345cd3d-ff07-4c8e-8ef7-eabbac273d03'); background-size:cover; }

    .container { width:1280px; margin:0 auto; padding:32px; }
    .welcome h1 { font-size:30px; margin:0; }
    .welcome p { font-size:16px; color: var(--textSecondary); margin:8px 0 0; }

    .stats { display:grid; grid-template-columns: repeat(4, 1fr); gap:24px; margin-top:44px; }
    .stat-card { position:relative; height:173.6px; border-radius:16px; background: var(--cardBg); border:0.8px solid var(--cardBorder); box-shadow: var(--shadowLg); }
    .stat-icon { position:absolute; left:24px; top:24px; width:48px; height:48px; border-radius:14px; box-shadow: var(--shadowLg); display:flex; align-items:center; justify-content:center; }
    .stat-value { position:absolute; left:24px; top:88px; font-size:30px; }
    .stat-label { position:absolute; left:24px; top:128px; font-size:14px; color: var(--textSecondary); }

    .events { display:grid; grid-template-columns: 1fr 1fr; gap:24px; margin-top:32px; }
    .panel { background: var(--cardBg); border:0.8px solid var(--cardBorder); border-radius:16px; box-shadow: var(--shadowLg); padding:25px; }
    .panel-title { display:flex; align-items:center; gap:12px; margin-bottom:24px; }
    .panel-icon { width:36px; height:36px; border-radius:14px; }
    .panel-title h3 { font-size:20px; margin:0; }

    .list { display:flex; flex-direction:column; gap:16px; }
    .list-item { display:flex; align-items:center; justify-content:space-between; padding:0 16px; border-radius:14px; }
    .list-left { display:flex; align-items:center; gap:16px; }
    .dot-green { width:8px; height:8px; border-radius:50%; background:#00c950; }
    .dot-red { width:8px; height:8px; border-radius:50%; background:#fb2c36; }
    .item-title { font-size:14px; }
    .item-sub { font-size:12px; color:#6a7282; }
    .badge-attending { background:#fff4e5; color:#e17100; padding:4px 12px; border-radius:999px; font-size:12px; }
    .badge-attended { background:#dcfce7; color:#008236; padding:4px 12px; border-radius:999px; font-size:12px; }
    .badge-missed { background:#ffe2e2; color:#c10007; padding:4px 12px; border-radius:999px; font-size:12px; }

    .upcoming-card {padding: 5px 17px; }
    .up-row { display:flex; align-items:center; justify-content:space-between; }
    .up-sub { display:flex; align-items:center; justify-content:space-between; margin-top:4px; }
    .up-participants { color:#e17100; font-size:12px; }

    .cta { margin-top:16px; height:48px; border-radius:14px; background: linear-gradient(90deg, #ffea00 0%, #e8d400ff 0%, #ffec1bff 100%); position:relative; }
    .cta p { display: flex; align-items: center; justify-content: center; height:100%; margin:0; font-size:16px; font-weight:600; color:#FFFFFF; cursor:pointer; }

    .quick { background: var(--cardBg); border:0.8px solid var(--cardBorder); border-radius:16px; box-shadow: var(--shadowLg); margin-top:32px; padding:25px; }
    .quick h3 { font-size:20px; margin:0 0 16px; }
    .quick-grid { display:grid; grid-template-columns: repeat(3, 1fr); gap:16px; }
    .quick-btn { border:1.6px solid #e5e7eb; border-radius:14px; height:111px; position:relative; padding:16px; }
    .quick-icon { width:32px; height:32px; background-size:cover;}
    .quick-title { position:absolute; left:16px; top:56px; font-size:14px; }
    .quick-sub { position:absolute; left:16px; top:76px; font-size:12px; color:#6a7282; }

    @media (max-width: 1280px) { .container { width:95%; } .stats { grid-template-columns: repeat(2, 1fr); } .events { grid-template-columns: 1fr; } .quick-grid { grid-template-columns: 1fr; } }
  </style>
</head>
<body>
  <header class="header">
    <div class="header-inner">
      <div class="brand">
        <div class="brand-icon"><div class="brand-logo" aria-hidden="true"></div></div>
        <div class="brand-text">
          <div class="brand-title">UMAttend</div>
          <div class="brand-sub">Attendance Management System</div>
        </div>
      </div>
      <div class="user">
        <div class="bell">
          <div class="bell-icon" aria-hidden="true"></div>
          <div class="bell-dot" aria-hidden="true"></div>
        </div>
        <div class="avatar">
          <div class="avatar-circle">J</div>
          <div>
            <div class="avatar-name">April Bords</div>
            <div class="avatar-role">Student</div>
          </div>
          <div class="avatar-menu" aria-hidden="true"></div>
        </div>
      </div>
    </div>
  </header>

  <main class="container" data-name="Dashboard" data-node-id="6:2">
    <section class="welcome">
      <h1>Welcome back, April Bords!</h1>
      <p>Here's what's happening with your intramural activities</p>
    </section>

    <section class="stats" aria-label="Stats overview">
      <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #05df72 0%, #00bc7d 100%);">
          <div style="width:24px;height:24px;background-image:url('https://www.figma.com/api/mcp/asset/35348bc4-7a4d-4823-be30-49532388a08e');background-size:contain;" aria-hidden="true"></div>
        </div>
        <div class="stat-value">24</div>
        <div class="stat-label">Events Attended</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #51a2ff 0%, #00b8db 100%);">
          <div style="width:24px;height:24px;background-image:url('https://www.figma.com/api/mcp/asset/35e9a586-28e4-4cfc-b09d-68ec8aba75d2');background-size:contain;" aria-hidden="true"></div>
        </div>
        <div class="stat-value">8</div>
        <div class="stat-label">Upcoming Events</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #c27aff 0%, #f6339a 100%);"></div>
        <div class="stat-value">12</div>
        <div class="stat-label">Team Members</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #ffea00 0%, #ffd700 100%);"></div>
        <div class="stat-value">96%</div>
        <div class="stat-label">Attendance Rate</div>
      </div>
    </section>

    <section class="events" aria-label="Events lists">
      <div class="panel">
        <div class="panel-title">
          <h3>Recent Events</h3>
        </div>
        <div class="list">
          <div class="list-item">
            <div class="list-left">
              <span class="dot-green"></span>
              <div>
                <div class="item-title">Mutya ng UM</div>
                <div class="item-sub">Dec 12, 2025 • 1:00 PM</div>
              </div>
            </div>
            <span class="badge-attending">ATTENDING</span>
          </div>
          <div class="list-item">
            <div class="list-left">
              <span class="dot-green"></span>
              <div>
                <div class="item-title">Volleyball Quarterfinals</div>
                <div class="item-sub">Dec 14, 2024 • 10:00 AM</div>
              </div>
            </div>
            <span class="badge-attended">ATTENDED</span>
          </div>
          <div class="list-item">
            <div class="list-left">
              <span class="dot-green"></span>
              <div>
                <div class="item-title">Chess Competition</div>
                <div class="item-sub">Dec 13, 2024 • 1:00 PM</div>
              </div>
            </div>
            <span class="badge-attended">ATTENDED</span>
          </div>
          <div class="list-item">
            <div class="list-left">
              <span class="dot-red"></span>
              <div>
                <div class="item-title">Track and Field Prelims</div>
                <div class="item-sub">Dec 12, 2024 • 9:00 AM</div>
              </div>
            </div>
            <span class="badge-missed">MISSED</span>
          </div>
        </div>
      </div>

      <div class="panel">
        <div class="panel-title">
          <h3>Upcoming Events</h3>
        </div>
        <div class="list">
          <div class="upcoming-card">
            <div class="up-row">
              <div>Swimming Competition</div>
              <div class="quick-icon" style="background-image:url('https://www.figma.com/api/mcp/asset/75faeadb-9f2d-4af0-8eb0-fd7422be860b');" aria-hidden="true"></div>
            </div>
            <div class="up-sub">
              <div class="item-sub">Dec 18, 2024 • 3:00 PM</div>
              <div class="up-participants">15 participants</div>
            </div>
          </div>
          <div class="upcoming-card">
            <div class="up-row">
              <div>Badminton Finals</div>
              <div class="quick-icon" style="background-image:url('https://www.figma.com/api/mcp/asset/75faeadb-9f2d-4af0-8eb0-fd7422be860b');" aria-hidden="true"></div>
            </div>
            <div class="up-sub">
              <div class="item-sub">Dec 19, 2024 • 1:00 PM</div>
              <div class="up-participants">8 participants</div>
            </div>
          </div>
          <div class="upcoming-card">
            <div class="up-row">
              <div>Table Tennis Tournament</div>
              <div class="quick-icon" style="background-image:url('https://www.figma.com/api/mcp/asset/75faeadb-9f2d-4af0-8eb0-fd7422be860b');" aria-hidden="true"></div>
            </div>
            <div class="up-sub">
              <div class="item-sub">Dec 20, 2024 • 11:00 AM</div>
              <div class="up-participants">12 participants</div>
            </div>
          </div>
        </div>
        <div class="cta"><p>View All Events</p></div>
      </div>
    </section>

    <section class="quick" aria-label="Quick Actions">
      <h3>Quick Actions</h3>
      <div class="quick-grid">
        <div class="quick-btn">
          <div class="quick-icon" style="background-image:url('https://www.figma.com/api/mcp/asset/ff03ccd7-d29a-4f4c-ba63-64e2e95ee823');"></div>
          <div class="quick-title">Mark Attendance</div>
          <div class="quick-sub">Check in to current event</div>
        </div>
        <div class="quick-btn">
          <div class="quick-icon" style="background-image:url('https://www.figma.com/api/mcp/asset/e9cdc3c2-dda1-4a4a-bfad-8bac08e09594');"></div>
          <div class="quick-title">View Schedule</div>
          <div class="quick-sub">See your event calendar</div>
        </div>
        <div class="quick-btn">
          <div class="quick-icon" style="background-image:url('https://www.figma.com/api/mcp/asset/3e701a10-b9f4-4543-9fad-1b8d71c69baf');"></div>
          <div class="quick-title">Team Management</div>
          <div class="quick-sub">Manage your team</div>
        </div>
      </div>
    </section>
  </main>
</body>
</html>