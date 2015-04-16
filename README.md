# sail2doc
sail2doc

说明
====
一直很想做一个跟新浪微博开放平台那种比较人性化的文档系统，找了一些开源现成的系统，总是有些不合自己胃口。思来想去感觉还是定制一套。开源出来，分享给大家。

配置
====

  #nginx配置文件
  server {
      listen       8081;  #这个端口改成默认80
      server_name  dev.sail.com;  #配置访问url
      location / {
          root   /usr/htdocs/sail;   #框架目录
          index  index.html index.htm index.php;

          #将所有请求rewrite到index.php
          if (!-e $request_filename){
              rewrite ^/(.*)$ /index.php?_ac=$1 last;
          }
      }
      error_log  /var/log/nginx/sail.cn.log;

      error_page  404              /404.html;
      location ~ \.php$ {
          root   /usr/htdocs/sail;
          fastcgi_pass    127.0.0.1:9000;
          fastcgi_index index.php;
          fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
          include        fastcgi_params;
      }
  }
