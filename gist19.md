###[简单又实用的 shell 命令](https://www.v2ex.com/t/338470)
```js
find . -type d -name ".svn"|xargs rm -rf;
find . -type f -name "*.a"|xargs svn add;
find . -type d -name ".svn" -delete
grep "search something" -r * --include=*.php
统计某文件个数 ll l grep xxx l wc -l
https://github.com/nvbn/thefuck
while read -d " "; do sl; done 

孩子不到 1 岁的时教会按空格看火车，按了一年多了
命令行的艺术https://github.com/jlevy/the-art-of-command-line/blob/master/README-zh.md
http://www.commandlinefu.com/commands/browse/sort-by-votes

https://billie66.github.io/TLCL/book/index.html

怎么没有人说 sl 这个命令, 具我的研究它可以用来测试网络是否稳定 
如果稳定的话会有一列火车帽着白烟从屏幕右边向左边疾驰而过 
如果不稳定火车就会一卡一卡的走不动
windows查看WiFi密码
cmd 运行
for /f “skip=9 tokens=1,2 delims=:” %i in (‘netsh wlan show profiles’) do @echo %j | findstr -i -v echo | netsh wlan show profiles %j key=clear
查看Linux版本
cat /etc/redhat-release#或者
cat /etc/issue
linux查看端口占用
netstat -anl | grep “80” ；#1080 8080也是会被筛选出来
lsof -i:80
linux查看程序占用的端口
ps -ef | grep nginx
linux安装docker
curl -s https://get.docker.com/ | sudo sh
linux查看目录中有多少文件
ls -lR|grep “^-“|wc -l
Python启动http服务器（传文件）
python -m SimpleHTTPServer
linux显示命令执行的具体时间精确到秒
export HISTTIMEFORMAT=’%F %T ‘
history | more
linux DD 显示进度
先放入后台，然后每5秒显示一下进度
sudo dd if= xxx.img of=/dev/mmcblk1 bs=10MB &
while (ps auxww |grep “ dd “ |grep -v grep |awk ‘{print $2}’ |while read pid; do kill -USR1 $pid; done) ; do sleep 5; done
命令行测速 （python+speedtest）
sudo apt-get install python-pip
sudo pip install speedtest-cli
另一种
wget https://raw.githubusercontent.com/sivel/speedtest-cli/master/speedtest.py
##　mplayer 后台播放
mplayer * < /dev/null > /dev/null 2>1&
block一些恶意ip
wget https://teddysun.com/wp-content/uploads/2013/05/block.sh
chmod +x block.sh
./block.sh
最常用的命令排行https://vsxen.github.io/2016/12/02/short-useful-command/
history | awk ‘{CMD[$2]++;count++;} END { for (a in CMD )print CMD[ a ]” “ CMD[ a ]/count*100 “% “ a }’ | grep -v “./“ | column -c3 -s “ “ -t |sort -nr | nl | head -n10
命令行播放器 mpv.io
```
