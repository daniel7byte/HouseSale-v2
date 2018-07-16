<style>
  .price-to .plus {
    display: none;
  }
</style>

<script src="assets/sweetalert/sweetalert.min.js"></script>
<link rel="stylesheet" href="assets/sweetalert/sweetalert.css">

<script>
    $( "form" ).submit(function( event ) {
        if ( $( "#zipcode" ).val() == "" ) {
            if ( $( "#city" ).val() == "-" ) {
                if ( $( "#county" ).val() != "-" ) {
                    return;
                }
            }else{
                return;
            }
        }else{
            return;
        }

        sweetAlert("", "Select a field. City or County!", "error");
        event.preventDefault();
    });
</script>

<div class="form-group">
    <label for="in-contract-type" class="control-label" style="font-size: 16px;"><?php echo FORM_LABEL1; ?></label>
    <select id="" data-placeholder="Contract type" class="form-control">
        <option>Georgia</option>
    </select>
</div>

<div class="form-group">
    <label for="zipcode" class="control-label"><?php echo FORM_LABEL2; ?></label>
    <input class="form-control" type='text' name="zipcode" id="zipcode" value="">
</div>

<div class="form-group">
    <label for="county" class="control-label"><?php echo FORM_LABEL3; ?></label>
    <select class="form-control" name="county" id="county" required>
        <option value="-"><?php echo FORM_SELECT_ALL; ?></option>
        <?php
        $queryCounty = $mysql->prepare("SELECT DISTINCT dato11 FROM datoscasas ORDER BY dato11 ASC;");
        $queryCounty->execute();
        $rowsCounty = $queryCounty->fetchAll();
        foreach ($rowsCounty as $row):
            ?>
            <option value="<?=$row['dato11']?>"><?=$row['dato11']?></option>
        <?php endforeach; ?>
    </select>
</div>

<div class="form-group">
    <label for="city" class="control-label"><?php echo FORM_LABEL4; ?></label>
    <select id="city" name="city" class="form-control">
        <option value="-"><?php echo FORM_SELECT_ALL; ?></option>
        <?php
        $queryCounty = $mysql->prepare("SELECT DISTINCT dato10 FROM datoscasas ORDER BY dato10 ASC;");
        $queryCounty->execute();
        $rowsCounty = $queryCounty->fetchAll();
        foreach ($rowsCounty as $row):
            ?>
            <option value="<?=$row['dato10']?>"><?=$row['dato10']?></option>
        <?php endforeach; ?>
    </select>
</div>

<div class="form-group">
    <label for="price" class="control-label"><?= FORM_LABEL6 ?></label>
    <input type=number name=price-min value=<?= ($_GET['price-min']) ?? 1 ?> min=1 class=form-control placeholder="Min" style="margin-bottom: 1rem" id="price-min">
    <input type=number name=price-max value=<?= ($_GET['price-max']) ?? 99999999 ?> max=99999999 class=form-control placeholder="Max" id="price-max">
</div>

<!-- Daterangepicker -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<div class="form-group" style="display:block;">
    <label for="datefilter" class="control-label">DATE</label>
    <!-- <input class="form-control" type='text' name="datefilter" id="datefilter" value=""> -->
    <input type="text" class="form-control" name="datefilter" id="datefilter" value="" />
</div>

<script type="text/javascript">
$(function() {

  $('input[name="datefilter"]').daterangepicker({
      autoUpdateInput: false,
      autoApply: true,
      locale: {
          cancelLabel: 'Clear',
          format: 'YYYY-MM-DD'
      }
  });

  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
  });

  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});
</script>
<!-- End Daterangepicker -->

<div class="form-group" style="display:none;">
    <label for="id" class="control-label">ID</label>
    <input class="form-control" type='text' name="id" id="id" value="">
</div>

<div class="form-group">
    <label for="systemFiltro" class="control-label"><?php echo FORM_LABEL7; ?></label>
    <select class="form-control" name="systemFiltro" id="systemFiltro">
        <option value="" selected><?php echo FORM_SELECT_ALL; ?></option>
        <option value="1">FMLS</option>
        <option value="0">GAMLS</option>
    </select>
</div>
