Reference article: https://architecturenotes.co/p/redis

== Single Redis Instance

Note: Redis is not supported on Windows

Using my local Linux server, went to Portainer and created a first instance of Redis using Docker (refers to https://redis.io/docs/latest/operate/oss_and_stack/install/install-stack/docker/).

Deployed redis/redis-stack:latest

Build a small VM Linux (ubuntu 22.04)

After having converted the .pem file as .ppk using PuTTYgen, connected to it using hostname azureuser@4.178.136.31

```
$ sudo apt update
$ sudo apt upgrade
```
