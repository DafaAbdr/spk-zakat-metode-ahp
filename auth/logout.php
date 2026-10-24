<?php
require_once __DIR__ . '/../includes/functions.php';
session_unset();
session_destroy();
session_start();
setFlash('info', 'Anda telah keluar dari sistem.');
header('Location: login.php');
exit;
