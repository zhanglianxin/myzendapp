-- scripts/schema.mysql.sql
--
-- You will need load your database schema with this SQL.

DROP TABLE IF EXISTS book;

CREATE TABLE book (
    id int(11) NOT NULL AUTO_INCREMENT,
    author VARCHAR(32) NOT NULL,
    title VARCHAR(32) NOT NULL,
    imagepath VARCHAR(64) NOT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT "";

CREATE TABLE employee (
    id int(11) NOT NULL AUTO_INCREMENT,
    emp_name VARCHAR(32) NOT NULL,
    emp_job VARCHAR(32) NOT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT "";
