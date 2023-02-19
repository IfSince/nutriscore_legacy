<?php $searchResult = $searchResult ?? null; ?>

<?php if($searchResult != null && $searchResult->getRowCount() > 0): ?>
  <div class="relative overflow-x-auto pt-4">
    <table class="w-full text-sm text-left text-gray-500" aria-label="Search results">
      <?php if($searchResult->includeHeader()):?>
        <thead class="text-xs text-gray-900 uppercase">
          <tr>
            <?php foreach ($searchResult->getFields() as $field):?>
              <th scope="col" class="px-6 py-3">
                <?=$field?>
              </th>
            <?php endforeach;?>
          </tr>
        </thead>
      <?php endif;?>
      <tbody>
        <?php foreach ($searchResult->getRows() as $row):?>
          <tr class="bg-white border-b last:border-none hover:bg-gray-100">
            <?php foreach ($searchResult->getFields() as $field):?>
              <th scope="row" class="font-medium text-gray-900 whitespace-nowrap">
                <?php if($searchResult->isClickable()):?>
                  <a href="<?= $row['link']?>" class="px-6 py-4 block cursor-pointer"><?=ucfirst($row[$field])?></a>
                <?php else:?>
                  <span class="px-6 py-4 block"><?=ucfirst($row[$field])?></span>
                <?php endif;?>
              </th>
            <?php endforeach;?>
          </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>
<?php endif;?>