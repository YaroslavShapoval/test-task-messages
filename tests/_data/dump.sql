CREATE TABLE IF NOT EXISTS test_messages (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  email VARCHAR(250) NOT NULL,
  text TEXT NOT NULL,
  image_path VARCHAR(64),
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  status INT DEFAULT 0,
  is_edited BOOLEAN DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS test_users (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  login VARCHAR(50) NOT NULL,
  name VARCHAR(50) NOT NULL,
  email VARCHAR(250) NOT NULL,
  password_hash VARCHAR(250) NOT NULL,
  auth_key VARCHAR(250) NOT NULL,
  is_admin BOOLEAN DEFAULT FALSE,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL
);

# Password generation: \source\models\User::generatePasswordHash()
# password = 123
INSERT INTO test_users (`login`, `name`, `email`, `password_hash`, `auth_key`, `is_admin`, `created_at`, `updated_at`)
  VALUE ('admin', 'Administrator', 'admin@example.com',
         '$2y$13$sTQNTCyrb/vTp8ENe4pRnuw08j4J9Z/Ul97ubZNAXCOrdg9Eux8p.', 'generated_auth_key',
         true, '2016-04-01 12:00:00', '2016-04-01 12:00:00');