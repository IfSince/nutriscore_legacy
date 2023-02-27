<?php

use NutriScore\Models\Diary\DiaryRecording;
use NutriScore\Models\Diary\TimeOfDay;
use NutriScore\Services\PersonCalculationService;

$messages = $messages = [];

$breakFastRecordings = array_filter($diaryRecordings ?? [], fn(DiaryRecording $recording) => $recording->timeOfDay === TimeOfDay::BREAKFAST);
$lunchRecordings = array_filter($diaryRecordings ?? [], fn(DiaryRecording $recording) => $recording->timeOfDay === TimeOfDay::LUNCH);
$dinnerRecordings = array_filter($diaryRecordings ?? [], fn(DiaryRecording $recording) => $recording->timeOfDay === TimeOfDay::DINNER);
$snacksRecordings = array_filter($diaryRecordings ?? [], fn(DiaryRecording $recording) => $recording->timeOfDay === TimeOfDay::SNACKS);
getTemplatePart('head', ['title' => 'diary', 'module' => 'diary']);
getTemplatePart('header', ['active' => 'diary']);
?>

<script>
  const data = '<?=json_encode($diaryRecordings)?>';
  const recordingData = JSON.parse(data);

  const personData = '<?=json_encode($personDTO)?>';
  const personDTO = JSON.parse(personData);
</script>

<div class="pt-14 lg:pt-0 lg:pl-60 h-full w-full">
  <section class="px-6 py-4 lg:pt-16 lg:pb-10 flex justify-center items-center bg-gradient-to-b from-gray-600 to-gray-800 relative">
    <div class="flex justify-center items-center relative w-48 h-48">
      <div class="flex flex-col text-center gap-1 pt-2 text-white/70">
        <span class="font-medium text-4xl" id="calorieIntakeNumber">0</span>
        <span class="font-medium">kcal</span>
      </div>
      <svg class="w-full h-full absolute stroke-[12] stroke-round fill-none">
        <circle r="80" cx="50%" cy="50%" class="stroke-green/30"></circle>
        <circle r="80" cx="50%" cy="50%" class="stroke-green transition-all ease-fill duration-500" data-percentage="10" id="calorieIntake"></circle>
      </svg>
    </div>
  </section>

  <?php getTemplatePart('date-selector');?>
  <section class="w-full bg-gray-100 pb-20 md:pb-10 py-6 md:px-4">
    <?php getTemplatePart('global-messages', ['messages' => $messages]);?>
    <div class="flex flex-col lg:flex-row">
      <div class="flex flex-col lg:flex-row lg:flex-wrap flex-grow basis-4/6 h-fit">
        <div class="w-full flex flex-col 2xl:flex-row gap-8 pb-8">
          <div class="bg-white md:rounded-md px-2 py-4 shadow-border flex-grow basis-1/2 min-w-[300px]">
            <div class="border-b border-b-gray-200 pb-3 px-2 flex justify-between items-center">
              <h3 class="text-xl md:text-2xl text-gray-800"><?=_('Breakfast')?></h3>
              <a class="text-white bg-green outline-none transition-colors font-medium rounded-full text-sm p-1.5 sm:p-2.5 text-center
                      inline-flex items-center mr-2 sm:mr-4 hover:bg-green-dark focus:outline focus:border-green-dark"
                 href="/diary/search">
                <span class="w-4 h-4 material-icons text-lg">add</span>
                <span class="sr-only">Icon description</span>
              </a>
            </div>
            <div class="relative overflow-x-auto pt-4">
              <table class="w-full text-sm text-left text-gray-500" aria-label="Search results">
                <thead>
                  <tr>
                    <th class="block px-2" scope="col"><?=_('Title')?></th>
                    <th scope="col"><?=_('Amount')?></th>
                    <th scope="col"><?=_('Calories')?></th>
                    <th scope="col"><?=_('Protein')?></th>
                    <th scope="col"><?=_('Carbs')?></th>
                    <th scope="col"><?=_('Fat')?></th>
                  </tr>
                </thead>
                <tbody id="breakfastContainer"></tbody>
              </table>
            </div>
          </div>

          <div class="bg-white md:rounded-md px-2 py-4 shadow-border flex-grow basis-1/2 min-w-[300px]">
            <div class="border-b border-b-gray-200 pb-3 px-2 flex justify-between items-center">
              <h3 class="text-xl md:text-2xl text-gray-800"><?=_('Lunch')?></h3>
              <a class="text-white bg-green outline-none transition-colors font-medium rounded-full text-sm p-1.5 sm:p-2.5 text-center
                      inline-flex items-center mr-2 sm:mr-4 hover:bg-green-dark focus:outline focus:border-green-dark"
                 href="/diary/search">
                <span class="w-4 h-4 material-icons text-lg">add</span>
                <span class="sr-only">Icon description</span>
              </a>
            </div>
            <div class="relative overflow-x-auto pt-4">
              <table class="w-full text-sm text-left text-gray-500" aria-label="Search results">
                <thead>
                  <tr>
                    <th class="block px-2" scope="col"><?=_('Title')?></th>
                    <th scope="col"><?=_('Amount')?></th>
                    <th scope="col"><?=_('Calories')?></th>
                    <th scope="col"><?=_('Protein')?></th>
                    <th scope="col"><?=_('Carbs')?></th>
                    <th scope="col"><?=_('Fat')?></th>
                  </tr>
                </thead>
                <tbody id="lunchContainer"></tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="w-full flex flex-col 2xl:flex-row gap-8">
          <div class="bg-white md:rounded-md px-2 py-4 shadow-border lg:basis-1/2 min-w-[300px]">
            <div class="border-b border-b-gray-200 pb-3 px-2 flex justify-between items-center">
              <h3 class="text-xl md:text-2xl text-gray-800"><?=_('Dinner')?></h3>
              <a class="text-white bg-green outline-none transition-colors font-medium rounded-full text-sm p-1.5 sm:p-2.5 text-center
                      inline-flex items-center mr-2 sm:mr-4 hover:bg-green-dark focus:outline focus:border-green-dark"
                 href="/diary/search">
                <span class="w-4 h-4 material-icons text-lg">add</span>
                <span class="sr-only">Icon description</span>
              </a>
            </div>
            <div class="relative overflow-x-auto pt-4">
              <table class="w-full text-sm text-left text-gray-500" aria-label="Search results">
                <thead>
                  <tr>
                    <th class="block px-2" scope="col"><?=_('Title')?></th>
                    <th scope="col"><?=_('Amount')?></th>
                    <th scope="col"><?=_('Calories')?></th>
                    <th scope="col"><?=_('Protein')?></th>
                    <th scope="col"><?=_('Carbs')?></th>
                    <th scope="col"><?=_('Fat')?></th>
                  </tr>
                </thead>
                <tbody id="dinnerContainer"></tbody>
              </table>
            </div>
          </div>

          <div class="bg-white md:rounded-md px-2 py-4 shadow-border lg:basis-1/2 min-w-[300px]">
            <div class="border-b border-b-gray-200 pb-3 px-2 flex justify-between items-center">
              <h3 class="text-xl md:text-2xl text-gray-800"><?=_('Snacks')?></h3>
              <a class="text-white bg-green outline-none transition-colors font-medium rounded-full text-sm p-1.5 sm:p-2.5 text-center
                      inline-flex items-center mr-2 sm:mr-4 hover:bg-green-dark focus:outline focus:border-green-dark"
                 href="/diary/search">
                <span class="w-4 h-4 material-icons text-lg">add</span>
                <span class="sr-only">Icon description</span>
              </a>
            </div>
            <div class="relative overflow-x-auto pt-4">
              <table class="w-full text-sm text-left text-gray-500" aria-label="Search results">
                <thead>
                  <tr>
                    <th class="block px-2" scope="col"><?=_('Title')?></th>
                    <th scope="col"><?=_('Amount')?></th>
                    <th scope="col"><?=_('Calories')?></th>
                    <th scope="col"><?=_('Protein')?></th>
                    <th scope="col"><?=_('Carbs')?></th>
                    <th scope="col"><?=_('Fat')?></th>
                  </tr>
                </thead>
                <tbody id="snacksContainer"></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="lg:px-4 mt-8 md:mt-12 lg:mt-0 flex flex-col gap-6 h-fit flex-grow basis-1/6">
        <div class="bg-white md:rounded-md px-2 py-4 pb-8 shadow-border flex-grow min-w-[250px]">
          <div class="border-b border-b-gray-200 pb-3 px-2">
            <h3 class="text-xl md:text-2xl text-gray-800"><?=_('Macros')?></h3>
          </div>
          <div class="pt-2 px-4 flex flex-col gap-2">
            <div class="pt-2 flex flex-col">
              <div class="flex w-full justify-between pl-1 pr-2 text-sm">
                <span class="font-medium"><?=_('Protein')?></span>
                <span>
                  <span id="proteinIntake">0</span>g
                  /<span class="font-medium"><?=$personDTO->proteinIntake?>g</span>
                </span>
              </div>
              <div class="px-3 py-2 flex relative">
                <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                <span class="bg-green rounded-lg absolute top-0 left-0 h-full transition-all ease-fill duration-500" id="proteinIntakePercentage"></span>
              </div>
            </div>
            <div class="pt-2 flex flex-col">
              <div class="flex w-full justify-between pl-1 pr-2 text-sm">
                <span class="font-medium"><?=_('Carbohydrates')?></span>
                <span class="overflow-hidden">
                  <span id="carbohydratesIntake">0</span>g
                  /<span class="font-medium"><?=$personDTO->carbohydratesIntake?>g</span>
                </span>
              </div>
              <div class="px-3 py-2 flex relative">
                <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                <span class="bg-blue rounded-lg absolute top-0 left-0 h-full transition-all ease-fill duration-500"
                      id="carbohydratesIntakePercentage"></span>
              </div>
            </div>
            <div class="pt-2 flex flex-col">
              <div class="flex w-full justify-between pl-1 pr-2 text-sm">
                <span class="font-medium"><?=_('Fat')?></span>
                <span>
                  <span id="fatIntake">0</span>g
                  /<span class="font-medium"><?=$personDTO->fatIntake?>g</span>
                </span>
              </div>
              <div class="px-3 py-2 flex relative">
                <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                <span class="bg-orange rounded-lg absolute top-0 left-0 h-full transition-all ease-fill duration-500" id="fatIntakePercentage"></span>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white md:rounded-md px-2 pt-4 pb-8 shadow-border flex-grow min-w-[250px]">
          <div class="border-b border-b-gray-200 pb-3 px-2">
            <h3 class="text-xl md:text-2xl text-gray-800"><?=_('Vitamins')?></h3>
          </div>
          <div class="pt-2 px-4 flex flex-col gap-2">
            <div class="flex w-full gap-6">
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Retinol')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Tocopherol')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
            </div>

            <div class="flex w-full gap-6">
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Thiamin')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Riboflavin')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
            </div>

            <div class="flex w-full gap-6">
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Niacin')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Pyridoxin')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
            </div>

            <div class="flex w-full gap-6">
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Ascorbinsäure')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Vitamin D')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
            </div>

            <div class="flex w-full gap-6">
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Vitamin K')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Folat')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
            </div>

            <div class="flex w-full gap-6">
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Panthothensäure')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Biotin')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
            </div>

            <div class="flex w-full gap-6">
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Vitamin B12')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white md:rounded-md px-2 pt-4 pb-8 shadow-border flex-grow min-w-[250px]">
          <div class="border-b border-b-gray-200 pb-3 px-2">
            <h3 class="text-2xl text-gray-800"><?=_('Minerals')?></h3>
          </div>
          <div class="pt-2 px-4 flex flex-col gap-2">
            <div class="flex w-full gap-6">
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Sodium')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Potassium')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
            </div>

            <div class="flex w-full gap-6">
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Calcium')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Phosphor')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
            </div>

            <div class="flex w-full gap-6">
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Magnesium')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Iron')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
            </div>

            <div class="flex w-full gap-6">
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Chlorid')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Iod')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
            </div>

            <div class="flex w-full gap-6">
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Fluoride')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Zinc')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
            </div>

            <div class="flex w-full gap-6">
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Selenium')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Copper')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
            </div>

            <div class="flex w-full gap-6">
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Manganese')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Chrome')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
            </div>

            <div class="flex w-full gap-6">
              <div class="pt-2 flex flex-col basis-1/2">
                <span class="pl-1 text-sm font-medium"><?=_('Molybdenum')?></span>
                <div class="px-3 py-2 flex relative">
                  <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                  <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>