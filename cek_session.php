<?php
session_start();

echo "<h1>Isi Session Saat Ini:</h1>";
echo "<pre>"; 
print_r($_SESSION);
echo "</pre>";

echo "<hr>";
echo "ID Session Anda: " . session_id();
?>