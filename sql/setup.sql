CREATE DATABASE emotions;

USE emotions;

CREATE TABLE emotions (emotion_name VARCHAR(20),response VARCHAR(20),security_level VARCHAR(40));
INSERT INTO emotions VALUES ('anger','response','bad_significant_impact');
INSERT INTO emotions VALUES ('happiness','response1','good_high_impact');
