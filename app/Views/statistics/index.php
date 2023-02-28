<!-- usually use node_modules to use chart.js, but because we don't have a js builder or similar I temporarily import it like this -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<?php
$messages = $messages ?? [];

getTemplatePart('head', ['title' => 'statistics', 'module' => 'statistics']);
getTemplatePart('header', ['active' => 'statistics']);
?>

<div class="pt-14 lg:pt-0 lg:pl-60 h-full w-full">
  <section class="px-6 py-4 lg:pt-16 lg:pb-10 flex justify-center items-center bg-gradient-to-b from-gray-600 to-gray-800 relative"></section>

  <?php getTemplatePart('date-range-selector');?>
  <section class="w-full bg-gray-100 md:pb-10 py-6 md:px-4">
    <?php getTemplatePart('global-messages', ['messages' => $messages]);?>

    <div class="w-full bg-white p-3 pb-10 md:rounded-md flex flex-col gap-4 shadow-border mb-6">
      <div class="border-b border-b-gray-200 pb-3 px-2">
        <h3 class="text-xl md:text-2xl text-gray-800"><?=_('Weight')?></h3>
      </div>
      <div class="xl:w-2/3" >
        <script>
          const data = JSON.parse('<?= json_encode($weightRecordings)?>');
          const weightRecordingsData = data.sort((a,b) =>  new Date(a.dateOfRecording) - new Date(b.dateOfRecording));
        </script>

        <canvas id="weightRecordings"></canvas>
      </div>
    </div>

    <!-- would like to display images in the chart declared in js, but for now just shown below for completeness -->
    <div class="w-full bg-white p-3 pb-10 md:rounded-md flex flex-col gap-4 shadow-border mb-6">
      <div class="border-b border-b-gray-200 pb-3 px-2">
        <h3 class="text-xl md:text-2xl text-gray-800"><?=_('Images')?></h3>
      </div>
      <?php foreach ($images as $image):?>
        <div class="flex">
          <div class="flex flex-col overflow-hidden">
            <img class="h-24 w-auto object-contain" src="<?=$image->getPath()?>" alt="<?=$image->getText()?>">
            <span class="pt-2 text-gray-500"><?=$image->getText()?></span>
          </div>

        </div>
      <?php endforeach;?>
    </div>
  </section>

</div>