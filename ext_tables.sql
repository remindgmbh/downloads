CREATE TABLE tx_downloads_domain_model_download (
    name varchar(255),
    thumbnail int(11) unsigned DEFAULT '0' NOT NULL,
    file int(11) unsigned DEFAULT '0' NOT NULL,
    groups int(11) unsigned,
 );

 CREATE TABLE tx_downloads_domain_model_group (
    name varchar(255),
    description text,
    downloads int(11) unsigned,
    image int(11) unsigned DEFAULT '0' NOT NULL,
);
