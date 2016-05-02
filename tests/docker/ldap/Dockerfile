FROM phusion/baseimage:0.9.8
MAINTAINER Victor Geyer <victor@geyer.io>

USER root
WORKDIR /root
EXPOSE 389
ENTRYPOINT ["./entrypoint.sh"]

RUN apt-get -y update
RUN LC_ALL=C DEBIAN_FRONTEND=noninteractive apt-get install -y slapd ldap-utils
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

ADD slapd.conf /etc/ldap/slapd.conf
RUN chown openldap:openldap /etc/ldap/slapd.conf

ADD entrypoint.sh ./entrypoint.sh
RUN chmod +x ./entrypoint.sh
