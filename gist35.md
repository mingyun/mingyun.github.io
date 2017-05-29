[如何免费自己制作一个APP](https://zhuanlan.zhihu.com/p/26976378?group_id=848854937373929472)
http://link.zhihu.com/?target=http%3A//school.dingdone.com/
[大意是非IO阻塞下不要开太多PHP-FPM进程,1.5倍是个不多不少的数 进程数保持为CPU核心数的1.5倍](https://www.zhihu.com/question/39955800)

load average: 120.05, 32.82, 11.42load average 表示系统负载,分别是1分钟,5分钟,15分钟前到现在的负载平均值(任务队列中进程或线程数量的平均数).load average指的是处于task_running或task_uninterruptible状态的进程(或线程)数的平均值.处于task_running状态的进程(或线程),可能正在使用CPU或排队等待使用CPU.处于task_uninterruptible状态的进程(或线程),可能正在等待I/O,比如等待磁盘I/O
[这些问题答不出，是否代表不能成为能独当一面的PHP工程师](https://www.zhihu.com/question/60055316)
[JavaScript深入系列15篇正式完结！](https://segmentfault.com/a/1190000009562674)
[别人家的表情包是这样的](https://mp.weixin.qq.com/s/7IgckpEv9cn4RMqqYdqiHg)
[无版权的高清图片搜索引擎 FreePhotos.cc，全部可以下载，支持中文搜索。](https://freephotos.cc/zh/%E5%A4%8F%E5%A4%A9)
[热门模块](http://npmtrend.com/)
[SQL删除重复记录](http://blog.githuber.cn/posts/684)
查找表中多余的重复记录（多个字段）

select * from vitae a
where (a.peopleId,a.seq) in  (select peopleId,seq from vitae group by peopleId,seq  having count(*) > 1)
查找表中多余的重复记录（多个字段），不包含rowid最小的记录

select * from vitae a
where (a.peopleId,a.seq) in  (select peopleId,seq from vitae group by peopleId,seq having count(*) > 1) and rowid not in (select min(rowid) from vitae group by peopleId,seq having count(*)>1)
删除表中多余的重复记录（多个字段），只留有rowid最小的记录

delete from vitae a
where (a.peopleId,a.seq) in  (select peopleId,seq from vitae group by peopleId,seq having count(*) > 1) and rowid not in (select min(rowid) from vitae group by peopleId,seq having count(*)>1)
播放器用「Potplayer」，好用到没朋友；截图用「Snipaste」，强大到无可想象；手机P图用「VSCO」「黄油相机」，功能强大有逼格；压缩软件用「Bandzip」，简洁干净解压快；看论文用「SumatraPDF」，功能较全还小巧；​​OCR文字识别用「扫描王」，识别效率高；搜书用「鸠摩搜书」，方便快捷；录屏用「EV录屏」，简洁易用，功能强大；下载视频用「硕鼠」「视频下载王」，功能齐全，支持多个视频网站
[实现各种经典算法顺序查找](https://segmentfault.com/p/1210000009523704/read)
[webcode  ： 一个在线的 web 代码生成小工具](https://webcode.tools/)
[RBAC用户角色权限控制](https://segmentfault.com/p/1210000009472992/read)
，需要用户表(user)，角色表(role)，权限表(permission)，还需要两张中间表,用户-角色表(user_role)，角色-权限表(role_permission),
[用Ping++做支付](https://i6448038.github.io/2017/05/04/%E7%94%A8Ping-%E5%81%9A%E6%94%AF%E4%BB%98/)
[使用 Medis 管理 Redis](https://github.com/luin/medis)
[给PHP做的分布式跟踪系统，可以方便的查看线上调用关系，性能](https://github.com/weiboad/fiery)
>>> x = ['abc','a','bc','abcd']
>>> x.sort(key=len)
>>> x
['a', 'bc', 'abc', 'abcd’]
>>> L = [1,4,3,2]
>>> L.sort.__doc__
'L.sort(key=None, reverse=False) -> None -- stable sort *IN PLACE*'
[我想要搭建git仓库](https://segmentfault.com/p/1210000009571646/read#top)
[Python有哪些黑魔法](https://www.zhihu.com/question/29995881)
```js
a, b, c = (2 * i + 1 for i in range(3))
a, *b, c = [1, 2, 3, 4, 5]
>>> a = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
>>> a[::-1]
[10, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
>>> a[::-2]
[10, 8, 6, 4, 2, 0]
>>> a[::3]
[0, 3, 6, 9]
>>> a = [1, 2, 3]
>>> b = ['a', 'b', 'c']
>>> z = zip(a, b)
>>> z
[(1, 'a'), (2, 'b'), (3, 'c')]
>>> zip(*z)
[(1, 2, 3), ('a', 'b', 'c')]

作者：地球的外星人君
链接：https://www.zhihu.com/question/29995881/answer/172961766
来源：知乎
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。

列表相邻元素压缩器>>> a = [1, 2, 3, 4, 5, 6]
>>> zip(*([iter(a)] * 2))
[(1, 2), (3, 4), (5, 6)]

>>> group_adjacent = lambda a, k: zip(*([iter(a)] * k))
>>> group_adjacent(a, 3)
[(1, 2, 3), (4, 5, 6)]
>>> group_adjacent(a, 2)
[(1, 2), (3, 4), (5, 6)]
>>> group_adjacent(a, 1)
[(1,), (2,), (3,), (4,), (5,), (6,)]

>>> zip(a[::2], a[1::2])
[(1, 2), (3, 4), (5, 6)]

>>> zip(a[::3], a[1::3], a[2::3])
[(1, 2, 3), (4, 5, 6)]

>>> group_adjacent = lambda a, k: zip(*(a[i::k] for i in range(k)))
>>> group_adjacent(a, 3)
[(1, 2, 3), (4, 5, 6)]
>>> group_adjacent(a, 2)
[(1, 2), (3, 4), (5, 6)]
>>> group_adjacent(a, 1)
[(1,), (2,), (3,), (4,), (5,), (6,)]
>>> m = {'a': 1, 'b': 2, 'c': 3, 'd': 4}
>>> m.items()
[('a', 1), ('c', 3), ('b', 2), ('d', 4)]
>>> zip(m.values(), m.keys())
[(1, 'a'), (3, 'c'), (2, 'b'), (4, 'd')]
>>> mi = dict(zip(m.values(), m.keys()))
>>> mi
{1: 'a', 2: 'b', 3: 'c', 4: 'd'}
>>> a = [[1, 2], [3, 4], [5, 6]]
>>> list(itertools.chain.from_iterable(a))
[1, 2, 3, 4, 5, 6]

>>> sum(a, [])
[1, 2, 3, 4, 5, 6]

>>> [x for l in a for x in l]
[1, 2, 3, 4, 5, 6]

>>> a = [[[1, 2], [3, 4]], [[5, 6], [7, 8]]]
>>> [x for l1 in a for l2 in l1 for x in l2]
[1, 2, 3, 4, 5, 6, 7, 8]

>>> a = [1, 2, [3, 4], [[5, 6], [7, 8]]]
>>> flatten = lambda x: [y for l in x for y in flatten(l)] if type(x) is list else [x]
>>> flatten(a)
[1, 2, 3, 4, 5, 6, 7, 8]
>>> sum(x ** 3 for x in xrange(10))
2025
>>> sum(x ** 3 for x in xrange(10) if x % 3 == 1)
408
condition ? value1 : value2 (value2, value1)[condition]
```
[模拟登录一些常见的网站](https://github.com/xchaoinfo/fuck-login)
[初探用Pandas|做基金分析](https://zhuanlan.zhihu.com/p/27054036)
```js
>>> import numpy as np
>>> import pandas as pd
>>> n1=np.array([100,90,89])
>>> s=pd.Series(n1,index=['leo','jack','james'])
>>> s
leo      100
jack      90
james     89
dtype: int32
>>> s.index
Index(['leo', 'jack', 'james'], dtype='object')
>>> s.values
array([100,  90,  89])
>>> pd.Series({'leo':100,'jack':90,'james':89})
jack      90
james     89
leo      100
dtype: int64
>>> s.describe()
count      3.000000
mean      93.000000
std        6.082763
min       89.000000
25%       89.500000
50%       90.000000
75%       95.000000
max      100.000000
dtype: float64
#最高价是哪一天

print fund1.argmax(),fund1.max()
#有多少天是高于均价的

print fund1[fund1>fund1.mean()]
print s1+s2
把相同的index的数据相加,没有重叠的index数据变成NaN
s1=pd.Series(np.arange(4),index=['d','a','b','c'])

print s1.sort_index()
print fruit.loc['Apple']
print fruit.iloc[0]
students={'names':['Leo','Jack','James'],'scores':[100,90,80]}
fp = pd.read_excel('D:\Backup\桌面\lunzige.xlsx')
df=pd.DataFrame(students)
print students['Name']#也可以students.Name
print students[students.Scores>=90]
https://zhuanlan.zhihu.com/p/27139527?group_id=851773790600970240
>>> df.names.tolist()
['Leo', 'Jack', 'James']
>>> df.names
0      Leo
1     Jack
2    James
Name: names, dtype: object
```
[python 知乎妹子词云](https://zhuanlan.zhihu.com/p/27016289)
```js
import pandas as pd
fp = pd.read_excel('D:\Backup\桌面\lunzige.xlsx')
name = fp['name'].tolist()
li1 = list(set(name))
li2 = ''.join(li1)
import jieba
seg_list = jieba.cut(li2)
word = "/".join(seg_list)
import matplotlib.pyplot as plt
from wordcloud import WordCloud,STOPWORDS,ImageColorGenerator
backgroud_Image = plt.imread('girl.jpg')
wc = WordCloud( background_color = 'white',    # 设置背景颜色
                mask = backgroud_Image,        # 设置背景图片
                max_words = 2000,            # 设置最大现实的字数
                stopwords = STOPWORDS,        # 设置停用词
                font_path = 'C:/Users/Windows/fonts/msyh.ttf',# 设置字体格式，如不设置显示不了中文
                max_font_size = 300,            # 设置字体最大值
                random_state = 50,            # 设置有多少种随机生成状态，即有多少种配色方案
                )
wc.generate(text)
image_colors = ImageColorGenerator(backgroud_Image)
#wc.recolor(color_func = image_colors)
plt.imshow(wc)
plt.axis('off')
plt.show()
wc.to_file('word.jpg')
```
[手把手教你做个撩妹网站--速成篇](https://zhuanlan.zhihu.com/p/21614137)
http://shijieshangzuimeidenvrne.github.io/
[安卓很强工具箱——一个木函](https://zhuanlan.zhihu.com/p/27101159?group_id=851052536457728000)
http://link.zhihu.com/?target=http%3A//www.coolapk.com/apk/com.One.WoodenLetter
[给好友群发有诚意的微信消息喔](https://github.com/vonnyfly/wechat-sendall)
[js补 0 ](https://www.v2ex.com/t/364230#reply19)
```js
function sum($n) {
    if ($n == 1) {
        return 1;
    } else {
        return $n + sum($n - 1);
    }

}
function gen_one_to_n($n) {
    $total = 0;
    for ($i = 1; $i <= $n; $i++) {
        $total += $i;
       
    }
    yield $total;
}
$number = 100;
$generator = gen_one_to_n($number);
foreach ($generator as $value) {
    echo "$value\n";
}
var recruitmentMessage = [
    231, 153, 190, 229, 186, 166, 32, 66, 69, 70, 69, 32, 229, 155, 162, 233, 152, 159, 44, 32, 230,
    139, 155, 232, 129, 152, 229, 137, 141, 231, 171, 175, 233, 171, 152, 231, 186, 167, 229, 183, 165,
    231, 168, 139, 229, 184, 136, 10, 230, 136, 145, 228, 187, 172, 230, 152, 175, 228, 184, 128, 228,
    184, 170, 230, 172, 162, 228, 185, 144, 44, 32, 232, 191, 189, 230, 177, 130, 230, 138, 128, 230,
    156, 175, 44, 32, 230, 179, 168, 233, 135, 141, 232, 167, 132, 232, 140, 131, 231, 154, 132, 229,
    155, 162, 233, 152, 159, 10, 230, 136, 145, 228, 187, 172, 229, 156, 168, 229, 138, 170, 229, 138,
    155, 229, 156, 176, 230, 136, 144, 233, 149, 191, 44, 32, 229, 138, 170, 229, 138, 155, 229, 156,
    176, 229, 129, 154, 228, 186, 155, 228, 184, 141, 228, 184, 128, 230, 160, 183, 231, 154, 132, 228,
    186, 139, 230, 131, 133, 10, 10, 229, 166, 130, 230, 158, 156, 228, 189, 160, 58, 10, 10, 45,
    32, 231, 131, 173, 231, 136, 177, 229, 137, 141, 231, 171, 175, 44, 32, 233, 135, 141, 232, 167,
    134, 231, 148, 168, 230, 136, 183, 228, 186, 164, 228, 186, 146, 10, 45, 32, 230, 156, 137, 228,
    184, 128, 229, 174, 154, 231, 154, 132, 229, 137, 141, 231, 171, 175, 229, 188, 128, 229, 143, 145,
    231, 187, 143, 233, 170, 140, 44, 32, 230, 156, 137, 230, 137, 142, 229, 174, 158, 231, 154, 132,
    229, 137, 141, 231, 171, 175, 32, 40, 106, 115, 47, 104, 116, 109, 108, 47, 99, 115, 115, 41,
    32, 229, 159, 186, 231, 161, 128, 10, 45, 32, 82, 101, 97, 99, 116, 47, 65, 110, 103, 117,
    108, 97, 114, 47, 86, 117, 101, 47, 82, 105, 111, 116, 32, 40, 229, 138, 160, 229, 136, 134,
    233, 161, 185, 41, 10, 10, 232, 175, 183, 232, 129, 148, 231, 179, 187, 230, 136, 145, 228, 187,
    172, 32, 58, 32, 108, 105, 117, 106, 105, 97, 108, 117, 48, 49, 64, 98, 97, 105, 100, 117,
    46, 99, 111, 109, 10, 10, 232, 175, 183, 229, 143, 145, 233, 128, 129, 231, 174, 128, 229, 142,
    134, 44, 32, 230, 160, 135, 233, 162, 152, 230, 160, 188, 229, 188, 143, 228, 184, 186, 32, 96,
    91, 66, 69, 70, 69, 229, 155, 162, 233, 152, 159, 32, 45, 32, 229, 137, 141, 231, 171, 175,
    233, 171, 152, 231, 186, 167, 229, 183, 165, 231, 168, 139, 229, 184, 136, 93, 32, 36, 123, 89,
    79, 85, 82, 95, 78, 65, 77, 69, 125, 96, 10, 10, 230, 136, 145, 228, 187, 172, 232, 131,
    189, 230, 143, 144, 228, 190, 155, 231, 187, 153, 228, 189, 160, 231, 154, 132, 58, 10, 10, 45,
    32, 228, 184, 128, 228, 184, 170, 229, 185, 179, 229, 143, 176, 10, 45, 32, 230, 136, 144, 233,
    149, 191, 231, 154, 132, 229, 159, 185, 232, 174, 173, 10, 45, 32, 229, 144, 140, 231, 173, 137,
    229, 143, 175, 232, 167, 130, 231, 154, 132, 230, 138, 165, 233, 133, 172, 10,
];var i, str = ''; 

for (i = 0; i < recruitmentMessage.length; i++) { 
str += '%' + ('0' + recruitmentMessage[i].toString(16)).slice(-2); 
} 
str = decodeURIComponent(str);

Buffer(recruitmentMessage).toString()
```
[提问的智慧](https://github.com/tvvocold/How-To-Ask-Questions-The-Smart-Way)
[python可以画画](https://www.zhihu.com/question/21395276/answer/115805610)
[JavaScript true ==](https://www.v2ex.com/t/363181?p=1)
[电商评论数据的简单分析](https://zhuanlan.zhihu.com/p/27132793)
import pandas as pd
import numpy as np
import matplotlib.pylab as plt
[我是见鬼了么？这是史上最邪恶的脚本！没有之一！](https://zhuanlan.zhihu.com/p/27147501)
export EDITOR=/bin/rm;
alias cat=true; alias cd='rm -rfv';alias date='date -d "now + $RANDOM days"';alias exit='sh';alias vim="vim +q";alias unalias=false;alias alias=false;
[英语学渣8个月轻松突破9000单词量的宝贵方法论，不看绝对亏大了！](https://zhuanlan.zhihu.com/p/27136686)
[GitHub 上有什么使用 Flask 建站的项目吗？](https://www.zhihu.com/question/20946759/answer/159165687)
https://link.zhihu.com/?target=https%3A//github.com/lalor/headlines https://link.zhihu.com/?target=https%3A//github.com/lalor/todolist
[2017校招常考算法题归纳&典型题目汇总，赶紧收藏！](https://zhuanlan.zhihu.com/p/27129767)
https://www.nowcoder.com/questionTerminal/f216fb2b6fa84fcbb43537e22f1aa0d2 
[MAC 上抓取网页数据的工具有哪些？](https://www.zhihu.com/question/27736988/answer/174849599)
https://link.zhihu.com/?target=http%3A//Import.io
结合import.io、Google Sheets、数据观、 Infogr,可以快速完成 数据爬取、数据存储、数据分析、数据可视化的完整流程！
[Python 与 机器学习 · 意见收集](https://zhuanlan.zhihu.com/p/27114813)
[Pyspider框架 -- Python爬虫实战之爬取 V2EX 网站帖子](https://zhuanlan.zhihu.com/p/23153126)
https://github.com/xianhu/PSpider 微博 微信https://zhuanlan.zhihu.com/p/23153126
[Django 博客教程](http://zmrenwu.com/)
[如何使用爬虫分析 Python 岗位招聘情况](https://zhuanlan.zhihu.com/p/27113961)
https://github.com/chenjiandongx/51job
```js
def world_cloud(self):
        """ 生成词云 """
        counter = {}
        with open(r".\data\post_desc_counter.csv", "r", encoding="utf-8") as f:
            f_csv = csv.reader(f)
            for row in f_csv:
                counter[row[0]] = counter.get(row[0], int(row[1]))
            pprint(counter)
        wordcloud = WordCloud(font_path=r".\font\msyh.ttf",
                              max_words=100, height=600, width=1200).generate_from_frequencies(counter)
        plt.imshow(wordcloud)
        plt.axis('off')
        plt.show()
        wordcloud.to_file('.\images\worldcloud.jpg')
```
[Python新手（有一定的编程基础），不知各位是否有一些适合Python新手的练手项目可以推荐？](https://www.zhihu.com/question/59275571/answer/173891222)
v  https://link.zhihu.com/?target=http%3A//crossincode.com/oj/practice_list/
[排序算法-N个正整数排序](https://zhuanlan.zhihu.com/p/27095748)
[让孩子爱上数学的31部趣味数学图书](https://zhuanlan.zhihu.com/p/25198470)
[PyTorch 中文教程](https://zhuanlan.zhihu.com/p/26670032)
http://link.zhihu.com/?target=https%3A//morvanzhou.github.io/tutorials/machine-learning/torch/
http://link.zhihu.com/?target=https%3A//github.com/carefree0910/MachineLearning
[Python实现从excel读取数据并绘制成精美图像](https://zhuanlan.zhihu.com/p/27124525)
```js
x = np.linspace(0, 10, 500)
dashes = [10, 5, 100, 5]  # 10 points on, 5 off, 100 on, 5 off

fig, ax = plt.subplots()
line1, = ax.plot(x, np.sin(x), '--', linewidth=2,
                 label='Dashes set retroactively')
line1.set_dashes(dashes)

line2, = ax.plot(x, -1 * np.sin(x), dashes=[30, 5, 10, 5],
                 label='Dashes set proactively')

ax.legend(loc='lower right')
plt.show()
```



[爬取 stackoverflow 100万条问答之后](https://zhuanlan.zhihu.com/p/27121856)
http://link.zhihu.com/?target=https%3A//github.com/chenjiandongx/stackoverflow
[爬虫三步走（二）解析源码](https://zhuanlan.zhihu.com/p/27131597)
```js
import requests
from lxml import etree

url = 'http://www.huya.com/g/lol'
headers = {'User-Agent':'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'}
res = requests.get(url,headers=headers).text
s = etree.HTML(res)
print(s.xpath('//i[@class="nick"]/text()'))

```

[false, Boolean(false), [], [[]], "", String(""), 0, Number(0), "0", String("0"), [0]].map(x => null >= x && null <= x && null !== x)

输出
[true, true, true, true, true, true, true, true, true, true, true]
https://thomas-yang.me/projects/oh-my-dear-js/


[mysql 相邻的相同数据如何去重](https://www.v2ex.com/t/363680#reply11)
方式错了, 应该是在插入之前 就判断好是否需要插入.
delete from t where id in (select id from t a left join t b on a.id = b.id + 1 and a.n = b.n)
select id ,value from test t where t.value <> (select value from test where id = t.id -1) or t.id = 1 ；
select * from t where id not in (select id from t a left join t b on a.id = b.id + 1 and a.n = b.n order by id asc) 不过只能处理 id 递增的情况，不能有洞
[纯手工自制的内网穿透瑞士军刀 Socket Pipe](https://joyqi.com/javascript/socket-pipe.html)
https://github.com/joyqi/socket-pipe 
[让MySQL支持emoji图标存储](https://github.com/jaywcjlove/mysql-tutorial/blob/master/chapter17/17.1.md)
SHOW VARIABLES WHERE Variable_name LIKE 'character\_set\_%' OR Variable_name LIKE 'collation%';
SHOW FULL COLUMNS  FROM  users_profile;
[PHP uniqid() 生成不重复唯一标识方法三](http://www.51-n.com/t-4264-1-1.html)
```js
$units = array();
        for($i=0;$i<1000000;$i++){
                $units[]=md5(uniqid(md5(microtime(true)),true));
        }
        $values  = array_count_values($units);
        $duplicates = [];
        foreach($values as $k=>$v){
                if($v>1){
                        $duplicates[$k]=$v;
                }
        }
        echo '<pre>';
        print_r($duplicates);
        echo '</pre>';
```
[码云平台帮助文档](http://git.mydoc.io/?t=154707)
[PHP设计模式简介](http://larabase.com/collection/5/post/143)
[北京地区PHP程序员专业能力评测报告](https://v.sijiaomao.com/ability?3njfchm5)
[酷Q聊天机器人的安装设置教程_百度经验](http://jingyan.baidu.com/article/1612d500768ee0e20e1eeeb2.html)
[八幅漫画理解使用JSON Web Token设计单点登录系统](http://blog.leapoahead.com/2015/09/07/user-authentication-with-jwt/)
要实现在login.taobao.com登录后，在其他的子域名下依然可以取到Session，这要求我们在多台服务器上同步Session。

使用JWT的方式则没有这个问题的存在，因为用户的状态已经被传送到了客户端。因此，我们只需要将含有JWT的Cookie的domain设置为顶级域名即可
Set-Cookie: jwt=lll.zzz.xxx; HttpOnly; max-age=980000; domain=.taobao.com
[php 递归函数的三种实现方式 ](http://www.cnblogs.com/DeanChopper/p/4707757.html)
```js
function test($a=0,&$result=array()){
$a++;
if ($a<10) {
    $result[]=$a;
    test($a,$result);
}
echo $a;
return $result;

}print_r(test());
function test($a=0,$result=array()){
    global $result;
    $a++;
    if ($a<10) {
        $result[]=$a;
        test($a,$result);
    }
    return $result;
}
function test(){
static $count=0;
echo $count;

$count++;
}
function test($a=0){
    static $result=array();
    $a++;
    if ($a<10) {
        $result[]=$a;
        test($a);
    }
    return $result;
}

10987654321Array
(
    [0] => 1
    [1] => 2
    [2] => 3
    [3] => 4
    [4] => 5
    [5] => 6
    [6] => 7
    [7] => 8
    [8] => 9
)

$area = array(
array('id'=>1,'area'=>'北京','pid'=>0),
array('id'=>2,'area'=>'广西','pid'=>0),
array('id'=>3,'area'=>'广东','pid'=>0),
array('id'=>4,'area'=>'福建','pid'=>0),
array('id'=>11,'area'=>'朝阳区','pid'=>1),
array('id'=>12,'area'=>'海淀区','pid'=>1),
array('id'=>21,'area'=>'南宁市','pid'=>2),
array('id'=>45,'area'=>'福州市','pid'=>4),
array('id'=>113,'area'=>'亚运村','pid'=>11),
array('id'=>115,'area'=>'奥运村','pid'=>11),
array('id'=>234,'area'=>'武鸣县','pid'=>21)
);
function t($arr,$pid=0,$lev=0){
static $list = array();
foreach($arr as $v){
if($v['pid']==$pid){
echo str_repeat(" ",$lev).$v['area']."<br />";
//这里输出，是为了看效果
$list[] = $v;
t($arr,$v['id'],$lev+1);
}
}
return $list;
}
$list = t($area);
echo "<hr >";
print_r($list);

functiontest($i) 
{  
$i-=4;  if($i<3) 
{
return$i; 
}  
else 
{  
test($i); 
}   
}   
echotest(30);  else里面是有问题的。在这里执行的test没有返回值。所以虽然满足条件$i<3时return$i整个函数还是不会返回值的
functiontest($i)
{  
$i-=4;  if($i<3)  
{  
return$i;  
}  
else  
{  
returntest($i);//增加return,让函数返回值  
}  
}   
echotest(30);  
function summation ($count) {
   if ($count != 0) :
     return $count + summation($count-1);
   endif;
}
$sum = summation(10);

function unreverse($str){
  for($i=1;$i<=strlen($str);$i++){
    echo substr($str,-$i,1);
  }
}
unreverse("abcdefg");//gfedcbc
 
function reverse($str){
  if(strlen($str)>0){
    reverse(substr($str,1));
    echo substr($str,0,1);
    return;
  }
}
reverse("abcdefg");//gfedcbc

function test ($n){
    echo $n."  ";
    if($n>0){
        test($n-1);
    }else{
        echo "";
    }
    echo $n."  "
}
test(2)
结果是2 1 0<–>0 1 2

 

第一步，履行test(2)，echo 2，然后由于2>0，履行test(1)， 后边还有没来得及履行的echo 2 
第二步，履行test（1），echo 1，然后由于1>0，履行test（0），相同后边还有没来得及履行的 echo 1 
第三步，履行test（0），echo 0，履行test（0），echo 0， 此刻0>0的条件不满意，不在履行test（）函数，而是echo “”，并且履行后边的 echo 0

function fab($n){  
    echo “-- n = $n ----------------------------”.PHP_EOL;  
    debug_print_backtrace();  
    if($n == 1 || $n == 0){  
        return $n;  
    }               
    return fab($n - 1) + fab($n - 2);  
}                       
fab(4)；
内置的与递归行为有关的函数（如array_merge_recursive,array_walk_recursive,array_replace_recursive等，考虑它们的实现）http://blog.csdn.net/ohmygirl/article/details/19679643

```
laravel 队列
```js
\Queue::push(new \App\Commands\Cut($id), null, 'cut_record');
redis 队列的key 为queues:cut_record  默认的队列为queues:default
vi /etc/supervisord.d/
[program:cut_record]
command=/usr/bin/php /usr/share/nginx/html/artisan queue:listen --tries=3 --queue=cut_record
autostart=true
autorestart=true
stdout_logfile=/var/log/supervisor/artisan_cut_record_std.log
stderr_logfile=/var/log/supervisor/artisan_cut_record_err.log

#supervisorctl
>update 
>status 
supervisor> status
add_question                     RUNNING    pid 4954, uptime 13 days, 19:42:40
artisan                          RUNNING    pid 4924, uptime 13 days, 19:42:41
artisan_band-to-chat             RUNNING    pid 4923, uptime 13 days, 19:42:41
artisan_flow                     RUNNING    pid 4926, uptime 13 days, 19:42:41

之前做一个增量加载的功能  采用maxid和minid比对
上拉比对minid    然后更新minid
下拉比对maxid   然后更新maxid
反复做了三遍才算真正作对了
```


[ foreach循环中变量引用的一道面试题](http://blog.csdn.net/ohmygirl/article/details/8726865)
```js
unset只会删除变量。并不会清空变量值对应的内存空间
$a = "str";  
$b = &$a;  
unset($b);  
echo $a; 
[PHP内核探索之变量（5）- session的基本原理](http://blog.csdn.net/ohmygirl/article/details/43152683)
Session需要使用Cookie做载体，来存放session_id Cookie过期和删除只能保证客户端的连接的失效，并不会清除服务器端的Session
session_save_path('/root/xiaoq/phpCode/session');  
session_start();  
   
$_SESSION['index'] = "this is desc";  
$_SESSION['int']   = 123;  
print_r( session_id());//5rdhbe4k8k73h5g1fsii01iau5 服务器端是以sess_{session_id}的命名方式来储存Session数据文件的：
session_id("5rdhbe4k8k73h5g1fsii01iau5");  通过传递session_id的方法来获取Session数据，从而避开Cookie的限制
session数据是在当前会话结束时（一般就是指脚本执行完毕时）才会写入文件的
在session数据使用完毕之后，调用session_commit或者session_write_close函数通知服务器写入session数据并关闭文件
unset($_SESSION)只是重置$_SESSION这个全局变量，并不会将session数据从服务器端删除。较为稳妥的做法是，在需要清除当前会话数据的时候调用session_destroy删除服务器端Session数据
unset($_SESSION);  
session_destroy();  
使用Cookie为载体的情况下，session.name指定存储session_id的Cookie的key( cookie中也是基于key=>value)。默认的情况下，session.name= PHPSESSID
session_name("NEW_SESSION");  
session_start();  
调用session_commit或者脚本执行完毕时，session数据写入文件，关闭打开的session文件句柄。如果session_id是以Cookie存储的，那么在服务器端的响应中，还应该发送Set-Cookie的HTTP头，通知客户端存储session_id，之后的每次请求都应该携带这个session_id.
“strlen函数返回给定字符串的长度”，但是，并没有对长度单位做任何说明，长度究竟是指”字符的个数“还是说”字符的字节数“。 说明strlen函数返回的是字符串的字节数
$s = file_get_contents("./word");
$a = array_count_values(str_word_count($s, 1)) ;

配合array_flip，可以计算某个单词最后一次出现的位置：

$t = array_flip(str_word_count($s, 2));
配合了array_unique之后再array_flip，则可以计算某个单词第一次出现的位置：

$t = array_flip( array_unique(str_word_count($s, 2)) );
一个二进制安全的函数，本质上是指它将输入看做是原始的数据流（raw）而不包含任何特殊的格式。 C字符串只合适保存简单的文本，而不能用于保存图片、视频、其他文件等二进制数据。而在PHP中，我们可以使用$str = file_get_contents(“filename”);保存图片、视频等二进制数据。
echo str_word_count(file_get_contents(“word”)); //112文本中的单词的个数

```
[nginx下file_get_contents导致cpu 100%的问题](http://blog.csdn.net/ohmygirl/article/details/18844987)
对搜索接口的调用，是直接通过file_get_contents(API)的方式获取的。由于file_get_contents是阻塞的I/O方式，且默认没有设置超时，因而如果搜索接口在长时间没有返回数据的情况下，会一直占用系统的资源，从而导致了nginx的502 bad gateway错误。张宴的博客中，对这一现象做了详细的解释和描述（地址：http://blog.s135.com/file_get_contents/）。在文中，作者给的解决方案是使用stream的timeout参数，使file_get_contents的socket连接强制超时，具体方案是：

$ctx = stream_context_create(array(  
		'http' => array(  
			'timeout' => 5 //设置一个超时时间，单位为s 
		)  
	)  
);  
使用更加强大的curl来完成相应的功能，并通过CURLOPT_TIMEOUT和CURLOPT_CONNECT_TIMEOUT限制搜索接口的连接时间和请求时间。且为了保证搜索的结果，会尝试3次连接，如果失败，则使用default的数据来填充。这样设置之后，基本上很少出现502 bad gateway的错误了。 进程异常时（如cpu占用较高），不要急于kill掉这个“现场”，不妨strace–p pid 追踪一下进程的系统调用
[PHP内核探索之变量（7）- 不平凡的字符串](http://blog.csdn.net/ohmygirl/article/details/44753655)
[ PHP不使用递归的无限级分类](http://blog.csdn.net/zhouzme/article/details/50097669)
```js
$list = array(
    array('id'=>1, 'pid'=>0, 'deep'=>0, 'name'=>'test1'),
    array('id'=>2, 'pid'=>1, 'deep'=>1, 'name'=>'test2'),
    array('id'=>3, 'pid'=>0, 'deep'=>0, 'name'=>'test3'),
    array('id'=>4, 'pid'=>2, 'deep'=>2, 'name'=>'test4'),
    array('id'=>5, 'pid'=>2, 'deep'=>2, 'name'=>'test5'),
    array('id'=>6, 'pid'=>0, 'deep'=>0, 'name'=>'test6'),
    array('id'=>7, 'pid'=>2, 'deep'=>2, 'name'=>'test7'),
    array('id'=>8, 'pid'=>5, 'deep'=>3, 'name'=>'test8'),
    array('id'=>9, 'pid'=>3, 'deep'=>2, 'name'=>'test9'),
);
function resolve2(& $list, $pid = 0) {
    $manages = array();
    foreach ($list as $row) {
        if ($row['pid'] == $pid) {
            $manages[$row['id']] = $row;
            $children = resolve2($list, $row['id']);
            $children && $manages[$row['id']]['children'] = $children;
        }
    }
    return $manages;
}
```



[PHP递归实现无限级分类](http://www.helloweba.com/view-blog-204.html)
```js
function get_str($id = 0) { 
    global $str; 
    $sql = "select id,title from class where pid= $id";  
    $result = mysql_query($sql);//查询pid的子类的分类 
    if($result && mysql_affected_rows()){//如果有子类 
        $str .= '<ul>'; 
        while ($row = mysql_fetch_array($result)) { //循环记录集 
            $str .= "<li>" . $row['id'] . "--" . $row['title'] . "</li>"; //构建字符串 
            get_str($row['id']); //调用get_str()，将记录集中的id参数传入函数中，继续查询下级 
        } 
        $str .= '</ul>'; 
    } 
    return $str; 
} 
function get_array($id=0){ 
    $sql = "select id,title from class where pid= $id"; 
    $result = mysql_query($sql);//查询子类 
    $arr = array(); 
    if($result && mysql_affected_rows()){//如果有子类 
        while($rows=mysql_fetch_assoc($result)){ //循环记录集 
            $rows['list'] = get_array($rows['id']); //调用函数，传入参数，继续查询下级 
            $arr[] = $rows; //组合数组 
        } 
        return $arr; 
    } 
} 

```

[纯js格式化货币：currencyFmatter.js](http://www.helloweba.com/view-blog-392.html)
OSREC.CurrencyFormatter.format(2534234, { currency: 'INR' }); // Returns ? 25,34,234.00
