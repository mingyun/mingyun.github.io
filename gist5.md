###php导出excel
```php
header("Content-type:text/csv");   
header("Content-Disposition:attachment;filename=".$filename);   
header('Cache-Control:must-revalidate,post-check=0,pre-check=0');   
header('Expires:0');   
header('Pragma:public');
$str='第一行,第二行';
$str =  iconv('utf-8','GBK//IGNORE',$str);
echo $str;
ob_flush();
flush();
sleep(1); 
```
###[利用pytesser模块识别图像文字](http://www.cnblogs.com/chenbjin/p/4147564.html)
```php
from pytesser import *
im = Image.open('fonts_test.png')
text = image_to_string(im)
print "Using image_to_string(): "
print text
text = image_file_to_string('fonts_test.png', graceful_errors=True)
print "Using image_file_to_string():"
print text
```
###[pdf转中文](https://www.zhihu.com/question/47480852/answer/121215315)
```php
 
# python3 安装使用pip install pdfminer3k
import os import subprocess from os.path import isfile,join ef = 'D:/xpdf/pdftotext.exe' cfg = 'D:/xpdf/xpdfrc' file = 'D:/xpdf/1.pdf' def convert(file): bo = subprocess.check_output([ef,'-f','1','-l','1','-cfg',cfg,'-raw',file,'-']) #这个命令中的所有调用文件参数必须使用full path.否则调用出错。 return bo.decode('utf-8') dr = r'M:\0700 SPEC&GAD' files = [f for f in os.listdir(dr) if isfile(join(dr,f)) and f.endswith('.pdf')] for file in files: bo = convert(join(dr,file)) if len(bo)!=0: print(bo.split('\r\n'))
```
###[使用浏览器打开网页](http://gohom.win/2015/12/22/pyWebbrowser/)
```php
import webbrowser
a=webbrowser.get('safari')
#a=webbrowser.MacOSX('safari')
a.open("http://www.baidu.com")
```
###npm包列表
```php
$ ls `npm root -g`
anywhere       browser-sync  json-server  nodeppt     spy-debugger
apidoc         dredd         jstophp      phantomjs   tianqi
asciify        gulp          livepool     puer        tldr
baidu-ocr-api  hexo          m-console    sails       webpack
bower          http-server   markdown     spawn-sync  weinre
```
###[音乐audio 的 play()](https://segmentfault.com/q/1010000007479793)
```php
#需要用户主动去触发才得行
    <div>
        <audio controls="true" id="audio">
            <source src="http://i.dxlfile.com/app/music/27.mp3" />
            <!-- <source src="http://i.dxlfile.com/app/music/27.ogg" /> -->
            <!-- <source src="http://i.dxlfile.com/app/music/27.ogg" /> -->
        </audio>
        <a href="javascript:;" id="fakeClick"></a>
    </div>
    <script>
    var audio = document.getElementById("audio");
    var aEle = document.getElementById("fakeClick");

    aEle.addEventListener('click', function(e) {
        e.preventDefault();
        audio.play();
    })

    function fakeClick(fn) {
        var evt;
        if (document.createEvent) {
            evt = document.createEvent("MouseEvents");
            if (evt.initMouseEvent) {
                evt.initMouseEvent("click", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
                aEle.dispatchEvent(evt);
            }
        }
    }

    audio.addEventListener("canplay", fakeClick);
    </script>
```
###[返回100条不重复的记录](https://segmentfault.com/q/1010000008024825)
```php
'UPDATE `list` SET `State` = '1', `pid` = ' . getmypid() . '  WHERE `State` = '0' LIMIT 100;'
'SELECT * FROM `list` WHERE `pid` = ' . getmypid() . ' LIMIT 100'
'UPDATE `list` SET `pid` = ' . getmypid() . ' WHERE `pid` = '0''
```
###随机红包
```php
function randomRed($total,$num,$min = 0.01){
        $list = [];
        for($i= 1;$i< $num;$i++){
            $safe_total = ($total-($num-$i)*$min)/($num-$i);//随机安全上限
            $money      = mt_rand($min*100,$safe_total*100)/100;
            $total      = $total-$money;
            $list[$i]   = round($money,2);
        }
        $list[$num] = round($total,2);
        return $list;
    }
```
