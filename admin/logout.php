<?php
setcookie('admin_token', '', time() - 3600, '/', '', false, true);
header('Location: login.php');
exit;

