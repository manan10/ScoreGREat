create table user_friends (id int primary key, friends json, requests json);

INSERT INTO user_friends (`id`,`friends`,`requests`) VALUES (1,'[3, 4, 6]','[]');
INSERT INTO user_friends (`id`,`friends`,`requests`) VALUES (2,'[1, 1]','[]');
INSERT INTO user_friends (`id`,`friends`,`requests`) VALUES (3,NULL,NULL);
INSERT INTO user_friends (`id`,`friends`,`requests`) VALUES (4,NULL,NULL);
INSERT INTO user_friends (`id`,`friends`,`requests`) VALUES (5,NULL,NULL);
INSERT INTO user_friends (`id`,`friends`,`requests`) VALUES (6,NULL,NULL);
INSERT INTO user_friends (`id`,`friends`,`requests`) VALUES (7,NULL,'[]');
INSERT INTO user_friends (`id`,`friends`,`requests`) VALUES (8,NULL,'[2]');
INSERT INTO user_friends (`id`,`friends`,`requests`) VALUES (9,NULL,NULL);
INSERT INTO user_friends (`id`,`friends`,`requests`) VALUES (10,NULL,NULL);
INSERT INTO user_friends (`id`,`friends`,`requests`) VALUES (11,NULL,NULL);
