use mysql;

CREATE TABLE IF NOT EXISTS questions(
	form_name varchar(20) NOT NULL,
	type varchar(20) NOT NULL,
	required varchar (5) NOT NULL,
	
	question_no int NOT NULL,
	question varchar(30) NOT NULL,
	option_a varchar(10) NOT NULL,
	option_b varchar(10) NOT NULL,
	option_c varchar(10) NOT NULL,
	option_d varchar(10) NOT NULL
	
);

