###[生成了词云图](https://github.com/NyanCat12/CrossinWeekly/blob/master/NovelWordCount.py)
```js
# Crossin的编程教室 
import re
from collections import Counter
from matplotlib import pyplot
from wordcloud import WordCloud
import matplotlib.pyplot as plt

def NovelRe(Novel):
    content = open(Novel, 'r').read().lower()
    words = []
    pattern = r"(?<!')\b[a-zA-Z]{2}[a-zA-Z]+\b"
    tmp = re.findall(pattern, content)
    DropList = ['you','your','he','him','his','she','her','they','them','their','where','when','what','who','which','there','said','had','don','mer','for','jul','its','his','with','charles','elecbook','classics','charlotte','bront','aesop','fables','dickens','tale','and','the','that','was']
    for word in DropList:
        tmp = [x for x in tmp if x!=word]
    for x in tmp:
        words.append(x)
    Count = Counter(words).most_common(100)
    return Count
'''
#用不上
def WordListToWordDict(WordList):
    Dict = {}
    for word in WordList:
        Dict[word[0]] = word[1]
    return Dict
#用不上
def FullWordList(OldList, AddDict):
    for key in AddDict:
        OldList.append(key)
    NewList = list(set(OldList))
    return NewList
'''
def Output():
    NovelList = ['a tale of two cities(双城记).txt', 'Aesop’s Fables(伊索寓言).txt', 'Jane Eyre(简·爱).txt', 'Oliver Twist(雾都孤儿(孤星血泪)).txt', 'Romeo and Juliet(罗蜜欧和朱丽叶).txt']
    for novel in NovelList:
        print (novel[:-4]+'\n'+'========================================')
        WordList = NovelRe(novel)
        i = 1

        wordsum = 0
        for word in WordList:
            wordsum += word[1]
            
        for word in WordList:
            print (str(i) + '.'+'\t' + str(word[0]) + '\t' + str('%.5f%%' %(word[1]/wordsum)))
            i += 1
        print ('\n')
'''
#用不上
def Freq(Dict):
    WordSum = 0
    for key in Dict:
        WordSum += Dict[key]
    for key in Dict:
        Dict[key] = Dict[key]/WordSum#只是前100的单词出现总次数，不是文章总数
    return Dict
#用不上
def Style():
    NovelList = ['a tale of two cities(双城记).txt', 'Aesop’s Fables(伊索寓言).txt', 'Jane Eyre(简·爱).txt', 'Oliver Twist(雾都孤儿(孤星血泪)).txt', 'Romeo and Juliet(罗蜜欧和朱丽叶).txt']
    Dict = {}
    for novel in NovelList:
        Dict[novel[:-4]] = Freq(WordListToWordDict(NovelRe(novel)))
    WordList = []
    for key in Dict:
        WordList = FullWordList(WordList, Dict[key])
    return (WordList, Dict)
#用不上
def WordVector(WordList, Dict):
    vector = [x*0 for x in range(len(WordList))]
    for index in range(len(WordList)):
        try:
            vector[index] = Dict[WordList[index]]
        except:
            vector[index] = 0
    return vector
#用不上
def NovelVector():
    WordList, Dict = Style()
    NovelVectorDict = {}
    for key in Dict:
        NovelVectorDict[key] = WordVector(WordList, Dict[key])
    return NovelVectorDict
def Plot():
    pass
'''
def OutputForWordCloud():
    NovelList = ['a tale of two cities(双城记).txt', 'Aesop’s Fables(伊索寓言).txt', 'Jane Eyre(简·爱).txt', 'Oliver Twist(雾都孤儿(孤星血泪)).txt', 'Romeo and Juliet(罗蜜欧和朱丽叶).txt']
    WordList = []
    NovelName = []
    for novel in NovelList:
        WordList.append(NovelRe(novel))
        NovelName.append(novel[:-4])
    return NovelName, WordList

def Wordcloud(name, freq):
    wordcloud = WordCloud(max_font_size=40).fit_words(freq)

    plt.imshow(wordcloud)
    plt.axis("off")
    plt.savefig(str(name)+".jpg")
    return 0
    


if __name__ == '__main__':
    Output()
    print ('Generating wordclouds')
    NovelName, WordList = OutputForWordCloud()
    for novel, word in zip(NovelName, WordList):
        Wordcloud(novel, word)
    print ('Wordclouds saved')
    #WordList, Dict = Style()

>>> from collections import Counter
>>> Counter('adffdsads')
Counter({'d': 3, 'f': 2, 's': 2, 'a': 2})
>>> c = Counter('adffdsads')
>>> c.most_common(3)
[('d', 3), ('a', 2), ('f', 2)]
```
###[现在有一文本文件 ‘abc.txt’，有 1000 行内容，现在需要在每一行的开头添加一个 ‘+’ 字符](http://mp.weixin.qq.com/s?timestamp=1489372072&src=3&ver=1&signature=qVVtrc2xfLjj-VcYj9yPBO3DHCDzca2ev2-Zxdd1Z8DgyzXERKux1dVNxpj7iVCgCfBFsrkcZzh4CTN1PkilExc6l6HO9nteOBHjoe09NJGUKa95IZzlPh66Iwy*63dHGs7z886SmdNiyPX8pXiVCG-ZSUqVw4P3ZGWdtp5IEXY=)
```js
text = 'The module provides some convenience functions'
# 初始化“包装器” 文本包装 textwrap
wrapper = textwrap.TextWrapper()
# 每行最大长度
wrapper.width = 20
# 第一行词头
wrapper.initial_indent = '+'
# 非首行词头
wrapper.subsequent_indent = '+'
# 最后填充文本
result = wrapper.fill(text)
print(result)

>>> text = 'module provides some convenience functions.'
>>> print(textwrap.shorten(text, 20))
module [...]
# placeholder 参数修改结尾形式
>>> print(textwrap.shorten(text, 20, placeholder='...'))
module...
finally 下的语句无论是否出现异常，均会被执行。

try:
  dfdg = xidfg  # 定义一个错误变量
  f = 2/0  # 除0错误
except ZeroDivisionError as e:
  print(e)
finally:
  print('程序结束')
  
   raw_input 得到的输入是字符串，无法直接和数字去比较大小。但在python2里，你这样做了，也不会报错，而是产生不可预知的结果。在python3里，则会直接报错。

Python2 中应改为：

answer = input()
Python3 中可使用：

answer = eval(input())

>>> [1, 2] == [2, 1]
False
>>> {'a':1, 'b':2} == {'b':2, 'a':1}
True
>>> from collections import OrderedDict
d = OrderedDict()
d['c'] = 3
d['b'] = 2
d['a'] = 1
print(d)
无论在什么环境下，输出结果都是：

OrderedDict([('c', 3), ('b', 2), ('a', 1)])
d = {'a': 2, 'b': 3, 'c': 1}
# 以 value 值对 dic 排序
sd = sorted(d.items(), key=lambda x: x[1])
# 转换为有序字典
od = OrderedDict(sd)
print(od)

```
###[代理ip](https://github.com/twy93007/adult_novel_fenxi/blob/master/proxyip.py)
```js
# coding:utf-8
import requests
from bs4 import BeautifulSoup
import re
import os.path

# 构造Header
user_agent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_5)'
headers = {'User-Agent': user_agent}

# 爬取代理
def getListProxies():
    # 获得页面
    session = requests.session()
    page = session.get("http://www.xicidaili.com/nn", headers=headers)
    # soup解析
    soup = BeautifulSoup(page.text, 'lxml')
    proxyList = []
    taglist = soup.find_all('tr', attrs={'class': re.compile("(odd)|()")})
    # 构造代理信息
    for trtag in taglist:
        tdlist = trtag.find_all('td')
        proxy = {'http': tdlist[1].string + ':' + tdlist[2].string,
                 'https': tdlist[1].string + ':' + tdlist[2].string}
        url = "http://ip.chinaz.com/getip.aspx"  # 用来测试IP是否可用的url
        # 测试IP是否可用
        try:
            response = session.get(url, proxies=proxy, timeout=5)
            proxyList.append(proxy)
            if (len(proxyList) == 10):
                break
        except Exception, e:
            continue

    return proxyList

print getListProxies()
```







###[使用selenium webdriver从隐藏元素中获取文本](http://blog.csdn.net/vinson0526/article/details/51830650)
```js
from selenium import webdriver

DEMO_PAGE = '''data:text/html,
    <p>Demo page for how to get text from hidden elements using Selenium WebDriver.</p>
    <div id='demo-div'>Demo div <p style='display:none'>with a hidden paragraph inside.</p><hr /><br /></div>'''

driver = webdriver.PhantomJS()
driver.get(DEMO_PAGE)

demo_div = driver.find_element_by_id("demo-div")

print demo_div.get_attribute('innerHTML')
print driver.execute_script("return arguments[0].innerHTML", demo_div)

print demo_div.get_attribute('textContent')
print driver.execute_script("return arguments[0].textContent", demo_div)

driver.quit
```
wxBot: https://github.com/liuwons/wxBot 
图灵机器人: http://www.tuling123.com/ 



###[mySQL，从入门到熟练](https://mp.weixin.qq.com/s/KqSpXIveVJsnMeye0bZ-WQ  )
 select if(industryField like '%电子商务%',1,0) from DataAnalyst  select city,
          count(distinct positionId),
          count(if(industryField like '%电子商务%',positionId,null)) 
from DataAnalyst
group by city  嵌套子查询 select left(salary,locate("k",salary)-1),salary from DataAnalyst
2017-02-12 秦路 秦路 
https://mp.weixin.qq.com/s?timestamp=1489318889&src=3&ver=1&signature=Np8VmcjEHxgPDeTDkQx55eGaIPfE-lJcUgusBUrG0NJGmLeafxDa3WomM6c4cyNYBJSACxg6D3IEunIXPCD-I238nLSTU74wxuXMuQiIBXAZ7IMhktb7n8rEsAGGbtQqbP7ZQ*2JeLBVgQ-rmSPxyjJUCw90iZQDfeoNgjaVmrg=  
###[【Python爬虫实战】为啥学Python，BOSS告诉你](https://zhuanlan.zhihu.com/p/25641178)
```js
url = 'http://www.zhipin.com/job_detail/?query=Python&scity=101200100&source=2'
headers = {
	'Accept':'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
	'Accept-Language':'zh-CN,zh;q=0.8',
	'Host':'www.zhipin.com',
	'User-Agent':'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36',
}a = requests.get(url,headers=headers)
soup = BeautifulSoup(a.text,'lxml')
b = soup.find_all("span",class_="red")
print(b)
for i in b:
	c = i.get_text("|", strip=True)
	print(c) https://link.zhihu.com/?target=https%3A//github.com/zhangslob/-Python-Python-BOSS-/blob/master/test.py
```
###[用python实现微信聊天机器人](https://zhuanlan.zhihu.com/p/25682247?group_id=823517271958896640)
```js
import requests
from wxpy import *
import json


#图灵机器人https://zhuanlan.zhihu.com/p/25692489
def talks_robot(info = '你叫什么名字'):
    api_url = 'http://www.tuling123.com/openapi/api'
    apikey = 'APIKey'
    data = {'key': apikey,
                'info': info}
    req = requests.post(api_url, data=data).text
    replys = json.loads(req)['text']
    return replys

#微信自动回复
robot = Robot()
# 回复来自其他好友、群聊和公众号的消息
@robot.register()
def reply_my_friend(msg):
    message = '{}'.format(msg.text)
    replys = talks_robot(info=message)
    return replys

# 开始监听和自动处理消息
robot.start()


@robot.register() 
def just_print(msg): 
print(datetime.now().strftime("%I:%M:%S") + " " + msg.chat.nick_name + ":" + msg.text)
# register不限定回复对象，匹配所有聊天对象（包括公众号，群），但是不做回复，只print收到的消息，这样不会打扰任何人。
@robot.register(Friend, TEXT) 
def auto_reply_by_tuling(msg): 
print(datetime.now().strftime("%I:%M:%S") + " " + msg.chat.nick_name + ":" + msg.text) 
return Tuling(api_key=Tuling_api_key).reply_text(msg)
# register指定回复Friend对象，因为写在后面，所以受到来自好友的消息时，会优先按这个方法来处理。这里既做了打印又做了图灵机器人的自动回复。
# 这样就不会打扰群里了。而且wxpy还支持群里有人@你了才回复
```
###[从自动化刷票说phantomjs和selenium](https://www.yanxiuer.com/phantomjsandselenium.html)
###[ELK+redis搭建nginx日志分析平台](http://yanliu.org/2015/08/19/ELK-redis%E6%90%AD%E5%BB%BAnginx%E6%97%A5%E5%BF%97%E5%88%86%E6%9E%90%E5%B9%B3%E5%8F%B0/)
###[msyql 积分返还算法求解](https://segmentfault.com/q/1010000008652947)
"select user from tablename where status=1 and time<'{$time}' limit 100";
"update tablename set number=number-100 where status=1 and time<'{$time}'";
"update tablename set status=0, time='当前时间' where status=1 and number=0;
###[js可以替换或删掉选中文本](https://segmentfault.com/q/1010000008657235)
// 1. 设置整个页面为可编辑状态
document.body.setAttribute('contenteditable', true)
// 2. 全选
document.execCommand('selectAll')
// 3. 剪切
document.execCommand('cut')

###[python爬虫爬取中证指数官网数据](https://segmentfault.com/q/1010000008619396)
```js
import requests
from itertools import groupby

url = 'http://www.csindex.com.cn/sseportal/ps/zhs/hqjt/csi/show_zsgz.js'
r = requests.get(url)

text = r.text.replace('"', '').replace('var zsgz','').split('\r\n')
content = [_.split('=') for _ in text if _ and not _.startswith('00')]

rows = []
for _, lst in groupby(content, key=lambda x: int(x[0]) / 10):
    row = tuple([v for k, v in lst])
    rows.append(row)

print rows
```
###[执行PHP文件会添加php命令路径](https://segmentfault.com/q/1010000008626259)
php的安全机制。

在安全模式下，只有在特定目录中的外部程序才可以被执行，对其它程序的调用将被拒绝。这个目录可以在php.ini文件中用 safe_mode_exec_dir指定，或在编译PHP是加上--with-exec-dir选项来指定，默认是 /usr/local/php/bin
PHP里面执行whoami命令，但是执行时候会自动在 /usr/bin/whoami 前添加 /usr/local/php 路径导致出错
###[Python 3.6中 'utf-8' codec can't decode byte invalid start byte](https://segmentfault.com/q/1010000008631001)
```js
网站返回的是gzip压缩过的数据，所以要进行解码
Content-Encoding: gzip
# coding=utf-8
from io import BytesIO
import gzip
import urllib.request

url = ('http://wthrcdn.etouch.cn/weather_mini?city=%E4%B8%8A%E6%B5%B7')
resp = urllib.request.urlopen(url)
content = resp.read() # content是压缩过的数据

buff = BytesIO(content) # 把content转为文件对象
f = gzip.GzipFile(fileobj=buff)
res = f.read().decode('utf-8')
print(res)
```
###[模拟滑动验证码](https://segmentfault.com/q/1010000008584470)
```js
# -*- coding:utf-8 -*-
from selenium import webdriver
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.common.action_chains import ActionChains
import PIL.Image as image
import time,re, random
import requests
try:
    from StringIO import StringIO
except ImportError:
    from io import StringIO

#爬虫模拟的浏览器头部信息
agent = "Mozilla/5.0 (Windows NT 5.1; rv:33.0) Gecko/20100101 Firefox/33.0"
headers = {
        "User-Agent": agent
        }

# 根据位置对图片进行合并还原
# filename:图片
# location_list:图片位置
#内部两个图片处理函数的介绍
#crop函数带的参数为(起始点的横坐标，起始点的纵坐标，宽度，高度）
#paste函数的参数为(需要修改的图片，粘贴的起始点的横坐标，粘贴的起始点的纵坐标）
def get_merge_image(filename,location_list):
    #打开图片文件
    im = image.open(filename)
    #创建新的图片,大小为260*116
    new_im = image.new("RGB", (260,116))
    im_list_upper=[]
    im_list_down=[]
    # 拷贝图片
    for location in location_list:
        #上面的图片
        if location["y"]==-58:
            im_list_upper.append(im.crop((abs(location["x"]),58,abs(location["x"])+10,166)))
        #下面的图片
        if location["y"]==0:
            im_list_down.append(im.crop((abs(location["x"]),0,abs(location["x"])+10,58)))
    new_im = image.new("RGB", (260,116))
    x_offset = 0
    #黏贴图片
    for im in im_list_upper:
        new_im.paste(im, (x_offset,0))
        x_offset += im.size[0]
    x_offset = 0
    for im in im_list_down:
        new_im.paste(im, (x_offset,58))
        x_offset += im.size[0]
    return new_im

#下载并还原图片
# driver:webdriver
# div:图片的div
def get_image(driver,div):
    #找到图片所在的div
    background_images=driver.find_elements_by_xpath(div)
    location_list=[]
    imageurl=""
    #图片是被CSS按照位移的方式打乱的,我们需要找出这些位移,为后续还原做好准备
    for background_image in background_images:
        location={}
        #在html里面解析出小图片的url地址，还有长高的数值
        location["x"]=int(re.findall("background-image: url\(\"(.*)\"\); background-position: (.*)px (.*)px;",background_image.get_attribute("style"))[0][1])
        location["y"]=int(re.findall("background-image: url\(\"(.*)\"\); background-position: (.*)px (.*)px;",background_image.get_attribute("style"))[0][2])
        imageurl=re.findall("background-image: url\(\"(.*)\"\); background-position: (.*)px (.*)px;",background_image.get_attribute("style"))[0][0]
        location_list.append(location)
    #替换图片的后缀,获得图片的URL
    imageurl=imageurl.replace("webp","jpg")
    #获得图片的名字
    imageName = imageurl.split("/")[-1]
    #获得图片
    session = requests.session()
    r = session.get(imageurl, headers = headers, verify = False)
    #下载图片
    with open(imageName, "wb") as f:
        f.write(r.content)
        f.close()
    #重新合并还原图片
    image=get_merge_image(imageName, location_list)
    return image

#对比RGB值
def is_similar(image1,image2,x,y):
    pass
    #获取指定位置的RGB值
    pixel1=image1.getpixel((x,y))
    pixel2=image2.getpixel((x,y))
    for i in range(0,3):
        # 如果相差超过50则就认为找到了缺口的位置
        if abs(pixel1[i]-pixel2[i])>=50:
            return False
    return True

#计算缺口的位置
def get_diff_location(image1,image2):
    i=0
    # 两张原始图的大小都是相同的260*116
    # 那就通过两个for循环依次对比每个像素点的RGB值
    # 如果相差超过50则就认为找到了缺口的位置
    for i in range(0,260):
        for j in range(0,116):
            if is_similar(image1,image2,i,j)==False:
                return  i

#根据缺口的位置模拟x轴移动的轨迹
def get_track(length):
    pass
    list=[]
    #间隔通过随机范围函数来获得,每次移动一步或者两步
    x=random.randint(1,3)
    #生成轨迹并保存到list内
    while length-x>=5:
        list.append(x)
        length=length-x
        x=random.randint(1,3)
    #最后五步都是一步步移动
    for i in range(length):
        list.append(1)
    return list

#滑动验证码破解程序
def main():
    #打开火狐浏览器
    driver = webdriver.Firefox()
    #用火狐浏览器打开网页
    driver.get("http://www.geetest.com/exp_embed")
    #等待页面的上元素刷新出来
    WebDriverWait(driver, 30).until(lambda the_driver: the_driver.find_element_by_xpath("//div[@class="gt_slider_knob gt_show"]").is_displayed())
    WebDriverWait(driver, 30).until(lambda the_driver: the_driver.find_element_by_xpath("//div[@class="gt_cut_bg gt_show"]").is_displayed())
    WebDriverWait(driver, 30).until(lambda the_driver: the_driver.find_element_by_xpath("//div[@class="gt_cut_fullbg gt_show"]").is_displayed())
    #下载图片
    image1=get_image(driver, "//div[@class="gt_cut_bg gt_show"]/div")
    image2=get_image(driver, "//div[@class="gt_cut_fullbg gt_show"]/div")
    #计算缺口位置
    loc=get_diff_location(image1, image2)
    #生成x的移动轨迹点
    track_list=get_track(loc)
    #找到滑动的圆球find_element_by_xpath('//div[@class="gt_slider_knob gt_show"]')
    element=driver.find_element_by_xpath("//div[@class="gt_slider_knob gt_show"]")
    location=element.location
    #获得滑动圆球的高度
    y=location["y"]
    #鼠标点击元素并按住不放
    print ("第一步,点击元素")
    ActionChains(driver).click_and_hold(on_element=element).perform()
    time.sleep(0.15)
    print ("第二步，拖动元素")
    track_string = ""
    for track in track_list:
        #不能移动太快,否则会被认为是程序执行
        track_string = track_string + "{%d,%d}," % (track, y - 445)
        #xoffset=track+22:这里的移动位置的值是相对于滑动圆球左上角的相对值，而轨迹变量里的是圆球的中心点，所以要加上圆球长度的一半。
        #yoffset=y-445:这里也是一样的。不过要注意的是不同的浏览器渲染出来的结果是不一样的，要保证最终的计算后的值是22，也就是圆球高度的一半
        ActionChains(driver).move_to_element_with_offset(to_element=element, xoffset=track+22, yoffset=y-445).perform()
        #间隔时间也通过随机函数来获得,间隔不能太快,否则会被认为是程序执行
        time.sleep(random.randint(10,50)/100)
    print (track_string)
    #xoffset=21，本质就是向后退一格。这里退了5格是因为圆球的位置和滑动条的左边缘有5格的距离
    ActionChains(driver).move_to_element_with_offset(to_element=element, xoffset=21, yoffset=y-445).perform()
    time.sleep(0.1)
    ActionChains(driver).move_to_element_with_offset(to_element=element, xoffset=21, yoffset=y-445).perform()
    time.sleep(0.1)
    ActionChains(driver).move_to_element_with_offset(to_element=element, xoffset=21, yoffset=y-445).perform()
    time.sleep(0.1)
    ActionChains(driver).move_to_element_with_offset(to_element=element, xoffset=21, yoffset=y-445).perform()
    time.sleep(0.1)
    ActionChains(driver).move_to_element_with_offset(to_element=element, xoffset=21, yoffset=y-445).perform()
    print ("第三步，释放鼠标")
    #释放鼠标
    ActionChains(driver).release(on_element=element).perform()
    time.sleep(3)
    #点击验证
    # submit = driver.find_element_by_xpath("//div[@class="gt_ajax_tip success"]")
    # print(submit.location)
    # time.sleep(5)
    #关闭浏览器,为了演示方便,暂时注释掉.
    #driver.quit()

#主函数入口
if __name__ == "__main__":
    pass
    main()
```
###[SQL中一个表的转换问题](https://segmentfault.com/q/1010000008591791)
```js
pandas的melt方法

a = pd.DataFrame([[0101,1,2,3],[0202,4,5,6]],columns=['date','a','b','c'])
   date  a  b  c
0    65  1  2  3
1   130  4  5  6
pd.melt(a,id_vars=['date'],var_name='col1',value_name='col2')
   date col1  col2
0    65    a     1
1   130    a     4
2    65    b     2
3   130    b     5
4    65    c     3
5   130    c     6
```

###[python如何进行socket连接](https://segmentfault.com/q/1010000008631917 )
```js
from websocket import create_connection


ws = create_connection("ws://42.96.131.185:7575")
print("Sending 'Hello, World'...")
for i in range(10000):
    ws.send(b"Hello, World")
    print("Sent")
print("Reeiving...")
result = ws.recv()
print("Received '%s'" % result)
ws.close()
```
三级联动的生成器插件 https://microzz.com/2017/03/12/select-plugin/ 
https://segmentfault.com/q/1010000008626085
https://segmentfault.com/q/1010000008642343 php socket 是干嘛的 请用具体场景举例
php 在线打开word文档https://segmentfault.com/q/1010000008623235
借助第三方：http://www.idocv.com/index.html http://www.officeweb365.com
2.自己转换成swf http://www.print2flash.com
PHP如何判断每个月的每一周是几号到几号https://segmentfault.com/q/1010000008608311 
###[PHP多维数组排序问题](https://segmentfault.com/q/1010000008605080)
```js
<?php

$a = $b = $c = [];

array_map(function( $value ) use ( &$a,&$b,&$c ){
      array_push($a, $value['a']);
      array_push($b, $value['b']);
      array_push($c, $value['c']);
} , $arr);

$count = $arr;

var_dump($count);
array_multisort(
    $a,SORT_ASC,
    $b,SORT_ASC,
    $c,SORT_ASC,
    $arr
);

var_dump($arr);
```

###[字符串里的u'\u00a1'怎么打印成中文](https://segmentfault.com/q/1010000008601928)
```js
demo.decode('unicode-escape')
当然限 Python 2，因为 Python 3 里边不会遇到这种字符串
```
###[mysql返回字符串](https://segmentfault.com/q/1010000008576315)
```js
用PDO的话：PDO::ATTR_STRINGIFY_FETCHES，例：

$pdo = new PDO('...');
$pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, true);
$stm = $pdo->prepare("select 1, 2.3, 'hello'");
$stm->execute();
$result = $stm->fetch(PDO::FETCH_NUM);
```
###[关联查询的sql查询不全的问题](https://segmentfault.com/q/1010000008615512)
select id,title,(select count(*) from attop_article where attop_article.type = attop_article_type.id) as count from attop_article_type;


###[mysql select 不取第一条和第二条怎么做到](https://segmentfault.com/q/1010000008599232)
limit的第二个参数中放入 select count(*) from table 的值, 也可以用查询条件比如 where id > 2 这样筛选 
###[Python中如何将爬取到的数据循环存入到csv](https://segmentfault.com/q/1010000008624695)
```js
#coding=utf-8

import requests
import json
import time
import csv
import codecs

headers = {
    'User-Agent': 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.113 Safari/537.36'
}
url = 'https://sec.wedengta.com/getIntelliStock?action=IntelliSecPool&id=99970_56&_={0}'.format(time.time())
r = requests.get(url, headers=headers)
result = json.loads(r.text)

rows = []
for every in json.loads(result['content'])['vtDaySec']:
    for company in every['vtSec']:
        row = (
            every['sOptime'].encode('utf-8'),
            company['sChnName'].encode('utf-8'),
            company['sDtCode'][4:].encode('utf-8')
        )
        rows.append(row)

with codecs.open('company.csv', 'wb') as f:
    f.write(codecs.BOM_UTF8)
    writer = csv.writer(f)
    writer.writerow(['date', 'stk_name', 'stk_num'])
    writer.writerows(rows)

```



###[python3 脚本调用shell 指令如何获得返回值](https://segmentfault.com/q/1010000008624292)
```js
import os
if(os.system('netstat -tnlp | grep nginx') == 0) {
    print 'process nginx exists.'
}
import os
if(os.popen('netstat -tnlp | grep nginx').read() != '') {
    print 'process nginx exists.'
}
调用子程序更强大的是subprocess.Popen
>>> subprocess.getstatusoutput('ls /bin/ls')
(0, '/bin/ls')
>>> subprocess.getstatusoutput('cat /bin/junk')
(256, 'cat: /bin/junk: No such file or directory')
>>> subprocess.getstatusoutput('/bin/junk')
(256, 'sh: /bin/junk: not found')
```
###[几个有趣的javascript函数](http://gengliming.com/2015/06/05/some-funny-js-functions/)
###[对登录中账号密码进行加密之后再传输的爆破的思路和方式](http://www.freebuf.com/articles/web/127888.html)
###[饿了么大前端 Node.js 进阶教程](https://cnodejs.org/topic/58ad76db7872ea0864fedfcc#58b3bf27e418a986315f3959)
###[Web服务器性能压力测试工具](http://biezhi.me/2015/12/03/webserver-performance-pressure-test-tool/)
webbench  siege -c 100 -r 10 -f site.url
###[新一代子域名爆破工具brutedns](http://www.freebuf.com/sectool/127099.html)
我博客地址：https://www.yanxiuer.com。更多有关技术的细节会在上边更新。
pyrhon3 brutedns.py -d target -l 1/2 -s low/medium/high
工具地址：https://github.com/yanxiu0614/subdomain3
interface DateGlobal {
  const SECONDS_IN_A_DAY = 86400;
}

addExpireAt(DateGlobal::SECONDS_IN_A_DAY);
###[28张相见恨晚的速查表（Cheat Sheet）——Python篇](https://zhuanlan.zhihu.com/p/25669434?group_id=823242843865894912)
matplotlib:https://www.datacamp.com/community/blog/python-matplotlib-cheat-sheet
scipy:https://www.datacamp.com/community/blog/python-scipy-cheat-sheet
pandas:https://www.datacamp.com/community/blog/python-pandas-cheat-sheet
numpy:https://www.datacamp.com/community/blog/python-numpy-cheat-sheet
scikit-Learn:https://www.datacamp.com/community/blog/scikit-learn-cheat-sheet
bokeh:https://www.datacamp.com/community/blog/bokeh-cheat-sheet-python
python basic:https://www.datacamp.com/community/tutorials/python-data-science-cheat-sheet-basics
###[历史爱好者福利—这个网站包含了6000年来的世界历史地图演变](https://zhuanlan.zhihu.com/p/25658582?group_id=823149310563713024)
http://link.zhihu.com/?target=http%3A//x768.com/w/twha.zh-hans 
###[循环体异步函数中循环变量i的保存](https://zhuanlan.zhihu.com/p/25647386?group_id=822928818560983040)
```js
for (var i=1; i<=5; i++) {
    setTimeout( function timer() {
        console.log(i);
    }, i*1000 );
}

for (var i=1; i<=5; i++) {
    (function(i){
        setTimeout( function timer() {
            console.log(i);
        }, i*1000 );
    })(i);
}
for (var i=1; i<=5; i++) {
    setTimeout( (function(i){
        return function timer() {
            console.log(i);
        }
    })(i), i*1000 );
}
for (var i=1; i<=5; i++) {
    setTimeout( function timer(i) {
        console.log(i);
    }, i*1000, i );
}
for (let i=1; i<=5; i++) {
    setTimeout( function timer() {
        console.log(i);
    }, i*1000 );
}
```
###[使用Python定制词云](https://zhuanlan.zhihu.com/p/25538157?group_id=822178793971126272)
```js
from os import path
from wordcloud import WordCloud

d = path.dirname(__file__)

# Read the whole text.
text = open(path.join(d, 'constitution.txt')).read()

# Generate a word cloud image
wordcloud = WordCloud().generate(text)

 
import matplotlib.pyplot as plt
plt.imshow(wordcloud)
plt.axis("off")

# lower max_font_size
wordcloud = WordCloud(max_font_size=40).generate(text)
plt.figure()
plt.imshow(wordcloud)
plt.axis("off")
plt.show()
https://link.zhihu.com/?target=https%3A//www.shiyanlou.com/courses/756 
```
###[Python教你用matplotlib画个心心撩妹](https://zhuanlan.zhihu.com/p/25575403?group_id=821786158840320000)
```js
import matplotlib.pyplot as plt
import numpy as np
import math
pi = math.pi
t = np.arange(0,2*pi,0.001)
r = np.frompyfunc(round,1,1)
sin = np.frompyfunc(math.sin,1,1)
cos = np.frompyfunc(math.cos,1,1)
#y = sin(x)*(abs(cos(x)))**0.5/(sin(x)+1.4)-2*sin(x)+2
'''
y = 2*cos(t)-cos(2*t)
x = 2*sin(t)-sin(2*t)
'''
x=sin(t)
c=cos(t)
p=x**2
y=c+p**(1/3)
plt.plot(x, y,color='r', linewidth=9)
plt.fill(x,y,color='r')
plt.title("my heart for you")
ax = plt.subplot(111)
ax.spines['right'].set_color('none')
ax.spines['top'].set_color('none')
ax.spines['bottom'].set_color('none')
ax.spines['left'].set_color('none')
plt.xlim(-1.2,1.2),plt.xticks([])
plt.yticks([])
plt.show()
```
###[总结一些前端的知识点 (一)](https://zhuanlan.zhihu.com/p/25351196?group_id=821810418736599040)

###[用python实现微信聊天机器人](https://zhuanlan.zhihu.com/p/25682247?group_id=823517271958896640)

###[10行Python代码的词云](http://mp.weixin.qq.com/s/HysMAAPMY2zLilQVnTUE5A)
```js
import matplotlib.pyplot as plt
from wordcloud import WordCloud
import jieba

text_from_file_with_apath = open('/Users/hecom/23tips.txt').read()

wordlist_after_jieba = jieba.cut(text_from_file_with_apath, cut_all = True)
wl_space_split = " ".join(wordlist_after_jieba)

my_wordcloud = WordCloud().generate(wl_space_split)

plt.imshow(my_wordcloud)
plt.axis("off")
plt.show()
直接进入wordcloud.py 的源码，找字体库相关的代码

FONT_PATH = os.environ.get("FONT_PATH", os.path.join(os.path.dirname(__file__), "DroidSansMono.ttf"))
wordcloud 默认使用了DroidSansMono.ttf 字体库，改一下换成一个支持中文的ttf 字库
```
###[JavaScript技巧](https://rockjins.js.org/2017/02/15/javascript-skill/)
```js
获取一个链接的绝对地址
var getAbsoluteUrl = (function() {
  var a;

  return function(url) {
    if(!a) a = document.createElement('a');
    a.href = url;

    return a.href;
  };
})();

//使用
getAbsoluteUrl("/something"); //https://rockjins.github.io/something
上传图片预览功能
<input type="file" name="file" onchange="showPreview(this)" />
<img id="portrait" src="" width="70" height="75">
function showPreview(source) {
  var file = source.files[0];
  if(window.FileReader) {
      var fr = new FileReader();
      fr.onloadend = function(e) {
        document.getElementById("portrait").src = e.target.result;
      };
      fr.readAsDataURL(file);
  }
}
Math.round函数的坑
Math.round(-3.2) //-3

Math.round(-3.5) //-3(这个就奇怪了)

Math.round(-3.8) //-4

//其实，Math.round(x)等同于：
Math.floor(x + 0.5)
const EPSILON = Math.pow(2, -53); //1.1102230246251565e-16

function epsEqu(x,y) {
  return Math.abs(x - y) < EPSILON;
}

epsEqu(0.1+0.2, 0.3) //true
随机生成字母和数字组合的字符串
Math.random().toString(36).substr(2);
//un80usvvsgcpi0rffskf39pb9
//02aoe605zgg5xqup6fdclnb3xr
//ydzr1swdxjg3yolkb95p14i
```
###[SQL，从入门到熟练](http://mp.weixin.qq.com/s/KqSpXIveVJsnMeye0bZ-WQ)
###[你真的了解如何将Nginx配置为Web服务器吗](http://mp.weixin.qq.com/s/jYd9WkLOAvv6RfxfSa_PYg)
###[再议数据库军规](http://mp.weixin.qq.com/s/8LHNXdpRcn_ehIdb8Q4EvA)
###[Vue.js 的一些资源索引](https://github.com/jsfront/src/blob/master/vuejs.md)
###[python 计算两个时间相差的分钟数](https://segmentfault.com/q/1010000008657761)
```js
import datetime

t1 = datetime.datetime(2017,3,4,8,49,0)
t2 = datetime.datetime(2017,3,5,8,50,30)

min =(t2-t1).total_seconds()/60
m = round(min)

print(m)
```
###[Web全栈工程师](https://coin8086.gitbooks.io/getfullstack/content/)
###[PHP软件指南](https://github.com/yangweijie/clean-code-php)
###[前端面试题（一）：递归解析](http://mp.weixin.qq.com/s/-V-Vp0EqevA869vHuvpY6A)
```js
function fillArray(array,result){  
    var count = array.length;
    var i = 0; 
    for(;i<count;++i){	
        var temp = array[i];
        if(Array.isArray(temp)){
            fillArray(temp,result);
	} else {		
            result.push(array[i]);
	}
  }
}
var result = [];
fillArray(meta,result);
var resultMap = {};
function fillArrayII(array,result){
    var count = array.length;
    var i = 0;
    if (!count){
        return [];
    }
    for(;i<count;++i){
        var temp = array[i];
        var g = resultMap[temp];
        if(g){
            result.push(g);
	} else {
            if (Array.isArray(temp)){
                fillArrayII(temp,result);
	    } else {
                result.push(temp);
	    }
	}
    }
}
var date1 = new Date();
var time1 = date1.getTime();
var r = [];
fillArrayII(meta,r);
var date2 = new Date();
var time2 = date2.getTime();
console.log('no cache time : ',time2 - time1);
var date3 = new Date();
var time3 = date3.getTime();
var f = [];
fillArrayII(meta,f);
var date4 = new Date();
var time4 = date4.getTime();
console.log('cache time : ',time4 - time3);
尾递归就是把计算结果放到调用者函数的尾部，顶部的返回值越简单越好，而尾巴的返回可能是越来越复杂的计算。

```
###[程序员证明自己智商的时候到了，一大波智力面试题正在靠近](http://mp.weixin.qq.com/s/yLcHLCfVkz5o4vsaC-4NEA)
###[frp内网穿透配置](http://www.kkblog.me/notes/frp%E5%86%85%E7%BD%91%E7%A9%BF%E9%80%8F%E9%85%8D%E7%BD%AE)
https://github.com/fatedier/frp
###[如何让你的分库分表中间件支持emoji表情](http://www.jianshu.com/p/c01843ae82c7?hmsr=toutiao.io&utm_medium=toutiao.io&utm_source=toutiao.io)
###[PHP实现微信开放平台扫码登录源码](https://dev.21ds.cn/article/36.html)
###[Python微信智能回复](http://lafree317.github.io/2017/02/16/%E5%BE%AE%E4%BF%A1%E6%99%BA%E8%83%BD%E5%9B%9E%E5%A4%8D/)
https://github.com/Lafree317/PythonChat 
###[msyql in or效率](https://github.com/zhangyachen/zhangyachen.github.io/issues/60)
select * from table where id in (xxx,xxx,xxx...,xxx)
select * from table where id=xxx or id=xxx or id=xxx ... or id=xxx
在InnoDB引擎下，in返回的顺序是按照主键排序的
当id为主键时，两个sql效率差别不大，都运用了主键进行查询。但是当id上没有索引时，mysql会扫描整个表，对每一个元组的id去in的列表或者or的列表里进行查询 所以在没有索引时，in的效率会高于or。
###[python读取excel](http://biezhi.me/2015/03/12/python-read-excel/)
```js
# -*- coding: utf-8 -*- 
import  xdrlib ,sys
import xlrd

def open_excel(file= 'file.xls'):
    try:
        data = xlrd.open_workbook(file)
        return data
    except Exception,e:
        print str(e)
#根据索引获取Excel表格中的数据   参数:file：Excel文件路径     colnameindex：表头列名所在行的所以  ，by_index：表的索引
def excel_table_byindex(file= 'file.xls',colnameindex=0,by_index=0):
    data = open_excel(file)
    table = data.sheets()[by_index]
    nrows = table.nrows #行数
    ncols = table.ncols #列数
    colnames =  table.row_values(colnameindex) #某一行数据 
    list =[]
    for rownum in range(1,nrows):

         row = table.row_values(rownum)
         if row:
             app = {}
             for i in range(len(colnames)):
                app[colnames[i]] = row[i] 
             list.append(app)
    return list

#根据名称获取Excel表格中的数据   参数:file：Excel文件路径     colnameindex：表头列名所在行的所以  ，by_name：Sheet1名称
def excel_table_byname(file= 'file.xls',colnameindex=0,by_name=u'Sheet1'):
    data = open_excel(file)
    table = data.sheet_by_name(by_name)
    nrows = table.nrows #行数 
    colnames =  table.row_values(colnameindex) #某一行数据 
    list =[]
    for rownum in range(1,nrows):
         row = table.row_values(rownum)
         if row:
             app = {}
             for i in range(len(colnames)):
                app[colnames[i]] = row[i]
             list.append(app)
    return list

def main():
   tables = excel_table_byindex()
   for row in tables:
       print row

   tables = excel_table_byname()
   for row in tables:
       print row

if __name__=="__main__":
    main()
```
https://github.com/ElemeFE/node-interview
###[基于AIML的PHP聊天天机器人](https://github.com/kompasim/chatbot-utf8)
###[mysqlDBA的40条军规](http://mp.weixin.qq.com/s/PtIaqAjs298uH6edEYb2xg)

###[一款国产Nmap在线扫描系统](http://www.freebuf.com/sectool/127670.html)
https://github.com/geekchannel/webmap 工具地址：http://nmap.pay.re
TinyAnalytics：一个轻量级分析工具https://github.com/josephernest/TinyAnalytics
###[PDFLayoutTextStripper：将PDF格式的文档转换成为TXT的纯文本文件](https://github.com/JonathanLink/PDFLayoutTextStripper)
###[image to ascii 的生成器还蛮好玩的](http://lunatic.no/ol/img2aschtml.php)
http://www.xilinjie.com/hao/ 
日常代码审查工具https://github.com/softwaremill/codebrag



###[客户端身份认证](http://veryyoung.me/blog/2015/08/17/client-authentication.html)
生成token：客户端发送用户名和密码，判断账户密码是否正确,如果正确，调用tokenService.storeToken(userId)来生成一个token，并把该token保存在redis中，同时返回给client。

token的规则是

userId|timeStamp
返回给client的token需要进行des加密，并且urlEncode

token的有效时间为半小时

校验token：通过tokenService.checkToken(token)来校验token是否有效


###[2016-02-25PHP 用 curl 读取 HTTP chunked 数据](http://www.ideawu.net/blog/archives/929.html?f=http://blogread.cn/)
```js
$url = "http://127.0.0.1:8100/stream";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_WRITEFUNCTION, 'myfunc');
$result = curl_exec($ch);
curl_close($ch);

function myfunc($ch, $data){
    $bytes = strlen($data);
    // 处理 data
    return $bytes;
}function myfunc($ch, $data){
    $bytes = strlen($data);
    static $buf = '';
    $buf .= $data;
    while(1){
        $pos = strpos($buf, "\n");
        if($pos === false){
            break;
        }
        $data = substr($buf, 0, $pos+1);
        $buf = substr($buf, $pos+1);

        // 处理 data
    }
}
```
###[微信支付（公众号）的流程以及各种坑](http://veryyoung.me/blog/2016/01/05/wechat-pay-is-fucking-shit.html)
###[JS 实现的 unix Terminal命令行，数据都记录在浏览器内存中](http://www.masswerk.at/jsuix/)
###[Mysql In 子查询慢](http://veryyoung.me/blog/2015/08/17/mysql-in-slow.html)
```js
SELECT * FROM table_a WHERE id IN (SELECT id FROM table_id_list)
再把ID列表select一次

SELECT * FROM table_a WHERE id IN (SELECT id from(SELECT id FROM table_id_list)) 秒查
SELECT * FROM table_a JOIN (SELECT id FROM table_id_list) id_list ON table_a.id = id_list.id
###[该项目是 J2Cache 的 Python 语言移植版本](https://git.oschina.net/ld/Py3Cache)
###[mysql按日期分组](http://biezhi.me/2015/09/12/mysql-group-by-date/)
1、按月分组：
select month(FROM_UNIXTIME(time)) from table_name group by month(FROM_UNIXTIME(time))
2、按年月分组：
select DATE_FORMAT(FROM_UNIXTIME(time),"%Y-%m") from tcm_fund_list group by DATE_FORMAT(FROM_UNIXTIME(time),"%Y-%m")
或者：
select FROM_UNIXTIME(time,"%Y-%m") from tcm_fund_list group by FROM_UNIXTIME(time,"%Y-%m")
3、按年月日分组：
select DATE_FORMAT(FROM_UNIXTIME(time),"%Y-%m-%d") from tcm_fund_list group by DATE_FORMAT(FROM_UNIXTIME(time),"%Y-%m-%d")
或者：
select FROM_UNIXTIME(time,"%Y-%m-%d") from tcm_fund_list group by FROM_UNIXTIME(time,"%Y-%m-%d")
其中FROM_UNIXTIME(time,"%Y-%m-%d")中的time代表UNIX时间戳的字段名称 
###[Redis 数据备份与恢复](http://biezhi.me/2016/03/07/redis-data-backup-and-recovery/)
redis 127.0.0.1:6379> SAVE 
OK
该命令将在 redis 安装目录中创建dump.rdb文件。

恢复数据
如果需要恢复数据，只需将备份文件 (dump.rdb) 移动到 redis 安装目录并启动服务即可。获取 redis 目录可以使用 CONFIG 命令，如下所示：

redis 127.0.0.1:6379> CONFIG GET dir
1) "dir"
2) "/usr/local/redis/bin"
以上命令 CONFIG GET dir 输出的 redis 安装目录为 /usr/local/redis/bin
```
###[为Nginx目录设置访问密码](http://biezhi.me/2015/05/20/set-access-password-for-nginx-directory/)
```js
http://trac.edgewall.org/export/10770/trunk/contrib/htpasswd.py
执行命令：

chmod 777 htpasswd.py
./htpasswd.py -c -b htpasswd username password
其中htpasswd是生成的文件名

修改nginx的conf

修改nginx.conf或者所要设置的vhost的conf，加入如下语句：

location  ^~ / {
	auth_basic "Password";
	auth_basic_user_file /usr/local/nginx/conf/htpasswd;
}
```
###[协议分析（微信网页版 wx2.qq.com）](http://biezhi.me/2016/02/21/wechat-protocol-analysis/)
Java版实现源码：https://github.com/biezhi/wechat-robot Python实现：https://github.com/Urinx/WeixinBot C#实现：https://github.com/sherlockchou86/WeChat.NET QT实现：https://github.com/xiangzhai/qwx
###[MySQL工具推荐 | 基于MySQL binlog的flashback工具，MySQL下的误操作有后悔药](http://t.cn/Ribd3Kk)
###[Python读写zip压缩文件](http://biezhi.me/2015/09/15/python-read-and-write-zip-compressed-files/)
```js
import zipfile
 
z = zipfile.ZipFile("zipfile.zip", "r")
 
#打印zip文件中的文件列表
for filename in z.namelist(  ):
    print 'File:', filename
 
#读取zip文件中的第一个文件
first_file_name = z.namelist()[0]
content = z.read(first_file_name)
print first_file_name
print content
z = zipfile.ZipFile('test.zip', 'w', zipfile.ZIP_DEFLATED)
z.write('test.html')
z.close( ) 
```
###[无损压缩/放大图片神器推荐](http://mp.weixin.qq.com/s/HpG3vgCXsP-UY6jJpJ_a7Q)
重量级的下载工具
https://imagecyborg.com http://waifu2x.udp.jp/index.zh-CN.html
没想到你是这样的gif动图 http://mp.weixin.qq.com/s?__biz=MzAxMDA5ODk3OQ==&mid=2649327987&idx=1&sn=5003298b1e779bd942d27fa3b41ddc8e&chksm=8348a93fb43f202900133faf8a461d6e6501d891d4a0ce00d4b36e8b898db59c65d709ec8b9f&scene=21#wechat_redirect   小巧的工具
ScreenToGif zhitu.isux.us
###[PHP过滤掉Emoji表情字符](http://www.ideawu.net/blog/category/web/php)
function smarty_modifier_emojistrip($string)
{       
    return preg_replace('/\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF]/', '', $string);
}
###[美团点评SQL优化工具SQLAdvisor开源](http://mp.weixin.qq.com/s/idz6b2rls97W4Iw6J-ubng)

GitHub 地址：https://github.com/Meituan-Dianping/SQLAdvisor 
###[10行Python代码的词云](http://mp.weixin.qq.com/s/HysMAAPMY2zLilQVnTUE5A)
###[Python 资源大全中文版](https://segmentfault.com/p/1210000008627120/read#top)
###[所谓mysql的优化，三分是配置的优化，七分是sql语句的优化](http://weibo.com/ttarticle/p/show?id=2309404083337810553196)
https://my.oschina.net/benhaile/blog/849499
###[笑来搜原型 Laravel Scout & ElasticSearch ik http://scout.lijinma.com/search](https://github.com/lijinma/laravel-scout-elastic-demo)
把一个公众账号的文章拉下来，然后实现所有文章的“标题”和“内容”的搜索，在项目中我选择了李笑来老师的”学习学习再学习“中的50篇文章。


###[微信里有哪些优雅装B的小技巧](https://www.zhihu.com/question/45231797)
http://baozoumanhua.com/zhuangbi/list?from=web  暴走漫画装逼神器系列
###[解压文件](http://stackoverflow.com/questions/3263129/unzipping-larger-files-with-php)
```js
图片解压后导致 php 内存溢出
$filename = 'c:\kosmas.zip';
        $archive = zip_open($filename);
        while($entry = zip_read($archive)){
            $size = zip_entry_filesize($entry);
            $name = zip_entry_name($entry);
            $unzipped = fopen('c:/unzip/'.$name,'wb');
            while($size > 0){
                $chunkSize = ($size > 10240) ? 10240 : $size;
                $size -= $chunkSize;
                $chunk = zip_entry_read($entry, $chunkSize);
                if($chunk !== false) fwrite($unzipped, $chunk);
            }

            fclose($unzipped);
        }
        
        $buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
 fwrite($fp,"$buf");
浮点数 http://0.30000000000000004.com/
 
```
###[GitHub Page精选](http://blog.githuber.cn/)
MySQL 每次查询一条数据查询十次与一次查询十条数据之间的区别http://blog.githuber.cn/posts/1009
###[ Python3爬虫三大案例实战分享](https://m.hellobi.com/course/156?from=timeline)

https://github.com/Germey/TouTiao/blob/master/spider.py
###[理解 TCP 和 UDP](https://github.com/JerryC8080/understand-tcp-udp?hmsr=toutiao.io&utm_medium=toutiao.io&utm_source=toutiao.io)
###[SQL删除重复记录](http://www.xiangguo.li/sql_and_nosql/2015/01/01/sql)
```js
select * from people
where peopleId in (select  peopleId  from  people  group  by  peopleId  having  count(peopleId) > 1)
select * from vitae a
where (a.peopleId,a.seq) in  (select peopleId,seq from vitae group by peopleId,seq  having count(*) > 1)
删除表中多余的重复记录（多个字段），只留有rowid最小的记录

delete from vitae a
where (a.peopleId,a.seq) in  (select peopleId,seq from vitae group by peopleId,seq having count(*) > 1) and rowid not in (select min(rowid) from vitae group by peopleId,seq having count(*)>1)
5、查找表中多余的重复记录（多个字段），不包含rowid最小的记录

select * from vitae a
where (a.peopleId,a.seq) in  (select peopleId,seq from vitae group by peopleId,seq having count(*) > 1) and rowid not in (select min(rowid) from vitae group by peopleId,seq having count(*)>1)
```
###[前端的甩锅指南](https://zhuanlan.zhihu.com/p/25649277)
如果不在浏览器上，写爬虫脚本的话需要自己把 Cookie 这个 header 带上。很多的 web server 是借助 Cookie 作为用户会话的凭证的，比如存一个唯一的 sessionid 值到 Cookie，每次请求都带上，来判断是哪个用户。如果不用 Cookie 作为会话认证，还有其他方式吗？其实说到底认证就是需要传给服务端有个字段标识哪个用户，那我们可以在头里面加个 Authorization 的字段，其他名字也行，只要跟服务端商量好。
加一些 http 的头也能有效的防御攻击，比如 csp(Content Security Policy)
###[十款好用的图片/视频类工具](http://mp.weixin.qq.com/s/3wpEW0sjf-YWonojgPxYWA)
让照片变成名画--prisma 智能拼图神器--shape collage
###[Mysql数字排序](http://veryyoung.me/blog/2015/08/17/mysql-rank-number.html)
SELECT * FROM  table_name ORDER BY CAST(field_name AS UNSIGNED) 
SELECT * FROM table_name ORDER BY field_name*1 desc
 SELECT * FROM table_name ORDER BY ABS（field_name) desc 
 ###[Usql：SQL数据库的通用命令行界面，用Go语言编写](https://github.com/knq/usql)
 ###[免费的在线格式转换工具](http://www.alltoall.net/)
 ###[数据结构宝典](http://www.ucai.cn/dsviz/)
 ###[github-trending小工具](http://www.jianshu.com/p/25722080c73d?hmsr=toutiao.io&utm_medium=toutiao.io&utm_source=toutiao.io)
 https://github.com/bonfy/github-trending 
 ```js
 def scrape(language, filename):

    HEADERS = {
        'User-Agent'        : 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:11.0) Gecko/20100101 Firefox/11.0',
        'Accept'            : 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
        'Accept-Encoding'    : 'gzip,deflate,sdch',
        'Accept-Language'    : 'zh-CN,zh;q=0.8'
    }

    url = 'https://github.com/trending/{language}'.format(language=language)
    r = requests.get(url, headers=HEADERS)
    assert r.status_code == 200

    d = pq(r.content)
    items = d('ol.repo-list li')

    # codecs to solve the problem utf-8 codec like chinese
    with codecs.open(filename, "a", "utf-8") as f:
        f.write('\n####{language}\n'.format(language=language))

        for item in items:
            i = pq(item)
            title = i("h3 a").text()
            owner = i("span.prefix").text()
            description = i("p.col-9").text()
            url = i("h3 a").attr("href")
            url = "https://github.com" + url
            f.write(u"* [{title}]({url}):{description}\n".format(title=title, url=url, description=description))
 ```
 
###[php原生的引擎](https://www.zhihu.com/question/39711044)
```js
 

这个是模板文件
<h1><?=$title?></h1>
<ul>
	<?php foreach($list as $value): ?>
		<li><?=$value?></li>
	<?php endforeach; ?>
</ul>

这个是解析文件：
<?php
/**
 * 模板解析
 */
class View{
	protected $path;
	protected $vars;
	public function __construct($path, $vars = []){
		if (is_file($path)) {
			$this->path = $path;
		}
		$this->vars = $vars;
	}

	public function fetch(){
		ob_start();
		ob_implicit_flush(0);
		extract($this->vars, EXTR_OVERWRITE);
		require_once $this->path;
		return ob_get_clean();
	}
}

$view = new View('./index.html', ['title' => 'test', 'list' => ['a', 'b', 'c']]);
echo $view->fetch();

```
###[Git基础(二)--常见撤销操作](http://goldenera.me/2017/02/23/Git%E5%9F%BA%E7%A1%80(%E4%BA%8C)--%E5%B8%B8%E8%A7%81%E6%92%A4%E9%94%80%E6%93%8D%E4%BD%9C/)
```js
撤销工作区文件

git checkout filename
撤销暂存区文件至工作区

git reset filename
撤销本地仓库的某次至工作区

git reset commit
Git 命令行输入如下命令，禁止自动转换换行符

 
git config --global core.autocrlf false
pull 失败 解决方案：取消 Pull 操作然后手动合并
git merge --abort
git reset --merge
checkout : Unable to create ‘/path/project/.git/index.lock’ rm -f ./.git/index.lock
###[不小心敲了rm -rf后](https://www.zhihu.com/question/29438735)
不允许用rm命令的，要删除文件，需要mv文件到指定目录/delete/，会有一个定时任务，每周清空/delete/下文件
mv 文件(夹) /tmp 

(/tmp 下的文件在每次关机后都会被清理干净)
使用了以下命令：brew install safe-rm
echo 'alias rm=/usr/local/safe-rm' >> ~/.profile
不过不是root应该还是删不掉/的吧，反正我没试过。 命令行的回收站，设置alias rm=trash
```
###[Pandas速查手册中文版](https://zhuanlan.zhihu.com/p/25630700)
###[最新任意命令执行漏洞)批量检测工具精简版 ](https://zhuanlan.zhihu.com/p/25628971)
###[我所依赖的记忆方法](https://zhuanlan.zhihu.com/p/25603437)
https://faded12.github.io/conversion/ 记忆转换工具（中/英）
###[Python Web导出有排版要求的PDF文件](https://zhuanlan.zhihu.com/p/25691170)
xhtml2pdf 安装

pip install xhtml2pdf
pip install html5lib==1.0b8
中文字体问题

xhtml2pdf默认不支持中文字体，所以需要下载中文字体，比如:

宋体: simsun
同时要指定html页面的charset， 如：

<meta charset='utf8'/>
###[requests模块的response.text与response.content有什么区别](https://www.zhihu.com/question/56816991)
```js
requests.content返回的是二进制响应内容

而requests.text则是根据网页的响应来猜测编码，如果服务器不指定的话，默认编码是"

ISO-8859-1"
用response.encoding看一下他猜测的编码是啥。我猜应该是ISO-8859-1

然后你用response.encoding = 'utf-8'

然后再 response.text ，返回的内容应该是正常的了.
url = 'http://www.23us.com/class/9_11.html'
  response = requests.get(url)
response.encoding = response.apparent_encoding
resp.text返回的是Unicode型的数据。
resp.content返回的是bytes型也就是二进制的数据。
如果你想取文本，可以通过r.text。 如果想取图片，文件，则可以通过r.content。
（resp.json()返回的是json格式数据）

 # 例如下载并保存一张图片  
import requests  
jpg_url = 'http://img2.niutuku.com/1312/0804/0804-niutuku.com-27840.jpg'  
content = requests.get(jpg_url).content  
with open('demo.jpg', 'wb') as fp:     
    fp.write(content) 
```
###[APACHE VirtualHost的配置](http://goldenera.me/2017/02/16/%E4%BB%8E%E9%9B%B6%E5%BC%80%E5%A7%8B%E5%BB%BA%E7%AB%99(%E4%BA%8C)--VirtualHost%E7%9A%84%E9%85%8D%E7%BD%AE/)
```js
sudo mkdir -p /var/www/mysite.com
sudo chown -R $USER:$USER /var/www/mysite.com
cp /etc/apache2/site-available/default /etc/apache2/site-available/mysite.com
vi mysite.com.conf 
建议的配置文件内容

<VirtualHost *:80>
    ServerAdmin yourEmail@gmail.com
    ServerName www.yoursite.com
    DocumentRoot /var/www/example.com
    ErrorLog ${APACHE_LOG_DIR}/mysite.com/error.log
    CustomLog ${APACHE_LOG_DIR}/mysite.com/access.log
</VirtualHost>
激活配置文件

sudo a2ensite mysite.com.conf
重启apahce

sudo service apache2 restart
```
###[微信消息防撤回工具](https://zhuanlan.zhihu.com/p/25706692)
http://link.zhihu.com/?target=https%3A//pan.baidu.com/s/1c2mWSVm 
如果有朋友发消息给你并撤回你就会收到文件传输助手的通知了。
https://zhuanlan.zhihu.com/p/25689314?utm_source=zhihu&utm_medium=social 
###[cookies 转换 python dict](https://zhuanlan.zhihu.com/p/23208898)
```js
from http.cookies import SimpleCookie

#浏览器中的原始cookies字符串
rawdata = '''omg_first_visit_completed=1; __utmt=1; __utma=114157465.1493803552.1477441810.1477441810.1477441810.1; __utmb=114157465.1.10.1477441810; __utmc=114157465; __utmz=114157465.1477441810.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)'''

from http.cookies import SimpleCookie
cookie = SimpleCookie(rawdata)
cookies = {i.key:i.value for i in cookie.values()}
{'__utmt': '1', 
'omg_first_visit_completed': '1', 
'__utmc': '114157465',
'__utmb': '114157465.1.10.1477441810', '__utma': '114157465.1493803552.1477441810.1477441810.1477441810.1', 
'__utmz': '114157465.1477441810.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)'}
```
