Create table usuarios (
ID Int UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
login Varchar(30),
senha Varchar(40),
nome Varchar(40),
sobrenome Varchar(40),
email Varchar(40),

Primary Key (ID)) ENGINE = MyISAM;