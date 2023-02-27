<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <title>NutriScore - Exception Occured</title>

  <link rel="stylesheet" type="text/css" href="/assets/styles/material-icons.css">
  <link rel="stylesheet" type="text/css" href="/assets/styles/dist/tailwind.css">

  <script type="module" src=/assets/scripts/shared/shared.module.js defer></script>

  <script type=\"module\" src=\"/assets/scripts/$module/$module.module.js\" defer></script>
</head>
<body>
  <div class="flex px-4 py-6">
    <div class="flex items-center w-full px-4 py-2 mb-4 rounded-lg shadow border bg-red-100/75 border-red-500 text-red-900"
         data-toast>
      <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 rounded-lg">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Error icon</span>
      </div>
      <div class="ml-3 font-bold text-sm"><?=$message?></div>
      <button class="ml-auto -mx-1.5 -my-1.5 text-gray-400 rounded-lg inline-flex h-8 w-8 p-1.5
                             focus:outline-green hover:text-gray-700"
              type="button"
              aria-label="Close">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
      </button>
    </div>
  </div>
</body>
</html>