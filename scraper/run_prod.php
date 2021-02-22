<?php
include '../core/init.php';
 ?>
<style>

body
{
  background-color: black;
  color: grey;
}

</style>

<body>
  <u>Start at <?= date('d M Y h:iA') ?></u>
  <div id='disp_data'>
  </div>

  <div id='loading'>
  </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>

<?php
  // $all_shops = $shop_class->get_all_shop();
  //
  // $string = '';
  //
  // foreach ($all_shops as $key => $value)
  // {
  //   $string .= "'".$value['shopid']."',";
  // }
  //
  // $string = rtrim($string,',');

?>
var shopids = [];

$.ajax({
        type:'POST',
        url: './list_items/getShop.php',
        data:
        {
          "type" : '<?= $_GET['a'] ?>'
        },
        success:function(data){
            shopids = JSON.parse(data); //an array [1,2]

        }
    });


var i = 0;

setInterval(run_scraper, 500);

function run_scraper()
{

  if(shopids.length >= i)
  {
    console.log(shopids[i]);

    $.ajax({
            type:'POST',
            url: './list_items/',
            data:
            {
              "shopid" : shopids[i]
            },
            success:function(data){
              if(data != '')
              {
                $("#disp_data").append(data+"<br>");

                window.scrollTo(0,document.body.scrollHeight);

              }
              else
              {
                var string_dot = '';

                for( var i =0; i< (Math.floor(Math.random() * 5) + 1); i++)
                {
                  string_dot = string_dot+'.';
                }
                $("#loading").html("<br>"+data+"Processing"+string_dot);
              }
            }
        });
    }
    else
    {
      location.reload();
    }

    i++;

}

</script>
