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
            <label class="default-input__label" for="username">Username</label>
            <input class="default-input"
                   type="text"
                   id="username"
                   name="username"
                   value="<?= getPostParam(Registration::USERNAME_FORM_FIELD)?>">
            <?php printMessages($errors, Registration::USERNAME_FORM_FIELD)?>
          </div>
    
          <div class="w-full mt-4">
            <label class="default-input__label" for="email">E-Mail</label>
            <input class="default-input"
                   type="text"
                   id="email"
                   name="email"
                   value="<?= getPostParam(Registration::EMAIL_FORM_FIELD)?>">
            <?php printMessages($errors, Registration::EMAIL_FORM_FIELD)?>
          </div>
    
          <div class="w-full mt-4">
            <label class="default-input__label" for="password">Password</label>
            <input class="default-input"
                   type="text"
                   id="password"
                   name="password"
                   value="<?= getPostParam(Registration::PASSWORD_FORM_FIELD)?>">
            <?php printMessages($errors, Registration::PASSWORD_FORM_FIELD)?>
          </div>
    
          <div class="w-full mt-4">
            <label class="default-input__label" for="repeatPassword">Repeat Password</label>
            <input class="default-input"
                   type="text"
                   id="repeatPassword"
                   name="repeatPassword"
                   value="<?= getPostParam(Registration::REPEAT_PASSWORD_FORM_FIELD)?>">
            <?php printMessages($errors, Registration::REPEAT_PASSWORD_FORM_FIELD)?>
          </div>
        </div>

        <div class="w-full" data-quest-panel="false" data-quest-step="personal">
          <div class="w-full">
            <label class="default-input__label" for="firstName">First name</label>
            <input class="default-input"
                   type="text"
                   id="firstName"
                   name="firstName"
                   value="<?= getPostParam(Registration::FIRST_NAME_FORM_FIELD)?>">
            <?php printMessages($errors, Registration::FIRST_NAME_FORM_FIELD)?>
          </div>

          <div class="w-full mt-4">
            <label class="default-input__label" for="surname">Surname</label>
            <input class="default-input"
                   type="text"
                   id="surname"
                   name="surname"
                   value="<?= getPostParam(Registration::SURNAME_FORM_FIELD)?>">
            <?php printMessages($errors, Registration::SURNAME_FORM_FIELD)?>
          </div>

          <div class="w-full mt-5">
            <span class="default-input__label">Gender</span>
            <div class="flex justify-between px-2" id="gender">
              <div>
                <input class="accent-green focus:outline-2 focus:outline-green peer"
                       type="radio"
                       id="genderMale"
                       name="gender"
                       value="male"
                       <?= getPostParam(Registration::GENDER_FORM_FIELD) === 'male' ? 'checked' : null?>>
                <label class="text-gray-dark cursor-pointer pl-0.5 peer-checked:text-green"
                       for="genderMale">Male</label>
              </div>
              <div>
                <input class="accent-green focus:outline-2 focus:outline-green peer"
                       type="radio"
                       id="genderFemale"
                       name="gender"
                       value="female"
                        <?= getPostParam(Registration::GENDER_FORM_FIELD) === 'female' ? 'checked' : null?>>
                <label class="text-gray-dark cursor-pointer pl-0.5 peer-checked:text-green"
                       for="genderFemale">Female</label>
              </div>
              <div>
                <input class="accent-green focus:outline-2 focus:outline-green peer"
                       type="radio"
                       id="genderOther"
                       name="gender"
                       value="other"
                       <?= getPostParam(Registration::GENDER_FORM_FIELD) === 'other' ? 'checked' : null?>>
                <label class="text-gray-dark cursor-pointer pl-0.5 peer-checked:text-green"
                       for="genderOther">Other</label>
              </div>
            </div>
            <?php printMessages($errors, Registration::GENDER_FORM_FIELD)?>
          </div>

          <div class="w-full mt-4">
            <label class="default-input__label" for="dateOfBirth">Date of Birth</label>
            <input class="default-input"
                   type="text"
                   id="dateOfBirth"
                   name="dateOfBirth"
                   value="<?= getPostParam(Registration::DATE_OF_BIRTH_FORM_FIELD)?>">
            <?php printMessages($errors, Registration::DATE_OF_BIRTH_FORM_FIELD)?>
          </div>

          <div class="w-full mt-4">
            <label class="default-input__label" for="height">Height (in cm)</label>
            <input class="default-input"
                   type="text"
                   id="height"
                   name="height"
                   value="<?= getPostParam(Registration::HEIGHT_FORM_FIELD)?>">
            <?php printMessages($errors, Registration::HEIGHT_FORM_FIELD)?>
          </div>

          <div class="w-full mt-4">
            <label class="default-input__label" for="weight">Weight (in kg)</label>
            <input class="default-input"
                   type="text"
                   id="weight"
                   name="weight"
                   value="<?= getPostParam(Registration::WEIGHT_FORM_FIELD)?>">
            <?php printMessages($errors, Registration::WEIGHT_FORM_FIELD)?>
          </div>
        </div>

        <div class="w-full" data-quest-panel="false" data-quest-step="nutrition">
          <div class="w-full">
            <label class=default-input__label for="nutritionType">Nutrition type</label>
            <select class="default-input" id="nutritionType" name="nutritionType">
              <option value="normal"
                      <?= getPostParam(Registration::NUTRITION_TYPE_FORM_FIELD) === 'normal' ? 'selected' : null?>>
                Normal
              </option>
              <option value="ketogenic"
                      <?= getPostParam(Registration::NUTRITION_TYPE_FORM_FIELD) === 'ketogenic' ? 'selected' : null?>>
                Ketogenic
              </option>
              <option value="lowCarb"
                      <?= getPostParam(Registration::NUTRITION_TYPE_FORM_FIELD) === 'lowCarb' ? 'selected' : null?>>
                Low carb
              </option>
              <option value="lowFat"
                      <?= getPostParam(Registration::NUTRITION_TYPE_FORM_FIELD) === 'lowFat' ? 'selected' : null?>>
                Low fat
              </option>
              <option value="highProtein"
                      <?= getPostParam(Registration::NUTRITION_TYPE_FORM_FIELD) === 'highProtein' ? 'selected' : null?>>
                High protein
              </option>
              <option value="manually"
                      <?= getPostParam(Registration::NUTRITION_TYPE_FORM_FIELD) === 'manually' ? 'selected' : null?>>
                Manually
              </option>
              <option value="dachReference"
                      <?= getPostParam(Registration::NUTRITION_TYPE_FORM_FIELD) === 'dachReference' ? 'selected' : null?>>
                D-A-CH Reference
              </option>
            </select>
            <?php printMessages($errors, Registration::NUTRITION_TYPE_FORM_FIELD)?>
          </div>
        </div>

        <div class="w-full" data-quest-panel="false" data-quest-step="preferences">
          <div class="w-full">
            <label class="default-input__label" for="preferences">Preferences</label>
            <input class="default-input" type="text" id="preferences" name="preferences">
          </div>
        </div>
      </div>

      <div class="w-full mt-8 ml-2">
        <div class="flex items-center">
          <input class="accent-green focus:outline-2 focus:outline-green"
                 type="checkbox"
                 id="tos"
                 name="tos"
                  <?= getPostParam(Registration::TOS_FORM_FIELD) ?? null === '1' ? 'checked' : null?>>
          <label class="cursor-pointer pl-2" for="tos">
            I agree to the
            <a class="text-green cursor-pointer hover:underline focus:underline focus:outline-none" href="#">
              Terms of Service.
            </a>
          </label>
        </div>
        <?php printMessages($errors, Registration::TOS_FORM_FIELD)?>
      </div>
      <button class="btn btn-primary mt-4" type="submit">Register</button>
      <span class="empty:hidden text-sm font-medium text-error"><?= $resultMessage ?? null?></span>
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
