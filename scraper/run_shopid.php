<?php
$type = $_GET['a'];
 ?>
<style>

body
{
  background-color: black;
  color: grey;
}

</style>

<body>
  <div id='disp_data'>
  </div>

  <div id='loading'>
  </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>

run_scraper();

setInterval(run_scraper, 500);

function run_scraper()
{
  $.ajax({
          type:'POST',
          url: './shop_id/?a=<?=$type?>',
          data:
          {
            "sample" : "1"
          },
          success:function(data){
            if(data != '')
            {
              console.log(data);
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

</script>
