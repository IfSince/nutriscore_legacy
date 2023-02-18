<?php

use NutriScore\Enums\MessageType;
use NutriScore\Utils\Session;

$messages = $messages ?? [];
$errors = array_merge(
        getValidationFieldMessagesByType('root', $messages, MessageType::ERROR),
        Session::getFlashMessagesByType(MessageType::ERROR)
);

$warnings = array_merge(
        getValidationFieldMessagesByType('root', $messages, MessageType::WARNING),
        Session::getFlashMessagesByType(MessageType::WARNING)
);

$hints = array_merge(
        getValidationFieldMessagesByType('root', $messages, MessageType::HINT),
        Session::getFlashMessagesByType(MessageType::HINT)
);

$success = array_merge(
        getValidationFieldMessagesByType('root', $messages, MessageType::SUCCESS),
        Session::getFlashMessagesByType(MessageType::SUCCESS)
);
?>
<?php if (!empty($errors) || !empty($warnings) || !empty($hints) || !empty($success)):?>
  <ul class="w-full bg-white p-3 pb-0 md:rounded-md flex flex-col gap-4 shadow-border mb-6" data-toast-parent>
    <?php foreach ($errors as $message):?>
      <li class="flex items-center w-full px-4 py-2 rounded-lg shadow border bg-red-100/75 border-red-500 text-red-900"
          data-toast>
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 rounded-lg">
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
          <span class="sr-only">Error icon</span>
        </div>
        <div class="ml-3 text-sm font-normal"><?=(method_exists($message, 'getMessage')) ? $message->getMessage() : $message ?></div>
        <button class="ml-auto -mx-1.5 -my-1.5 text-gray-400 rounded-lg inline-flex h-8 w-8 p-1.5
                             focus:outline-green hover:text-gray-700"
                type="button"
                aria-label="Close">
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
      </li>
    <?php endforeach;?>

    <?php foreach ($warnings as $message):?>
      <li class="flex items-center w-full px-4 py-2 rounded-lg shadow border bg-orange-100/75 border-orange-500 text-orange-900"
          data-toast>
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 rounded-lg">
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
          <span class="sr-only">Error icon</span>
        </div>
        <div class="ml-3 text-sm font-normal"><?=(method_exists($message, 'getMessage')) ? $message->getMessage() : $message ?></div>
        <button class="ml-auto -mx-1.5 -my-1.5 text-gray-400 rounded-lg inline-flex h-8 w-8 p-1.5
                             focus:outline-green hover:text-gray-700"
                type="button"
                aria-label="Close">
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
      </li>
    <?php endforeach;?>

    <?php foreach ($hints as $message):?>
      <li class="flex items-center w-full px-4 py-2 mb-4 rounded-lg shadow border bg-blue-100/75 border-blue-500 text-blue-900"
          data-toast>
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-blue-500 rounded-lg">
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
          <span class="sr-only">Error icon</span>
        </div>
        <div class="ml-3 text-sm font-normal"><?=(method_exists($message, 'getMessage')) ? $message->getMessage() : $message ?></div>
        <button class="ml-auto -mx-1.5 -my-1.5 text-gray-400 rounded-lg inline-flex h-8 w-8 p-1.5
                             focus:outline-green hover:text-gray-700"
                type="button"
                aria-label="Close">
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
      </li>
    <?php endforeach;?>

    <?php foreach ($success as $message):?>
      <li class="flex items-center w-full px-4 py-2 mb-4 rounded-lg shadow border bg-green-100/75 border-green-500 text-green-900"
          data-toast>
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 rounded-lg">
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
          <span class="sr-only">Error icon</span>
        </div>
        <div class="ml-3 text-sm font-normal"><?=(method_exists($message, 'getMessage')) ? $message->getMessage() : $message ?></div>
        <button class="ml-auto -mx-1.5 -my-1.5 text-gray-400 rounded-lg inline-flex h-8 w-8 p-1.5
                             focus:outline-green hover:text-gray-700"
                type="button"
                aria-label="Close">
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
      </li>
    <?php endforeach;?>
  </ul>
<?php endif;?>