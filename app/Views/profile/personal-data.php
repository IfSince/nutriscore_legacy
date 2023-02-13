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
        Personal Data
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
        My Personal Data
      </h3>
      <div class="border-b border-b-gray-200 pb-3 mb-6"></div>
      <form method="post">
        <div class="pb-8">
          <div class="flex flex-wrap gap-4 sm:gap-6">
            <div class="basis-full sm:basis-1/3 md:basis-1/3 lg:basis-1/4">
              <label class="default-input__label" for="firstName">First name</label>
              <input class="default-input" type="text" id="firstName" name="firstName">
              <ul class="text-sm font-medium text-red-500 pl-2">
                <?php renderFieldErrors($errors ?? null, 'firstName'); ?>
              </ul>
            </div>
            <div class="basis-full sm:basis-1/3 md:basis-1/3 lg:basis-1/4">
              <label class="default-input__label" for="surname">Surname</label>
              <input class="default-input" type="text" id="surname" name="surname">
              <ul class="text-sm font-medium text-red-500 pl-2">
                <?php renderFieldErrors($errors ?? null, 'surname'); ?>
              </ul>
            </div>
          </div>

          <div class="flex mt-4 sm:mt-6 md:mt-8 flex-wrap gap-4 sm:gap-6 md:gap-8">
            <div class="basis-full sm:basis-1/4 md:basis-1/6 lg:basis-1/8">
              <label class="default-input__label" for="gender">Gender</label>
              <select class="default-input" name="gender" id="gender">
                <option value="MALE" <?php renderSelectedByValue('gender', 'MALE');?>>Male</option>
                <option value="FEMALE" <?php renderSelectedByValue('gender', 'FEMALE');?>>Female</option>
                <option value="OTHER" <?php renderSelectedByValue('gender', 'OTHER');?>>Other</option>
              </select>
              <ul class="text-sm font-medium text-red-500 pl-2">
                <?php renderFieldErrors($errors ?? null, 'gender'); ?>
              </ul>
            </div>

            <div class="basis-full sm:basis-1/4 md:basis-1/5 lg:basis-1/5">
              <label class="default-input__label" for="dateOfBirth">Date of Birth</label>
              <input class="default-input" type="date" name="dateOfBirth" id="dateOfBirth" <?php renderValue('dateOfBirth');?>>
              <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                <?php renderFieldErrors($errors ?? null, 'dateOfBirth'); ?>
              </ul>
            </div>

            <div class="basis-full md:basis-1/2 flex flex-row gap-4 sm:gap-6 md:gap-8">
              <div class="basis-full sm:basis-1/4 md:basis-1/6 lg:basis-1/8">
                <label class="default-input__label" for="height">Height (in cm)</label>
                <input class="default-input" type="number" name="height" id="height" <?php renderValue('height');?>>
                <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                  <?php renderFieldErrors($errors ?? null, 'height'); ?>
                </ul>
              </div>

              <div class="basis-full sm:basis-1/4 md:basis-1/6 lg:basis-1/8">
                <label class="default-input__label" for="weight">Weight (in kg)</label>
                <input class="default-input" type="number" name="weight" id="weight" <?php renderValue('weight');?>>
                <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                  <?php renderFieldErrors($errors ?? null, 'weight'); ?>
                </ul>
              </div>
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