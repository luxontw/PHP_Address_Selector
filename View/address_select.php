<?php echo '<div class="col-md-2"><select class="form-control" name="'.$name.'" onchange="this.form.submit();" onfocus="this.selectedIndex=-1;">';
if(is_array($items))
{
  foreach ($items as $item) { echo $item; }
} else {
  echo $items;
}?></select></div>