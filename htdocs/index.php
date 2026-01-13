<?php
function envOrDefault(string $key, string $default): string
{
    $value = getenv($key);
    return $value !== false && $value !== '' ? $value : $default;
}

$phpPort = envOrDefault('PHP_PORT', '8080');
$phpMyAdminPort = envOrDefault('PHPMYADMIN_PORT', '8000');

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LAMP Docker</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; color: #222; margin: 0; padding: 24px; }
        .card { background: #fff; border: 1px solid #e2e2e2; border-radius: 8px; padding: 20px; max-width: 760px; margin: 0 auto; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        h1 { margin-top: 0; }
        a { color: #0a6ed1; text-decoration: none; }
        a:hover { text-decoration: underline; }
        ul { line-height: 1.6; }
        code { background: #f0f0f0; padding: 2px 6px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>LAMP - Multi PHP</h1>
        <p>Nginx front with multiple PHP-FPM versions per folder.</p>

        <h3>Apps</h3>
        <ul>
            <li><a href="http://127.0.0.1:<?php echo htmlspecialchars($phpPort, ENT_QUOTES, 'UTF-8'); ?>/php82/" target="_blank" rel="noopener">PHP 8.2 app</a></li>
            <li><a href="http://127.0.0.1:<?php echo htmlspecialchars($phpPort, ENT_QUOTES, 'UTF-8'); ?>/php81/" target="_blank" rel="noopener">PHP 8.1 app</a></li>
        </ul>

        <h3>Tools</h3>
        <ul>
            <li><a href="http://127.0.0.1:<?php echo htmlspecialchars($phpMyAdminPort, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener">phpMyAdmin</a></li>
        </ul>

        <h3>Structure</h3>
        <ul>
            <li>Root served by Nginx on port <code><?php echo htmlspecialchars($phpPort, ENT_QUOTES, 'UTF-8'); ?></code>.</li>
            <li><code>htdocs/php82</code> -> PHP 8.2 FPM container.</li>
            <li><code>htdocs/php81</code> -> PHP 8.1 FPM container.</li>
        </ul>
    </div>
</body>
</html>