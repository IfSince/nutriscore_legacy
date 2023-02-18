<?php
$messages = $messages ?? [];

$searchResults = $searchResults ?? [];

getTemplatePart('head', ['title' => 'diary']);
getTemplatePart('header', ['active' => 'diary']);
?>

<div class="pt-16 lg:pt-0 lg:pl-60 h-full w-full">
  <section class="w-full border-b border-b-gray-200 flex justify-start bg-white">
    <div class="w-full flex justify-start items-center py-1 md:py-2 px-4 md:px-6 text-gray-400 max-w-2xl">
      <a class="flex hover:text-gray-700 transition-colors" href="#">
        <span class="material-icons text-2xl md:text-3xl">arrow_back</span>
      </a>
    </div>
  </section>
  <section class="w-full bg-gray-100 pb-20 md:pb-10 py-6 md:px-4">
    <?php getTemplatePart('global-messages', ['messages' => $messages]);?>

    <div class="w-full bg-white p-3 pb-10 md:rounded-md flex flex-col gap-4 shadow-border mb-6">
      <div class="border-b border-b-gray-200 pb-3 px-2">
        <h3 class="text-xl md:text-2xl text-gray-800">Food Search</h3>
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

      <?php if(count($searchResults) > 0): ?>
        <div class="relative overflow-x-auto pt-4">
          <table class="w-full text-sm text-left text-gray-500" aria-label="Search results">
            <thead class="text-xs text-gray-900 uppercase">
              <tr>
                <th scope="col" class="px-6 py-3">
                  Description
                </th>
                <th scope="col" class="px-6 py-3">
                  Calories
                </th>
                <th scope="col" class="px-6 py-3">
                  Protein
                </th>
                <th scope="col" class="px-6 py-3">
                  Carbohydrates
                </th>
                <th scope="col" class="px-6 py-3">
                  Fat
                </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($searchResults as $row):?>
                <tr class="bg-white border-b last:border-none hover:bg-gray-100 cursor-pointer">
                  <th scope="row" class="font-medium text-gray-900 whitespace-nowrap">
                    <a href="/diary/add/food/<?=$row->getId()?>" class="px-6 py-4 block"><?=ucfirst($row->getDescription())?></a>
                  </th>
                  <td>
                    <a href="/diary/add/food/<?=$row->getId()?>" class="px-6 py-4 block"><?=$row->getCalories()?></a>
                  </td>
                  <td>
                    <a href="/diary/add/food/<?=$row->getId()?>" class="px-6 py-4 block"><?=$row->getProtein()?></a>
                  </td>
                  <td>
                    <a href="/diary/add/food/<?=$row->getId()?>" class="px-6 py-4 block"><?=$row->getCarbohydrates()?></a>
                  </td>
                  <td>
                    <a href="/diary/add/food/<?=$row->getId()?>" class="px-6 py-4 block"><?=$row->getFat()?></a>
                  </td>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
      <?php endif;?>

    </div>
  </section>
</div>