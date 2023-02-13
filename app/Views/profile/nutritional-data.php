<?php

use NutriScore\Enums\MessageType;
use NutriScore\Utils\Session;

getTemplatePart('head', ['title' => 'Profile']);
getTemplatePart('header', ['active' => 'profile']);
?>

<div class="pt-16 lg:pt-0 lg:pl-60 h-full w-full">
  <section class="w-full bg-gradient-to-b from-gray-600 to-gray-800 pb-10">
    <div class="sm:px-6 md:px-10 lg:px-20 py-8 md:py-10">
      <h3 class="px-6 md:pl-2 sm:text-2xl md:text-3xl font-medium sm:font-bold tracking-wide sm:tracking-tight text-gray-100">
        Nutritional Data
      </h3>
    </div>
  </section>

  <section class="w-full bg-gray-100 pb-20 md:pb-10 py-6 md:px-4">
    <?php if(!empty($errors['root']) || !empty($warnings['root']) || !empty($hints['root']) || !empty($success['root']) ||
            Session::hasFlashMessages()): ?>
      <?php getTemplatePart(
              'global-messages',
              [
                      'errors' => array_merge($errors['root'] ?? [], Session::getFlashMessagesByType(MessageType::ERROR)),
                      'warnings' => array_merge($warnings['root'] ?? [], Session::getFlashMessagesByType(MessageType::WARNING)),
                      'hints' => array_merge($hints['root'] ?? [], Session::getFlashMessagesByType(MessageType::HINT)),
                      'success' => array_merge($success['root'] ?? [], Session::getFlashMessagesByType(MessageType::SUCCESS))
              ]
      );?>
    <?php endif;?>
    <div class="bg-white md:rounded-md px-6 pt-4 py-6 shadow-border flex-grow basis-1/2 min-w-[300px]">
      <h3 class="font-medium text-gray-700 text-2xl tracking-tight sm:font-medium">
        My Nutritional Data
      </h3>
      <div class="border-b border-b-gray-200 pb-3 mb-6"></div>
      <form method="post">
        <div class="pb-8">
          <div class="flex flex-wrap gap-4 sm:gap-6 md:gap-8">
            <div class="basis-full sm:basis-1/2 md:basis-1/3 lg:basis-1/4">
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
                <?php renderFieldErrors($errors ?? null, 'nutritionType'); ?>
              </ul>
            </div>
            <div class="basis-full md:basis-1/2 lg:basis-2/3 xl:basis-1/2 2xl:basis-1/3 flex flex-row gap-4 sm:gap-6 md:gap-8">
              <div class="basis-full md:basis-1/3">
                <label class="default-input__label" for="protein">Protein</label>
                <input class="default-input" type="number" name="protein" id="protein" <?php renderValue('protein');?>>
                <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                  <?php renderFieldErrors($errors ?? null, 'protein'); ?>
                </ul>
              </div>

              <div class="basis-full md:basis-1/3">
                <label class="default-input__label" for="carbohydrates">Carbs</label>
                <input class="default-input" type="number" name="carbohydrates" id="carbohydrates" <?php renderValue('carbohydrates');?>>
                <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                  <?php renderFieldErrors($errors ?? null, 'carbohydrates'); ?>
                </ul>
              </div>

              <div class="basis-full md:basis-1/3">
                <label class="default-input__label" for="fat">Fat</label>
                <input class="default-input" type="number" name="fat" id="fat" <?php renderValue('fat');?>>
                <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                  <?php renderFieldErrors($errors ?? null, 'fat'); ?>
                </ul>
              </div>
            </div>
          </div>

          <div class="flex mt-4 sm:mt-6 md:mt-8 flex-wrap gap-4 sm:gap-6 md:gap-8">
            <div class="basis-full md:basis-1/2 lg:basis-2/3 xl:basis-2/3 2xl:basis-1/2 flex flex-row gap-4 sm:gap-6 md:gap-8">
              <div class="basis-full sm:basis-1/2 md:basis-1/2 lg:basis-1/2 2xl:basis-1/4 sm:grow-[3] md:grow-[2]">
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
                  <?php renderFieldErrors($errors ?? null, 'activityLevel'); ?>
                </ul>
              </div>

              <div class="basis-2/5 md:basis-1/4 lg:basis-1/4 2xl:basis-1/6 grow">
                <label class="default-input__label" for="palLevel">PAL Level</label>
                <input class="default-input" type="number" name="palLevel" id="palLevel" <?php renderValue('palLevel');?>>
                <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                  <?php renderFieldErrors($errors ?? null, 'palLevel'); ?>
                </ul>
              </div>
            </div>
          </div>

          <div class="flex mt-4 sm:mt-6 md:mt-8 flex-wrap gap-4 sm:gap-6 md:gap-8">
            <div class="basis-full sm:basis-5/12 md:basis-1/3 lg:basis-1/4 2xl:basis-1/4">
              <label class=default-input__label for="bmrCalculationType">BMR Calculation Type</label>
              <select class="default-input" name="bmrCalculationType" id="bmrCalculationType">
                <option value="EASY" <?php renderSelectedByValue('bmrCalculationType', 'EASY');?>>Easy</option>
                <option value="COMPLICATED" <?php renderSelectedByValue('bmrCalculationType', 'COMPLICATED');?>>Complicated</option>
                <option value="HARRIS_BENEDICT" <?php renderSelectedByValue('bmrCalculationType', 'HARRIS_BENEDICT');?>>Harris Benedict</option>
                <option value="MIFFLIN_ST_JEOR" <?php renderSelectedByValue('bmrCalculationType', 'MIFFLIN_ST_JEOR');?>>Mifflin-St. Jeor</option>
              </select>
              <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                <?php renderFieldErrors($errors ?? null, 'bmrCalculationType'); ?>
              </ul>
            </div>
            <div class="basis-full sm:basis-5/12 md:basis-1/3 lg:basis-1/4 2xl:basis-1/4">
              <label class=default-input__label for="goal">Objective</label>
              <select class="default-input" name="goal" id="goal" <?php renderValue('goal');?>>
                <option value="KEEP">Keep weight</option>
                <option value="LOOSE">Loose weight</option>
                <option value="GAIN">Gain weight</option>
              </select>
              <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                <?php renderFieldErrors($errors ?? null, 'goal'); ?>
              </ul>
            </div>
          </div>
        </div>

        <div class="pt-4 md:pt-6 flex flex-col sm:flex-row justify-between w-full border-t border-t-gray-200">
          <div>
            <button class="btn btn-primary" type="submit">Save</button>
          </div>
          <div></div>
        </div>
      </form>
    </div>
  </section>

</div>