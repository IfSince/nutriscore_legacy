<?php getTemplatePart('head', ['title' => 'overview']);?>
<?php getTemplatePart('header', ['active' => 'overview']);?>

<div class="fixed bottom-[88px] right-6">
  <div data-actions class="flex hidden flex-col items-center mb-6 space-y-4">
    <button class="w-14 h-14 flex items-center justify-center rounded-full text-white bg-gray-400 transition-colors
                     shadow-border relative hover:bg-gray-700 focus:ring-2 focus:ring-gray-300 focus:outline-none"
            type="button">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
      </svg>
      <span class="absolute block mb-px text-sm font-medium -translate-y-1/2 -left-[68px] top-1/2 text-gray-400">Activity</span>
    </button>
    <button class="w-14 h-14 flex items-center justify-center rounded-full text-gray-400 bg-white transition-colors border border-gray-200
                     shadow-border relative hover:text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-gray-300 focus:outline-none"
            type="button">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
      </svg>
      <span class="absolute block mb-px text-sm font-medium -translate-y-1/2 -left-14 top-1/2">Meal</span>
    </button>
  </div>
  <button class="w-14 h-14 flex items-center justify-center rounded-full text-white bg-green shadow-border
                   transition-transform transition-colors hover:bg-green-hover focus:outline-2 focus:outline-green-dark"
          type="button"
          data-action-button>
    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
    </svg>
  </button>
</div>

<div class="pt-16 lg:pt-0 lg:pl-60 h-full w-full">
  <section class="px-6 pt-10 pb-20 lg:pt-16 lg:pb-10 flex justify-center items-center bg-gradient-to-b from-gray-600 to-gray-800 relative">
    <div class="flex justify-center items-center relative h-40 w-full">
      <svg class="w-32 h-32 rounded-full absolute stroke-[10] stroke-round fill-none">
        <circle r="50" cx="64" cy="64" class="stroke-orange/30"></circle>
        <circle r="50" cx="64" cy="64" class="stroke-orange" data-percentage="30"></circle>
      </svg>

      <svg class="w-40 h-40 rounded-full absolute stroke-[10] stroke-round fill-none">
        <circle r="65" cx="80" cy="80" class="stroke-blue/30"></circle>
        <circle r="65" cx="80" cy="80" class="stroke-blue" data-percentage="40"></circle>
      </svg>

      <svg class="w-48 h-48 rounded-full absolute stroke-[10] stroke-round fill-none">
        <circle r="80" cx="50%" cy="50%" class="stroke-green/30"></circle>
        <circle r="80" cx="50%" cy="50%" class="stroke-green" data-percentage="50"></circle>
      </svg>


      <div class="translate-y-14 lg:translate-y-0 flex flex-row self-end w-full max-w-xs justify-evenly
                    lg:ml-96 lg:flex-col lg:w-fit lg:max-w-fit lg:gap-2">
          <span class="flex items-center text-sm font-medium text-white">
            <span class="flex w-2.5 h-2.5 bg-green rounded-full mr-2.5 flex-shrink-0"></span>
            Protein 72g
          </span>
        <span class="flex items-center text-sm font-medium text-white">
            <span class="flex w-2.5 h-2.5 bg-purple-500 rounded-full mr-2.5 flex-shrink-0"></span>
            Carbs 40g
          </span>
        <span class="flex items-center text-sm font-medium text-white">
            <span class="flex w-2.5 h-2.5 bg-indigo-500 rounded-full mr-2.5 flex-shrink-0"></span>
            Fat 20g
          </span>
      </div>
    </div>
  </section>
  
  <?php getTemplatePart('date-selector');?>
</div>