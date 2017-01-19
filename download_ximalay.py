http://mobile.ximalaya.com/mobile/v1/album?albumId=230311&device=android&isAsc=true&pageId=1&pageSize=20&pre_page=0&source=3&statEvent=pageview/album@230311&statModule=全部_专辑&statPage=search@交通广播&statPosition=1&trackId=26541554
//http://mobile.ximalaya.com/mobile/v1/album/track?albumId=230311&device=android&isAsc=true&pageId=2&pageSize=20&pre_page=0&statEvent=pageview/album@230311&statModule=全部_专辑&statPage=search@交通广播&statPosition=1
$ximalaya = 'http://mobile.ximalaya.com/mobile/v1/album/track?albumId=230311&device=android&isAsc=true&pageId=2&pageSize=20&pre_page=3&source=3&statEvent=pageview%2Falbum%40230311&statModule=%E5%85%A8%E9%83%A8_%E4%B8%93%E8%BE%91&statPage=search%40%E4%BA%A4%E9%80%9A%E5%B9%BF%E6%92%AD&statPosition=1&trackId=26541554';
/*http://mobile.ximalaya.com/mobile/v1/album?albumId=230311&device=android&isAsc=true&pageId=1&pageSize=20&pre_page=0&source=3&statEvent=pageview/album@230311&statModule=全部_专辑&statPage=search@交通广播&statPosition=1&trackId=26541554
http://mobile.ximalaya.com/mobile/v1/album/track?albumId=230311&device=android&isAsc=true&pageId=2&pageSize=20&pre_page=0&statEvent=pageview/album@230311&statModule=全部_专辑&statPage=search@交通广播&statPosition=1
http://mobile.ximalaya.com/mobile/v1/album/track?albumId=230311&device=android&isAsc=true&pageId=3&pageSize=20&pre_page=0&statEvent=pageview/album@230311&statModule=全部_专辑&statPage=search@交通广播&statPosition=1*/
$res = file_get_contents($ximalaya);

print_r(json_decode($res,1));
#数组的playUrl64就是下载地址
Array
(
    [ret] => 0
    [data] => Array
        (
            [list] => Array
                (
                    [0] => Array
                        (
                            [trackId] => 26349363
                            [uid] => 4946354
                            [playUrl64] => http://audio.xmcdn.com/group24/M09/94/53/wKgJMFhFGe-Tr3AjAQV5Yro4HD4927.mp3
                            [playUrl32] => http://audio.xmcdn.com/group24/M09/94/6F/wKgJNVhFGdSgKkNvAIK80DXX8S8467.mp3
                            [playPathHq] => http://audio.xmcdn.com/group23/M0A/94/90/wKgJNFhFGhWztUipAhDdVzZc1cM398.m4a
                            [playPathAacv164] => http://audio.xmcdn.com/group24/M09/94/72/wKgJNVhFGezQBfazAQiYP8FkisM860.m4a
                            [playPathAacv224] => http://audio.xmcdn.com/group24/M09/94/6F/wKgJNVhFGdDQTkkkAGUrLOYNivs893.m4a
                            [title] => 【小南.城市晚安.你的侠骨柔情难了恩怨情长】VOL.202
                            [duration] => 2141
                            [albumId] => 230311
                            [isPaid] => 
                            [processState] => 2
                            [createdAt] => 1480923613000
                            [coverSmall] => http://fdfs.xmcdn.com/group8/M08/37/B6/wKgDYVWXTJ-ST8pdAAB6bkn8EvI702_web_meduim.jpg
                            [coverMiddle] => http://fdfs.xmcdn.com/group8/M08/37/B6/wKgDYVWXTJ-ST8pdAAB6bkn8EvI702_web_large.jpg
                            [coverLarge] => http://fdfs.xmcdn.com/group8/M08/37/B6/wKgDYVWXTJ-ST8pdAAB6bkn8EvI702_mobile_large.jpg
                            [nickname] => 927交通广播小南
                            [smallLogo] => http://fdfs.xmcdn.com/group3/M03/90/07/wKgDslKlhGWAs7FbAADX4zHiACo793_mobile_small.jpg
                            [userSource] => 1
                            [opType] => 1
                            [isPublic] => 1
                            [likes] => 642
                            [playtimes] => 91173
                            [comments] => 40
                            [shares] => 0
                            [status] => 1
                        )

                    [1] => Array
                        (
                            [trackId] => 26175738
                            [uid] => 4946354
                            [playUrl64] => http://audio.xmcdn.com/group24/M04/89/A1/wKgJNVhBHPLDbNO0AVbbq2OZfMI359.mp3
                            [playUrl32] => http://audio.xmcdn.com/group24/M04/89/A2/wKgJNVhBHP_gb1X3AKtt9d2sT0g874.mp3
                            [playPathHq] => http://audio.xmcdn.com/group24/M04/89/A1/wKgJNVhBHPfCiFwcArV3iNvQmjo398.m4a
                            [playPathAacv164] => http://audio.xmcdn.com/group25/M06/89/38/wKgJMVhBHSCBYyGFAVrxGUeC62o300.m4a
                            [playPathAacv224] => http://audio.xmcdn.com/group24/M04/89/89/wKgJMFhBHPTADqsFAISnAdlRdf8256.m4a
                            [title] => 【小南.城市晚安.专注是对时光最好的交代】VOL.201
                            [duration] => 2808
                            [albumId] => 230311
                            [isPaid] => 
                            [processState] => 2
                            [createdAt] => 1480662192000
                            [coverSmall] => http://fdfs.xmcdn.com/group8/M08/37/B6/wKgDYVWXTJ-ST8pdAAB6bkn8EvI702_web_meduim.jpg
                            [coverMiddle] => http://fdfs.xmcdn.com/group8/M08/37/B6/wKgDYVWXTJ-ST8pdAAB6bkn8EvI702_web_large.jpg
                            [coverLarge] => http://fdfs.xmcdn.com/group8/M08/37/B6/wKgDYVWXTJ-ST8pdAAB6bkn8EvI702_mobile_large.jpg
                            [nickname] => 927交通广播小南
                            [smallLogo] => http://fdfs.xmcdn.com/group3/M03/90/07/wKgDslKlhGWAs7FbAADX4zHiACo793_mobile_small.jpg
                            [userSource] => 1
                            [opType] => 1
                            [isPublic] => 1
                            [likes] => 128
                            [playtimes] => 44888
                            [comments] => 29
                            [shares] => 0
                            [status] => 1
                        )

                )

            [pageId] => 2
            [pageSize] => 20
            [maxPageId] => 16
            [totalCount] => 306
        )

    [msg] => 0
)

#!/usr/bin/env python
# coding=utf-8
# -*- coding: utf_8 -*-
import os, sys
import urllib2

try:
    from lxml import html
except ImportError:
    raise SystemExit('lxml库导入错误,请安装lxml库!')


# 类定义
class ximalaya:
    def __init__(self, url):
        self.url = url  # 传入的专辑URL,类似http://www.ximalaya.com/16960840/album/294567
        self.num = 100  # 定义默认下载的mp3总数,若不想限制,修改download里面相关代码

    def getpage(self):
        '获取分页数方法'
        pagelen = ''  # 保存分页数
        try:
            request = urllib2.urlopen(self.url, timeout=30).read()
        except Exception, msg:
            print '网页打开出错,请检查!', msg
        else:
            page = html.fromstring(request)
            plen = page.xpath('//div[@class="pagingBar_wrapper"]/a/@href')
            if len(plen) > 1:  # 判断分页是否多于1页
                pagelen = len(plen) - 1  # 排除分页链接中的javascript:;
            else:
                pagelen = 1  # 如果没有分页,则分页数为1
            print '正在获取分页数据,共有分页：%d\n' % pagelen
        return pagelen

    def analyze(self):
        '解析真实地址方法'
        mp3list = []  # 存储解析后的真实地址
        if 'sound' in self.url:
            playurl = self.url.replace('www.', 'm.')
            try:
                page = html.fromstring(urllib2.urlopen(playurl, timeout=30).read())
            except Exception, msg:
                print '请求播放地址出错', msg, playurl
            else:
                mp3 = page.xpath('//div[@class="pl-info-panel"]/a/@sound_url')[0]  # 获取真实的mp3地址
                title = page.xpath('//h1[@class="pl-name"]/text()')[0]
                mp3list.append((title, mp3))
                print '指定mp3地址解析成功: %s\n' % mp3
        else:
            for ids in range(1, self.getpage() + 1):
                purl = self.url + '?page=' + str(ids)  # 生成真实的分页地址
                try:
                    request = urllib2.urlopen(purl, timeout=30).read()
                except Exception, msg:
                    print '请求分页地址出错', msg
                else:
                    page = html.fromstring(request)
                    plist = page.xpath('//div[@class="miniPlayer3"]/a[@class="title"]')
                    for i in range(len(plist)):
                        title = plist[i].attrib['title']  # 获取每条mp3标题
                        link = plist[i].attrib['href']  # 获取每条mp3地址
                        id = link[link.rfind('/') + 1:]  # 获取专辑下所有的id
                        playurl = self.url.replace('www.', 'm.').replace('album', 'sound')  # 替换为移动端访问地址
                        playurl = playurl.replace(playurl[playurl.rfind('/') + 1:], id)  # 替换原始url中最后一段id
                        try:
                            page = html.fromstring(urllib2.urlopen(playurl, timeout=30).read())
                        except Exception, msg:
                            print '请求播放地址出错', msg, playurl
                        else:
                            mp3 = page.xpath('//div[@class="pl-info-panel"]/a/@sound_url')[0]  # 获取真实的mp3地址
                            mp3list.append((title, mp3))
            print '批量mp3地址解析成功,共有mp3: [%d] 条!\n' % len(mp3list)
        return mp3list

    def download(self):
        '下载mp3方法'
        count = 0  # 下载计数器
        for title, mp3 in self.analyze():
            count += 1
            title = title.replace('?', '').replace('"', '').replace(':', '').replace('/', '')  # 替换标题中特殊字符
            title = title.encode('utf8', 'ignore')  # 编码转换,避免报错
            mp3_name = title + '.mp3'
            try:
                if os.path.isfile(mp3_name) and os.path.getsize(mp3_name) > 0: continue
                print '正在下载 %s\n' % title
                with open(mp3_name, 'wb') as mp3_file:  # 保存mp3到本地
                    mp3_file.write(urllib2.urlopen(mp3).read())
                    print mp3_name + ' 下载成功!\n'
            except Exception, msg:
                print '\n爷,有部分下载失败了:', title, msg
            if count == self.num: break  # 如果不想限制,请在此行前面加入注释。


if __name__ == '__main__':
    print '+' + '-' * 50 + '+'
    print '\t   Python 喜马拉雅mp3批量下载工具https://github.com/listc/xmlyDownload/blob/master/xmlyDownload.py'
    print '\t   Blog：http://www.waitalone.cn/'
    print '\t\t Code BY： 独自等待'
    print '\t\t Time：2016-02-16'
    print '+' + '-' * 50 + '+'
    if len(sys.argv) != 2:
        print '用法: ' + os.path.basename(sys.argv[0]) + ' 你要下载的专辑mp3主页地址,地址如下：'
        print '实例: ' + os.path.basename(sys.argv[0]) + ' http://www.ximalaya.com/12495477/album/269179'
        sys.exit()
    ximalaya = ximalaya(sys.argv[1])  # 实例化类
ximalaya.download() # 下载mp3


#coding=utf-8
import os,requests,re
import urllib,urllib2
import sys
import json
import codecs
sys.path.append("..")
class Common():
    #  获取网页源码http://blog.csdn.net/iloster/article/details/50165907
    @staticmethod
    def getHtml(url):
        html = urllib2.urlopen(url).read()
        #print  "[+]获取网页源码:"+url
        return html

    # 下载文件
    @staticmethod
    def download(url,filepath,filename):
        headers = {
            'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Charset': 'UTF-8,*;q=0.5',
            'Accept-Encoding': 'gzip,deflate,sdch',
            'Accept-Language': 'en-US,en;q=0.8',
            'User-Agent': 'Mozilla/5.0 (Linux; Android 4.4.2; Nexus 4 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.114 Mobile Safari/537.36'
        }
        request = urllib2.Request(url,headers = headers);
        response = urllib2.urlopen(request)
        path = filepath + filename.decode('utf-8')
        with open(path,'wb') as output:
            while True:
                buffer = response.read(1024*256);
                if not buffer:
                    break
                # received += len(buffer)
                output.write(buffer)

        print u"[+]下载文件成功:"+path

    @staticmethod
    def isExist(filepath):
        return os.path.exists(filepath)

    @staticmethod
    def createDir(filepath):
         os.makedirs(filepath,0777)

class Xmly():

    URL_PRIFIX = "http://www.ximalaya.com/tracks/"
    def getJsonUrl(self,url):
        result = url.split('/')
        return result[len(result)-1]+".json"
    def getVoiceUrl(self,html):
        # print html
        jsonStr = json.loads(html)
        return jsonStr["title"].encode('utf-8'),jsonStr["play_path"]

    def download(self,url,filepath):
        jsonUrl = self.URL_PRIFIX + self.getJsonUrl(url)
        html = Common.getHtml(jsonUrl)
        voiceTitle,voiceUrl = self.getVoiceUrl(html)
        Common.download(voiceUrl,filepath,voiceTitle+'.mp4')

class ximalayadown:
    def __init__(self, url):
        self.url = url  # 传入的专辑URL,类似http://www.ximalaya.com/16960840/album/294567
        self.num = 10 # 定义默认下载的mp3总数,若不想限制,修改download里面相关代码
        self.urlheader = {
            'Accept': 'application/json, text/javascript, */*; q=0.01',
            'X-Requested-With': 'XMLHttpRequest',
            'User-Agent': 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36',
            'Content-Type': 'application/x-www-form-urlencoded',
            'Referer': self.url,
            'Cookie': '_ga=GA1.2.1628478964.1476015684; _gat=1',
        }

    def getpage(self):
        '获取分页数方法'
        pagelist = []  # 保存分页数
        try:
            response = requests.get(self.url, headers=self.urlheader).text.encode('utf-8')
        except Exception, msg:
            print u'网页打开出错,请检查!', msg
        else:
            reg_list = [
                re.compile(r"class=\"pagingBar_wrapper\" url=\"(.*?)\""),
                re.compile(r"<a href='(/\d+/album/\d+\?page=\d+)' data-page='\d+'")
            ]
            for reg in reg_list:
                pagelist.extend(reg.findall(response))
        print pagelist        
        if pagelist:
            return ['http://www.ximalaya.com' + x for x in pagelist[:-1]]
        else:
            return [self.url]

    def analyze(self, trackid):
        '解析真实mp3地址'
        trackurl = 'http://www.ximalaya.com/tracks/%s.json' % trackid
        mp3list = [] # 存储解析后的真实地址
        try:
            response = requests.get(trackurl, headers=self.urlheader).text
        except Exception:
            print trackurl + '解析失败!'
            with open('analyze_false.txt', 'ab+') as false_analyze:
                false_analyze.write(trackurl + '\n')
        else:
            jsonobj = json.loads(response)
            title = jsonobj['title']
            mp3 = jsonobj['play_path']
            filename = title.strip() + '.mp3'
            #print filename, mp3
            mp3list.append((filename, mp3))
            urllib.urlretrieve(mp3,filename)
            # todo 调用aria2c.exe实现多线程下载
            # 乱码问题比较难以解决。
            with codecs.open('ximamp3.txt', 'ab+',encoding='utf-8') as mp3file:
                #mp3file.write('%s|%s\n' % (filename, mp3))
                pass
        return mp3list
                
    def todownlist(self):
        count = 0  # 下载计数器
        '生成待下载的文件列表'
        if 'sound' in self.url:  # 解析单条mp3
            trackid = self.url[self.url.rfind('/') + 1:]
            self.analyze(trackid)
        else:
            for purl in self.getpage():  # 解析每个专辑页面中的所有mp3地址
                print purl
                try:
                    response = requests.get(purl, headers=self.urlheader).text
                except Exception, msg:
                    print u'分页请求失败!', msg
                else:
                    #http://www.ximalaya.com/16960840/album/294567 http://www.ximalaya.com/tracks/28971473.json
                    """
                    <div class="personal_body" sound_ids="28971473,28643367,27953085,27663229,26973202,26852829,26734651,26463578,26117345,26081393,25610518,25169911,24762046,24393582,23917193,23472619,23061220,23051457,22637240,22267189,21956882,21143161,21036973,20377523,20275426,20032727,19668798,19668696,19380085,19049618,18689435,18333606,17981121,17667574,17369282,17284894,17172046,17084189,16799738,16528499,16484663,16184900,15859258,15557484,15242496,14632411,14332754,14049489,13476576,13206446,12953860,12766699,12270269,12206484,12160722,12048977,12021970,11709701,11609682,11459136,11390125,11241820,10998720,10919446,10733550,10651217,10569004,10544376,10490608,10242776,10162944,10079859,9979959,9909145,9836103,9724918,9568113,9478600,9431565,9365107,9187804,9065711,8956681,8831872,8727352,8654034,8578119,8512594,8408150,8324652,8217849,8164678,8114063,8058475,7980519,7942180,7903565,7829661,7757954,7704090">
        <div class="detailContent" sound_id="28971473">
                    """
                    ids_reg = re.compile(r'sound_ids="(.+?)"')
                    ids_res = ids_reg.findall(response)
                    idslist = [j for j in ids_res[0].split(',')]
                    for trackid in idslist:
                        count += 1
                        self.analyze(trackid)
                    if count == self.num: break  # 如果不想限制,请在此行前面加入注释。    
                    
if __name__ == '__main__':
    url = "http://www.ximalaya.com/13163945/sound/10499951"
    #xmly = Xmly()
    #xmly.download(url,"./")
    print '+' + '-' * 50 + '+'
    print u'\t   Python 喜马拉雅mp3批量下载工具'
    print u'\t   Blog：https://www.waitalone.cn/ximalaya-download.html'
    print u'\t\t Code BY： 独自等待'
    print u'\t\t Time：2016-07-29'
    print '+' + '-' * 50 + '+'
    if len(sys.argv) != 2:
        print u'用法: ' + os.path.basename(sys.argv[0]) + u' 你要下载的专辑mp3主页地址,地址如下：'
        print u'实例: ' + os.path.basename(sys.argv[0]) + ' http://www.ximalaya.com/12495477/album/269179'
        sys.exit()
    ximalaya = ximalayadown(sys.argv[1])  # 实例化类
    ximalaya.todownlist()
    #https://github.com/aria2/aria2/releases $ aria2c https://github.com/aria2/aria2/releases/download/release-1.31.0/aria2-1.31.0-win-64bit-build1.zip
    #xima.bat for /f "tokens=1,2 delims=|" %%i in (ximamp3.txt) do aria2c.exe -s 10 -j 10 %%j --out=%%i
