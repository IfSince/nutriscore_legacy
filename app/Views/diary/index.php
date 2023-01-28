<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <title>Overview</title>

  <link rel="stylesheet" type="text/css" href="assets/styles/material-icons.css">
  <link rel="stylesheet" type="text/css" href="assets/styles/dist/tailwind.css">
  <script type="module" src="assets/scripts/diary/diary.module.js" defer></script>
</head>
<body class="">
  <header class="h-16 w-full fixed top-0 left-0 py-3 px-6 bg-white flex justify-between z-50
                 lg:px-0 lg:py-6 lg:w-60 lg:h-full shadow-lg lg:flex-col lg:gap-y-14">
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
            <span class="material-icons">home</span>
            <span class="font-medium text-xs lg:text-base tracking-wide lg:inline">Overview</span>
          </a>
        </li>
        <li class="grow-[3] sm:grow">
          <a class="menu-link mobile-menu__entry" href="#">
            <span class="material-icons text-green">library_books</span>
            <span class="font-medium text-xs lg:text-base tracking-wide lg:inline text-green">Diary</span>
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

  <div class="pt-16 lg:pt-0 lg:pl-60 h-full w-full">
    <section class="px-6 py-4 lg:pt-36 lg:pb-10 flex justify-center items-center bg-gradient-to-b from-gray-600 to-gray-800 relative">
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

    <section class="w-full border-b border-b-gray-200 flex justify-center bg-white">
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

    <section class="w-full bg-gray-100 flex flex-col lg:flex-row pb-24">
      <div class="md:px-10 lg:pl-20 py-8 md:py-10 flex flex-col lg:flex-row lg:flex-wrap flex-grow basis-4/6 h-fit">


        <div class="w-full flex flex-col 2xl:flex-row gap-8 pb-8">
          <div class="bg-white rounded-md px-2 py-4 shadow-border flex-grow basis-1/2 min-w-[300px]">
            <div class="border-b border-b-gray-200 pb-3 px-2">
              <h3 class="text-xl lg:text-2xl">Breakfast</h3>
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

          <div class="bg-white rounded-md px-2 py-4 shadow-border flex-grow basis-1/2 min-w-[300px]">
            <div class="border-b border-b-gray-200 pb-3 px-2">
              <h3 class="text-xl lg:text-2xl">Lunch</h3>
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
          <div class="bg-white rounded-md px-2 py-4 shadow-border lg:basis-1/2 min-w-[300px]">
            <div class="border-b border-b-gray-200 pb-3 px-2">
              <h3 class="text-xl lg:text-2xl">Dinner</h3>
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

          <div class="bg-white rounded-md px-2 py-4 shadow-border lg:basis-1/2 min-w-[300px]">
            <div class="border-b border-b-gray-200 pb-3 px-2">
              <h3 class="text-xl lg:text-2xl">Snacks</h3>
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

      <div class="md:px-10 lg:pr-20 lg:py-10 flex flex-col gap-6 h-fit flex-grow basis-2/6">
        <div class="bg-white rounded-md px-2 pt-4 pb-8 shadow-border flex-grow min-w-[250px]">
          <div class="border-b border-b-gray-200 pb-3 px-2">
            <h3 class="text-xl lg:text-2xl">Macros</h3>
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

        <div class="bg-white rounded-md px-2 pt-4 pb-8 shadow-border flex-grow min-w-[250px]">
          <div class="border-b border-b-gray-200 pb-3 px-2">
            <h3 class="text-xl lg:text-2xl">Vitamins</h3>
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

        <div class="bg-white rounded-md px-2 pt-4 pb-8 shadow-border flex-grow min-w-[250px]">
          <div class="border-b border-b-gray-200 pb-3 px-2">
            <h3 class="text-2xl">Minerals</h3>
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

</body>
</html>