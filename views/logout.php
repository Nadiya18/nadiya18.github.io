<?php
session_unset();
session_destroy();
echo "<script>location.replace('index.php');</script>";
?>