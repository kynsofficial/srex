<?php

include 'conn.php';

$conn = $pdo->open();
try{
  $stmt = $conn->prepare("SELECT * FROM settings WHERE id = 1");
  $stmt->execute();
  $settings = $stmt->fetch();
}
catch(PDOException $e){
  echo "There is some problem in connection: " . $e->getMessage();
}
$pdo->close();

  header('Content-type: application/json');
  echo '
  {
    "theme_color": "'.$settings['theme'].'",
    "background_color": "'.$settings['theme'].'",
    "display": "standalone",
    "scope": "'.$settings['site_url'].'login",
    "start_url": "'.$settings['site_url'].'login",
    "orientation": "any",
    "name": "'.$settings['site_name'].'",
    "short_name": "'.$settings['site_name'].'",
    "description": "'.$settings['site_desc'].'",
    "icons": [
        {
            "src": "'.$settings['site_url'].'assets/pwa/icon-192x192.png",
            "sizes": "192x192",
            "type": "image/png"
        },
        {
            "src": "'.$settings['site_url'].'assets/pwa/icon-256x256.png",
            "sizes": "256x256",
            "type": "image/png"
        },
        {
            "src": "'.$settings['site_url'].'assets/pwa/icon-384x384.png",
            "sizes": "384x384",
            "type": "image/png"
        },
        {
            "src": "'.$settings['site_url'].'assets/pwa/icon-512x512.png",
            "sizes": "512x512",
            "type": "image/png"
        }
    ]
}
  ';
?>
