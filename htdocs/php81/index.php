<?php
function envOrDefault(string $key, string $default): string
{
    $value = getenv($key);
    return $value !== false && $value !== '' ? $value : $default;
}

function testConnection(): array
{
    $host = envOrDefault('DB_HOST', 'mariadb');
    $port = envOrDefault('DB_PORT', '3306');
    $user = envOrDefault('DB_USER', 'root');
    $password = envOrDefault('DB_PASSWORD', '');
    $database = envOrDefault('DB_NAME', '');

    try {
        $dsn = "mysql:host={$host};port={$port};dbname={$database}";
        $connection = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);

        return [
            'ok' => true,
            'message' => 'Connected successfully to MariaDB',
        ];
    } catch (PDOException $exception) {
        return [
            'ok' => false,
            'message' => 'Connection failed: ' . $exception->getMessage(),
        ];
    }
}

$connectionResult = testConnection();
$phpPort = envOrDefault('PHP_PORT', '8080');
$phpMyAdminPort = envOrDefault('PHPMYADMIN_PORT', '8000');

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PHP 8.1 App</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; color: #222; margin: 0; padding: 24px; }
        .card { background: #fff; border: 1px solid #e2e2e2; border-radius: 8px; padding: 20px; max-width: 720px; margin: 0 auto; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        h1 { margin-top: 0; }
        .status { padding: 10px 12px; border-radius: 6px; display: inline-block; margin: 8px 0; }
        .ok { background: #e7f7ef; color: #167c3b; border: 1px solid #a9e2c2; }
        .error { background: #fdebea; color: #a12622; border: 1px solid #f5b5b2; }
        a { color: #0a6ed1; text-decoration: none; }
        a:hover { text-decoration: underline; }
        code { background: #f0f0f0; padding: 2px 6px; border-radius: 4px; }
        ul { line-height: 1.6; }
    </style>
</head>
<body>
    <div class="card">
        <h1>PHP 8.1 App</h1>
        <p>Running on php:8.1-fpm via Nginx.</p>

        <div class="status <?php echo $connectionResult['ok'] ? 'ok' : 'error'; ?>">
            <?php echo htmlspecialchars($connectionResult['message'], ENT_QUOTES, 'UTF-8'); ?>
        </div>

        <h3>Links</h3>
        <ul>
            <li><a href="http://127.0.0.1:<?php echo htmlspecialchars($phpPort, ENT_QUOTES, 'UTF-8'); ?>/" target="_blank" rel="noopener">Home</a></li>
            <li><a href="http://127.0.0.1:<?php echo htmlspecialchars($phpMyAdminPort, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener">phpMyAdmin</a></li>
        </ul>

        <h3>Current Settings</h3>
        <ul>
            <li>DB host: <code><?php echo htmlspecialchars(envOrDefault('DB_HOST', 'mariadb'), ENT_QUOTES, 'UTF-8'); ?></code></li>
            <li>DB name: <code><?php echo htmlspecialchars(envOrDefault('DB_NAME', 'app_db'), ENT_QUOTES, 'UTF-8'); ?></code></li>
            <li>DB user: <code><?php echo htmlspecialchars(envOrDefault('DB_USER', 'app_user'), ENT_QUOTES, 'UTF-8'); ?></code></li>
        </ul>
    </div>
</body>
</html>
