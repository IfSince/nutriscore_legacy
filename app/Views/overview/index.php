<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  
  <title>Overview</title>
  
  <link rel="stylesheet" type="text/css" href="assets/styles/material-icons.css">
  <link rel="stylesheet" type="text/css" href="assets/styles/dist/tailwind.css">
  <script type="module" src="assets/scripts/overview/overview.module.js" defer></script>
</head>
<body class="">
  <header class="h-16 w-full fixed top-0 left-0 py-3 px-6 bg-white flex justify-between z-50
                 lg:px-0 lg:py-6 lg:w-60 lg:h-full lg:shadow-lg lg:flex-col lg:gap-y-14">
    <a href="#">
      <img class="w-auto h-full lg:h-auto w-full lg:px-6" src="assets/logo.svg" alt="logo">
    </a>
    <nav class="flex items-center lg:flex-col-reverse lg:grow justify-between bg-white">
      <div class="flex lg:flex-col gap-x-4 w-full">
        <a class="menu-link flex w-full items-center gap-x-6 text-green lg:text-gray-400" href="#">
          <span class="material-icons text-5xl lg:text-4xl">person</span>
          <span class="hidden font-medium text-base tracking-wide lg:inline">Account</span>
        </a>
      </div>
  
      <ul class="fixed flex w-full justify-between bottom-0 left-0 group border-t border-t-gray-200 lg:static lg:flex-col lg:border-none">
        <li class="grow">
          <a class="menu-link mobile-menu__entry pl-6" href="#">
            <span class="material-icons text-green">home</span>
            <span class="font-medium text-xs lg:text-base tracking-wide lg:inline text-green">Overview</span>
          </a>
        </li>
        <li class="grow-[3] sm:grow">
          <a class="menu-link mobile-menu__entry" href="#">
            <span class="material-icons">library_books</span>
            <span class="font-medium text-xs lg:text-base tracking-wide lg:inline">Diary</span>
          </a>
        </li>
        <li class="grow-[2] sm:grow">
          <a class="menu-link mobile-menu__entry" href="#">
            <span class="material-icons">show_chart</span>
            <span class="font-medium text-xs lg:text-base tracking-wide lg:inline">Statistics</span>
          </a>
        </li>
        <li class="grow">
          <a class="menu-link mobile-menu__entry pr-6" href="#">
            <span class="material-icons">notifications</span>
            <span class="font-medium text-xs lg:text-base tracking-wide lg:inline">Notifications</span>
          </a>
        </li>
      </ul>
    </nav>
  </header>
  
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
    <section class="px-6 pt-10 pb-20 lg:pt-36 lg:pb-10 flex justify-center items-center bg-gradient-to-b from-gray-600 to-gray-800 relative">
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
  
    <section class="w-full border-b border-b-gray-200 flex justify-center">
      <div class="w-full flex justify-between items-center py-1 md:py-2 px-6 text-gray-400 max-w-2xl">
        <a class="flex hover:text-gray-700 transition-colors" href="#">
          <span class="material-icons text-xl md:text-2xl">arrow_back</span>
        </a>
        <span class="font-medium text-gray-700 text-lg md:text-xl">Today</span>
        <a class="flex hover:text-gray-700 transition-colors" href="#">
          <span class="material-icons text-xl md:text-2xl">arrow_forward</span>
        </a>
      </div>
    </section>
  </div>
</body>
</html>