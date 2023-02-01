<?php
if(isset($data['title'])) {
  $title = ucfirst($data['title']);
  $title = "NutriScore - $title";
} else {
  $title = 'NutriScore';
}

$module = $data['module'] ?? null;
if (isset($module)) {
  $directory = substr($module, 0, strrpos($module, '/'));
  $directory = (!empty($directory)) ? $directory : $module;

  $moduleName = (strrpos($module, '/')) ? substr($module, strrpos($module, '/') + 1) : $module;
  $pathElements = array_filter(['assets', 'scripts', $directory, $moduleName]);
  $times = substr_count($directory, '/') + 1;

  $moduleSrcPath = str_repeat('../', $times) . implode('/', $pathElements) . '.module.js';
}

$tailwindPath = str_repeat('../', $times ?? 1) . "assets/styles/dist/tailwind.css";
$materialIconsPath = str_repeat('../', $times ?? 1) . "assets/styles/material-icons.css";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <title><?php echo $title ?></title>

  <link rel="stylesheet" type="text/css" href="<?php echo $materialIconsPath?>">
  <link rel="stylesheet" type="text/css" href="<?php echo $tailwindPath?>">

  <?php if(isset($moduleSrcPath)) {
    echo "<script type=\"module\" src=$moduleSrcPath defer></script>";
  }
  ?>
</head>
<body>