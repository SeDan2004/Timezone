<?php 

$list = scandir($_SERVER['DOCUMENT_ROOT'] . '/ClockCsv');
array_shift($list);
array_shift($list);

if ($_POST['caller'] === 'Admin.js') {
  echo json_encode($list);
}

?>