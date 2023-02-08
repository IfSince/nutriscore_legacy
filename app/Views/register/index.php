<?php
$errors = $data['errors'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  
  <title>Register</title>

  <link rel="stylesheet" type="text/css" href="assets/styles/material-icons.css">
  <link rel="stylesheet" type="text/css" href="assets/styles/dist/tailwind.css">
  <script type="module" src="assets/scripts/registration/registration-quest.js" defer></script>
</head>
<body class="flex md:justify-center md:items-center overflow-x-hidden lg:h-screen lg:w-screen">
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
            <input class="default-input" type="text" name="username" id="username" <?php renderValue('username');?>>
            <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
              <?php renderErrors($errors, 'username'); ?>
            </ul>
          </div>
          <div class="w-full mt-4">
            <label class="default-input__label" for="email">E-Mail</label>
            <input class="default-input" type="text" name="email" id="email" <?php renderValue('email');?>>
            <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
              <?php renderErrors($errors, 'email'); ?>
            </ul>
          </div>
          <div class="w-full mt-8">
            <label class="default-input__label" for="password">Password</label>
            <input class="default-input" type="password" name="password" id="password" <?php renderValue('password');?>>
            <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
              <?php renderErrors($errors, 'password'); ?>
            </ul>
          </div>
          <div class="w-full mt-4">
            <label class="default-input__label" for="repeatPassword">Repeat password</label>
            <input class="default-input" type="password" name="repeatPassword" id="repeatPassword" <?php renderValue('repeatPassword');?>>
            <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
              <?php renderErrors($errors, 'repeatPassword'); ?>
            </ul>
          </div>
          <div class="w-full mt-8 ml-2">
            <div class="flex items-center">
              <input class="accent-green focus:outline-2 focus:outline-green"
                     type="checkbox"
                     name="acceptedTos"
                     id="acceptedTos"
                     <?php renderChecked('acceptedTos');?>>
              <label class="cursor-pointer pl-2" for="acceptedTos">
                I agree to the
                <a class="text-green cursor-pointer hover:underline focus:underline focus:outline-none" href="#">
                  Terms of Service.
                </a>
              </label>
            </div>
            <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
              <?php renderErrors($errors, 'acceptedTos'); ?>
            </ul>
          </div>
        </div>
        
        <div data-quest-panel="false" data-quest-step="personal">
          <div class="w-full mt-8">
            <label class="default-input__label" for="firstName">First name</label>
            <input class="default-input" type="text" name="firstName" id="firstName" <?php renderValue('firstName');?>>
            <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
              <?php renderErrors($errors, 'firstName'); ?>
            </ul>
          </div>
          <div class="w-full mt-4">
            <label class="default-input__label" for="surname">Surname</label>
            <input class="default-input" type="text" name="surname" id="surname" <?php renderValue('surname');?>>
            <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
              <?php renderErrors($errors, 'surname'); ?>
            </ul>
          </div>
          <div class="w-full mt-4">
            <span class="default-input__label">Gender</span>
            <div class="flex justify-between px-2" id="gender">
              <div>
                <input class="accent-green focus:outline-2 focus:outline-green cursor-pointer peer"
                       type="radio"
                       id="genderMale"
                       name="gender"
                       value="MALE"
                       <?php renderCheckedByValue('gender', 'MALE');?>>
                <label class="text-gray-700 font-medium cursor-pointer pl-0.5 peer-checked:text-green"
                       for="genderMale">Male</label>
              </div>
              <div>
                <input class="accent-green focus:outline-2 focus:outline-green cursor-pointer peer"
                       type="radio"
                       id="genderFemale"
                       name="gender"
                       value="FEMALE"
                        <?php renderCheckedByValue('gender', 'FEMALE');?>>
                <label class="text-gray-700 font-medium pl-0.5 peer-checked:text-green"
                       for="genderFemale">Female</label>
              </div>
              <div>
                <input class="accent-green focus:outline-2 focus:outline-green cursor-pointer peer"
                       type="radio"
                       id="genderOther"
                       name="gender"
                       value="OTHER"
                        <?php renderCheckedByValue('gender', 'OTHER');?>>
                <label class="text-gray-700 font-medium cursor-pointer pl-0.5 peer-checked:text-green"
                       for="genderOther">Other</label>
              </div>
            </div>
            <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
              <?php renderErrors($errors, 'gender'); ?>
            </ul>
          </div>
          <div class="w-full mt-6">
            <label class="default-input__label" for="dateOfBirth">Date of Birth</label>
            <input class="default-input" type="date" name="dateOfBirth" id="dateOfBirth" <?php renderValue('dateOfBirth');?>>
            <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
              <?php renderErrors($errors, 'dateOfBirth'); ?>
            </ul>
          </div>
          <div class="w-full mt-4">
            <label class="default-input__label" for="height">Height (in cm)</label>
            <input class="default-input" type="number" name="height" id="height" <?php renderValue('height');?>>
            <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
              <?php renderErrors($errors, 'height'); ?>
            </ul>
          </div>
          <div class="w-full mt-4">
            <label class="default-input__label" for="startingWeight">Starting weight (in kg)</label>
            <input class="default-input" type="number" name="startingWeight" id="startingWeight" <?php renderValue('startingWeight');?>>
            <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
              <?php renderErrors($errors, 'startingWeight'); ?>
            </ul>
          </div>
        </div>

        <div data-quest-panel="false" data-quest-step="nutrition">
          <div class="w-full mt-8">
            <label class=default-input__label for="nutritionType">Nutrition type</label>
            <select class="default-input" name="nutritionType" id="nutritionType">
              <option value="NORMAL" <?php renderSelectedByValue('nutritionType', 'NORMAL');?>>Normal</option>
              <option value="KETOGENIC" <?php renderSelectedByValue('nutritionType', 'KETOGENIC');?>>Ketogenic</option>
              <option value="LOW_CARB" <?php renderSelectedByValue('nutritionType', 'LOW_CARB');?>>Low carb</option>
              <option value="LOW_FAT" <?php renderSelectedByValue('nutritionType', 'lowFat');?>>Low fat</option>
              <option value="HIGH_PROTEIN" <?php renderSelectedByValue('nutritionType', 'LOW_FAT');?>>High protein</option>
              <option value="HP_HF" <?php renderSelectedByValue('nutritionType', 'HP_HF');?>>HP + HF</option>
              <option value="DACH_REFERENCE" <?php renderSelectedByValue('nutritionType', 'DACH_REFERENCE');?>>D-A-C-H Reference</option>
              <option value="MANUALLY" <?php renderSelectedByValue('nutritionType', 'MANUALLY');?>>Manually</option>
            </select>
            <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
              <?php renderErrors($errors, 'nutritionType'); ?>
            </ul>
          </div>
          <div class="w-full mt-8">
            <label class="default-input__label" for="protein">Protein</label>
            <input class="default-input" type="number" name="protein" id="protein" <?php renderValue('protein');?>>
            <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
              <?php renderErrors($errors, 'protein'); ?>
            </ul>
          </div>
          <div class="w-full mt-4">
            <label class="default-input__label" for="carbohydrates">Carbohydrates</label>
            <input class="default-input" type="number" name="carbohydrates" id="carbohydrates" <?php renderValue('carbohydrates');?>>
            <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
              <?php renderErrors($errors, 'carbohydrates'); ?>
            </ul>
          </div>
          <div class="w-full mt-4">
            <label class="default-input__label" for="fat">Fat</label>
            <input class="default-input" type="number" name="fat" id="fat" <?php renderValue('fat');?>>
            <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
              <?php renderErrors($errors, 'fat'); ?>
            </ul>
          </div>
        </div>

        <div data-quest-panel="false" data-quest-step="others">
          <div class="w-full mt-8">
            <label class=default-input__label for="bmrCalculationType">BMR Calculation Type</label>
            <select class="default-input" name="bmrCalculationType" id="bmrCalculationType">
              <option value="EASY" <?php renderSelectedByValue('bmrCalculationType', 'EASY');?>>BMR (easy)</option>
              <option value="COMPLICATED" <?php renderSelectedByValue('bmrCalculationType', 'COMPLICATED');?>>BMR (complicated)</option>
              <option value="HARRIS_BENEDICT" <?php renderSelectedByValue('bmrCalculationType', 'HARRIS_BENEDICT');?>>BMR (Harris Benedict)</option>
              <option value="MIFFLIN_ST_JEOR" <?php renderSelectedByValue('bmrCalculationType', 'MIFFLIN_ST_JEOR');?>>BMR (Mifflin-St. Jeor)</option>
            </select>
            <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
              <?php renderErrors($errors, 'bmrCalculationType'); ?>
            </ul>
          </div>
          <div class="w-full mt-4">
            <label class=default-input__label for="activityLevel">Activity Level</label>
            <select class="default-input" name="activityLevel" id="activityLevel">
              <option value="NO_SPORTS" <?php renderSelectedByValue('activityLevel', 'NO_SPORTS');?>>No exercise</option>
              <option value="ONE_TO_THREE" <?php renderSelectedByValue('activityLevel', 'ONE_TO_THREE');?>>Exercise 1-3/week</option>
              <option value="THREE_TO_FIVE" <?php renderSelectedByValue('activityLevel', 'THREE_TO_FIVE');?>>Exercise 3-5/week</option>
              <option value="SIX_TO_SEVEN" <?php renderSelectedByValue('activityLevel', 'SIX_TO_SEVEN');?>>Exercise 6-7/week</option>
              <option value="DAILY" <?php renderSelectedByValue('activityLevel', 'DAILY');?>>Exercise daily</option>
              <option value="PAL_LEVEL" <?php renderSelectedByValue('activityLevel', 'PAL_LEVEL');?>>PAL Level</option>
              <option value="MET" <?php renderSelectedByValue('activityLevel', 'MET');?>>MET</option>
              <option value="MET_FACTOR" <?php renderSelectedByValue('activityLevel', 'MET_FACTOR');?>>MET Factor</option>
              <option value="PAL_FACTOR" <?php renderSelectedByValue('activityLevel', 'PAL_FACTOR');?>>PAL Factor</option>
            </select>
            <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
              <?php renderErrors($errors, 'activityLevel'); ?>
            </ul>
          </div>
          <div class="w-full mt-4">
            <label class="default-input__label" for="palLevel">PAL Level</label>
            <input class="default-input" type="number" name="palLevel" id="palLevel" <?php renderValue('palLevel');?>>
            <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
              <?php renderErrors($errors, 'palLevel'); ?>
            </ul>
          </div>
          <div class="w-full mt-4">
            <label class=default-input__label for="goal">Objective</label>
            <select class="default-input" name="goal" id="goal" <?php renderValue('goal');?>>
              <option value="KEEP">Keep weight</option>
              <option value="LOOSE">Loose weight</option>
              <option value="GAIN">Gain weight</option>
            </select>
            <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
              <?php renderErrors($errors, 'goal'); ?>
            </ul>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
</html>