

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1,user-scalable=no" >
    <title>报警设置</title>       
    <link rel="stylesheet" href="http://libs.baidu.com/jquerymobile/1.3.0/jquery.mobile-1.3.0.min.css" type="text/css" >    

   
    <link rel="shortcut icon" href="script/favicon.ico">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700" type="text/css" >
<script src="http://libs.baidu.com/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
       

   
    <script  src="http://libs.baidu.com/jquerymobile/1.3.0/jquery.mobile-1.3.0.min.js"  type="text/javascript"></script>
     <style type="text/css">
   .btcprice, .ltcprice
        {
            font-weight: bold;
            color: #ff9100;
            background-color: #fef1e6;
        }
        .price
        {
            background-color: #eaffe6;
            color: #5bc819;
        }
    </style>
</head>
<body>
<?php
$ch = curl_init();  
			curl_setopt($ch,CURLOPT_URL, "http://btckan.com/price/api");  
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);  
			$transaction_json = curl_exec($ch);  
			curl_close($ch);
			$transaction=json_decode($transaction_json,1);
			$link=mysql_connect('localhost','susheng','mingyun');
			mysql_select_db("susheng");
			mysql_query('set names utf8');
			$openid=mysql_escape_string($_GET['FromUserName']);
			$sql="select btclow,btcup,weixinkg from btc where openid='$openid'";
			$res=mysql_query($sql);
			$btc=mysql_fetch_array($res);
			mysql_close();
?>
    <div data-role="page" id="home">
        <div data-role="header" class="jqm-header" data-position="fixed">
            
            <div class="price">
             OKCoin价 BTC:<span class="btcprice">￥<?php echo $transaction['markets'][19][last][cny] ;?></span><!-- LTC:<span class="ltcprice">￥95.71</span>-->
            </div>
           
        </div>
        <!-- /header -->
        <div data-role="content">
            <ul data-role="listview" data-inset="true">
                <li data-role="list-divider">BTC价格监控</li>
                <li data-role="fieldcontain">
                    <select name="btckg" id="btckg" data-role="slider">
                        <option value="off">关</option>
                        <option value="on" selected="selected">开</option>
                    </select>
                    <hr />
                    <div>
                        <label>
                            当BTC价格上涨到此时发送报警￥:</label>
                        <input type="range" name="btcpriceup" id="btcpriceup" value="<?php if(!empty($btc['btcup'])){echo $btc['btcup'];}else{echo 4000;}?>"
                            min="3796" max="4738" data-highlight="true">
                    </div>
                    <div>
                        <label>
                            当BTC价格下跌到此时发送报警￥:</label>
                        <input type="range" name="btcpricedown" id="btcpricedown" value="<?php if(!empty($btc['btclow'])){echo $btc['btclow'];}else{echo 3500;}?>"
                            min="3036" max="3796" data-highlight="true">
                    </div>
                </li>
                <!-- <li data-role="list-divider">莱特币LTC价格波动报警-(情报监控员)</li>
                <li data-role="fieldcontain">
                    <select name="ltckg" id="ltckg" data-role="slider">
                        <option value="off">关</option>
                        <option value="on" selected="selected">开</option>
                    </select>
                    <hr />
                    <div>
                        <label>
                            当LTC价格上涨到此时发送报警￥:</label>
                        <input type="range" name="ltcpriceup" id="ltcpriceup" value="119.4"
                            min="95.7" max="119.4"
                            step=".1" data-highlight="true">
                    </div>
                    <div>
                        <label>
                            当LTC价格下跌到此时发送报警￥:</label><br />
                        <input type="range" name="ltcpricedown" id="ltcpricedown" value="85.6"
                            min="76.6" max="95.7"
                            step=".1" data-highlight="true">
                    </div>
                </li>-->
                <li data-role="list-divider">报警通知方式</li>
                <li data-role="fieldcontain">
                    <label for="weixinkg">
                        微信通知</label>
                    <select name="weixinkg" id="weixinkg" data-role="slider">
                        <option value="off">关</option>
                        <option value="on" selected="selected">开</option>
                    </select>
                  <!--   <label for="telkg">
                        手机短信通知</label>
                    <select name="telkg" id="telkg" data-role="slider">
                        <option value="off">关</option>
                        <option value="on" >开</option>
                    </select>-->
                </li>
            </ul>
            <a href="#" data-role="button" data-theme="b" data-icon="check" onclick="setalarm();">
                保存设置</a>
        </div>
        <!-- /content -->
        <div data-role="footer" data-id="foo1" data-position="fixed">
            <div data-role="navbar">
                <ul>
                    <li><a target="_blank"  href=""   data-transition="none" 
                        class="ui-btn-active ui-state-persist" data-icon="gear">最专业的人民币 ripple 网关</a></li>
                    
                  <!--  <li><a    href="bindmob.php?FromUserName=oz5HEtz1SW14r7D1k1LCt7nxQtCg&v=1" 
                        data-transition="none" data-icon="home"  onclick="$.mobile.showPageLoadingMsg('b','加载中...',false);" >个人信息</a></li>
                    <li><a      href="donate.php?FromUserName=oz5HEtz1SW14r7D1k1LCt7nxQtCg&v=1"   data-transition="none" data-icon="plus"  onclick="$.mobile.showPageLoadingMsg('b','加载中...',false);">捐赠</a></li>
                    <li><a     onclick="$.mobile.showPageLoadingMsg('b','加载中...',false);"href="market.php?FromUserName=oz5HEtz1SW14r7D1k1LCt7nxQtCg&v=1"   data-transition="none" data-icon="grid"     >行情</a></li>
					-->
                </ul>
            </div>
            <!-- /navbar -->
        </div>
        <!-- /footer -->
    </div>
    <!-- /page -->
        <div data-role="popup" id="popupDialog" data-overlay-theme="a" data-theme="c" style="max-width: 400px;"
        class="ui-corner-all">
        <div data-role="header" data-theme="a" class="ui-corner-top">
            <h3>
                提示</h3>
        </div>
        <div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">
            <div id="t">
            </div>
            <a href="#" data-role="button" data-rel="back" data-theme="c">知道了</a>
        </div>
    </div>
</body>

<script type="text/javascript">
/* $(document).bind("mobileinit", function(){
     $("#flipltcwx").slider("enable");
});
 $(document).bind("pageshow", function(){
   // alert(000);
});*/
 $(function(){
 
  $( "#btckg" ).unbind("change").on( 'change', function( event ) {
     var btckg=$(this).val();
     var btcpriceup=$("#btcpriceup");
     var btcpricedown=$("#btcpricedown");
     if(btckg=="on"){
        btcpriceup.slider('enable');
        btcpricedown.slider('enable');
     }else{
        btcpriceup.slider('disable');
        btcpricedown.slider('disable');
     }
     btcpriceup.slider('refresh');
     btcpricedown.slider('refresh');
  });
 /* $( "#ltckg" ).unbind("change").on( 'change', function( event ) {
     var ltckg=$(this).val();
     var ltcpriceup=$("#ltcpriceup");
     var ltcpricedown=$("#ltcpricedown");
     if(ltckg=="on"){
        ltcpriceup.slider('enable');
        ltcpricedown.slider('enable');
     }else{
        ltcpriceup.slider('disable');
        ltcpricedown.slider('disable');
     }
     ltcpriceup.slider('refresh');
     ltcpricedown.slider('refresh');
  });
  */
  
//$( "#sliderbtcup" ).bind( "change", function(event, ui) {
 // alert(  $(this).val(   )   );
//});
/*$( "#telkg" ).bind( "change", function(event, ui) {
　　var kg= $(this);
　　if(kg.val()=="on"){
　　   if(Tel==""){
　　     showdg("您没有绑定手机号，请去先个人中心绑定手机号");
　　     kg.val("off");
　　     kg.slider('refresh');  
　　     return;
　　   }
　　 if(BTCBalance<NeedBTCBalance  &&  LTCBalance < NeedLTCBalance){
　　     showdg("注意:由于您打开了手机短信报警,由于短信发送方会产生费用,需要您捐助1个LTC或0.02个BTC帮助我们,您可以在捐赠功能中获得地址，在3个确认后我们将为你充值你才可以启用短信通知功能");
　　     kg.val("off");
　　     kg.slider('refresh');  
　　     return;
　　   }
　　}　
});*/

});



function showdg(str) {
         var dialog = $('#popupDialog');
         $('#popupDialog #t').html(str);
         dialog.trigger("create");
         dialog.popup();
         dialog.popup('open');
     }
//via:http://14.104.164.109/WXUserCenter/home.aspx?FromUserName=oz5HEtz1SW14r7D1k1LCt7nxQtCg
var WeixinUserID=2735;
var FromUserName="<?php echo $_GET['FromUserName']?>";
var Tel="";
var NeedBTCBalance=0.02; //够资格发短信的BTC数
var NeedLTCBalance=1;//够资格发短信的LTC数
var BTCBalance=0.000000;
var LTCBalance=0.000000;
function setalarm(){
//$( "#telkg" ).val("on");
//$( "#telkg" ).slider( "refresh" );
 
  var btckg = $("#btckg").val();
  var btcpriceup=$("#btcpriceup").val();
  var btcpricedown=$("#btcpricedown").val();
  var ltckg = $("#ltckg").val();
  var ltcpriceup=$("#ltcpriceup").val();
  var ltcpricedown=$("#ltcpricedown").val();
  var weixinkg=$("#weixinkg").val();
  var telkg=$("#telkg").val();
  $.mobile.showPageLoadingMsg("b","设置中",false);
  $.post("ajax.php?cmd=setalarm",{"WeixinUserID":WeixinUserID,"FromUserName":FromUserName,"btckg":btckg,"btcpriceup":btcpriceup
  ,"btcpricedown":btcpricedown,"ltckg":ltckg,"ltcpriceup":ltcpriceup,"ltcpricedown":ltcpricedown,"weixinkg":weixinkg,"telkg":telkg},function(data){
    $.mobile.hidePageLoadingMsg();
    if(data =="ok"){
        var msg = "设置成功,开始监控行情中...,当价格行情波动到你设置的涨跌条件时,会自动发送微信!";//或手机短信通知
        //$( "#popupDialog" ).on( "popupafterclose", function( event, ui ) {window.location.reload();} );
        if(telkg=="on" ){
           if(Tel == ""){
              msg +="<br/>注意:由于您打开了手机短信报警,您还没有绑定手机号,请到个人信息中心去绑定接收通知短信的手机号";
           }else{
               if(BTCBalance<NeedBTCBalance  &&  LTCBalance < NeedLTCBalance){
                   msg +="<br/>注意:由于您打开了手机短信报警,由于短信发送方会产生费用,需要您捐助1个LTC或0.02个BTC帮助我们,捐助地址在个人信息中心";
               }else{
                  msg +="<br/>您已成功启用手机短信通知功能，此功能为新开发已正式上线";
               }
             
           }
        }else{
        
        }
         showdg(msg);
    }else{
         showdg(ok);
    }//end if
  
  });  
 
}//end fun
/*(function(){
          var onBridgeReady =  function () {
          var appId  = '',
              imgUrl = "https://www.rippay.com/images/rippay-footer.png",
              link   = "http://www.baidu.com",              
    			title  ="rippay",
                desc   = "go",
                fakeid = "",
                desc = desc || link;

// 发送给好友; 
          WeixinJSBridge.on('menu:share:appmessage', function(argv){
            
			WeixinJSBridge.invoke('sendAppMessage',{
			  "appid"      : appId,
			  "img_url"    : imgUrl,
			  "img_width"  : "640",
			  "img_height" : "640",
			  "link"       : share_scene(link, 1),
			  "desc"       : desc,
			  "title"      : title
									}, function(res) {report(link, fakeid, 1);
									}
							);
		});

// 分享到朋友圈;
          WeixinJSBridge.on('menu:share:timeline', function(argv){
            report(link, fakeid, 2);
			WeixinJSBridge.invoke('shareTimeline',{
			  "img_url"    : imgUrl,
			  "img_width"  : "640",
			  "img_height" : "640",
			  "link"       : share_scene(link, 2),
			  "desc"       : desc,
			  "title"      : title
			  }, function(res) {});
            
		});

// 分享到微博;
var weiboContent = '';
          WeixinJSBridge.on('menu:share:weibo', function(argv){
            
		WeixinJSBridge.invoke('shareWeibo',{
		  "content" : title + share_scene(link, 3),
		  "url"     : share_scene(link, 3) 
		  }, function(res) {report(link, fakeid, 3);
		  });
});

// 分享到Facebook
  WeixinJSBridge.on('menu:share:facebook', function(argv){
  report(link, fakeid, 4);
  WeixinJSBridge.invoke('shareFB',{
  "img_url"    : imgUrl,
  "img_width"  : "640",
  "img_height" : "640",
  "link"       : share_scene(link, 4),
  "desc"       : desc,
  "title"      : title
  }, function(res) {} );
  });

// 隐藏右上角的选项菜单入口;
//WeixinJSBridge.call('hideOptionMenu');
//隐藏微信中网页底部导航栏
  WeixinJSBridge.call('hideToolbar');
};
    if(document.addEventListener){
          document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
        } else if(document.attachEvent){
          document.attachEvent('WeixinJSBridgeReady'   , onBridgeReady);
          document.attachEvent('onWeixinJSBridgeReady' , onBridgeReady);
        }
})();*/

</script>

</html>
