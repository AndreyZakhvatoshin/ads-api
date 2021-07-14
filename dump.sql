CREATE TABLE app.ads (
  id INT auto_increment NOT NULL,
  text varchar(100) NOT NULL,
  price DECIMAL(6, 2) NOT NULL,
  `limit` INT NOT NULL,
  banner varchar(100) NOT NULL,
  show_count INT NOT NULL DEFAULT 0,
  CONSTRAINT ads_PK PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;