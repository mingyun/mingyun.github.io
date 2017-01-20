###[python将文本转化成gif图片阅读 ](http://blog.csdn.net/iloster/article/details/25463563)
```js
 import pygame  
from pygame.locals import *  
from sys import exit  
import time  
import codecs  
#获得文字  https://github.com/iloster/PythonScripts
def get_text():  
    with open('test.txt','r') as fp:  
        #print fp.read()  
        return fp.read()  
if __name__=='__main__':     
    text=get_text()  
    print type(text)  
    text = text.decode('gbk')  
    length=len(text) #字符串长度  
    #print text  
    print length  
    sum=0  
    #初始化pygame  
    pygame.init()  
    #创建一个窗口  
    screen=pygame.display.set_mode((500,500),0,32)  
    #设置标题  
    pygame.display.set_caption('loster v0.1')  
    #设置文字属性  
    my_font=pygame.font.SysFont('SimHei',64)  
    while True:  
        for event in pygame.event.get():  
            if event.type == QUIT:  
                pygame.quit()  
                exit()  
        for i in range(length):  
            print text[i]  
              
            text_surface=my_font.render(text[i],True,(0,0,0),(255,255,255))  
            #绘制文字  
            screen.blit(text_surface,(200,200))  
            #暂停1000ms  
            pygame.time.wait(1000)  
            #刷新  
            pygame.display.update() 
```
