--- 
customlog: 
  - 
    format: combined
    target: /etc/apache2/logs/domlogs/cimun.cl
  - 
    format: "\"%{%s}t %I .\\n%{%s}t %O .\""
    target: /etc/apache2/logs/domlogs/cimun.cl-bytes_log
documentroot: /home/cimun/public_html
group: cimun
hascgi: 1
homedir: /home/cimun
ip: 138.255.101.220
owner: brohostc
phpopenbasedirprotect: 1
phpversion: ea-php82
port: 81
scriptalias: 
  - 
    path: /home/cimun/public_html/cgi-bin
    url: /cgi-bin/
serveradmin: webmaster@cimun.cl
serveralias: www.cimun.cl mail.cimun.cl
servername: cimun.cl
usecanonicalname: 'Off'
user: cimun
