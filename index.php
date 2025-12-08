<?php
$tiles = [
    'A' => ['View Attendance', 'attendance.php', 'tile--wide-top', 'clipboard'],
    'B' => ['Time In', 'create.php', 'tile--square', 'clock'],
    'C' => ['Archive All Attendance and Absentees', "javascript:confirmClear()", 'tile--square', 'archive'],
    'D' => ['Register Attendee', 'register.php', 'tile--square', 'user-plus'],
    'E' => ['Absents', 'absent.php', 'tile--square', 'alert'],
    'F' => ['View Attendees', 'attendees.php', 'tile--wide-bottom', 'users'],
    'G' => ['Archives', 'archive.php', 'tile--tall', 'folder'],
];

function getIcon($name) {
    switch ($name) {

        case 'clock':
            return '<svg width="26" height="26" fill="none" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="12" cy="12" r="10"></circle>
                      <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>';

        case 'archive':
            return '<svg width="26" height="26" fill="none" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                      <rect x="3" y="3" width="18" height="4"></rect>
                      <path d="M5 7h14v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V7z"></path>
                    </svg>';

        case 'user-plus':
            return '<svg width="26" height="26" fill="none" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                      <circle cx="9" cy="7" r="4"></circle>
                      <line x1="19" y1="8" x2="19" y2="14"></line>
                      <line x1="16" y1="11" x2="22" y2="11"></line>
                    </svg>';

        case 'alert':
            return '<svg width="26" height="26" fill="none" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.18 3.86a2 2 0 0 0-3.42 0z"></path>
                      <line x1="12" y1="9" x2="12" y2="13"></line>
                      <line x1="12" y1="17" x2="12" y2="17"></line>
                    </svg>';

        case 'users':
            return '<svg width="26" height="26" fill="none" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M17 21v-2a4 4 0 0 0-3-3.87"></path>
                      <path d="M9 21v-2a4 4 0 0 1 3-3.87"></path>
                      <circle cx="12" cy="7" r="4"></circle>
                    </svg>';

        case 'folder':
            return '<svg width="26" height="26" fill="none" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    </svg>';

        default: // fallback icon
            return '<svg width="26" height="26" fill="none" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                      <rect x="3" y="6" width="18" height="13" rx="2" ry="2"></rect>
                      <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>';
    }
}

?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Dashboard</title>
<style>
  :root{
    --gap: 18px;
    --radius: 8px;
    --tile-bg: #4ca0ddff;
    --tile-bg-2: #5494fcff;
    --tile-text: #fff;
    --max-width: 1100px;
  }

    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('icons/bg.jpg') no-repeat center center/cover;
        opacity: 0.3;
        z-index: -1;
    }

    body {
        font-family: 'Poppins', sans-serif;
    }
    h2 {
        font-family: 'Poppins', sans-serif;
    }

    body{
        margin:0;
        font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        background:#f3f4f6;
        color: #111827;
        display:flex;
        justify-content:center;
        padding:32px;
    }
    .wrap{
        width:100%;
        max-width:var(--max-width);
    }

  h2{ margin:0 0 14px 0; font-size:20px; color:#111827; }

  .grid{
    display:grid;
    grid-template-columns: repeat(4, 1fr);
    grid-auto-rows: 1fr;
    gap: var(--gap);
    align-items:stretch;
  }

  .tile{
    display:flex;
    align-items:center;
    justify-content:flex-start;
    gap:14px;
    padding:18px;
    border-radius:var(--radius);
    color:var(--tile-text);
    text-decoration:none;
    box-shadow: 0 6px 18px rgba(9,30,66,0.2);
    background: linear-gradient(180deg, var(--tile-bg) 0%, var(--tile-bg-2) 100%);
    transition: transform .15s ease, box-shadow .15s ease, filter .12s;
    min-height: 0;
    overflow:hidden;
  }
  .tile:focus,
  .tile:hover{
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(9,30,66,0.12);
    filter:brightness(1.03);
    outline: none;
  }
  .tile:active{ transform: translateY(-2px); }

  .tile .icon{
    width:48px;
    height:48px;
    flex: 0 0 48px;
    display:grid;
    place-items:center;
    background: rgba(255,255,255,0.12);
    border-radius:0px;
  }
  .tile h3{
    margin:0;
    font-size:16px;
    line-height:1.05;
  }
  .tile p{ margin:4px 0 0 0; font-size:12px; opacity:0.92; }

.tile--wide-top{
    grid-column: 1 / span 2;
    grid-row: 1;
    height: 150px;
}
.tile--pos-B{
    grid-column: 3;
    grid-row: 1;
    height: 150px;
}
.tile--pos-C{
    grid-column: 4;
    grid-row: 1;
    height: 150px;
}

.tile--pos-D{
    grid-column: 1;
    grid-row: 2;
    height: 150px;
}
.tile--pos-E{
    grid-column: 2;
    grid-row: 2;
    height: 150px;
}

.tile--tall{
    grid-column: 3 / span 2;
    grid-row: 2 / span 2;
    height: 320px;
}

.tile--wide-bottom{
    grid-column: 1 / span 2;
    grid-row: 3;
    height: 150px;
}

  @media (max-width:700px){
    .grid{ grid-template-columns: 1fr; grid-auto-rows: auto; }
    .tile, .tile--tall, .tile--wide-top, .tile--wide-bottom { aspect-ratio: auto; }
    .tile{ padding:14px; }
  }
</style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="wrap">
    <h2 style="font-weight: bold;">Dashboard</h2>

    <div class="grid" role="list">
      <?php foreach($tiles as $k => $t):
        $title = htmlspecialchars($t[0]);
        $url   = htmlspecialchars($t[1]);
        $cls   = $t[2];
        $posClass = '';
        if ($k === 'B') $posClass = ' tile--pos-B';
        if ($k === 'C') $posClass = ' tile--pos-C';
        if ($k === 'D') $posClass = ' tile--pos-D';
        if ($k === 'E') $posClass = ' tile--pos-E';
      ?>
      <a href="<?= $url ?>" class="tile <?= $cls . $posClass ?>" role="listitem" aria-label="<?= $title ?>">
      <span class="icon" aria-hidden="true">
        <?= getIcon($t[3] ?? '') ?>
      </span>
        <div class="meta">
          <h3><?= $title ?></h3>
          <p style="opacity:.85; font-size:12px;">Click to open</p>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
        <div style="
        margin-top: 25px;
        text-align: center;
        font-weight: 600;
        font-size: 18px;
        letter-spacing: 1px;
        color: #1f2937;
    ">
        ATTENDANCE MONITORING FOR EVENTS
    </div>
  </div>

  <script>
    function confirmClear() {
      if (confirm("Are you sure you want to archive ALL attendance and absent logs? This action cannot be undone.")) {
        window.location.href = "archiveattendance_absent.php";
      }
  }
</script>


</body>
</html>