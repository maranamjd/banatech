<?php
if (isset($_POST['logout'])) {
  session_start();
  session_destroy();
}
else {
  header('Location: ../');
}
?>
