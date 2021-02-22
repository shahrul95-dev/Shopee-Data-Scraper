<?php
include '../../core/init.php';
// error_reporting(E_ALL);
// exit;
// for ($i=0; $i < 20; $i++)
// {
  if($_POST['shopid_provided'] != NULL)
  {
    $rand_shopid = $_POST['shopid_provided'];
  }
  else
  {
    if($_GET['a'] == '1')
    {
      $rand_shopid = rand(1000000,9999999);
    }
    else if($_GET['a'] == '2')
    {
      $rand_shopid = rand(10000000,99999999);
    }
    else
    {
      $rand_shopid = rand(100000000,999999999);
    }
  }

  $shop_data = $shop_class->get_shop($rand_shopid);

  while($shop_data != NULL)
  {
    if($_GET['a'] == '1')
    {
      $rand_shopid = rand(1000000,9999999);
    }
    else if($_GET['a'] == '2')
    {
      $rand_shopid = rand(10000000,99999999);
    }
    else
    {
      $rand_shopid = rand(100000000,999999999);
    }

    $shop_data = $shop_class->get_shop($rand_shopid);
  }

  if($_GET['shopid'] != NULL)
  {
    $rand_shopid = $_GET['shopid'];
  }
  // if($shop_data == NULL)
  // {
    $urls= 'https://shopee.com.my/api/v2/shop/get?shopid='.$rand_shopid;

    $mycurl = new mycurl($urls);

    $mycurl->createCurl($urls);

    $data = $mycurl->__tostring();

    $data = json_decode($data,true);

    $status = 'Unavailable';

    if($data['data'] != NULL)
    {
      $status = 'Success';

      //
      // if($shop_data == NULL)
      // {
        $param = array(
          1 => $data['data']['userid'],
          2 => $data['data']['shopid'],
          3 => $data['data']['account']['username']
        );

       $shop_class->insert_shop($param);


      // }

    }

    if($status == 'Success')
    {
      $shopid = $rand_shopid;

      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL,"../list_items/");
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS,
                  "shopid=$shopid");

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $server_output = curl_exec($ch);

      curl_close ($ch);

      if($server_output != false)
      {
        echo 'This user have product ready to sell';
      }

      echo $rand_shopid." (".$data['data']['account']['username'].") ".date('d M Y h:i A');
    }
  // }

// }



 ?>
