<?php

use NutriScore\Utils\CSRFToken;

$messages = $messages ?? null;

getTemplatePart('head', ['title' => 'New Weight Recording', 'module' => 'weight']);
getTemplatePart('header', ['active' => '', 'previousPage' => '/profile']);

?>

<div class="pt-14 lg:pt-0 lg:pl-60 h-full w-full">
  <section class="w-full pb-10 bg-gradient-to-b from-gray-600 to-gray-800">
    <div class="sm:px-6 md:px-10 lg:px-20 py-8 md:py-10">
    </div>
  </section>

  <section class="w-full bg-gray-100 pb-20 md:pb-10 py-6 md:px-4">
    <?php getTemplatePart('global-messages', ['messages' => $messages]);?>
    <div class="bg-white md:rounded-md px-6 pt-4 py-6 shadow-border flex-grow basis-1/2 min-w-[300px]">
      <h3 class="font-medium text-gray-700 text-2xl tracking-tight sm:font-medium">
        <?=_('New Weight Recording')?>
      </h3>
      <div class="border-b border-b-gray-200 pb-3 mb-6"></div>
      <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="csrfToken" value="<?=CSRFToken::get()?>">
        <div class="pb-8">
          <div class="flex flex-wrap gap-4 sm:gap-6 md:gap-8">
            <div class="basis-full sm:basis-1/3 md:basis-1/4 lg:basis-1/6">
              <label class="default-input__label" for="weight"><?=_('Weight (in kg)')?></label>
              <input class="default-input" type="number" id="weight" name="weight">
              <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                <?php renderValidationFieldMessages('weight', $messages);?>
              </ul>
            </div>
            <div class="basis-full sm:basis-1/3 md:basis-1/4 lg:basis-1/6">
              <label class="default-input__label" for="dateOfRecording"><?=_('Date of recording')?></label>
              <input class="default-input"
                     type="date"
                     id="dateOfRecording"
                     name="dateOfRecording"
                      <?php renderRequestValue('dateOfRecording', altValue: date('Y-m-d'));?>
              >
              <ul class="text-sm font-medium text-red-500 pl-2">
                <?php renderValidationFieldMessages('dateOfRecording', $messages);?>
              </ul>
            </div>
          </div>

          <div class="mt-4 sm:mt-6 md:mt-8 flex flex-wrap gap-4 sm:gap-6 md:gap-8">
            <div class="basis-full sm:basis-1/2 md:basis-1/2 lg:basis-1/2 xl:basis-1/3">
              <label class="default-input__label" for="image">Upload Image</label>
              <input class="default-input block w-full border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-0
                      file:h-full file:border-none file:px-3 file:mr-4 file:cursor-pointer file:bg-gray-200
                      file:transition-colors file:hover:bg-gray-300 file:text-gray-700"
                     type="file"
                     accept="image/*"
                     id="image"
                     name="image">
              <ul class="text-sm font-medium text-red-500 pl-2">
                <?php renderValidationFieldMessages('file', $messages);?>
              </ul>
            </div>
            <div class="basis-full sm:basis-1/3 md:basis-1/3 lg:basis-1/4">
              <label class="default-input__label" for="imageDescription"><?=_('Image Description')?></label>
              <input class="default-input" type="text" id="imageDescription" name="imageDescription">
              <ul class="text-sm font-medium text-red-500 pl-2">
                <?php renderValidationFieldMessages('text', $messages);?>
              </ul>
            </div>
          </div>
        </div>


        <div class="pt-4 md:pt-6 flex flex-col sm:flex-row justify-between w-full border-t border-t-gray-200">
          <div class="flex gap-4 sm:gp-6 md:gap-8">
            <a href="/profile" class="btn btn-default justify-center items-center hidden lg:flex">
              <?=_('Cancel')?>
            </a>
            <button class="btn btn-primary" type="submit"><?=_('Save')?></button>
          </div>
          <div></div>
        </div>
      </form>
    </div>
  </section>
</div>