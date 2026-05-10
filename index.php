<?php
$serverInfo = [
    'php_version' => phpversion(),
    'server_time' => date('Y-m-d H:i:s'),
    'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
    'hostname' => gethostname(),
    'os' => PHP_OS,
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COM SMKN 2 PINRANG — Server Status</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0a0a0f;
            --surface: #12121a;
            --border: #1e1e2e;
            --accent: #00ff88;
            --accent2: #ff3366;
            --accent3: #3366ff;
            --text: #e8e8f0;
            --muted: #555570;
            --mono: 'Space Mono', monospace;
            --sans: 'Syne', sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--sans);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Grid background */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(0,255,136,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,255,136,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 900px;
            margin: 0 auto;
            padding: 60px 24px;
        }

        /* Header */
        .header {
            margin-bottom: 60px;
            animation: fadeUp 0.6s ease both;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(0,255,136,0.08);
            border: 1px solid rgba(0,255,136,0.2);
            color: var(--accent);
            font-family: var(--mono);
            font-size: 11px;
            padding: 6px 14px;
            border-radius: 2px;
            margin-bottom: 24px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .badge::before {
            content: '';
            width: 6px;
            height: 6px;
            background: var(--accent);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        h1 {
            font-size: clamp(36px, 6vw, 64px);
            font-weight: 800;
            line-height: 1.05;
            letter-spacing: -0.03em;
        }

        h1 .line1 { color: var(--text); display: block; }
        h1 .line2 {
            color: transparent;
            -webkit-text-stroke: 1px var(--accent);
            display: block;
        }

        .subtitle {
            margin-top: 16px;
            color: var(--muted);
            font-family: var(--mono);
            font-size: 13px;
            letter-spacing: 0.05em;
        }

        /* Status grid */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border);
            margin-bottom: 2px;
            animation: fadeUp 0.6s ease 0.1s both;
        }

        .card {
            background: var(--surface);
            padding: 28px;
            position: relative;
            overflow: hidden;
            transition: background 0.2s;
        }

        .card:hover { background: #16161f; }

        .card::after {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 3px; height: 100%;
            background: var(--accent);
            transform: scaleY(0);
            transform-origin: bottom;
            transition: transform 0.3s ease;
        }

        .card:hover::after { transform: scaleY(1); }

        .card-label {
            font-family: var(--mono);
            font-size: 10px;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 10px;
        }

        .card-value {
            font-family: var(--mono);
            font-size: 15px;
            color: var(--accent);
            word-break: break-all;
        }

        /* PHP Info section */
        .section {
            margin-top: 2px;
            background: var(--surface);
            border: 1px solid var(--border);
            padding: 32px;
            animation: fadeUp 0.6s ease 0.2s both;
        }

        .section-title {
            font-family: var(--mono);
            font-size: 11px;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border);
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(30,30,46,0.5);
            gap: 16px;
        }

        .info-row:last-child { border-bottom: none; }

        .info-key {
            font-family: var(--mono);
            font-size: 12px;
            color: var(--muted);
            flex-shrink: 0;
        }

        .info-val {
            font-family: var(--mono);
            font-size: 12px;
            color: var(--text);
            text-align: right;
        }

        /* Success banner */
        .success-banner {
            margin-top: 2px;
            background: rgba(0,255,136,0.05);
            border: 1px solid rgba(0,255,136,0.15);
            padding: 20px 32px;
            display: flex;
            align-items: center;
            gap: 16px;
            animation: fadeUp 0.6s ease 0.3s both;
        }

        .success-icon {
            font-size: 24px;
            flex-shrink: 0;
        }

        .success-text {
            font-family: var(--mono);
            font-size: 12px;
            color: var(--accent);
            letter-spacing: 0.05em;
        }

        .success-text strong {
            display: block;
            font-size: 14px;
            margin-bottom: 2px;
        }

        /* Footer */
        .footer {
            margin-top: 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 24px;
            border-top: 1px solid var(--border);
            animation: fadeUp 0.6s ease 0.4s both;
        }

        .footer-left {
            font-family: var(--mono);
            font-size: 11px;
            color: var(--muted);
        }

        .footer-right {
            display: flex;
            gap: 6px;
        }

        .dot {
            width: 8px; height: 8px;
            border-radius: 50%;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        @media (max-width: 600px) {
            .footer { flex-direction: column; gap: 16px; align-items: flex-start; }
            .info-row { flex-direction: column; align-items: flex-start; }
            .info-val { text-align: left; }
        }
    </style>
</head>
<body>
<div class="container">

    <header class="header">
        <div class="badge">● Deployment Active</div>
        <h1>
            <span class="line1">Server</span>
            <span class="line2">Running.</span>
        </h1>
        <p class="subtitle">// comsmkn2pinrang.my.id &mdash; PHP <?= phpversion() ?> on Coolify</p>
    </header>

    <div class="grid">
        <div class="card">
            <div class="card-label">PHP Version</div>
            <div class="card-value"><?= phpversion() ?></div>
        </div>
        <div class="card">
            <div class="card-label">Server Time</div>
            <div class="card-value"><?= date('H:i:s') ?></div>
        </div>
        <div class="card">
            <div class="card-label">Hostname</div>
            <div class="card-value"><?= htmlspecialchars(gethostname()) ?></div>
        </div>
        <div class="card">
            <div class="card-label">OS Platform</div>
            <div class="card-value"><?= PHP_OS ?></div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">// Environment Info</div>
        <div class="info-row">
            <span class="info-key">SERVER_SOFTWARE</span>
            <span class="info-val"><?= htmlspecialchars($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') ?></span>
        </div>
        <div class="info-row">
            <span class="info-key">REQUEST_URI</span>
            <span class="info-val"><?= htmlspecialchars($_SERVER['REQUEST_URI'] ?? '/') ?></span>
        </div>
        <div class="info-row">
            <span class="info-key">SERVER_PROTOCOL</span>
            <span class="info-val"><?= htmlspecialchars($_SERVER['SERVER_PROTOCOL'] ?? 'HTTP/1.1') ?></span>
        </div>
        <div class="info-row">
            <span class="info-key">HTTPS</span>
            <span class="info-val"><?= (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? '✓ Enabled' : 'via Cloudflare' ?></span>
        </div>
        <div class="info-row">
            <span class="info-key">PHP_SAPI</span>
            <span class="info-val"><?= php_sapi_name() ?></span>
        </div>
        <div class="info-row">
            <span class="info-key">Memory Limit</span>
            <span class="info-val"><?= ini_get('memory_limit') ?></span>
        </div>
        <div class="info-row">
            <span class="info-key">Max Execution Time</span>
            <span class="info-val"><?= ini_get('max_execution_time') ?>s</span>
        </div>
        <div class="info-row">
            <span class="info-key">Date Generated</span>
            <span class="info-val"><?= date('Y-m-d H:i:s T') ?></span>
        </div>
    </div>

    <div class="success-banner">
        <div class="success-icon">✦</div>
        <div class="success-text">
            <strong>Deployment Successful</strong>
            PHP is running correctly on Coolify via Cloudflare Tunnel
        </div>
    </div>

    <footer class="footer">
        <div class="footer-left">COM SMKN 2 PINRANG &copy; <?= date('Y') ?> &mdash; Powered by Coolify + Cloudflare</div>
        <div class="footer-right">
            <div class="dot" style="background:#00ff88"></div>
            <div class="dot" style="background:#3366ff"></div>
            <div class="dot" style="background:#ff3366"></div>
        </div>
    </footer>

</div>
</body>
</html>