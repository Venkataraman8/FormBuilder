use mysql;

CREATE TABLE IF NOT EXISTS responses(
	
	user_name varchar(20) NOT NULL,
	form_name varchar(20) NOT NULL,
	
	answer_no int NOT NULL,
	answer varchar(100) NOT NULL
	
);