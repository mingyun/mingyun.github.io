###[微博图床上传图片](https://segmentfault.com/q/1010000008250059)
```js
$cookie = 'your cookie';
$ch = curl_init('http://picupload.service.weibo.com/interface/pic_upload.php'
    . '?mime=image%2Fjpeg&data=base64&url=0&markpos=1&logo=&nick=0&marks=1&app=miniblog');

curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_VERBOSE => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ["Cookie: $cookie"],
    CURLOPT_POSTFIELDS => ['b64_data' => base64_encode(file_get_contents('./img.jpg'))],
]);

var_export(curl_exec($ch));

如果要用 http://picupload.service.weibo.com/interface/pic_upload.php?mime=image%2Fjpeg&data=base64&url=0&markpos=1&logo=&nick=0&marks=1&app=miniblog 这个 URL 的话
POST 参数必须是 b64_data，值为经过 base64 编码后的字符串

如果要使用 pic1 参数的话，则要用 multipart 方式进行上传，且 URL 中必须包含 cb 参数，cb 参数的值为 http://weibo.com/aj/static/upimgback.html?_wv=5&callback=STK_ijax_ 加(js)时间戳

2种方法相比较的话，我个人倾向于 multipart 方法，因为 base64 编码会使上传文件的体积增加 1/3，不仅上传时间要更久，流量消耗也多了 1/3

具体可看 http://js.t.sinajs.cn/t5/home... 或者
用 fiddler 抓包看下 http://weibo.com/minipublish 的上传过程

或者你可以用我造的轮子 PHP实现的微博图床上传轮子https://github.com/consatan/weibo_image_uploader，支持 PHP 5.5.9 以上版本

        $cookie="";
        $base64_image_content = base64_encode(file_get_contents('d:/gg.jpg'));
        $post_data['b64_data']=$base64_image_content;
        $header = array (); 
        $header [] = 'Content-Type:application/x-www-form-urlencoded';  
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://picupload.service.weibo.com/interface/pic_upload.php?mime=image%2Fjpeg&data=base64&url=0&markpos=1&logo=&nick=0&marks=1&app=miniblog");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $cookie); 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS,20);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header );  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        $output = curl_exec($ch);
        $headers = curl_getinfo($ch);
        print_r($headers);
        curl_close($ch);
        
        成功截图https://ooo.0o0.ooo/2017/02/10/589d505fa2481.png
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
换成

$header [] = "Cookie:$cookie";  
curl_setopt($ch, CURLOPT_HTTPHEADER, $header );
```
