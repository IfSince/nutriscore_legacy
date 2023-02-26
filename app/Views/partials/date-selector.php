<script type="module" src="/assets/scripts/date-selector.js" defer></script>
<section class="w-full border-b border-b-gray-200 flex flex-col justify-center bg-white">
  <span class="flex justify-center pt-2 pb-1 border-b border-b-gray-200 text-sm font-medium text-gray-600" id="dateRange"></span>
  <ul class="flex justify-center lg:gap-2 xl:gap-4 text-sm font-medium text-center text-gray-500 py-2 px-6 md:px-0">
    <li class="mr-2">
      <button class="inline-flex items-center px-2 py-2.5 md:px-4 md:py-3 rounded-lg hover:text-gray-900 hover:bg-gray-100" id="prev">
        <span class="material-icons lg:mr-2">west</span>
        <span class="hidden xl:inline"><?=_('Previous week')?></span>
        <span class="hidden lg:inline xl:hidden"><?=_('Previous')?></span>
      </button>
    </li>

    <li class="mr-2">
      <input class="hidden peer" type="radio" name="dayOfWeek" id="monday" value="0" checked>
      <label class="inline-block px-2 py-2.5 md:px-4 md:py-3 rounded-md cursor-pointer hover:text-gray-900 hover:bg-gray-100
                    peer-checked:bg-green peer-checked:text-white"
             for="monday">
        <span class="hidden xl:inline"><?=_('Monday')?></span>
        <span class="hidden md:inline xl:hidden"><?=_('Mon')?></span>
        <span class="inline md:hidden">M</span>
      </label>
    </li>
    <li class="mr-2">
      <input class="hidden peer" type="radio" name="dayOfWeek" id="tuesday" value="1">
      <label class="inline-block px-2 py-2.5 md:px-4 md:py-3 rounded-md cursor-pointer hover:text-gray-900 hover:bg-gray-100
                    peer-checked:bg-green peer-checked:text-white"
             for="tuesday">
        <span class="hidden xl:inline"><?=_('Tuesday')?></span>
        <span class="hidden md:inline xl:hidden"><?=_('Tues')?></span>
        <span class="inline md:hidden"><?=_('T')?></span>
      </label>
    </li>
    <li class="mr-2">
      <input class="hidden peer" type="radio" name="dayOfWeek" id="wednesday" value="2">
      <label class="inline-block px-2 py-2.5 md:px-4 md:py-3 rounded-md cursor-pointer hover:text-gray-900 hover:bg-gray-100
                    peer-checked:bg-green peer-checked:text-white"
             for="wednesday">
        <span class="hidden xl:inline"><?=_('Wednesday')?></span>
        <span class="hidden md:inline xl:hidden"><?=_('Wed')?></span>
        <span class="inline md:hidden"><?=_('W')?></span>
      </label>
    </li>
    <li class="mr-2">
      <input class="hidden peer" type="radio" name="dayOfWeek" id="thursday" value="3">
      <label class="inline-block px-2 py-2.5 md:px-4 md:py-3 rounded-md cursor-pointer hover:text-gray-900 hover:bg-gray-100
                    peer-checked:bg-green peer-checked:text-white"
             for="thursday">
        <span class="hidden xl:inline"><?=_('Thurs')?></span>
        <span class="hidden md:inline xl:hidden"><?=_('Thurs')?></span>
        <span class="inline md:hidden"><?=_('T')?></span>
      </label>
    </li>
    <li class="mr-2">
      <input class="hidden peer" type="radio" name="dayOfWeek" id="friday" value="4">
      <label class="inline-block px-2 py-2.5 md:px-4 md:py-3 rounded-md cursor-pointer hover:text-gray-900 hover:bg-gray-100
                    peer-checked:bg-green peer-checked:text-white"
             for="friday">
        <span class="hidden xl:inline"><?=_('Friday')?></span>
        <span class="hidden md:inline xl:hidden"><?=_('Fri')?></span>
        <span class="inline md:hidden"><?=_('F')?></span>
      </label>
    </li>
    <li class="mr-2">
      <input class="hidden peer" type="radio" name="dayOfWeek" id="saturday" value="5">
      <label class="inline-block px-2 py-2.5 md:px-4 md:py-3 rounded-md cursor-pointer hover:text-gray-900 hover:bg-gray-100
                    peer-checked:bg-green peer-checked:text-white"
             for="saturday">
        <span class="hidden xl:inline"><?=_('Saturday')?></span>
        <span class="hidden md:inline xl:hidden"><?=_('Sat')?></span>
        <span class="inline md:hidden"><?=_('S')?></span>
      </label>
    </li>
    <li class="mr-2">
      <input class="hidden peer" type="radio" name="dayOfWeek" id="sunday" value="6">
      <label class="inline-block px-2 py-2.5 md:px-4 md:py-3 rounded-md cursor-pointer hover:text-gray-900 hover:bg-gray-100
                    peer-checked:bg-green peer-checked:text-white"
             for="sunday">
        <span class="hidden xl:inline"><?=_('Sunday')?></span>
        <span class="hidden md:inline xl:hidden"><?=_('Sun')?></span>
        <span class="inline md:hidden"><?=_('S')?></span>
      </label>
    </li>

    <li class="mr-2">
      <button class="inline-flex items-center px-2 py-2.5 md:px-4 md:py-3 rounded-lg hover:text-gray-900 hover:bg-gray-100" id="next">
        <span class="hidden xl:inline"><?=_('Next week')?></span>
        <span class="hidden lg:inline xl:hidden"><?=_('Next')?></span>
        <span class="material-icons lg:ml-2">east</span>
      </button>
    </li>
  </ul>
</section>