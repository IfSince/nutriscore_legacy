<?php
$messages = $messages ?? [];
$searchResult = $searchResult ?? [];

getTemplatePart('head', ['title' => 'diary']);
getTemplatePart('header', ['active' => 'diary', 'previousPage' => '/diary']);
?>

<div class="pt-14 lg:pt-0 lg:pl-60 h-full w-full">
  <section class="w-full bg-gray-100 py-6 md:px-4">
    <?php getTemplatePart('global-messages', ['messages' => $messages]);?>

    <div class="w-full bg-white p-3 pb-10 md:rounded-md flex flex-col gap-4 shadow-border mb-6">
      <div class="border-b border-b-gray-200 pb-3 px-2">
        <h3 class="text-xl md:text-2xl text-gray-800"><?=_('Food Search')?></h3>
      </div>
      <form method="get">
        <div class="flex relative">
          <button class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100
                         border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:outline-2 focus:outline-gray-500"
                  type="button"
                  data-dropdown-button="categories">
            All categories
            <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    fill-rule="evenodd" clip-rule="evenodd"></path>
            </svg>
          </button>
          <div class="hidden z-10 bg-white divide-y divide-gray-100 rounded-lg shadow-border w-44 absolute inset-y-auto inset-x-0 m-0
                      translate-x-[5px] translate-y-[50px]"
               data-dropdown="categories">
            <ul class="py-2 text-sm text-gray-700">
              <li>
                <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-200">Food</button>
              </li>
              <li>
                <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-200">Recipes</button>
              </li>
              <li>
                <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-200">Meals</button>
              </li>
            </ul>
          </div>
          <div class="relative w-full">
            <input class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300
                          focus:outline-none focus:border-green transition-colors"
                   placeholder="Search Food, Recipes, Meals..."
                   type="search"
                   id="query"
                   name="query"
                   <?php renderRequestValue('query', 'get'); ?>>
            <button class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-green rounded-r-lg border border-green
                           hover:bg-green-hover focus:outline-2 focus:outline-green-darker transition-colors"
                    type="submit">
              <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </button>
          </div>
        </div>
      </form>

      <?php getTemplatePart('search-result-list', ['searchResult' => $searchResult])?>

    </div>

    <div class="w-full bg-white px-3 py-3.5 md:rounded-md hidden lg:flex flex-col gap-4 shadow-border">
      <div class="flex">
        <div class="flex gap-4 sm:gp-6 md:gap-8">
          <a href="/diary" class="btn btn-default justify-center items-center flex">
            <?=_('Cancel')?>
          </a>
        </div>
      </div>
    </div>
  </section>
</div>