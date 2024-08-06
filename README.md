## 1 docker

设置用户名密码

- username：用户名（默认值：admin）
- password：密码（默认值：admin）

后台管理地址：`http://192.168.3.34:8080/admin`

```bash
docker run -d --restart always \
	--name tools \
	-p 8080:80 \
	-e username=admin \
	-e password=admin \
	cleverest/toolbox
```



## 2 docker compose

创建 `docker-compose.yml` 文件。如果不指定 `username` `password` ，默认用户名密码均为：`admin` 

设置用户名密码

- username：用户名（默认值：admin）
- password：密码（默认值：admin）

后台管理地址：`http://192.168.3.34:8080/admin`


```yaml
version: '3'

services:
  tools:
    image: cleverest/toolbox
    container_name: tools
    restart: unless-stopped
    ports:
      - "8080:80"
    environment:
      - username=admin
      - password=admin
```

```bash
# 启动服务
docker-compose up -d
```

