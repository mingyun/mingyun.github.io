<!DOCTYPE html>
<html>
    <head>
        <title>jQuery Mobile基本页面结构</title>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a3/jquery.mobile-1.0a3.min.css" />
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.5.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/mobile/1.0a3/jquery.mobile-1.0a3.min.js"></script>
    </head>
    <body>

<script type="text/javascript">

 

$( function() {
  $('body').bind( 'taphold', function( e ) {
    alert( 'You tapped and held!' );
    e.stopImmediatePropagation();
    return false;
  } );  

  $('body').bind( 'swipe', function( e ) {
    alert( 'You swiped!' );
    e.stopImmediatePropagation();
    return false;
  } );  
 
} );

</script>  
      <!--  <div data-role="page" id="home">
            <div data-role="header">
                <h1>Header</h1>
            </div>
            <div data-role="content">
                <p>页面中的内容都是包装在div标签中并在标签中加入data-role=”page”属性。 这样jQuery Mobile就会知道哪些内容需要处理。
说明：data-属性是HTML5新推出的很有趣的一个特性，它可以让开发人员添加任意属性到html标签中,只要添加的属性名有“data-”前缀。
在”page”div中，还可以包含”header”， ”content”， ”footer”的div元素,这些元素都是可选的，但至少要包含一个 “content”div。</p>
            </div>
            <div data-role="footer">
                <h4>Footer</h4>
            </div>
        </div>-->
<!-- Start of first page -->
<div data-role="page" id="menu">
   <div data-role="header"><h1>Menu</h1></div><!-- /header -->
   <div data-role="content"> 
   <a href="#" data-role="button" data-theme="a">About this app控制前景颜色，背景色和渐变色</a>
    <a href="#" data-role="button" data-theme="b">About this app</a>
    <a href="#" data-role="button" data-theme="c">About this app</a>
    <a href="#" data-role="button" data-theme="d">About this app</a>
    <a href="#" data-role="button" data-theme="e">About this app</a>
      <p>What vehicles do you like?</p>      
      <p><a href="#Cars">Cars</a></p>
      <p><a href="#Trains">Trains</a></p>
      <p><a href="#Planes">Planes</a></p>   
	  <a href="http://www.lampweb.org" rel="external">不想采用AJAX的方式加载页面，而想以原生的页面加载方式打开一个链接页面</a>
	  <p><a href="#Cars" data-transition="flip">页面切换效果</a></p>
	  <a href="#dialogPopUp" data-rel="dialog" data-role="button">当在一个页面中写多个”page”时在以dialog的方式打开一个页面时，不会出现对话框效果</a>
   </div><!-- /content -->
   <div data-role="footer"><h4>Page Footer</h4></div><!-- /footer -->
</div><!-- /page -->

<div data-role="page" id="Cars">
   <div data-role="header">
      <h1>Cars</h1>
	  <ul data-role="listview" style="margin-top: 0;">
   <li>
      <img src="http://img.freebase.com/api/trans/image_thumb/en/henry_viii_of_england?pad=1&errorid=%2Ffreebase%2Fno_image_png&maxheight=64&mode=fillcropmid&maxwidth=64" />
      <h3><a href="index.html">Henry VIII</a></h3>
      <p>Reign 37 Years</p>
      <a href="#home">Details</a>
   </li>
   <li>
      <img src="http://www.iwise.com/authorIcons/15/King_George%20V_64x64.png" />
      <h3><a href="index.html">George V</a></h3>
<p>Reign 25 Years</p>
      <a href="#home">Details</a>
   </li>
   <li>
      <img src="http://img.freebase.com/api/trans/image_thumb/en/prince_of_wales_secondary_school?pad=1&errorid=%2Ffreebase%2Fno_image_png&maxheight=64&mode=fillcropmid&maxwidth=64" />
      <h3><a href="index.html">Prince of Wales</a></h3>
      <p>Reign N/A</p>
      <a href="#home">Details</a>
   </li>
   <li>
   <img src="http://www.iwise.com/authorIcons/13846/Elizabeth%20I%20of%20England_64x64.png" />
      <h3><a href="index.html">Elizabeth I</a></h3>
      <p>Reign 44 Years</p>
      <a href="#home">Details</a>
   </li>
   <li>
      <img src="http://www.iwise.com/authorIcons/9098/Elizabeth%20II_64x64.png" />
      <h3><a href="index.html">Elizabeth II</a></h3>
      <p>Reign Since 1952</p>
      <a href="#home">Details</a>
   </li>
</ul>
   </div><!-- /header -->
   <div data-role="content">   
      <p>We can add a list of cars</p>
   </div><!-- /content -->
   <div data-role="footer">
      <h4>Page Footer</h4>
   </div><!-- /footer -->
</div><!-- /page -->


<!-- Start of third page -->
<div data-role="page" id="Trains">
   <div data-role="header">
      <h1>Trains</h1>
	  <div data-role="collapsible" data-state="collapsed">
                    <h3>可折叠内容的实例</h3>
                    <p>This app rocks!</p>
                </div>
	  <ul data-role="listview" style="margin-top: 0;">
   <li><a href="#nav1">Henry VIII <span class="ui-li-count">Reign 37 Years</span></a></li>
   <li><a href="#nav1">George V <span class="ui-li-count">Reign 25 Years</span></a></li>
   <li><a href="#nav1">Prince of Wales <span class="ui-li-count">N/A</span></a></li>
   <li><a href="#nav1">Elizabeth I <span class="ui-li-count">Reign 44 Years</span></a></li>
   <li><a href="#nav1">Elizabeth II<span class="ui-li-count">Reign since 1952</span></a></li>
</ul>
   </div><!-- /header -->
   <div data-role="content">   
      <p>We can add a list of trains</p>
   </div><!-- /content -->
   <div data-role="footer">
      <h4>Page Footer</h4>
   </div><!-- /footer -->
</div><!-- /page -->


<!-- Start of fourth page -->
<div data-role="page" id="Planes">
  <!-- <div data-role="header">
      <h1>Planes</h1>
</div> /header -->
<div data-role="header" data-position="inline">
   <a href="cancel.html" data-icon="delete">Cancel</a>
   <h1>Edit Contact</h1>
   <a href="save.html" data-icon="check">Save</a>
</div>
   <div data-role="content">   
      <p>We can add a list of planes导航条依然是div，而诸如ui-btn-active这个class可以使得你的按钮显示为被选择状态</p>
   </div><!-- /content -->
   <div data-role="footer">
   <div data-role="navbar">
   <ul>
      <li><a href="#nav1" class="ui-btn-active">One</a></li>
      <li><a href="#nav2">Two</a></li>
   </ul>
</div><!-- /navbar -->
</div><!-- /footer -->
</div><!-- /page -->
<div data-role="page" id="nav1">
   <div data-role="header">
      <h1>Nav Screen 1</h1>
   </div><!-- /header -->
   <div data-role="content">Screen for Navigation One</div><!-- /content -->
   <div data-role="footer">
   <h4>Additional Footer information</h4>
   </div><!-- /footer -->
</div><!-- /page -->


<div data-role="page" id="nav2">
   <div data-role="header">
      <h1>Nav Screen 2</h1>
   </div><!-- /header -->
   <div data-role="content">   
   Screen for Navigation Two
   </div><!-- /content -->
<div data-role="footer">
<h4>Additional Footer information</h4>
</div><!-- /footer -->
</div><!-- /page -->
<div data-role="page" id="dialogPopUp">
   <div data-role="header">
      <h1>Dialog Title</h1>
   </div><!-- /header -->
   <div data-role="content">   
      This is a dialog box      
   </div><!-- /content -->
<div data-role="footer">
<h4>Additional Footer information</h4>
</div><!-- /footer -->
</div><!-- /page -->

   <div data-role="header" data-position="fixed">
      <h1>可以为footer或者header添加 data-position="fixed"来实现这一点。以下代码会强制footer/header固定在下方/上方</h1>
   </div><!-- /header -->
   <div data-role="content" >
      <ul data-role="listview" data-dividertheme="d" style="margin-top: 0;">
         <li data-role="list-divider">Royal Family</li>
         <li><a href="#nav1">Henry VIII</a></li>
         <li><a href="#nav1">George V</a></li>
         <li><a href="#nav1">Prince of Wales</a></li>
         <li><a href="#nav1">Elizabeth I</a></li>
         <li><a href="#nav1">Elizabeth II</a></li>
         <li data-role="list-divider">Prime Miniseters</li>
         <li><a href="#nav2">Winston Churchill</a></li>
         <li><a href="#nav2">Tony Blare</a></li>
         <li><a href="#nav2">David Cameron</a></li>
      </ul>
   </div><!-- /content -->
<div data-role="footer" data-position="fixed">
   <div data-role="navbar">
      <ul>
         <li><a href="#nav1" class="ui-btn-active">Royals</a></li>
         <li><a href="#nav2">Leaders</a></li>
      </ul>
   </div><!-- /navbar -->
</div><!-- /footer -->
</div><!-- /page -->


<div data-role="page" id="nav1" data-position="fixed">
   <div data-role="header">
      <h1>Royal Family</h1>
   </div><!-- /header -->
<div data-role="content">
<p>Members and relatives of the British Royal Family historically represented the monarch in various places throughout the British Empire, sometimes for extended periods as viceroys, or for specific ceremonies or events. Today, they often perform ceremonial and social duties throughout the United Kingdom and abroad on behalf of the UK, but, aside from the monarch, have no constitutional role in the affairs of government. This is the same for the other realms of the Commonwealth though the family there acts on behalf of, is funded by, and represents the sovereign of that particular state, and not the United Kingdom.</P>
</div><!-- /content -->
   <div data-role="footer" data-position="fixed">
      <h4>Royal Family</h4>
   </div><!-- /header -->
</div><!-- /page -->


<div data-role="page" id="nav2" data-position="fixed">
   <div data-role="header">
      <h1>Prime Ministers</h1>
   </div><!-- /header -->
<div data-role="content">
The Prime Minister of the United Kingdom of Great Britain and Northern Ireland is the Head of Her Majesty's Government in the United Kingdom. The Prime Minister and Cabinet (consisting of all the most senior ministers, who are government department heads) are collectively accountable for their policies and actions to the Sovereign, to Parliament, to their political party and ultimately to the electorate. The current Prime Minister, David Cameron, was appointed on 11 May 2010.</div><!-- /content -->
<div data-role="footer" data-position="fixed">
   <h4>Prime Minister</h4>
      </div><!-- /header -->
   </div><!-- /page -->





    </body>
</html>











