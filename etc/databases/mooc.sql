/* -------------------------
        MOOC CONTEXT
---------------------------- */

-- Generic tables

CREATE TABLE mutations (
	id BIGINT AUTO_INCREMENT PRIMARY KEY,
	table_name VARCHAR(255) NOT NULL,
	operation ENUM ('INSERT', 'UPDATE', 'DELETE') NOT NULL,
	old_value JSON NULL,
	new_value JSON NULL,
	mutation_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

CREATE TABLE domain_events (
	id CHAR(36) NOT NULL,
	aggregate_id CHAR(36) NOT NULL,
	name VARCHAR(255) NOT NULL,
	body JSON NOT NULL,
	occurred_on TIMESTAMP NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

-- Aggregates tables

CREATE TABLE users (
	id CHAR(36) NOT NULL,
	email VARCHAR(255) NOT NULL,
	first_name VARCHAR(255) NOT NULL,
	last_name VARCHAR(255) NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

CREATE TRIGGER after_users_insert
	AFTER INSERT
	ON users
	FOR EACH ROW
BEGIN
	INSERT INTO mutations (table_name, operation, new_value, mutation_timestamp)
	VALUES ('users', 'INSERT', JSON_OBJECT('id', new.id, 'email', new.email, 'first_name', new.first_name, 'last_name', new.last_name), NOW());
END;

CREATE TRIGGER after_users_update
	AFTER UPDATE
	ON users
	FOR EACH ROW
BEGIN
	INSERT INTO mutations (table_name, operation, old_value, new_value, mutation_timestamp)
	VALUES ('users',
			'UPDATE',
			JSON_OBJECT('id', old.id, 'email', old.email, 'first_name', old.first_name, 'last_name', old.last_name),
			JSON_OBJECT('id', new.id, 'email', new.email, 'first_name', new.first_name, 'last_name', new.last_name),
			NOW());
END;

CREATE TRIGGER after_users_delete
	AFTER DELETE
	ON users
	FOR EACH ROW
BEGIN
	INSERT INTO mutations (table_name, operation, old_value, mutation_timestamp)
	VALUES ('users', 'DELETE', JSON_OBJECT('id', old.id, 'email', old.email, 'first_name', old.first_name, 'last_name', old.last_name), NOW());
END;

CREATE TABLE users_counter (
	id CHAR(36) NOT NULL,
	total INT NOT NULL,
	existing_users JSON NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

INSERT INTO users_counter (id, total, existing_users)
VALUES ("cdf26d7d-3deb-4e8c-9f73-4ac085a8d6f3", 0, "[]");

/* -------------------------
      BACKOFFICE CONTEXT
---------------------------- */

CREATE TABLE backoffice_users (
	id CHAR(36) NOT NULL,
	email VARCHAR(255) NOT NULL,
	first_name VARCHAR(255) NOT NULL,
	last_name VARCHAR(255) NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
