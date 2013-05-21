<head>
<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="js/jquery.easyui.min.js"></script>  
<script>
$(function(){
    TheObject = {
    getArray: function(callback) { 
        $.ajax({
              cache: true,
              type: 'POST',
        url: 'menu_js.php',
              success: function (data){ 
                  callback.call(this,data);
              }
         });
     }
}

TheObject.getArray(function(data) {
    javascript: console.log(data);    
});
$.ajax({
        type: 'POST',
        url: 'menu_js.php',
        success: function(data){
            $('#result').html(data);
        },
       
    });   
    
})
</script>
</head>
<body>
<div id="result"></div>
tes
</body>