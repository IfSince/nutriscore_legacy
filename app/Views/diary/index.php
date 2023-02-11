<?php
use NutriScore\Utils\Session;

getTemplatePart('head', ['title' => 'diary', 'module' => 'diary']);?>
<?php getTemplatePart('header', ['active' => 'diary']);?>

<div class="pt-16 lg:pt-0 lg:pl-60 h-full w-full">
  <section class="px-6 py-4 lg:pt-16 lg:pb-10 flex justify-center items-center bg-gradient-to-b from-gray-600 to-gray-800 relative">
    <div class="flex justify-center items-center relative w-48 h-48">
      <div class="flex flex-col text-center gap-1 pt-2 text-white/70">
        <span class="font-medium text-4xl">2140</span>
        <span class="font-medium">kcal</span>
      </div>
      <svg class="w-full h-full absolute stroke-[12] stroke-round fill-none">
        <circle r="80" cx="50%" cy="50%" class="stroke-green/30"></circle>
        <circle r="80" cx="50%" cy="50%" class="stroke-green" data-percentage="60"></circle>
      </svg>
    </div>
  </section>

  <?php getTemplatePart('date-selector');?>
  <?php if(!empty($errors['root']) || Session::hasFlashMessages()): ?>
  <div class="w-full pb-2 pt-4 md:px-4 bg-gray-100">
    <?php getTemplatePart('global-messages', ['errors' => $errors['root'] ?? []]);?>
  </div>
  <?php endif;?>
  <section class="w-full bg-gray-100 flex flex-col lg:flex-row pb-24">
    <div class="py-4 md:px-4 flex flex-col lg:flex-row lg:flex-wrap flex-grow basis-4/6 h-fit">
      <div class="w-full flex flex-col 2xl:flex-row gap-8 pb-8">
        <div class="bg-white md:rounded-md px-2 py-4 shadow-border flex-grow basis-1/2 min-w-[300px]">
          <div class="border-b border-b-gray-200 pb-3 px-2">
            <h3 class="text-xl md:text-2xl text-gray-800">Breakfast</h3>
          </div>
          <div class="pt-2 flex flex-col gap-1">
            <div class="bg-gray-200 rounded-lg px-3 py-2 flex">
              <span class="basis-1/5">Egg</span>
              <span class="basis-1/5">50g</span>
              <span class="basis-3/5 text-end">100kcal</span>
            </div>
            <div class="px-3 py-2 flex">
              <span class="basis-1/5">Egg</span>
              <span class="basis-1/5">50g</span>
              <span class="basis-3/5 text-end">100kcal</span>
            </div>
            <div class="bg-gray-200 rounded-lg px-3 py-2 flex">
              <span class="basis-1/5">Egg</span>
              <span class="basis-1/5">50g</span>
              <span class="basis-3/5 text-end">100kcal</span>
            </div>
            <div class="px-3 py-2 flex">
              <span class="basis-1/5">Egg</span>
              <span class="basis-1/5">50g</span>
              <span class="basis-3/5 text-end">100kcal</span>
            </div>
            <div class="px-3 py-2 flex">
              <span class="basis-1/5">Egg</span>
              <span class="basis-1/5">50g</span>
              <span class="basis-3/5 text-end">100kcal</span>
            </div>
            <div class="px-3 py-2 flex">
              <span class="basis-1/5">Egg</span>
              <span class="basis-1/5">50g</span>
              <span class="basis-3/5 text-end">100kcal</span>
            </div>
          </div>
        </div>

        <div class="bg-white md:rounded-md px-2 py-4 shadow-border flex-grow basis-1/2 min-w-[300px]">
          <div class="border-b border-b-gray-200 pb-3 px-2">
            <h3 class="text-xl md:text-2xl text-gray-800">Lunch</h3>
          </div>
          <div class="pt-2 flex flex-col gap-1">
            <div class="bg-gray-200 rounded-lg px-3 py-2 flex">
              <span class="basis-1/5">Egg</span>
              <span class="basis-1/5">50g</span>
              <span class="basis-3/5 text-end">100kcal</span>
            </div>
            <div class="px-3 py-2 flex">
              <span class="basis-1/5">Egg</span>
              <span class="basis-1/5">50g</span>
              <span class="basis-3/5 text-end">100kcal</span>
            </div>
            <div class="bg-gray-200 rounded-lg px-3 py-2 flex">
              <span class="basis-1/5">Egg</span>
              <span class="basis-1/5">50g</span>
              <span class="basis-3/5 text-end">100kcal</span>
            </div>
            <div class="px-3 py-2 flex">
              <span class="basis-1/5">Egg</span>
              <span class="basis-1/5">50g</span>
              <span class="basis-3/5 text-end">100kcal</span>
            </div>
          </div>
        </div>
      </div>


      <div class="w-full flex flex-col 2xl:flex-row gap-8">
        <div class="bg-white md:rounded-md px-2 py-4 shadow-border lg:basis-1/2 min-w-[300px]">
          <div class="border-b border-b-gray-200 pb-3 px-2">
            <h3 class="text-xl md:text-2xl text-gray-800">Dinner</h3>
          </div>
          <div class="pt-2 flex flex-col gap-1">
            <div class="bg-gray-200 rounded-lg px-3 py-2 flex">
              <span class="basis-1/5">Egg</span>
              <span class="basis-1/5">50g</span>
              <span class="basis-3/5 text-end">100kcal</span>
            </div>
            <div class="px-3 py-2 flex">
              <span class="basis-1/5">Egg</span>
              <span class="basis-1/5">50g</span>
              <span class="basis-3/5 text-end">100kcal</span>
            </div>
            <div class="bg-gray-200 rounded-lg px-3 py-2 flex">
              <span class="basis-1/5">Egg</span>
              <span class="basis-1/5">50g</span>
              <span class="basis-3/5 text-end">100kcal</span>
            </div>
            <div class="px-3 py-2 flex">
              <span class="basis-1/5">Egg</span>
              <span class="basis-1/5">50g</span>
              <span class="basis-3/5 text-end">100kcal</span>
            </div>
          </div>
        </div>

        <div class="bg-white md:rounded-md px-2 py-4 shadow-border lg:basis-1/2 min-w-[300px]">
          <div class="border-b border-b-gray-200 pb-3 px-2">
            <h3 class="text-xl md:text-2xl text-gray-800">Snacks</h3>
          </div>
          <div class="pt-2 flex flex-col gap-1">
            <div class="bg-gray-200 rounded-lg px-3 py-2 flex">
              <span class="basis-1/5">Egg</span>
              <span class="basis-1/5">50g</span>
              <span class="basis-3/5 text-end">100kcal</span>
            </div>
            <div class="px-3 py-2 flex">
              <span class="basis-1/5">Egg</span>
              <span class="basis-1/5">50g</span>
              <span class="basis-3/5 text-end">100kcal</span>
            </div>
            <div class="bg-gray-200 rounded-lg px-3 py-2 flex">
              <span class="basis-1/5">Egg</span>
              <span class="basis-1/5">50g</span>
              <span class="basis-3/5 text-end">100kcal</span>
            </div>
            <div class="px-3 py-2 flex">
              <span class="basis-1/5">Egg</span>
              <span class="basis-1/5">50g</span>
              <span class="basis-3/5 text-end">100kcal</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="py-4 md:px-4 mt-8 md:mt-12 lg:mt-0 flex flex-col gap-6 h-fit flex-grow basis-1/6">
      <div class="bg-white md:rounded-md px-2 pt-4 pb-8 shadow-border flex-grow min-w-[250px]">
        <div class="border-b border-b-gray-200 pb-3 px-2">
          <h3 class="text-xl md:text-2xl text-gray-800">Macros</h3>
        </div>
        <div class="pt-2 px-4 flex flex-col gap-2">
          <div class="pt-2 flex flex-col">
            <div class="flex w-full justify-between pl-1 pr-2 text-sm">
              <span class="font-medium">Protein</span>
              <span>10mg/15mg</span>
            </div>
            <div class="px-3 py-2 flex relative">
              <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
              <span class="bg-green rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
            </div>
          </div>
          <div class="pt-2 flex flex-col">
            <div class="flex w-full justify-between pl-1 pr-2 text-sm">
              <span class="font-medium">Carbohydrates</span>
              <span>10mg/15mg</span>
            </div>
            <div class="px-3 py-2 flex relative">
              <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
              <span class="bg-blue rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
            </div>
          </div>
          <div class="pt-2 flex flex-col">
            <div class="flex w-full justify-between pl-1 pr-2 text-sm">
              <span class="font-medium">Fat</span>
              <span>10mg/15mg</span>
            </div>
            <div class="px-3 py-2 flex relative">
              <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
              <span class="bg-orange rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white md:rounded-md px-2 pt-4 pb-8 shadow-border flex-grow min-w-[250px]">
        <div class="border-b border-b-gray-200 pb-3 px-2">
          <h3 class="text-xl md:text-2xl text-gray-800">Vitamins</h3>
        </div>
        <div class="pt-2 px-4 flex flex-col gap-2">
          <div class="flex w-full gap-6">
            <div class="pt-2 flex flex-col flex-grow">
              <span class="pl-1 text-sm font-medium">Protein</span>
              <div class="px-3 py-2 flex relative">
                <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
              </div>
            </div>
            <div class="pt-2 flex flex-col flex-grow">
              <span class="pl-1 text-sm font-medium">Protein</span>
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
          <h3 class="text-2xl text-gray-800">Minerals</h3>
        </div>
        <div class="pt-2 px-4 flex flex-col gap-2">
          <div class="flex w-full gap-6">
            <div class="pt-2 flex flex-col flex-grow">
              <span class="pl-1 text-sm font-medium">Protein</span>
              <div class="px-3 py-2 flex relative">
                <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
              </div>
            </div>
            <div class="pt-2 flex flex-col flex-grow">
              <span class="pl-1 text-sm font-medium">Protein</span>
              <div class="px-3 py-2 flex relative">
                <span class="bg-gray-200 rounded-lg absolute top-0 left-0 h-full w-full"></span>
                <span class="bg-gray-400 rounded-lg absolute top-0 left-0 h-full w-1/2"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>