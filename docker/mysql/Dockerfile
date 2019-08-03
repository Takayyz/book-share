FROM mysql:5.7.20

COPY mysql.cnf /etc/mysql/mysql.cnf
RUN set -eux && \
  chmod 644 /etc/mysql/mysql.cnf && \
  rm -rf /var/lib/mysql-files && \
  mkdir /var/lib/mysql-files && \
  cp /etc/localtime /etc/localtime.org && \
  ln -sf /usr/share/zoneinfo/Asia/Tokyo /etc/localtime && \
  touch /var/log/mysql/mysqld.log
