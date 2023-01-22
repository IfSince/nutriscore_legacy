<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  
  <title>Login</title>
  
  <link rel="stylesheet" type="text/css" href="assets/styles/dist/tailwind.css">
  <link rel="stylesheet" type="text/css" href="assets/styles/material-icons.css">
</head>
<body class="w-screen h-screen flex md:justify-center md:items-center">
  <?php

  if (isset($data['errors'])) {
    foreach ($data['errors'] as $fieldErrors) {
      echo '<div>' . $fieldErrors[0] . '</div>';
    }
  }

  ?>
  <div class="w-full h-full flex flex-col md:flex-row md:max-w-5xl lg:max-h-[600px] lg:shadow-underlined lg:rounded-2xl lg:overflow-hidden test">
    
    <div class="flex-grow bg-green w-full pb-7 px-7 shadow-lg md:shadow-none flex items-end md:items-center md:justify-center
                max-h-56 md:max-h-full md:max-w-sm">
      <h1 class="text-5xl text-white font-medium md:hidden">Login</h1>
      <h2 class="text-5xl text-white font-medium hidden md:block leading-snug">Welcome <br> Back!</h2>
    </div>
    
    <div class="px-7 w-full flex-grow flex flex-col justify-evenly items-center">
      <h2 class="text-5xl text-green font-medium hidden md:block">Login</h2>
      <form class="w-full max-w-sm" method="post">
        <div class="w-full">
          <label class="default-input__label" for="username">Username</label>
          <input class="default-input" type="text" name="username" id="username" value="<?php  ?>">
          <ul class="text-sm font-medium text-red-500 pl-2"></ul>
        </div>
        <div class="w-full mt-6">
          <label class="default-input__label" for="password">Password</label>
          <input class="default-input" type="text" name="password" id="password">
          <ul class="text-sm font-medium text-red-500 pl-2"></ul>
        </div>
        <div class="w-full mt-6 pl-2 flex justify-between">
          <div class="flex items-center">
            <input class="accent-green focus:outline-2 focus:outline-green" type="checkbox" name="remember-me" id="remember-me">
            <label class="text-gray-700 cursor-pointer pl-2" for="remember-me">Remember Me</label>
          </div>
          <a class="text-green cursor-pointer hover:underline focus:underline focus:outline-none" href="#">Forgot Password?</a>
        </div>
        <button class="btn btn-primary mt-12" type="submit">Login</button>
      </form>
  
      <div class="pt-8 flex justify-center max-w-xs">
        <span class="text-gray-700">Don't have an account?</span>
        <a href="register" class="text-green pl-3 hover:underline focus:underline focus:outline-none">Sign up here.</a>
      </div>
    </div>
  </div>
</body>
</html>