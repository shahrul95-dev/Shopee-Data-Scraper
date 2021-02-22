<?php
include '../../core/init.php';

$type_request = $_POST['type'];

$all_shops = $shop_class->get_all_shop_only_shopid();

$middle = (int)(count($all_shops)/2);

$counterv1 = 0;

$arrayv1 = array();

foreach ($all_shops as $keyv1 => $valuev1)
{
  $counterv1++;

  if($counterv1 <= $middle)
  {
    $arrayv1[] = $valuev1['shopid'];
  }
  // code...
}


$counterv2 = 0;

$arrayv2 = array();

foreach ($all_shops as $keyv2 => $valuev2)
{
  $counterv2++;

  if($counterv2 > $middle)
  {
    $arrayv2[] = $valuev2['shopid'];
  }
  // code...
}

if($type_request == '1')
{
  echo json_encode($arrayv1);
}
else
{
  echo json_encode($arrayv2);
}

// if($type_request == '1') //front
// {
//
// }
// $all_shops = json_encode($all_shops);
//
//
// var_dump($all_shops);
 ?>
