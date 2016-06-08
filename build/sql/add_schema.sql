CREATE DATABASE beton24;
CREATE SCHEMA beton24_1;

CREATE USER beton24 WITH PASSWORD '159753';
GRANT ALL PRIVILEGES ON DATABASE beton24 TO beton24;
GRANT ALL ON SCHEMA beton24_1 TO beton24;

CREATE USER beton24_1 WITH PASSWORD '159753';
GRANT ALL PRIVILEGES ON DATABASE beton24 TO beton24_1;
GRANT ALL ON SCHEMA beton24_1 TO beton24_1;
нет доступа
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA beton24_1 TO beton24_1
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA beton24_1 TO beton24_1

/*
ALTER DEFAULT PRIVILEGES IN SCHEMA beton24_1
    GRANT INSERT, SELECT, UPDATE, DELETE, TRUNCATE, REFERENCES, TRIGGER ON TABLES
    TO beton24;
ALTER DEFAULT PRIVILEGES IN SCHEMA beton24_1
    GRANT SELECT, UPDATE, USAGE ON SEQUENCES
    TO beton24;
*/


/*****************************/
GRANT ALL PRIVILEGES ON SCHEMA public TO beton24_1;
GRANT ALL PRIVILEGES ON SCHEMA beton24_1 TO beton24_1;
GRANT ALL PRIVILEGES ON SCHEMA beton24_1 TO beton24;

GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA beton24_1 TO beton24_1;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA beton24_1 TO beton24_1;

alter default privileges in schema beton24_1 grant all on tables to beton24_1;
alter default privileges in schema beton24_1 grant all on sequences to beton24_1;

REVOKE ALL PRIVILEGES ON SCHEMA public FROM beton24_1;
REVOKE ALL PRIVILEGES ON SCHEMA beton24_1 FROM beton24_1;
REVOKE ALL PRIVILEGES ON SCHEMA beton24_1 FROM beton24;
DROP SCHEMA beton24_2;
DROP ROLE beton24_1

/******************/
pg_dump -U postgres betontest > betontest.dump

Исправить в файле
Ctrl+\
1) OWNER TO beton; ==>> OWNER TO beton24_1;
2) создание postgis расширения
3) схема по умолчанию

psql -U postgres - d beton24 < betontest.dump
