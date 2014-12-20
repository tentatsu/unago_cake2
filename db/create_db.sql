create database unago_default default character set utf8;
create database test_unago_default default character set utf8;

grant all privileges on unago_default.* to unago_default@localhost identified by 'unago_default!?';
grant all privileges on test_unago_default.* to unago_default@localhost identified by 'unago_default!?';