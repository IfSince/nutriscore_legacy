<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  
  <title>Login</title>
  
  <link rel="stylesheet" href="https://use.typekit.net/hbp1ubp.css"> <!-- Adobe Font-->
  <link rel="stylesheet" href="assets/styles/dist/tailwind.css">
  <link rel="stylesheet" type="text/css" href="assets/styles/material-icons.css">
</head>
<body class="bg-gray-light flex justify-center items-center min-h-screen px-6">
  <div class="w-full h-fit max-w-sm bg-white shadow-xl rounded-2xl flex items-center flex-col relative px-6 sm:px-10
              pb-10 mt-12">
    <div class="h-24 w-24 shadow-md rounded-2xl flex justify-center items-center bg-white absolute -translate-y-2/4">
      <span class="material-icons text-6xl text-green">person</span>
    </div>
    
    <form class="w-full" method="post">
      <h1 class="text-4xl text-center uppercase text-green tracking-wide font-medium mt-20 mb-4">Login</h1>
      <div class="w-full">
        <label class="default-input__label" for="username">Username</label>
        <input class="default-input" type="text" id="username">
        <ul class="text-sm font-medium text-error"></ul>
      </div>
      
      <div class="w-full mt-4">
        <label class="default-input__label" for="password">Password</label>
        <input class="default-input" type="text" id="password">
        <ul class="text-sm font-medium text-error"></ul>
      </div>
      
      <div class="w-full mt-2 ml-2 flex justify-between">
        <div class="flex items-center">
          <input class="accent-green focus:outline-2 focus:outline-green" type="checkbox" id="remember-me">
          <label class="text-green cursor-pointer pl-2" for="remember-me">Remember Me</label>
        </div>
        <a class="text-green cursor-pointer hover:underline focus:underline focus:outline-none" href="#">
          Forgot Password?
        </a>
      </div>
      
      <button class="btn btn-primary mt-10" type="submit">Login</button>
      <p class="mt-4 text-center text-gray-dark">
        New?
        <a class="text-green cursor-pointer hover:underline focus:underline focus:outline-none" href="/?route=register">
          Create Account
        </a>
      </p>
    </form>
  </div>
</body>
</html>
