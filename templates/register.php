<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  
  <title>Register</title>
  
  <link rel="stylesheet" type="text/css" href="https://use.typekit.net/hbp1ubp.css"> <!-- Adobe Font-->
  <link rel="stylesheet" type="text/css" href="assets/styles/dist/tailwind.css">
  <link rel="stylesheet" type="text/css" href="assets/styles/material-icons.css">

  <script type="module" src="assets/scripts/registration-quest.js" defer></script>
</head>
<body class="bg-gray-light flex justify-center items-center min-h-screen px-6">
  <div class="w-full h-fit max-w-sm bg-white shadow-xl rounded-2xl flex items-center flex-col relative px-6 sm:px-10
              pb-10 mt-12">
    <div class="h-24 w-24 shadow-md rounded-2xl flex justify-center items-center bg-white absolute -translate-y-2/4">
      <span class="material-icons text-6xl text-green">person</span>
    </div>
    
    <form class="w-full" method="post" id="registrationForm">
      <h1 class="text-4xl text-center uppercase text-green tracking-wide font-medium mt-20 mb-6">Register</h1>
  
      <div class="flex justify-between flex-col items-center">
        <div class="w-full grow flex justify-between px-2 mb-6" data-quest-steps></div>
  
        <div class="w-full" data-quest-panel="true" data-quest-step="account">
          <div class="w-full">
            <label class="rounded-input__label" for="username">Username</label>
            <input class="rounded-input" type="text" id="username">
            <ul class="text-sm font-medium text-error"></ul>
          </div>
    
          <div class="w-full mt-4">
            <label class="rounded-input__label" for="email">E-Mail</label>
            <input class="rounded-input" type="text" id="email">
            <ul class="text-sm font-medium text-error"></ul>
          </div>
    
          <div class="w-full mt-4">
            <label class="rounded-input__label" for="password">Password</label>
            <input class="rounded-input" type="text" id="password">
            <ul class="text-sm font-medium text-error"></ul>
          </div>
    
          <div class="w-full mt-4">
            <label class="rounded-input__label" for="repeatPassword">Repeat Password</label>
            <input class="rounded-input" type="text" id="repeatPassword">
            <ul class="text-sm font-medium text-error"></ul>
          </div>
        </div>

        <div class="w-full" data-quest-panel="false" data-quest-step="personal">
          <div class="w-full">
            <label class="rounded-input__label" for="firstName">First name</label>
            <input class="rounded-input" type="text" id="firstName">
            <ul class="text-sm font-medium text-error"></ul>
          </div>

          <div class="w-full mt-4">
            <label class="rounded-input__label" for="surname">Surname</label>
            <input class="rounded-input" type="text" id="surname">
            <ul class="text-sm font-medium text-error"></ul>
          </div>
        </div>

        <div class="w-full" data-quest-panel="false" data-quest-step="address">
          <div class="w-full">
            <label class="rounded-input__label" for="street">Street</label>
            <input class="rounded-input" type="text" id="street">
            <ul class="text-sm font-medium text-error"></ul>
          </div>

          <div class="w-full mt-4">
            <label class="rounded-input__label" for="country">Country</label>
            <input class="rounded-input" type="text" id="country">
            <ul class="text-sm font-medium text-error"></ul>
          </div>
        </div>

        <div class="w-full" data-quest-panel="false" data-quest-step="preferences">
          <div class="w-full">
            <label class="rounded-input__label" for="preferences">Preferences</label>
            <input class="rounded-input" type="text" id="preferences">
            <ul class="text-sm font-medium text-error"></ul>
          </div>
        </div>
      </div>
      
      
      
      <button class="btn btn-primary mt-10" type="submit">Register</button>
      <p class="mt-4 text-center text-gray-dark">
        Already have an account?
        <a class="text-green cursor-pointer hover:underline focus:underline focus:outline-none" href="/?route=login">
          Login here.
        </a>
      </p>
    </form>
  </div>

</body>
</html>
