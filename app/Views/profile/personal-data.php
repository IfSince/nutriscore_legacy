<?php

use NutriScore\Models\Person\Gender;

$messages = $messages ?? [];

getTemplatePart('head', ['title' => 'Profile']);
getTemplatePart('header', ['active' => 'profile', 'previousPage' => '/profile']);
?>

<div class="pt-14 lg:pt-0 lg:pl-60 h-full w-full">
  <section class="w-full bg-gradient-to-b from-gray-600 to-gray-800 pb-10">
    <div class="sm:px-6 md:px-10 lg:px-20 py-8 md:py-10">
      <h3 class="px-6 md:pl-2 sm:text-2xl md:text-3xl font-medium sm:font-bold tracking-wide sm:tracking-tight text-gray-100">
        <?=_('Personal Data')?>
      </h3>
    </div>
  </section>

  <section class="w-full bg-gray-100 pb-20 md:pb-10 py-6 md:px-4">
    <?php getTemplatePart('global-messages', ['messages' => $messages]);?>
    <div class="bg-white md:rounded-md px-6 pt-4 py-6 shadow-border flex-grow basis-1/2 min-w-[300px]">
      <h3 class="font-medium text-gray-700 text-2xl tracking-tight sm:font-medium">
        <?=_('My Personal Data')?>
      </h3>
      <div class="border-b border-b-gray-200 pb-3 mb-6"></div>
      <form method="post" action="/person/save/<?=$person->getId()?>">
        <div class="pb-8">
          <div class="flex flex-wrap gap-4 sm:gap-6">
            <div class="basis-full sm:basis-1/3 md:basis-1/3 lg:basis-1/4">
              <label class="default-input__label" for="firstName"><?=_('First name')?></label>
              <input class="default-input" type="text" id="firstName" name="firstName" value="<?=$person->getFirstName()?>">
              <ul class="text-sm font-medium text-red-500 pl-2">
                <?php renderValidationFieldMessages('firstName', $messages);?>
              </ul>
            </div>
            <div class="basis-full sm:basis-1/3 md:basis-1/3 lg:basis-1/4">
              <label class="default-input__label" for="surname"><?=_('Surname')?></label>
              <input class="default-input" type="text" id="surname" name="surname" value="<?=$person->getSurname()?>">
              <ul class="text-sm font-medium text-red-500 pl-2">
                <?php renderValidationFieldMessages('surname', $messages);?>
              </ul>
            </div>
          </div>

          <div class="flex mt-4 sm:mt-6 md:mt-8 flex-wrap gap-4 sm:gap-6 md:gap-8">
            <div class="basis-full sm:basis-1/4 md:basis-1/6 lg:basis-1/8">
              <label class="default-input__label" for="gender"><?=_('Gender')?></label>
              <select class="default-input" name="gender" id="gender">
                <?php renderEnumSelectOptions($person->getGender() ?? null, Gender::cases())?>
              </select>
              <ul class="text-sm font-medium text-red-500 pl-2">
                <?php renderValidationFieldMessages('gender', $messages);?>
              </ul>
            </div>

            <div class="basis-full sm:basis-1/4 md:basis-1/5 lg:basis-1/5">
              <label class="default-input__label" for="dateOfBirth"><?=_('Date of Birth')?></label>
              <input class="default-input" type="date" name="dateOfBirth" id="dateOfBirth" value="<?=$person->getDateOfBirth()?>">
              <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                <?php renderValidationFieldMessages('dateOfBirth', $messages);?>
              </ul>
            </div>

            <div class="basis-full sm:basis-1/4 md:basis-1/6 lg:basis-1/8">
              <label class="default-input__label" for="height"><?=_('Height (in cm)')?></label>
              <input class="default-input" type="number" name="height" id="height" value="<?=$person->getHeight()?>">
              <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                <?php renderValidationFieldMessages('height', $messages);?>
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