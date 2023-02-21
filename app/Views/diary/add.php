<?php

use NutriScore\Models\Diary\TimeOfDay;

$messages = $messages ?? [];

getTemplatePart('head', ['title' => 'diary']);
getTemplatePart('header', ['active' => 'diary']);
?>

<div class="pt-16 lg:pt-0 lg:pl-60 h-full w-full">
  <section class="w-full border-b border-b-gray-200 flex justify-start bg-white">
    <div class="w-full flex justify-start items-center py-1 md:py-2 px-4 md:px-6 text-gray-400 max-w-2xl">
      <a class="flex hover:text-gray-700 transition-colors" href="#">
        <span class="material-icons text-2xl md:text-3xl">arrow_back</span>
      </a>
    </div>
  </section>
  <section class="w-full bg-gray-100 pb-20 md:pb-10 py-6 md:px-4">
    <?php getTemplatePart('global-messages', ['messages' => $messages]);?>

    <form class="w-full bg-white p-3 pb-10 md:rounded-md flex flex-col gap-4 shadow-border mb-6"
          method="post"
          action="/diary/add/<?=$diaryRecording->type->value?>/<?=$diaryRecording->id?>">
      <div class="border-b border-b-gray-200 pb-3 px-2">
        <h3 class="text-xl md:text-2xl text-gray-800"><?=ucfirst($diaryRecording->title)?></h3>
      </div>

      <div class="flex gap-4">
        <div class="flex flex-col">
          <span class="font-medium text-xl md:text-2xl text-gray-800"><?=$diaryRecording->calories?></span>
          <span class="text-sm text-gray-400"><?=_('Calories')?></span>
        </div>

        <div class="flex flex-col">
          <span class="font-medium text-xl md:text-2xl text-gray-800"><?=$diaryRecording->protein?></span>
          <span class="text-sm text-gray-400"><?=_('Protein')?></span>
        </div>

        <div class="flex flex-col">
          <span class="font-medium text-xl md:text-2xl text-gray-800"><?=$diaryRecording->carbohydrates?></span>
          <span class="text-sm text-gray-400"><?=_('Carbs')?></span>
        </div>

        <div class="flex flex-col">
          <span class="font-medium text-xl md:text-2xl text-gray-800"><?=$diaryRecording->fat?></span>
          <span class="text-sm text-gray-400"><?=_('Fat')?></span>
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
          <?php renderEnumSelectOptions(filter_input(INPUT_POST, 'timeOfDay') ?? null, TimeOfDay::cases())?>
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