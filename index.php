<?php
//index.php - Desain Terminal Retro Unik untuk Deployment SMKN 2 Pinrang

// Ambil data server sederhana untuk ditampilkan
$phpVersion = phpversion();
$serverOs = php_uname('s');
$currentTime = date('Y-m-d H:i:s T');
$clientIp = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
$hostName = $_SERVER['HTTP_HOST'] ?? 'unknown_host';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEPLOYMENT STATUS: ONLINE</title>
    <style>
        /* --- CSS INTERNAL - DESAIN TERMINAL RETRO CYBER --- */
        :root {
            --bg-color: #080a10;
            --main-color: #00ff41; /* Hijau Matrix */
            --accent-color: #00bcd4; /* Cyan */
            --text-shadow: 0 0 5px rgba(0, 255, 65, 0.7);
            --font-family: 'Courier New', Courier, monospace;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--bg-color);
            color: var(--main-color);
            font-family: var(--font-family);
            font-size: 16px;
            line-height: 1.5;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden; /* Mencegah scrollbar */
            position: relative;
        }

        /* Efek Scanline CRT */
        body::before {
            content: " ";
            display: block;
            position: absolute;
            top: 0; left: 0; bottom: 0; right: 0;
            background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.25) 50%);
            background-size: 100% 4px;
            z-index: 100;
            pointer-events: none;
            opacity: 0.3;
        }

        /* Container Utama */
        .terminal-window {
            width: 90%;
            max-width: 800px;
            height: 80vh;
            background: rgba(0, 0, 0, 0.8);
            border: 2px solid var(--main-color);
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 255, 65, 0.3);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        /* Header Jendela */
        .terminal-header {
            background: rgba(0, 255, 65, 0.1);
            padding: 8px 15px;
            border-bottom: 2px solid var(--main-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            user-select: none;
        }

        .header-title {
            color: var(--accent-color);
            font-weight: bold;
            font-size: 0.9em;
        }

        .header-buttons {
            display: flex;
            gap: 6px;
        }

        .btn { width: 12px; height: 12px; border-radius: 50%; }
        .btn-red { background-color: #ff5f56; }
        .btn-yellow { background-color: #ffbd2e; }
        .btn-green { background-color: #27c93f; }

        /* Konten Utama Terminal */
        .terminal-content {
            padding: 20px;
            flex-grow: 1;
            overflow-y: auto;
            position: relative;
        }

        /* Elemen Tipografi */
        h1 {
            font-size: 1.4em;
            color: var(--accent-color);
            margin-bottom: 15px;
            text-transform: uppercase;
            text-shadow: 0 0 8px rgba(0, 188, 212, 0.7);
        }

        .ascii-art {
            color: var(--main-color);
            font-size: 0.8em;
            white-space: pre;
            margin-bottom: 20px;
            line-height: 1.2;
            text-shadow: var(--text-shadow);
        }

        .log-entry {
            margin-bottom: 8px;
            display: flex;
        }

        .log-prefix { color: #888; margin-right: 10px; user-select: none; }
        .log-label { color: var(--accent-color); margin-right: 5px; }
        .log-value { color: #fff; font-weight: bold; }
        .status-ok { color: #27c93f; font-weight: bold; animation: pulse 1.5s infinite; }

        /* Footer / Input Prompt */
        .terminal-footer {
            padding: 10px 20px;
            border-top: 1px solid rgba(0, 255, 65, 0.2);
            color: #888;
            font-size: 0.9em;
        }

        /* Animasi */
        .cursor {
            display: inline-block;
            width: 10px; height: 1.2em;
            background-color: var(--main-color);
            margin-left: 5px;
            animation: blink 1s infinite;
            vertical-align: middle;
        }

        @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }
        @keyframes pulse { 0%, 100% { opacity: 1; text-shadow: 0 0 5px #27c93f; } 50% { opacity: 0.6; text-shadow: 0 0 2px #27c93f; } }

        /* Scrollbar Styling */
        .terminal-content::-webkit-scrollbar { width: 8px; }
        .terminal-content::-webkit-scrollbar-track { background: rgba(0,0,0,0.3); }
        .terminal-content::-webkit-scrollbar-thumb { background: rgba(0, 255, 65, 0.3); border-radius: 4px; }
        .terminal-content::-webkit-scrollbar-thumb:hover { background: rgba(0, 255, 65, 0.5); }

        /* Responsif */
        @media (max-width: 600px) {
            body { font-size: 14px; }
            h1 { font-size: 1.1em; }
            .ascii-art { font-size: 0.6em; }
            .terminal-window { height: 90vh; }
        }
    </style>
</head>
<body>

    <div class="terminal-window">
        <div class="terminal-header">
            <div class="header-buttons">
                <div class="btn btn-red"></div>
                <div class="btn btn-yellow"></div>
                <div class="btn btn-green"></div>
            </div>
            <div class="header-title">system_monitor@<?php echo htmlspecialchars($hostName); ?>:~</div>
            <div></div> </div>

        <div class="terminal-content">
            <h1>SISTEM DEPLOYMENT SMKN 2 PINRANG</h1>

            <div class="ascii-art">
   _____ __  __ _  __
  / ____|  \/  | |/ /
 | (___ | \  / | ' /
  \___ \| |\/| |  <
  ____) | |  | | . \
 |_____/|_|  |_|_|\_\
            </div>

            <div class="log-entry">
                <span class="log-prefix">[OK]</span>
                <span class="log-text">Initializing core service...</span>
            </div>
            <div class="log-entry">
                <span class="log-prefix">[OK]</span>
                <span class="log-text">Connecting to host: <span class="log-value"><?php echo htmlspecialchars($hostName); ?></span></span>
            </div>
            <div class="log-entry">
                <span class="log-prefix">[OK]</span>
                <span class="log-text">Web Server (Nginx) configured for folder <span class="log-value">/public</span>.</span>
            </div>
            <div class="log-entry">
                <span class="log-prefix">[WARN]</span>
                <span class="log-text">Database check skipped (Test Mode Active).</span>
            </div>

            <br>
            <div class="log-entry" style="font-size: 1.1em;">
                <span class="log-text">FINAL DEPLOYMENT STATUS: </span>
                <span class="status-ok">ONLINE & ACTIVE</span>
            </div>
            <hr style="border: none; border-top: 1px solid rgba(0, 255, 65, 0.2); margin: 20px 0;">

            <div class="log-entry">
                <span class="log-label">Waktu Server:</span>
                <span class="log-value"><?php echo htmlspecialchars($currentTime); ?></span>
            </div>
            <div class="log-entry">
                <span class="log-label">Versi PHP:</span>
                <span class="log-value"><?php echo htmlspecialchars($phpVersion); ?></span>
            </div>
            <div class="log-entry">
                <span class="log-label">OS Server:</span>
                <span class="log-value"><?php echo htmlspecialchars($serverOs); ?></span>
            </div>
            <div class="log-entry">
                <span class="log-label">IP Anda:</span>
                <span class="log-value"><?php echo htmlspecialchars($clientIp); ?></span>
            </div>

        </div>

        <div class="terminal-footer">
            admin@smkn2pinrang:~$&nbsp;<span class="log-value">system --check --test-mode</span><span class="cursor"></span>
        </div>
    </div>

</body>
</html>