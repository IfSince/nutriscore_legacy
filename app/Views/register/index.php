<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  
  <title>Register</title>

  <link rel="stylesheet" type="text/css" href="assets/styles/dist/tailwind.css">
  <link rel="stylesheet" type="text/css" href="assets/styles/material-icons.css">
  <script type="module" src="assets/scripts/registration/registration-quest.js" defer></script>
</head>
<body class="flex md:justify-center md:items-center overflow-x-hidden lg:h-screen lg:w-screen">
  <div class="absolute top-0 left-0 z-50">
    <?php

    if (isset($data['errors'])) {
      foreach ($data['errors'] as $fieldErrors) {
        echo '<div>' . $fieldErrors[0] . '</div>';
      }
    }

    ?>
  </div>
  <div class="w-full md:min-h-screen flex flex-col md:flex-row md:max-w-5xl lg:min-h-[600px] lg:h-fit
              lg:shadow-underlined lg:rounded-2xl lg:overflow-hidden test">
    <div class="fixed md:relative h-64 md:h-auto bg-green w-full pb-7 md:pb-0 px-7 shadow-lg md:shadow-none
                flex flex-col justify-end md:items-end md:justify-center max-h-64 md:max-h-full md:max-w-xs">
      <h1 class="mt-28 text-5xl text-white font-medium md:hidden">Register</h1>
      <ul class="mt-12 md:mt-0 w-full max-w-md md:w-auto flex md:flex-col md:h-full md:max-h-80 self-center justify-between items-start"
          data-quest-steps-routing>
      </ul>
    </div>
    
    <div class="mt-64 md:mt-0 md:pt-12 pb-12 px-7 w-full flex-grow flex flex-col justify-evenly items-center">
      <h2 class="text-5xl text-green font-medium hidden md:block md:pt-8">Register</h2>
      <form method="post" class="w-full max-w-sm" id="registrationForm">
        <div data-quest-panel="true" data-quest-step="account">
          <div class="w-full mt-8">
            <label class="default-input__label" for="username">Username</label>
            <input class="default-input" type="text" name="username" id="username">
            <ul class="text-sm font-medium text-red-500 pl-2 invisible peer-invalid:visible"></ul>
          </div>
          <div class="w-full mt-4">
            <label class="default-input__label" for="email">E-Mail</label>
            <input class="default-input" type="text" name="email" id="email">
            <ul class="text-sm font-medium text-red-500 pl-2"></ul>
          </div>
          <div class="w-full mt-8">
            <label class="default-input__label" for="password">Password</label>
            <input class="default-input" type="text" name="password" id="password">
            <ul class="text-sm font-medium text-red-500 pl-2"></ul>
          </div>
          <div class="w-full mt-4">
            <label class="default-input__label" for="repeatPassword">Repeat password</label>
            <input class="default-input" type="text" name="repeatPassword" id="repeatPassword">
            <ul class="text-sm font-medium text-red-500 pl-2"></ul>
          </div>
          <div class="w-full mt-8 ml-2">
            <div class="flex items-center">
              <input class="accent-green focus:outline-2 focus:outline-green"
                     type="checkbox"
                     name="tos"
                     id="tos">
              <label class="cursor-pointer pl-2" for="tos">
                I agree to the
                <a class="text-green cursor-pointer hover:underline focus:underline focus:outline-none" href="#">
                  Terms of Service.
                </a>
              </label>
            </div>
          </div>
        </div>
        
        <div data-quest-panel="false" data-quest-step="personal">
          <div class="w-full mt-8">
            <label class="default-input__label" for="firstName">First name</label>
            <input class="default-input" type="text" name="firstName" id="firstName">
            <ul class="text-sm font-medium text-red-500 pl-2"></ul>
          </div>
          <div class="w-full mt-4">
            <label class="default-input__label" for="surname">Surname</label>
            <input class="default-input" type="text" name="surname" id="surname">
            <ul class="text-sm font-medium text-red-500 pl-2"></ul>
          </div>
          <div class="w-full mt-4">
            <span class="default-input__label">Gender</span>
            <div class="flex justify-between px-2" id="gender">
              <div>
                <input class="accent-green focus:outline-2 focus:outline-green cursor-pointer peer"
                       type="radio"
                       id="genderMale"
                       name="gender"
                       value="male">
                <label class="text-gray-700 font-medium cursor-pointer pl-0.5 peer-checked:text-green"
                       for="genderMale">Male</label>
              </div>
              <div>
                <input class="accent-green focus:outline-2 focus:outline-green cursor-pointer peer"
                       type="radio"
                       id="genderFemale"
                       name="gender"
                       value="female">
                <label class="text-gray-700 font-medium pl-0.5 peer-checked:text-green"
                       for="genderFemale">Female</label>
              </div>
              <div>
                <input class="accent-green focus:outline-2 focus:outline-green cursor-pointer peer"
                       type="radio"
                       id="genderOther"
                       name="gender"
                       value="other">
                <label class="text-gray-700 font-medium cursor-pointer pl-0.5 peer-checked:text-green"
                       for="genderOther">Other</label>
              </div>
            </div>
          </div>
          <div class="w-full mt-6">
            <label class="default-input__label" for="dateOfBirth">Date of Birth</label>
            <input class="default-input" type="date" name="dateOfBirth" id="dateOfBirth">
            <ul class="text-sm font-medium text-red-500 pl-2"></ul>
          </div>
          <div class="w-full mt-4">
            <label class="default-input__label" for="height">Height (in cm)</label>
            <input class="default-input" type="text" name="height" id="height">
            <ul class="text-sm font-medium text-red-500 pl-2"></ul>
          </div>
          <div class="w-full mt-4">
            <label class="default-input__label" for="startingWeight">Starting weight (in kg)</label>
            <input class="default-input" type="text" name="startingWeight" id="startingWeight">
            <ul class="text-sm font-medium text-red-500 pl-2"></ul>
          </div>
        </div>
  
        <div data-quest-panel="false" data-quest-step="nutrition">
          <div class="w-full mt-8">
            <label class=default-input__label for="nutritionType">Nutrition type</label>
            <select class="default-input" name="nutritionType" id="nutritionType">
              <option value="normal">Normal</option>
              <option value="ketogenic">Ketogenic</option>
              <option value="lowCarb">Low carb</option>
              <option value="lowFat">Low fat</option>
              <option value="highProtein">High protein</option>
              <option value="hpHf">HP + HF</option>
              <option value="dachReference">D-A-C-H Reference</option>
              <option value="manually">Manually</option>
            </select>
            <ul class="text-sm font-medium text-red-500 pl-2"></ul>
          </div>
          <div class="w-full mt-8">
            <label class="default-input__label" for="protein">Protein</label>
            <input class="default-input" type="text" name="protein" id="protein">
            <ul class="text-sm font-medium text-red-500 pl-2"></ul>
          </div>
          <div class="w-full mt-4">
            <label class="default-input__label" for="carbohydrates">Carbohydrates</label>
            <input class="default-input" type="text" name="carbohydrates" id="carbohydrates">
            <ul class="text-sm font-medium text-red-500 pl-2"></ul>
          </div>
          <div class="w-full mt-4">
            <label class="default-input__label" for="fat">Fat</label>
            <input class="default-input" type="text" name="fat" id="fat">
            <ul class="text-sm font-medium text-red-500 pl-2"></ul>
          </div>
        </div>
  
        <div data-quest-panel="false" data-quest-step="others">
          <div class="w-full mt-8">
            <label class=default-input__label for="bmr">Basal Metabolic Rate</label>
            <select class="default-input" name="bmr" id="bmr">
              <option value="harris">BMR (Harris Benedict)</option>
              <option value="easy">BMR (easy)</option>
              <option value="complicated">BMR (complicated)</option>
              <option value="mifflin">BMR (Mifflin-St. Jeor)</option>
            </select>
            <ul class="text-sm font-medium text-red-500 pl-2"></ul>
          </div>
          <div class="w-full mt-4">
            <label class=default-input__label for="activityLevel">Activity Level</label>
            <select class="default-input" name="activityLevel" id="activityLevel">
              <option value="noExercise">No exercise</option>
              <option value="exerciseOneToThree">Exercise 1-3/week</option>
              <option value="exerciseThreeToFive">Exercise 3-5/week</option>
              <option value="exerciseSixToSeven">Exercise 6-7/week</option>
              <option value="exerciseDaily">Exercise daily</option>
              <option value="palLevel">PAL Level</option>
              <option value="met">MET</option>
              <option value="metFactor">MET Factor</option>
              <option value="palFactor">PAL Factor</option>
            </select>
            <ul class="text-sm font-medium text-red-500 pl-2"></ul>
          </div>
          <div class="w-full mt-4">
            <label class="default-input__label" for="palLevel">PAL Level</label>
            <input class="default-input" type="text" name="palLevel" id="palLevel">
            <ul class="text-sm font-medium text-red-500 pl-2"></ul>
          </div>
          <div class="w-full mt-4">
            <label class=default-input__label for="objective">Objective</label>
            <select class="default-input" name="objective" id="objective">
              <option value="keep">Keep weight</option>
              <option value="loose">Loose weight</option>
              <option value="gain">Gain weight</option>
            </select>
            <ul class="text-sm font-medium text-red-500 pl-2"></ul>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
</html>