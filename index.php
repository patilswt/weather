<!DOCTYPE html>
<html lang="en">
<head>
<title>Weather Forecast</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
    <form name="form1" method="post" >    
    <input type="text" id="cname"  placeholder="City name..">
    <button class="button" type="button" id="csearch" >Search</button>
  </form>
</div>

<div id="records_content">
  
  
</div>
</body>
</html>
<script>
  
  $(document).ready(function() {
        //alert("success");
    $("#csearch").click(function() {
        var cname = $('#cname').val();
          //alert(cname);
        if(cname != "")
        {
          $.ajax({
              type: "POST",
              url: "papi1.php",
              data: { cname: cname },
              success: function(result){  
              //alert(result);            
                $('#records_content').html(result);
              }
          });
        }else{ 
          alert("please enter city name"); 
        }
      });
  });

</script>

