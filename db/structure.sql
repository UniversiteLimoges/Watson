drop table if exists tl_liens;
drop table if exists tl_users;
drop table if exists tl_tags;
drop table if exists tl_tags_liens;

create table tl_liens(
    lien_id integer not null primary key auto_increment,
    lien_url varchar(255) not null,
    lien_titre varchar(255) not null,
    lien_desc TEXT not null,
    user_id integer not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table tl_users (
    usr_id integer not null primary key auto_increment,
    usr_name varchar(50) not null,
    usr_password varchar(88) not null,
    usr_salt varchar(23) not null,
    usr_role varchar(50) not null DEFAULT 'ROLE_ADMIN'
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table tl_tags (
    tag_id integer not null primary key auto_increment,
    tag_name varchar(50) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table tl_tags_liens (
    tag_id integer not null,
    lien_id integer not null
) engine=innodb character set utf8 collate utf8_unicode_ci;
