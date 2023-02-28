<?php
$messages = $messages ?? [];

getTemplatePart('head', ['title' => 'not found']);
?>
<header class="h-14 w-full fixed top-0 left-0 py-2 lg:py-3 px-6 bg-white flex justify-between z-50
                 lg:px-0 lg:py-6 lg:w-60 lg:h-full shadow-sm lg:shadow-lg lg:flex-col lg:gap-y-14">

  <a href="/overview">
    <img class="w-auto h-full lg:h-auto w-full lg:px-6" src="/assets/logo.svg" alt="logo">
  </a>
</header>
<div class="pt-14 lg:pt-0 lg:pl-60 h-full w-full">
  <section class="w-full bg-gray-100 py-6 md:px-4">
    <?php getTemplatePart('global-messages', ['messages' => $messages]);?>

    <div class="w-full bg-white md:rounded-md flex flex-col justify-center items-center gap-4 shadow-border mb-6
                pt-6 pb-14 px-6 min-h-[250px] md:min-h-[350px] lg:min-h-[600px]">
      <div class="flex flex-col justify-center items-center text-center">
        <span class="font-bold text-green text-6xl md:text-8xl">404</span>
        <span class="mt-4 font-light lg:font-normal text-sm md:text-base lg:text-lg max-w-sm">We're sorry, the page you requested could not be found.
          Please go back to the homepage or contact us at <a href="#">support@nutriscore.com</a></span>
      </div>
    </div>
  </section>

</div>