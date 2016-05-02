#!/bin/bash

/usr/sbin/slapd -f /etc/ldap/slapd.conf -h "ldap:///" -u openldap -g openldap  -d 0