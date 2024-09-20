Articles used as reference for this study:
* https://architecturenotes.co/p/redis

Note: Redis is not supported on Windows

== Single Redis Instance

=== Linux Install

Refers to https://redis.io/docs/latest/operate/oss_and_stack/install/install-stack/linux/

Built a small VM Linux (ubuntu 22.04) on Azure

After having converted the .pem file as .ppk using PuTTYgen, connected to it using hostname azureuser@4.178.136.31

```
sudo apt update
sudo apt upgrade

sudo apt-get install lsb-release curl gpg
curl -fsSL https://packages.redis.io/gpg | sudo gpg --dearmor -o /usr/share/keyrings/redis-archive-keyring.gpg
sudo chmod 644 /usr/share/keyrings/redis-archive-keyring.gpg
echo "deb [signed-by=/usr/share/keyrings/redis-archive-keyring.gpg] https://packages.redis.io/deb $(lsb_release -cs) main" | sudo tee /etc/apt/sources.list.d/redis.list
sudo apt-get update
sudo apt-get install redis-stack-server

sudo systemctl enable redis-stack-server
sudo systemctl start redis-stack-server
```

```
azureuser@Redis1:~$ sudo lsof -nP -iTCP -sTCP:LISTEN
COMMAND    PID            USER   FD   TYPE DEVICE SIZE/OFF NODE NAME
systemd-r  471 systemd-resolve   14u  IPv4   3569      0t0  TCP 127.0.0.53:53 (LISTEN)
sshd       843            root    3u  IPv4   5510      0t0  TCP *:22 (LISTEN)
sshd       843            root    4u  IPv6   5512      0t0  TCP *:22 (LISTEN)
redis-ser 8913          nobody   16u  IPv4  50428      0t0  TCP *:6379 (LISTEN)
redis-ser 8913          nobody   17u  IPv6  50429      0t0  TCP *:6379 (LISTEN)
```

Allowed inbound port 6379 in Azure

Installed Redis Insight tool

Connected it to the Redis database created recently, and then choose to load sample data to practice

=== Docker

Using my local Linux server, went to Portainer and created a first instance of Redis using Docker (refers to https://redis.io/docs/latest/operate/oss_and_stack/install/install-stack/docker/).

Deployed redis/redis-stack:latest, make sure to expose ports 6379 and 8001

Connect it to the Redis Insight, and load sample data


== HA

=== Structure

Build 2 Redis servers in Azure France zone

Redis1
4.178.136.31
PuTTY hostname azureuser@4.178.136.31

RedisSecondary1
4.233.219.196
PuTTY hostname azureuser@4.233.219.196
