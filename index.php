<?php
$tiles = [
    'A' => ['View Attendance', 'attendance.php', 'tile--wide-top'],
    'B' => ['Time In', 'create.php', 'tile--square'],
    'C' => ['Archive All Attendance', "javascript:confirmClear()", 'tile--square'],
    'D' => ['Register Attendee', 'register.php', 'tile--square'],
    'E' => ['Absents', 'absent.php', 'tile--square'],
    'F' => ['View Attendees', 'attendees.php', 'tile--wide-bottom'],
    'G' => ['Archives', 'archive.php', 'tile--tall'],
];
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
    --tile-bg: #2b5fd9ff;
    --tile-bg-2: #624ad9ff;
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
        background: url('bg.jpg') no-repeat center center/cover;
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
          <!-- SVG icon -->
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="6" width="18" height="13" rx="2" ry="2"></rect>
            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
          </svg>
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
        font-size: 14px;
        letter-spacing: 1px;
        color: #1f2937;
    ">
        ATTENDANCE MONITORING FOR EVENTS
    </div>
  </div>

  <script>
    function confirmClear() {
      if (confirm("Are you sure you want to delete ALL attendance logs? This action cannot be undone.")) {
        window.location.href = "archiveattendance.php";
      }
  }
</script>


</body>
</html>