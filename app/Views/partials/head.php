<?php
$site = $data['title'] ?? null;
$title = ucfirst($site) ?? null;

if(isset($title)) {
  $title = "NutriScore - $title";
} else {
  $title = 'NutriScore';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title><?php echo $title ?></title>

    <link rel="stylesheet" type="text/css" href="assets/styles/material-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/styles/dist/tailwind.css">
    <script type="module" src="<?php echo "assets/scripts/$site/$site.module.js"?>" defer></script>
</head>
<body>