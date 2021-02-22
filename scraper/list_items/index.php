<?php
include '../../core/init.php';
error_reporting(0);
//
// var_dump($_POST['shopid']);
// $all_shops = $shop_class->get_all_shop();

$shopid = $_REQUEST['shopid'];
// foreach ($all_shops as $key_shops => $value_shops)
// {
// $urls= 'https://shopee.com.my/api/v2/recommend_items/get?limit=20000&offset=0&recommend_type=28&shopid='.$shopid;
$urls = 'https://shopee.com.my/api/v2/search_items/?by=relevancy&limit=20000&match_id='.$shopid.'&newest=0&order=desc&page_type=shop&version=2';

$check_date_last_prod = $product_class->get_last_product($shopid);

$proceed_status = true;

if($check_date_last_prod != NULL)
{
    $date_last_prod = date("Y-m-d H:i:s",strtotime($check_date_last_prod['date_created']." +$hours_config hours"));

    if($date_last_prod >= date("Y-m-d H:i:s"))
    {
      $proceed_status = false;
    }

}

if($proceed_status)
{
  $mycurl = new mycurl($urls);

  $mycurl->createCurl($urls);

  $data = $mycurl->__tostring();

  $data = json_decode($data,true);

  if($data['items'] != NULL)
  {
    if(count($data['items']) > 0)
    {
      $products = $data['items'];

      $insert_disp = false;

      foreach ($products as $key_product => $value_product)
      {
        $product_data = $product_class->get_product($shopid,$value_product['itemid']);

        $insert_status = true;

        if($product_data != NULL)
        {
            $check_date = date("Y-m-d H:i:s",strtotime($product_data['date_created']." +$hours_config hours"));

            if($check_date >= date("Y-m-d H:i:s"))
            {
              $insert_status = false;
            }

        }

        if($insert_status)
        {

          $urls_prod = 'https://shopee.com.my/api/v2/item/get?itemid='.$value_product['itemid'].'&shopid='.$shopid;

          $mycurl_prod = new mycurl($urls_prod);

          $mycurl_prod->createCurl($urls_prod);

          $data_prod = $mycurl_prod->__tostring();

          $data_prod = json_decode($data_prod,true);

          $prod_price_string = '';

          foreach ($data_prod['item']['models'] as $key_model => $value_model)
          {
            $prod_price_string .= $value_model['name']."|".number_format($value_model['price']/100000, 2, '.', '')."|";
          }

          $prod_price_string = rtrim($prod_price_string,"|");

          $param = array(
            1 => $value_product['shopid'],
            2 => $value_product['itemid'],
            3 => $value_product['image'],
            4 => $prod_price_string,
            5 => $data_prod['item']['name'],
            6 => $data_prod['item']['stock']
          );

          $product_class->insert_product($param);
          // var_dump($server_output);
          // $initialFile = 'api_log_items'.date("Ymd").'.log';
          // $str = "\r\n DATE ".date('[Y-m-d H:i:s]')."\n ShopID: ".print_r($value_product, true)."\n DATA: ".print_r($server_output, true);
          // file_put_contents($initialFile, $str."\n", FILE_APPEND);

          $insert_disp = true;
        }

      }

      if($insert_disp)
      {
        echo $shopid." (".count($data['items']).") ".date('d M Y h:i A');
      }

    }
  }
}


// }


// echo "<pre>";
// var_dump($data);
// echo "</pre>";

?>
