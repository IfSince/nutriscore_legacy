<script type="module" src="/assets/scripts/date-selector.js" defer></script>
<section class="w-full border-b border-b-gray-200 flex flex-col justify-center bg-white">
  <div class="flex justify-center pt-2 pb-1 border-b border-b-gray-200 text-sm font-medium text-gray-600" id="dateRange">test</div>
  <ul class="flex justify-center lg:gap-2 xl:gap-4 text-sm font-medium text-center text-gray-500 py-2 px-6 md:px-0">
    <li class="mr-2">
      <button class="inline-flex items-center px-2 py-2.5 md:px-4 md:py-3 rounded-lg hover:text-gray-900 hover:bg-gray-100" id="prev">
        <span class="material-icons lg:mr-2">west</span>
        <span class="hidden xl:inline">Previous week</span>
        <span class="hidden lg:inline xl:hidden">Previous</span>
      </button>
    </li>

    <li class="mr-2">
      <input class="hidden peer" type="radio" name="dayOfWeek" id="monday" value="0" checked>
      <label class="inline-block px-2 py-2.5 md:px-4 md:py-3 rounded-md cursor-pointer hover:text-gray-900 hover:bg-gray-100
                    peer-checked:bg-green peer-checked:text-white"
             for="monday">
        <span class="hidden xl:inline">Monday</span>
        <span class="hidden md:inline xl:hidden">Mon</span>
        <span class="inline md:hidden">M</span>
      </label>
    </li>
    <li class="mr-2">
      <input class="hidden peer" type="radio" name="dayOfWeek" id="tuesday" value="1">
      <label class="inline-block px-2 py-2.5 md:px-4 md:py-3 rounded-md cursor-pointer hover:text-gray-900 hover:bg-gray-100
                    peer-checked:bg-green peer-checked:text-white"
             for="tuesday">
        <span class="hidden xl:inline">Tuesday</span>
        <span class="hidden md:inline xl:hidden">Tues</span>
        <span class="inline md:hidden">T</span>
      </label>
    </li>
    <li class="mr-2">
      <input class="hidden peer" type="radio" name="dayOfWeek" id="wednesday" value="2">
      <label class="inline-block px-2 py-2.5 md:px-4 md:py-3 rounded-md cursor-pointer hover:text-gray-900 hover:bg-gray-100
                    peer-checked:bg-green peer-checked:text-white"
             for="wednesday">
        <span class="hidden xl:inline">Wednesday</span>
        <span class="hidden md:inline xl:hidden">Wed</span>
        <span class="inline md:hidden">W</span>
      </label>
    </li>
    <li class="mr-2">
      <input class="hidden peer" type="radio" name="dayOfWeek" id="thursday" value="3">
      <label class="inline-block px-2 py-2.5 md:px-4 md:py-3 rounded-md cursor-pointer hover:text-gray-900 hover:bg-gray-100
                    peer-checked:bg-green peer-checked:text-white"
             for="thursday">
        <span class="hidden xl:inline">Thursday</span>
        <span class="hidden md:inline xl:hidden">Thurs</span>
        <span class="inline md:hidden">T</span>
      </label>
    </li>
    <li class="mr-2">
      <input class="hidden peer" type="radio" name="dayOfWeek" id="friday" value="4">
      <label class="inline-block px-2 py-2.5 md:px-4 md:py-3 rounded-md cursor-pointer hover:text-gray-900 hover:bg-gray-100
                    peer-checked:bg-green peer-checked:text-white"
             for="friday">
        <span class="hidden xl:inline">Friday</span>
        <span class="hidden md:inline xl:hidden">Fri</span>
        <span class="inline md:hidden">F</span>
      </label>
    </li>
    <li class="mr-2">
      <input class="hidden peer" type="radio" name="dayOfWeek" id="saturday" value="5">
      <label class="inline-block px-2 py-2.5 md:px-4 md:py-3 rounded-md cursor-pointer hover:text-gray-900 hover:bg-gray-100
                    peer-checked:bg-green peer-checked:text-white"
             for="saturday">
        <span class="hidden xl:inline">Saturday</span>
        <span class="hidden md:inline xl:hidden">Sat</span>
        <span class="inline md:hidden">S</span>
      </label>
    </li>
    <li class="mr-2">
      <input class="hidden peer" type="radio" name="dayOfWeek" id="sunday" value="6">
      <label class="inline-block px-2 py-2.5 md:px-4 md:py-3 rounded-md cursor-pointer hover:text-gray-900 hover:bg-gray-100
                    peer-checked:bg-green peer-checked:text-white"
             for="sunday">
        <span class="hidden xl:inline">Sunday</span>
        <span class="hidden md:inline xl:hidden">Sun</span>
        <span class="inline md:hidden">S</span>
      </label>
    </li>

    <li class="mr-2">
      <button class="inline-flex items-center px-2 py-2.5 md:px-4 md:py-3 rounded-lg hover:text-gray-900 hover:bg-gray-100" id="next">
        <span class="hidden xl:inline">Next week</span>
        <span class="hidden lg:inline xl:hidden">Next</span>
        <span class="material-icons lg:ml-2">east</span>
      </button>
    </li>
  </ul>
</section>