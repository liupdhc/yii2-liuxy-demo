yii2-liuxy-demo
==========

DEMO:
-----

Web服务器配置:
---------------------------------

  **For Nginx:**
  upstream phpbackend{
          server unix:/dev/shm/php-cgi.sock weight=1;
  }
  server {
      listen       80;
      server_name  xxx.com;
  
      access_log  logs/xxx.com_access.log  access;
      error_log   logs/xxx.com_error.log;
      set $project_root xxx;
      root   $project_root/frontend/web;
      index  index.php;
      location / {
          try_files $uri $uri/ /index.php?$args;
      }
  
      location /backend {
          index /web/index.php;
          alias $project_root/backend/web;
          set $relative_uri backend;
          try_files $uri $uri/ /web/index.php?$args;
  
          location ~ ^/backend/.*\.php$ {
              rewrite ^/backend/(.*)$ /web/$1;
              fastcgi_pass  phpbackend;
              fastcgi_index index.php;
              include fastcgi.conf;
          }
      }
      location ~ ^/web/.*\.php$ {
          internal;
          root $project_root/$relative_uri;
          fastcgi_pass phpbackend;
          include fastcgi.conf;
      }
  
      location ~* \.php$ {
          try_files $uri =404;
          fastcgi_pass  phpbackend;
          fastcgi_index index.php;
          include fastcgi.conf;
      }
  
      location ~* \.(htaccess|htpasswd|svn|git|log) {
          deny all;
      }
  }
