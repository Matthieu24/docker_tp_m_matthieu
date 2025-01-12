<?php
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    exit(0);
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Exemple de connexion à la base de données
$host = getenv('DB_SERVER');
$username = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');

try {
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8", $username, $password);

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS emails (
            id INT AUTO_INCREMENT PRIMARY KEY,
            datas TEXT NOT NULL,
            sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
} catch (PDOException $e) {
    echo json_encode(["error" => "Database connection failed: " . $e->getMessage()]);
    exit;
}

echo "Connected successfully";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM emails";
    $result = $pdo->query($sql);
    
    $data = [];
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

function sendEmail($to, $subject, $message) {
    $headers = 'From: admin@example.com' . "\r\n" .
               'Reply-To: admin@example.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();
    
    mail($to, $subject, $message, $headers);
}

sendEmail('recipient@example.com', 'Test Email', 'Ceci est un email.');

?>
