<?php

use NutriScore\Models\Person\ActivityLevel;
use NutriScore\Models\Person\BmrCalculationType;
use NutriScore\Models\Person\Goal;
use NutriScore\Models\Person\NutritionType;

$messages = $messages ?? [];

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
    <?php getTemplatePart('global-messages', ['messages' => $messages]);?>
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
                <?php renderEnumSelectOptions($person->getNutritionType() ?? null, NutritionType::cases())?>
              </select>
              <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                <?php renderValidationFieldMessages('nutritionType', $messages);?>
              </ul>
            </div>
            <div class="basis-full md:basis-1/2 lg:basis-2/3 xl:basis-1/2 2xl:basis-1/3 flex flex-row gap-4 sm:gap-6 md:gap-8">
              <div class="basis-full md:basis-1/3">
                <label class="default-input__label" for="protein">Protein</label>
                <input class="default-input" type="number" name="protein" id="protein" <?php renderPostValue('protein');?>>
                <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                  <?php renderValidationFieldMessages('protein', $messages);?>
                </ul>
              </div>

              <div class="basis-full md:basis-1/3">
                <label class="default-input__label" for="carbohydrates">Carbs</label>
                <input class="default-input" type="number" name="carbohydrates" id="carbohydrates" <?php renderPostValue('carbohydrates');?>>
                <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                  <?php renderValidationFieldMessages('carbohydrates', $messages);?>
                </ul>
              </div>

              <div class="basis-full md:basis-1/3">
                <label class="default-input__label" for="fat">Fat</label>
                <input class="default-input" type="number" name="fat" id="fat" <?php renderPostValue('fat');?>>
                <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                  <?php renderValidationFieldMessages('fat', $messages);?>
                </ul>
              </div>
            </div>
          </div>

          <div class="flex mt-4 sm:mt-6 md:mt-8 flex-wrap gap-4 sm:gap-6 md:gap-8">
            <div class="basis-full md:basis-1/2 lg:basis-2/3 xl:basis-2/3 2xl:basis-1/2 flex flex-row gap-4 sm:gap-6 md:gap-8">
              <div class="basis-full sm:basis-1/2 md:basis-1/2 lg:basis-1/2 2xl:basis-1/4 sm:grow-[3] md:grow-[2]">
                <label class=default-input__label for="activityLevel">Activity Level</label>
                <select class="default-input" name="activityLevel" id="activityLevel">
                  <?php renderEnumSelectOptions($person->getActivityLevel() ?? null, ActivityLevel::cases())?>
                </select>
                <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                  <?php renderValidationFieldMessages('activityLevel', $messages);?>
                </ul>
              </div>

              <div class="basis-2/5 md:basis-1/4 lg:basis-1/4 2xl:basis-1/6 grow">
                <label class="default-input__label" for="palLevel">PAL Level</label>
                <input class="default-input" type="number" name="palLevel" id="palLevel" <?php renderPostValue('palLevel');?>>
                <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                  <?php renderValidationFieldMessages('palLevel', $messages);?>
                </ul>
              </div>
            </div>
          </div>

          <div class="flex mt-4 sm:mt-6 md:mt-8 flex-wrap gap-4 sm:gap-6 md:gap-8">
            <div class="basis-full sm:basis-5/12 md:basis-1/3 lg:basis-1/4 2xl:basis-1/4">
              <label class=default-input__label for="bmrCalculationType">BMR Calculation Type</label>
              <select class="default-input" name="bmrCalculationType" id="bmrCalculationType">
                <?php renderEnumSelectOptions($person->getBmrCalculationType() ?? null, BmrCalculationType::cases())?>
              </select>
              <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                <?php renderValidationFieldMessages('bmrCalculationType', $messages);?>
              </ul>
            </div>
            <div class="basis-full sm:basis-5/12 md:basis-1/3 lg:basis-1/4 2xl:basis-1/4">
              <label class=default-input__label for="goal">Objective</label>
              <select class="default-input" name="goal" id="goal" <?php renderPostValue('goal');?>>
                <?php renderEnumSelectOptions($person->getGoal() ?? null, Goal::cases())?>
              </select>
              <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                <?php renderValidationFieldMessages('goal', $messages);?>
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