<?php getTemplatePart('head', ['title' => 'Profile']);?>
<?php getTemplatePart('header', ['active' => 'profile']);?>

<div class="pt-16 lg:pt-0 lg:pl-60 h-full w-full">
  <section class="w-full bg-gradient-to-b from-gray-600 to-gray-800 pb-10">
    <div class="sm:px-6 md:px-10 lg:px-20 py-8 md:py-10">
      <h3 class="px-6 md:pl-2 sm:text-2xl md:text-3xl font-medium sm:font-bold tracking-wide sm:tracking-tight text-gray-100">
        Nutritional Data
      </h3>
    </div>
  </section>
  <section class="w-full border-b border-b-gray-200 flex justify-center bg-white">
    <div class="w-full py-1 md:py-2 px-6 text-gray-400 text-center">
      Separator
    </div>
  </section>

  <?php if(!empty($errors['root'])): ?>
    <div class="w-full pb-2 pt-4 md:px-4 bg-gray-100">
      <?php getTemplatePart('global-messages', ['messages' => $errors['root']]);?>
    </div>
  <?php endif;?>
  <section class="w-full bg-gray-100 flex flex-col lg:flex-row pb-24">
    <div class="py-4 md:px-4 flex flex-col lg:flex-row lg:flex-wrap flex-grow basis-4/6 h-fit">
      test
    </div>
  </section>

</div>