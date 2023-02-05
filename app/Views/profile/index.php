<?php getTemplatePart('head', ['title' => 'profile', 'module' => 'profile']);?>
<?php getTemplatePart('header', ['active' => 'profile']);?>

<div class="pt-16 lg:pt-0 lg:pl-60 h-full w-full">
  <section class="px-6 md:px-10 lg:px-20 pt-6 pb-3 md:pb-6 lg:py-10 bg-gradient-to-b from-gray-600 to-gray-800 relative">
    <div class="lg:mt-16 flex flex-col md:flex-row flex-wrap gap-x-28">

      <form class="flex pb-3" method="post" enctype="multipart/form-data" id="profileForm">
        <div class="flex flex-col relative">
          <label for="upload"
                 class="cursor-pointer bg-gray-100 rounded-full w-20 h-20 sm:w-28 sm:h-28 md:w-32 md:h-32 lg:w-36 lg:h-36
                        overflow-hidden flex justify-center items-center group relative">
            <img src="<?= $personData->getUser()->getImage()->getPath() ?? 'assets/images/profile_img.svg'?>"
                 alt="Default profile image"
                 data-profile-img
                 class="w-full h-full object-cover transition-opacity group-hover:opacity-50">
            <div class="absolute w-12 h-12 transition-opacity opacity-0 group-hover:opacity-100">
              <span class="material-icons text-5xl text-gray-800">upload_file</span>
            </div>
          </label>
          <button class="absolute top-0 right-0 w-10 h-10 bg-green rounded-full hidden
                         flex justify-center items-center shadow-underlined transition-colors hover:bg-green-hover"
                  type="submit"
                  data-submit>
            <span class="material-icons text-white text-xl">publish</span>
          </button>
          <input type="file" id="upload" name="upload" accept="image/*" hidden>
        </div>
        <div class="flex flex-col pt-4 md:pt-6 ml-4 sm:ml-6 md:ml-8 lg:ml-10">
          <span class="text-white/90 font-medium text-2xl sm:text-3xl md:text-3xl lg:text-5xl">Leon Laade</span>
          <span class="text-white/70 text-lg md:pt-2 sm:text-xl md:text-xl lg:text-2xl">27.10.2000</span>
        </div>
      </form>
      <ul class="text-sm font-medium text-red-500 pl-2 pt-1">
        <?php renderErrors($errors ?? null, 'file');?>
      </ul>

      <div class="flex flex-col mt-4 w-full lg:max-w-xl">
        <div class="flex w-full justify-between px-1 py-2.5 border-b-2 border-b-white/10">
          <span class="font-medium tracking-wide text-white/90">Objective</span>
          <span class="text-white/70">Loose weight</span>
        </div>
        <div class="flex w-full justify-between px-1 py-2.5 border-b-2 border-b-white/10">
          <span class="font-medium tracking-wide text-white/90">Current weight</span>
          <span class="text-white/70">90kg</span>
        </div>
        <div class="flex w-full justify-between px-1 py-2.5 border-b-2 border-b-white/10">
          <span class="font-medium tracking-wide text-white/90">BMI</span>
          <span class="text-white/70">25,47</span>
        </div>

        <div class="mt-6 flex w-full justify-between px-1 py-2.5 border-b-2 border-b-white/10">
          <span class="font-medium tracking-wide text-white/90">Activity level</span>
          <span class="text-white/70">1-3/week</span>
        </div>
        <div class="flex w-full justify-between px-1 py-2.5">
          <span class="font-medium tracking-wide text-white/90">BMR</span>
          <span class="text-white/70">2075 kcal</span>
        </div>
      </div>

    </div>
  </section>

  <section class="w-full bg-gray-100 pb-10">
    <div class="sm:px-6 md:px-10 lg:px-20 py-8 md:py-10">
      <h3 class="px-6 md:pl-2 sm:text-2xl md:text-3xl font-medium sm:font-bold tracking-wide sm:tracking-tight
                 text-gray-400 sm:text-gray-700">
        My Account Data
      </h3>
      <div class="mt-3 flex flex-col md:flex-row sm:gap-6">
        <div class="md:max-w-sm px-6 sm:p-6 bg-white border border-gray-200 rounded-lg shadow flex justify-between sm:flex-col">
          <a href="profile/account-data" class="flex items-center">
            <h5 class="sm:mb-2 sm:text-2xl font-medium sm:font-bold tracking-wide md:tracking-tight text-gray-700">Account Data</h5>
          </a>
          <p class="mb-5 font-normal text-gray-500 hidden sm:block">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A at distinctio dolorem dolorum fuga
          </p>
          <a class="inline-flex transition-colors items-center px-3 py-2 sm:text-sm font-medium text-center text-green
                    sm:text-white sm:bg-green rounded-lg hover:text-green-hover sm:hover:text-white
                    sm:hover:bg-green-hover focus:outline-2 focus:outline-green-darker h-fit w-fit"
             href="profile/account-data">
            Edit data
            <span class="material-icons ml-2 -mr-1 text-xl font-medium sm:text-lg">arrow_forward</span>
          </a>
        </div>

        <div class="md:max-w-sm px-6 sm:p-6 bg-white border border-gray-200 rounded-lg shadow flex justify-between sm:flex-col">
          <a href="profile/personal-data" class="flex items-center">
            <h5 class="sm:mb-2 sm:text-2xl font-medium sm:font-bold tracking-wide md:tracking-tight text-gray-700">Personal Data</h5>
          </a>
          <p class="mb-5 font-normal text-gray-500 hidden sm:block">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A at distinctio dolorem dolorum fuga
          </p>
          <a class="inline-flex transition-colors items-center px-3 py-2 sm:text-sm font-medium text-center text-green
                    sm:text-white sm:bg-green rounded-lg hover:text-green-hover sm:hover:text-white
                    sm:hover:bg-green-hover focus:outline-2 focus:outline-green-darker h-fit w-fit"
             href="profile/personal-data">
            Edit data
            <span class="material-icons ml-2 -mr-1 text-xl font-medium sm:text-lg">arrow_forward</span>
          </a>
        </div>

        <div class="md:max-w-sm px-6 sm:p-6 bg-white border border-gray-200 rounded-lg shadow flex justify-between sm:flex-col">
          <a href="profile/nutritional-data" class="flex items-center">
            <h5 class="sm:mb-2 sm:text-2xl font-medium sm:font-bold tracking-wide md:tracking-tight text-gray-700">Nutritional Data</h5>
          </a>
          <p class="mb-5 font-normal text-gray-500 hidden sm:block">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A at distinctio dolorem dolorum fuga
          </p>
          <a class="inline-flex transition-colors items-center px-3 py-2 sm:text-sm font-medium text-center text-green
                    sm:text-white sm:bg-green rounded-lg hover:text-green-hover sm:hover:text-white
                    sm:hover:bg-green-hover focus:outline-2 focus:outline-green-darker h-fit w-fit"
             href="profile/nutritional-data">
            Edit data
            <span class="material-icons ml-2 -mr-1 text-xl font-medium sm:text-lg">arrow_forward</span>
          </a>
        </div>
      </div>

      <h3 class="mt-10 px-6 md:pl-2 sm:text-2xl md:text-3xl font-medium sm:font-bold tracking-wide sm:tracking-tight
                 text-gray-400 sm:text-gray-700">
        Account Settings
      </h3>
      <div class="mt-3 mb-8 flex flex-col md:flex-row sm:gap-6">
        <div class="md:max-w-sm px-6 sm:p-6 bg-white border border-gray-200 rounded-lg shadow flex justify-between sm:flex-col">
          <a href="#" class="flex items-center">
            <h5 class="sm:mb-2 sm:text-2xl font-medium sm:font-bold tracking-wide md:tracking-tight text-gray-700">Change Password</h5>
          </a>
          <p class="mb-5 font-normal text-gray-500 hidden sm:block">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A at distinctio dolorem dolorum fuga
          </p>
          <a class="inline-flex transition-colors items-center px-3 py-2 sm:text-sm font-medium text-center text-green
                    sm:text-white sm:bg-green rounded-lg hover:text-green-hover sm:hover:text-white
                    sm:hover:bg-green-hover focus:outline-2 focus:outline-green-darker h-fit w-fit"
             href="#">
            Edit data
            <span class="material-icons ml-2 -mr-1 text-xl font-medium sm:text-lg">arrow_forward</span>
          </a>
        </div>

        <div class="md:max-w-sm px-6 sm:p-6 bg-white border border-gray-200 rounded-lg shadow flex justify-between sm:flex-col">
          <a href="#" class="flex items-center">
            <h5 class="sm:mb-2 sm:text-2xl font-medium sm:font-bold tracking-wide md:tracking-tight text-gray-700">Sign Out</h5>
          </a>
          <p class="mb-5 font-normal text-gray-500 hidden sm:block">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A at distinctio dolorem dolorum fuga
          </p>
          <a class="inline-flex transition-colors items-center px-3 py-2 sm:text-sm font-medium text-center text-green
                    sm:text-white sm:bg-green rounded-lg hover:text-green-hover sm:hover:text-white
                    sm:hover:bg-green-hover focus:outline-2 focus:outline-green-darker h-fit w-fit"
             href="#">
            Edit data
            <span class="material-icons ml-2 -mr-1 text-xl font-medium sm:text-lg">arrow_forward</span>
          </a>
        </div>

        <div class="md:max-w-sm px-6 sm:p-6 bg-white border border-gray-200 rounded-lg shadow flex justify-between sm:flex-col">
          <a href="#" class="flex items-center">
            <h5 class="sm:mb-2 sm:text-2xl font-medium sm:font-bold tracking-wide md:tracking-tight text-gray-700">Delete Account</h5>
          </a>
          <p class="mb-5 font-normal text-gray-500 hidden sm:block">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A at distinctio dolorem dolorum fuga
          </p>
          <a class="inline-flex transition-colors items-center px-3 py-2 sm:text-sm font-medium text-center text-green
                    sm:text-white sm:bg-green rounded-lg hover:text-green-hover sm:hover:text-white
                    sm:hover:bg-green-hover focus:outline-2 focus:outline-green-darker h-fit w-fit"
             href="#">
            Edit data
            <span class="material-icons ml-2 -mr-1 text-xl font-medium sm:text-lg">arrow_forward</span>
          </a>
        </div>
      </div>

    </div>
  </section>

</div>