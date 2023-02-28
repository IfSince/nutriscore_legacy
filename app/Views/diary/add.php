<?php

use NutriScore\Models\Diary\TimeOfDay;
use NutriScore\Utils\CSRFToken;

$messages = $messages ?? [];

getTemplatePart('head', ['title' => 'diary', 'module' => 'diary-add']);
getTemplatePart('header', ['active' => 'diary', 'previousPage' => '/diary/search']);
?>

<div class="pt-16 lg:pt-0 lg:pl-60 h-full w-full">
  <section class="w-full bg-gray-100 pb-20 md:pb-10 py-6 md:px-4">
    <?php getTemplatePart('global-messages', ['messages' => $messages]);?>

    <form class="w-full bg-white p-3 pb-10 md:rounded-md flex flex-col gap-4 shadow-border mb-6"
          method="post"
          action="/diary/add/<?=$diaryRecording->type->value?>/<?=$diaryRecording->id?>?csrfToken=<?=CSRFToken::get()?>">
      <div class="border-b border-b-gray-200 pb-3 px-2">
        <h3 class="text-xl md:text-2xl text-gray-800">Add <?=ucfirst($diaryRecording->title)?></h3>
      </div>

      <div class="flex justify-center lg:justify-start flex-wrap gap-x-2 gap-y-4">
        <div class="flex flex-col items-center">
          <div class="flex justify-center items-center relative w-28 h-28">
            <div class="flex flex-col text-center text-gray-500">
              <span class="font-medium text-2xl"><?=$diaryRecording->calories?></span>
            </div>
            <svg class="w-full h-full absolute stroke-[8] stroke-round fill-none">
              <circle r="40" cx="50%" cy="50%" class="stroke-green/30"></circle>
              <circle class="stroke-green transition-all ease-fill duration-500"
                      id="calorieIntake"
                      data-percentage="100"
                      r="40" cx="50%" cy="50%"></circle>
            </svg>
          </div>
          <span class="text-sm font-medium tracking-wide"><?=_('Calories')?></span>
        </div>

        <div class="flex flex-col items-center">
          <div class="flex justify-center items-center relative w-28 h-28">
            <div class="flex flex-col text-center text-gray-500">
              <span class="font-medium text-2xl"><?=$diaryRecording->protein?></span>
            </div>
            <svg class="w-full h-full absolute stroke-[8] stroke-round fill-none">
              <circle r="40" cx="50%" cy="50%" class="stroke-green/30"></circle>
              <circle class="stroke-green transition-all ease-fill duration-500"
                      id="calorieIntake"
                      data-percentage="<?=$diaryRecording->protein / ($diaryRecording->protein + $diaryRecording->carbohydrates + $diaryRecording->fat) * 100?>"
                      r="40" cx="50%" cy="50%"></circle>
            </svg>
          </div>
          <span class="text-sm font-medium tracking-wide"><?=_('Protein')?></span>
        </div>

        <div class="flex flex-col items-center">
          <div class="flex justify-center items-center relative w-28 h-28">
            <div class="flex flex-col text-center text-gray-500">
              <span class="font-medium text-2xl"><?=$diaryRecording->carbohydrates?></span>
            </div>
            <svg class="w-full h-full absolute stroke-[8] stroke-round fill-none">
              <circle r="40" cx="50%" cy="50%" class="stroke-blue/30"></circle>
              <circle class="stroke-blue transition-all ease-fill duration-500"
                      id="calorieIntake"
                      data-percentage="<?=$diaryRecording->carbohydrates / ($diaryRecording->protein + $diaryRecording->carbohydrates + $diaryRecording->fat) * 100?>"
                      r="40" cx="50%" cy="50%"></circle>
            </svg>
          </div>
          <span class="text-sm font-medium tracking-wide"><?=_('Carbohydrates')?></span>
        </div>

        <div class="flex flex-col items-center">
          <div class="flex justify-center items-center relative w-28 h-28">
            <div class="flex flex-col text-center text-gray-500">
              <span class="font-medium text-2xl"><?=$diaryRecording->fat?></span>
            </div>
            <svg class="w-full h-full absolute stroke-[8] stroke-round fill-none">
              <circle r="40" cx="50%" cy="50%" class="stroke-orange/30"></circle>
              <circle class="stroke-orange transition-all ease-fill duration-500"
                      id="calorieIntake"
                      data-percentage="<?=$diaryRecording->fat / ($diaryRecording->protein + $diaryRecording->carbohydrates + $diaryRecording->fat) * 100?>"
                      r="40" cx="50%" cy="50%"></circle>
            </svg>
          </div>
          <span class="text-sm font-medium tracking-wide"><?=_('Fat')?></span>
        </div>
      </div>


      <div>
        <label class="default-input__label" for="amount"><?=_('Amount')?></label>
        <input class="default-input" type="number" name="amount" id="amount" <?php renderRequestValue('amount', altValue: 1);?>>
        <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
          <?php renderValidationFieldMessages('amount', $messages);?>
        </ul>
      </div>

      <div>
        <label class="default-input__label" for="dateOfRecording"><?=_('Date of recording')?></label>
        <input class="default-input" type="date" name="dateOfRecording" id="dateOfRecording" <?php renderRequestValue('dateOfRecording', altValue: date('Y-m-d'));?>>
        <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
          <?php renderValidationFieldMessages('dateOfRecording', $messages);?>
        </ul>
      </div>

      <div>
        <label class=default-input__label for="timeOfDay"><?=_('Time of day')?></label>
        <select class="default-input" name="timeOfDay" id="timeOfDay">
          <?php renderEnumSelectOptions(filter_input(INPUT_POST, 'timeOfDay') ?? TimeOfDay::BREAKFAST, TimeOfDay::class)?>
        </select>
        <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
          <?php renderValidationFieldMessages('timeOfDay', $messages);?>
        </ul>
      </div>

      <div class="pt-4 md:pt-6 flex flex-col sm:flex-row justify-between w-full">
        <div>
          <button class="btn btn-primary" type="submit"><?=_('Add to diary')?></button>
        </div>
        <div></div>
      </div>

    </form>

  </section>
</div>