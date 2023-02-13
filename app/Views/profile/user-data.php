<?php

use NutriScore\Enums\MessageType;
use NutriScore\Utils\Session;

getTemplatePart('head', ['title' => 'Profile']);
getTemplatePart('header', ['active' => 'profile']);

?>

<div class="pt-16 lg:pt-0 lg:pl-60 h-full w-full">
  <section class="w-full pb-10 bg-gradient-to-b from-gray-600 to-gray-800">
    <div class="sm:px-6 md:px-10 lg:px-20 py-8 md:py-10">
      <h3 class="px-6 md:pl-2 sm:text-2xl md:text-3xl font-medium sm:font-bold tracking-wide sm:tracking-tight text-gray-100">
        My Account Data
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
        My Account Data
      </h3>
      <div class="border-b border-b-gray-200 pb-3 mb-6"></div>
      <form method="post" action="/user/update">
        <div class="pb-8">
          <div class="flex flex-wrap gap-4 sm:gap-6 md:gap-8">
            <div class="basis-full sm:basis-1/3 md:basis-1/3 lg:basis-1/4">
              <label class="default-input__label" for="username">Username</label>
              <input class="default-input" type="text" id="username" name="username" value="<?=$user->getUsername()?>">
              <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
                <?php renderValidationFieldMessages( 'username', $errors ?? null); ?>
              </ul>
            </div>
            <div class="basis-full sm:basis-1/3 md:basis-1/3 lg:basis-1/4">
              <label class="default-input__label" for="email">E-Mail</label>
              <input class="default-input" type="text" id="email" name="email" value="<?=$user->getEmail()?>">
              <ul class="text-sm font-medium text-red-500 pl-2">
                <?php renderFieldErrors($errors ?? null, 'email'); ?>
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