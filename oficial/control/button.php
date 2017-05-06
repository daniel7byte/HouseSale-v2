<?php if (getStatus($row['dato2'], $_SESSION['id']) == true): ?>

  <a id="<?=$row['dato2']?>" target="_blank" onclick="event.preventDefault(); changeStatus(<?=$row['id']?>, <?=$row['dato2']?>)" class="btn btn-info btn-xs">
    <span class="glyphicon glyphicon-star"></span>
  </a>

<?php else: ?>

  <a id="<?=$row['dato2']?>" target="_blank" onclick="event.preventDefault(); changeStatus(<?=$row['id']?>, <?=$row['dato2']?>)" class="btn btn-danger btn-xs">
    <span class="glyphicon glyphicon-star-empty"></span>
  </a>

<?php endif; ?>