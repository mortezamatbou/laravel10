USE lyan_db;

CREATE TABLE my_users (
    id INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    status INT NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE my_users_status (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);


CREATE TABLE log_requests (
    id INT NOT NULL AUTO_INCREMENT,
    route_name VARCHAR(100) NOT NULL,
    uuid VARCHAR(100) NOT NULL,
    time_add VARCHAR(30) NOT NULL,
    PRIMARY KEY (id)
);


ALTER TABLE my_users
ADD FOREIGN KEY (status) REFERENCES my_users_status(id);

INSERT INTO my_users_status(title)
VALUES ("enable"), ("disable"), ("suspend");

INSERT INTO my_users(first_name, last_name, status)
VALUES ("Morteza", "Matbou", 1), ("Hossein", "Allahmoradi", 1), ("Mohsen", "Matbou", 3);

INSERT INTO log_requests(route_name, uuid, time_add)
VALUES ('/test/joins', UUID(), '1698517851'),
('/test/db', UUID(), '1698471562'),
('/test/where', UUID(), '1698514747'),
('/test/joins', UUID(), '1698467848'),
('/test/joins', UUID(), '1698518419'),
('/test/where', UUID(), '1698455127'),
('/test/db', UUID(), '1698523005'),
('/test/db', UUID(), '1698438986'),
('/test/db', UUID(), '1698469050'),
('/test/db', UUID(), '1698510662'),
('/test/group', UUID(), '1698510588'),
('/test/db', UUID(), '1698489250'),
('/test/where', UUID(), '1698460518'),
('/test/joins', UUID(), '1698498949'),
('/test/db', UUID(), '1698442923'),
('/test/where', UUID(), '1698509067'),
('/test/db', UUID(), '1698488647'),
('/test/joins', UUID(), '1698445803'),
('/test/joins', UUID(), '1698462717'),
('/test/db', UUID(), '1698463498'),
('/test/group', UUID(), '1698440274'),
('/test/group', UUID(), '1698439954'),
('/test/db', UUID(), '1698520936'),
('/test/db', UUID(), '1698485144'),
('/test/where', UUID(), '1698452079'),
('/test/group', UUID(), '1698459338'),
('/test/db', UUID(), '1698526773'),
('/test/where', UUID(), '1698449647'),
('/test/db', UUID(), '1698497418'),
('/test/db', UUID(), '1698460358'),
('/test/joins', UUID(), '1698455177'),
('/test/group', UUID(), '1698502525'),
('/test/joins', UUID(), '1698518353'),
('/test/group', UUID(), '1698491169'),
('/test/joins', UUID(), '1698447850'),
('/test/joins', UUID(), '1698501855'),
('/test/where', UUID(), '1698489414'),
('/test/joins', UUID(), '1698469160'),
('/test/db', UUID(), '1698451938'),
('/test/group', UUID(), '1698518239'),
('/test/where', UUID(), '1698466492'),
('/test/db', UUID(), '1698493005'),
('/test/joins', UUID(), '1698478511'),
('/test/group', UUID(), '1698512370'),
('/test/where', UUID(), '1698510701'),
('/test/joins', UUID(), '1698525491'),
('/test/db', UUID(), '1698490852'),
('/test/joins', UUID(), '1698459360'),
('/test/db', UUID(), '1698524927'),
('/test/db', UUID(), '1698474952'),
('/test/where', UUID(), '1698447930'),
('/test/where', UUID(), '1698494208'),
('/test/group', UUID(), '1698500609'),
('/test/group', UUID(), '1698450704'),
('/test/group', UUID(), '1698455834'),
('/test/group', UUID(), '1698441207'),
('/test/group', UUID(), '1698462142'),
('/test/joins', UUID(), '1698494462'),
('/test/where', UUID(), '1698458964'),
('/test/group', UUID(), '1698484190'),
('/test/where', UUID(), '1698517828'),
('/test/db', UUID(), '1698508064'),
('/test/joins', UUID(), '1698442837'),
('/test/group', UUID(), '1698467134'),
('/test/group', UUID(), '1698516043'),
('/test/db', UUID(), '1698506949'),
('/test/where', UUID(), '1698486959'),
('/test/joins', UUID(), '1698473138'),
('/test/joins', UUID(), '1698443979'),
('/test/where', UUID(), '1698522495'),
('/test/where', UUID(), '1698470135'),
('/test/db', UUID(), '1698452503'),
('/test/where', UUID(), '1698514115'),
('/test/joins', UUID(), '1698486504'),
('/test/db', UUID(), '1698483329'),
('/test/joins', UUID(), '1698469046'),
('/test/db', UUID(), '1698495182'),
('/test/group', UUID(), '1698516485'),
('/test/joins', UUID(), '1698528385'),
('/test/joins', UUID(), '1698491280'),
('/test/db', UUID(), '1698474488'),
('/test/where', UUID(), '1698477768'),
('/test/group', UUID(), '1698518678'),
('/test/db', UUID(), '1698505034'),
('/test/joins', UUID(), '1698518961'),
('/test/db', UUID(), '1698449508'),
('/test/db', UUID(), '1698525586'),
('/test/joins', UUID(), '1698473450'),
('/test/db', UUID(), '1698488769'),
('/test/joins', UUID(), '1698509334'),
('/test/group', UUID(), '1698493537'),
('/test/joins', UUID(), '1698505598'),
('/test/db', UUID(), '1698484050'),
('/test/group', UUID(), '1698507792'),
('/test/where', UUID(), '1698527644'),
('/test/where', UUID(), '1698459461'),
('/test/group', UUID(), '1698453177'),
('/test/where', UUID(), '1698521735'),
('/test/where', UUID(), '1698476007'),
('/test/joins', UUID(), '1698467419');
