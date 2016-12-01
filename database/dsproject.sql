CREATE TABLE dsproject_user(
	user_id int NOT NULL AUTO_INCREMENT COMMENT "用户ID",
	student_id varchar(16) COMMENT "学号",
	user_name varchar(16) COMMENT "姓名",
	dsproject_key varchar(64) COMMENT "数据结构实验密钥",
	created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at timestamp NULL,
	deleted_at timestamp NULL,
	PRIMARY KEY(user_id),
	INDEX idx_student_id(student_id),
	INDEX idx_dsproject_key(dsproject_key)
)DEFAULT CHARSET=utf8;


CREATE TABLE dsproject_grade_project1(
	user_id int COMMENT "用户ID",
	grade_point int COMMENT "分数",
	grade_comment varchar(1024) COMMENT "分数注释",
	grade_confirm boolean DEFAULT FALSE COMMENT "是否确认"
	PRIMARY KEY(user_id)
)DEFAULT CHARSET=utf8;
