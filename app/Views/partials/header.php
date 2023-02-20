<?php
$active = $active ?? 'overview';
$previousPage = $previousPage ?? false;

function renderActive(string $link, string $active): void {
  if ($link === $active) {
    echo 'text-green';
  }
}
?>
<header class="h-14 w-full fixed top-0 left-0 py-2 lg:py-3 px-6 bg-white flex justify-between z-50
                 lg:px-0 lg:py-6 lg:w-60 lg:h-full shadow-sm lg:shadow-lg lg:flex-col lg:gap-y-14">

  <?php if(!$previousPage):?>
    <a href="/overview">
      <img class="w-auto h-full lg:h-auto w-full lg:px-6" src="/assets/logo.svg" alt="logo">
    </a>
  <?php else:?>
    <a href="/overview" class="hidden lg:block">
      <img class="w-auto h-full lg:h-auto w-full lg:px-6" src="/assets/logo.svg" alt="logo">
    </a>
    <a href="<?=$previousPage?>" class="flex lg:hidden text-gray-400 hover:text-gray-700">
      <span class="material-icons text-4xl">arrow_back</span>
    </a>
  <?php endif; ?>
  <nav class="flex items-center lg:items-start bg-white grow">
    <ul class="fixed flex w-full justify-between bottom-0 left-0 group border-t border-t-gray-200 lg:static lg:flex-col lg:border-none">
      <li class="grow">
        <a class="menu-link mobile-menu__entry pl-6" href="/overview">
          <span class="material-icons <?php renderActive('overview', $active) ?>">home</span>
          <span class="font-medium text-xs lg:text-base tracking-wide lg:inline <?php renderActive('overview', $active) ?>"><?=_('Overview')?></span>
        </a>
      </li>
      <li class="grow-[3] sm:grow">
        <a class="menu-link mobile-menu__entry" href="/diary">
          <span class="material-icons <?php renderActive('diary', $active) ?>">library_books</span>
          <span class="font-medium text-xs lg:text-base tracking-wide lg:inline <?php renderActive('diary', $active) ?>"><?=_('Diary')?></span>
        </a>
      </li>
      <li class="grow-[2] sm:grow">
        <a class="menu-link mobile-menu__entry" href="/statistics">
          <span class="material-icons <?php renderActive('statistics', $active) ?>">show_chart</span>
          <span class="font-medium text-xs lg:text-base tracking-wide lg:inline <?php renderActive('statistics', $active) ?>"><?=_('Statistics')?></span>
        </a>
      </li>
      <li class="grow">
        <a class="menu-link mobile-menu__entry pr-6" href="/profile">
          <span class="material-icons <?php renderActive('profile', $active) ?>">person</span>
          <span class="font-medium text-xs lg:text-base tracking-wide lg:inline <?php renderActive('profile', $active) ?>"><?=_('Profile')?></span>
        </a>
      </li>
    </ul>
  </nav>
</header>