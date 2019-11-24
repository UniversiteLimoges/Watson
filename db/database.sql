create database if not exists docker character set utf8 collate utf8_unicode_ci;
use docker;

grant all privileges on docker.* to 'docker'@'localhost' identified by 'docker';
