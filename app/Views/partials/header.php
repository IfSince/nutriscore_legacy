<?php
$active = $data['active'] ?? 'overview';

function renderActive(string $link, string $active): void {
  if ($link === $active) {
    echo 'text-green';
  }
}
?>
<header class="h-16 w-full fixed top-0 left-0 py-3 px-6 bg-white flex justify-between z-50
                 lg:px-0 lg:py-6 lg:w-60 lg:h-full lg:shadow-lg lg:flex-col lg:gap-y-14">
    <a href="#">
        <img class="w-auto h-full lg:h-auto w-full lg:px-6" src="assets/logo.svg" alt="logo">
    </a>
    <nav class="flex items-center lg:flex-col-reverse lg:grow justify-between bg-white">
        <div class="flex lg:flex-col gap-x-4 w-full">
            <a class="menu-link flex w-full items-center gap-x-6 text-green lg:text-gray-400" href="/profile">
                <span class="material-icons text-5xl lg:text-4xl  <?php renderActive('profile', $active) ?>">person</span>
                <span class="hidden font-medium text-base tracking-wide lg:inline  <?php renderActive('profile', $active) ?>">Profile</span>
            </a>
        </div>

        <ul class="fixed flex w-full justify-between bottom-0 left-0 group border-t border-t-gray-200 lg:static lg:flex-col lg:border-none">
            <li class="grow">
                <a class="menu-link mobile-menu__entry pl-6" href="/overview">
                    <span class="material-icons <?php renderActive('overview', $active) ?>">home</span>
                    <span class="font-medium text-xs lg:text-base tracking-wide lg:inline <?php renderActive('overview', $active) ?>">
                      Overview
                    </span>
                </a>
            </li>
            <li class="grow-[3] sm:grow">
                <a class="menu-link mobile-menu__entry" href="/diary">
                    <span class="material-icons <?php renderActive('diary', $active) ?>">library_books</span>
                    <span class="font-medium text-xs lg:text-base tracking-wide lg:inline <?php renderActive('diary', $active) ?>">
                      Diary
                    </span>
                </a>
            </li>
            <li class="grow-[2] sm:grow">
                <a class="menu-link mobile-menu__entry" href="/statistics">
                    <span class="material-icons <?php renderActive('statistics', $active) ?>">show_chart</span>
                    <span class="font-medium text-xs lg:text-base tracking-wide lg:inline <?php renderActive('statistics', $active) ?>">
                      Statistics
                    </span>
                </a>
            </li>
            <li class="grow">
                <a class="menu-link mobile-menu__entry pr-6" href="/notifications">
                    <span class="material-icons <?php renderActive('notifications', $active) ?>">notifications</span>
                    <span class="font-medium text-xs lg:text-base tracking-wide lg:inline <?php renderActive('notifications', $active) ?>">
                      Notifications
                    </span>
                </a>
            </li>
        </ul>
    </nav>
</header>