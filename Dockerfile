FROM docker-registry.mycoachfootball.com:5000/mycoach_labs/nginx:2.0.0

ADD deploy/vhost.conf /etc/nginx/conf.d/default.conf

RUN apt-get update && apt-get install -y memcached php5-memcached php5-memcache && /etc/init.d/memcached stop && /etc/init.d/memcached start

COPY . /workspace