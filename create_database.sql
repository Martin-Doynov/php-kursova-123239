CREATE DATABASE airplanes;
CREATE USER 'airplanes_user'@'localhost' IDENTIFIED BY '123456';
GRANT ALL PRIVILEGES ON airplanes.* TO 'airplanes_user'@'localhost';
FLUSH PRIVILEGES;