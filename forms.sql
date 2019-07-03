use mysql;

CREATE TABLE IF NOT EXISTS forms(
		
		
		user_name varchar(20) NOT NULL,
		form_name varchar(20) NOT NULL,
		form_description varchar(100) NOT NULL,
		questions int NOT NULL
		
);