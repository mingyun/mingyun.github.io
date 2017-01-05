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
