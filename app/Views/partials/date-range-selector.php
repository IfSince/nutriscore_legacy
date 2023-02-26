<script type="module" src="/assets/scripts/date-range-selector.js" defer></script>
<section class="w-full border-b border-b-gray-200 flex flex-col justify-center bg-white">
  <span class="flex justify-center pt-2 pb-1 border-b border-b-gray-200 text-sm font-medium text-gray-600" id="dateRange"></span>
  <ul class="flex justify-center lg:gap-2 xl:gap-4 text-sm font-medium text-center text-gray-500 py-2 px-6 md:px-0">
    <li class="mr-2">
      <input class="hidden peer" type="radio" name="dayOfWeek" id="week" value="week" checked>
      <label class="inline-block px-2 py-2.5 md:px-4 md:py-3 rounded-md cursor-pointer hover:text-gray-900 hover:bg-gray-100
                    peer-checked:bg-green peer-checked:text-white"
             for="week">
        <span><?=_('Week')?></span>
      </label>
    </li>
    <li class="mr-2">
      <input class="hidden peer" type="radio" name="dayOfWeek" id="month" value="month">
      <label class="inline-block px-2 py-2.5 md:px-4 md:py-3 rounded-md cursor-pointer hover:text-gray-900 hover:bg-gray-100
                    peer-checked:bg-green peer-checked:text-white"
             for="month">
        <span><?=_('Month')?></span>
      </label>
    </li>
    <li class="mr-2">
      <input class="hidden peer" type="radio" name="dayOfWeek" id="year" value="year">
      <label class="inline-block px-2 py-2.5 md:px-4 md:py-3 rounded-md cursor-pointer hover:text-gray-900 hover:bg-gray-100
                    peer-checked:bg-green peer-checked:text-white"
             for="year">
        <span><?=_('Year')?></span>

      </label>
    </li>
    <li class="mr-2">
      <input class="hidden peer" type="radio" name="dayOfWeek" id="all" value="all">
      <label class="inline-block px-2 py-2.5 md:px-4 md:py-3 rounded-md cursor-pointer hover:text-gray-900 hover:bg-gray-100
                    peer-checked:bg-green peer-checked:text-white"
             for="all">
        <span><?=_('All')?></span>
      </label>
    </li>
  </ul>
</section>