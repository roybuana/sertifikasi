<?php
	defined('START')||(header("HTTP/1.1 403 Forbidden")&die('403.14 - Directory listing denied.'));
?> 
<script type="text/javascript">
        
        	$(function(){
        	   	$("#login").live("click",function(){
            		$("#fm").submit();	
            	})
        	   
         //$("tr").css({"height":"50px"});	  
 function getWidth()
      {
        xWidth = null;
        if(window.screen != null)
          xWidth = window.screen.availWidth;
    
        if(window.innerWidth != null)
          xWidth = window.innerWidth;
    
        if(document.body != null)
          xWidth = document.body.clientWidth;
    
        return xWidth;
      }
function getHeight() {
      xHeight = null;
      if(window.screen != null)
        xHeight = window.screen.availHeight;
    
      if(window.innerHeight != null)
        xHeight =   window.innerHeight;
    
      if(document.body != null)
        xHeight = document.body.clientHeight;
    
      return xHeight;
    }

//     alert(ting.height);
    if(getWidth()<=400){
         $('#win').window({
            width:240,
            modal:true,
            shadow:false,
            resizable:false,
            draggable:false,
            closable:false,
            maximizable:false,
            minimizable:false,
            collapsible:false
        })
        $('#tombolOK').linkbutton({
            iconCls:'icon-remove',
                plain:true,
                height:50
        })
        
       
       
    }else if(getWidth()>=401 && getWidth()<=710){
         $('#win').window({
            width:240,
            modal:true,
            shadow:false,
            resizable:false,
            draggable:false,
            closable:false,
            maximizable:false,
            minimizable:false,
            collapsible:false
        })
    }else{
         $('#win').window({
            width:240,
            modal:true,
            shadow:false,
            resizable:false,
            draggable:false,
            closable:false,
            maximizable:false,
            minimizable:false,
            collapsible:false
        })
    
                  
        
    }
		            })
	</script>
  <style>
  @media screen and (min-width: 250px) and (max-width: 350px){
    #d_username{float:left;
   width:100%;}
   #i_username{float:left;
   width:100%;}
   #i_login{float:left;
   width:65%;}
    }
  @media screen and (min-width: 351px) and (max-width: 800px){
    #d_username{float:left;
   width:100%;}
   #i_username{float:left;
   width:100%;}
   #i_login{float:left;
   width:65%;}
    }
  @media screen and (min-width: 801px) and (max-width: 2991px){
   #d_username{float:left;
   width:100%;}
   #i_username{float:left;
   width:100%;}
   #i_login{float:left;
   width:65%;}
    }
   
  #username,#pass
{
    border: 5px solid white; 
    -webkit-box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    -moz-box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    padding: 15px;
    background: rgba(255,255,255,0.5);
    margin: 0 0 10px 0;
    font-size: 15px;
}
  #login
{
    border: 5px solid white; 
    width:150px;
    -webkit-box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    -moz-box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    padding: 10px;
    background: rgba(213,222,211,0.5);
    margin: 0 0 0px 0;
    
}
  	.formLayout{
		margin-top: 20px;	
	}
	.formLayout label, .formLayout input
    {
        display: block;
        width: 220px;
        float: left;
        margin-bottom: 10px;
    }
 
    .formLayout label
    {
        text-align: right;
        padding-right: 20px;
    }
 
    br
    {
        clear: left;
    }
  
  </style>
 	
