<div class="listing__item contador">
  <div class="properties properties--grid">
	<div class="properties__thumb">
    <a href="property_details.php?id=<?=$row['dato2']?>" target="_blank" class="item-photo">
      <img src="dinamic_filter/getImages.php?id=<?=$row['dato2']?>&w=483&h=262" width="483" height="262" alt="" />
      <figure class="item-photo__hover item-photo__hover--params">
        <span class="properties__more">View details</span>
      </figure>
    </a>
	</div>
	<div class="properties__details">
	  <div class="properties__info">
      <a href="property_details.php?id=<?=$row['dato2']?>" target="_blank" class="properties__address">
        <span class="properties__address-street"><?=$row['dato7']?></span><span class="properties__address-city"><?=$row['dato10'] . ', '. $row['dato11'] . ', GA ' . $row['dato24'] . ', US'?> - <?=($row['id'] == "1" ? 'FMLS' : 'GAMLS' )?></span>
      </a>
		<div class="properties__offer">
		  <div class="properties__offer-column">
			<div class="properties__offer-value"><strong>$<?=number_format($row['dato5'])?></strong><span class="properties__offer-period"></span>
			</div>
			<?php if ($loggedIn): ?>
              <div>
                <?php include '../control/button.php'; ?>
              </div>
            <?php endif ?>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</div>
