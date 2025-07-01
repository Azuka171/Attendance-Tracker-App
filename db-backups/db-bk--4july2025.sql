/*
SQLyog Community v13.3.0 (64 bit)
MySQL - 8.0.30 : Database - employee_attendance_tracker
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`employee_attendance_tracker` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `employee_attendance_tracker`;

/*Table structure for table `attendance` */

DROP TABLE IF EXISTS `attendance`;

CREATE TABLE `attendance` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `employeeId` int unsigned NOT NULL,
  `date` date NOT NULL,
  `timeIn` time NOT NULL,
  `timeOut` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employeeId` (`employeeId`),
  CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`employeeId`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `attendance` */

insert  into `attendance`(`id`,`employeeId`,`date`,`timeIn`,`timeOut`) values 
(245,29,'2025-06-29','21:01:03','21:01:39');

/*Table structure for table `employees` */

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(20) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `marital_status` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `date_of_employment` date NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nationality` varchar(50) NOT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `state_Of_Origin` varchar(50) NOT NULL,
  `lga` varchar(50) NOT NULL,
  `next_Of_Kin_FullName` varchar(100) NOT NULL,
  `next_Of_Kin_Relationship` varchar(50) NOT NULL,
  `next_Of_Kin_Email` varchar(100) DEFAULT NULL,
  `next_Of_Kin_Phone` varchar(20) NOT NULL,
  `passport_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `certificate_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `next_Of_Kin_Phone` (`next_Of_Kin_Phone`),
  UNIQUE KEY `employee_id` (`employee_id`),
  UNIQUE KEY `phone_number` (`phone_number`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `employees` */

insert  into `employees`(`id`,`employee_id`,`first_name`,`last_name`,`marital_status`,`gender`,`email`,`phone_number`,`date_of_employment`,`date_of_birth`,`nationality`,`religion`,`state_Of_Origin`,`lga`,`next_Of_Kin_FullName`,`next_Of_Kin_Relationship`,`next_Of_Kin_Email`,`next_Of_Kin_Phone`,`passport_photo`,`certificate_path`) values 
(25,'EMP001','John','Doe','Single','Male','johndoe@example.com','1234567890','2025-01-01','1988-04-26','American','Christianity','New York','Manhattan','Jane Doe','Sister','janedoe@example.com','0987654321',NULL,NULL),
(26,'EMP002','Mary','Smith','Married','Female','marysmith@example.com','2345678901','2024-05-15','2000-01-02','British','Islam','London','Camden','Alan Smith','Husband','alansmith@example.com','9876543210',NULL,NULL),
(27,'EMP003','James','Brown','divorce','Male','jamesbrown@example.com','3456789012','2023-11-12','1992-01-21','Canadian','Atheism','Ontario','Toronto','Sarah Brown','Daughter','sarahbrown@example.com','8765432109','',''),
(28,'EMP004','Anna','Williams','Single','Female','annawilliams@example.com','4567890123','2022-07-20','1980-04-10','Nigerian','Christianity','Lagos','Ikeja','Victor Williams','Father','victorw@example.com','7654321098',NULL,NULL),
(29,'EMP005','Michael','Johnson','Married','Male','michaeljohnson@example.com','5678901234','2025-03-05','1987-03-17','South African','Judaism','Gauteng','Johannesburg','Emily Johnson','Wife','emilyj@example.com','6543210987',NULL,NULL),
(30,'EMP006','Patricia','Taylor','Widowed','Female','patriciataylor@example.com','6789012345','2024-09-17','1994-03-19','Indian','Hinduism','Delhi','South Delhi','Rajesh Kumar','Brother','rajeshk@example.com','5432109876',NULL,NULL),
(31,'EMP007','Robert','Anderson','Single','Male','robertanderson@example.com','7890123456','2021-06-10','1987-06-12','Australian','Christianity','Sydney','Parramatta','Laura Anderson','Mother','lauraa@example.com','4321098765',NULL,NULL),
(32,'EMP008','Linda','Harris','Married','Female','lindaharris@example.com','8901234567','2020-02-28','1995-07-31','Kenyan','Islam','Nairobi','Westlands','Mark Harris','Husband','markh@example.com','3210987654',NULL,NULL),
(33,'EMP009','William','Clark','Single','Male','williamclark@example.com','9012345678','2025-01-01','1993-07-23','Ghanaian','Christianity','Accra','Tema','Nana Clark','Sister','nanaclark@example.com','2109876543',NULL,NULL),
(34,'EMP010','Elizabeth','Lewis','Married','Female','elizabethlewis@example.com','1230987654','2023-05-05','1980-01-20','American','Judaism','California','Los Angeles','Henry Lewis','Husband','henryl@example.com','1098765432',NULL,NULL),
(35,'EMP011','Christopher','Lee','Single','Male','christopherlee@example.com','2349876543','2022-03-15','1981-08-05','Chinese','Buddhism','Beijing','Chaoyang','Ming Lee','Father','minglee@example.com','9876543211',NULL,NULL),
(36,'EMP012','Susan','Martin','Divorced','Female','susanmartin@example.com','3458765432','2024-06-30','1987-10-23','Irish','Christianity','Dublin','Fingal','Tom Martin','Son','tommartin@example.com','8765432110',NULL,NULL),
(37,'EMP013','Daniel','Hall','Married','Male','danielhall@example.com','4567654321','2023-10-10','1993-04-05','German','Christianity','Berlin','Mitte','Jessica Hall','Wife','jessicah@example.com','7654321109',NULL,NULL),
(38,'EMP014','Jessica','Young','Single','Female','jessicayoung@example.com','5676543210','2021-01-22','1980-11-13','Japanese','Shinto','Tokyo','Shinjuku','Ken Young','Brother','keny@example.com','6543211098',NULL,NULL),
(39,'EMP015','Matthew','King','Married','Male','matthewking@example.com','6785432109','2022-12-12','1986-07-29','British','Christianity','Manchester','Trafford','Emma King','Wife','emmak@example.com','5432110987',NULL,NULL),
(40,'EMP016','Dorothy','Allen','Widowed','Female','dorothyallen@example.com','7894321098','2024-01-01','1989-04-03','Canadian','Judaism','Quebec','Montreal','Samuel Allen','Son','samallen@example.com','4321109876',NULL,NULL),
(41,'EMP017','Joseph','Scott','Single','Male','josephscott@example.com','8903210987','2023-07-07','1985-07-23','South African','Christianity','KwaZulu-Natal','Durban','Rachel Scott','Sister','rachels@example.com','3211098765',NULL,NULL),
(42,'EMP018','Nancy','Adams','Married','Female','nancyadams@example.com','9012109876','2022-04-25','1980-01-11','Nigerian','Islam','Abuja','Garki','Abdul Adams','Husband','abdula@example.com','2109876544',NULL,NULL),
(43,'EMP019','Andrew','Baker','Divorced','Male','andrewbaker@example.com','1231098765','2024-08-18','1984-06-20','Kenyan','Christianity','Mombasa','Nyali','Sophia Baker','Daughter','sophiab@example.com','1098765433',NULL,NULL),
(44,'EMP020','Emily','Perez','Married','Female','emilyperez@example.com','2340987654','2023-09-09','1981-04-05','Mexican','Christianity','Mexico City','Coyoacan','Luis Perez','Husband','luisp@example.com','9876543212',NULL,NULL),
(45,'B15310663','Gideon','Azuka','','','gideonazuka100@gmail.com','07025935847','2025-01-22','1993-11-21','','','','','','','','',NULL,NULL),
(47,'A1734006','Peter','Mordi','single','male','PeterMordi@beninelectric.com','08028514177','2025-01-08','1982-09-01','Nigeria','Christian','Delta','Aniocha South','Gideon','brother','azukagideon111@gmail.com','08062540725',NULL,NULL),
(48,'A17344568','baxi','azuka','single','male','azukagideon111@gmail.com','07025935456','2025-01-01','1993-09-04','Nigeria','Christian','Delta','Aniocha South','Gideon Chinonso Azuka','brother','gideonazuka30@gmail.com','0813455678',NULL,NULL),
(49,'C1310663','Gideon','joy','married','female','joy@gmail.com','08134568967','2025-01-08','2000-10-12','Nigeria','Christian','Edo','Aniocha North','favour','sister','favour23@gmail.com','0903456578345',NULL,NULL),
(50,'Nulla in odio accusa','Rogan Cooke','Jin Delacruz','Officia cumque ullam','Cumque consequat Ma','zywonyr@mailinator.com','+1 (346) 121-1705','1997-05-12','2020-08-23','Eius nihil eu nostru','Qui porro in magnam ','Distinctio Quidem n','Dolores in tempor qu','Laith Swanson','Reprehenderit delen','dotad@mailinator.com','+1 (267) 512-2406','uploads/1737691238google 2.jpg',NULL),
(51,'Voluptas aspernatur ','Kessie Reese','Ainsley Cervantes','Obcaecati qui eos ra','Laborum Obcaecati q','xebufir@mailinator.com','+1 (446) 113-7918','2023-07-01','2019-02-07','Laboris delectus re','Qui sit deleniti pl','Et autem molestias s','Enim nesciunt eu cu','Lucius Stevens','Laboriosam dolorem ','kazop@mailinator.com','+1 (384) 599-7645','uploads/1737694857photo.jpg','uploads/1737694857Certifications (1).pdf'),
(52,'Dolore sint optio s','Scarlett Rivas','Phoebe Poole','Ducimus vel expedit','Quia temporibus dolo','wyguvim@mailinator.com','+1 (721) 613-8125','1975-11-24','1971-12-11','Dolor labore ut eu i','Quia consequatur do','Vel quia et nemo ut ','Qui fugit molestiae','Davis Gallegos','Enim quasi hic paria','fuva@mailinator.com','+1 (522) 864-6976','uploads/passport_photos/1737695427Azuka_Passport.jpg','uploads/certificates/1737695427Certifications_(1).pdf'),
(53,'Ratione aute elit a','Whitney Dotson','Maia Trujillo','Enim adipisci qui re','Commodi saepe quia e','vyhes@mailinator.com','+1 (547) 497-5889','1990-02-23','1977-10-25','Qui non veniam itaq','Quasi animi praesen','Qui quisquam odit ha','Consectetur nemo cor','Pearl Harmon','Rem dolor impedit c','hakab@mailinator.com','+1 (178) 736-7107','uploads/passport_photos/1737695578_image_used19.jpg','uploads/certificates/1737695578_birth_certificate_.pdf'),
(54,'Sapiente illum id q','Jemima Hardin','Tatum Huffman','Voluptatem sint al','Aspernatur obcaecati','mebenyboh@mailinator.com','+1 (506) 394-7559','1973-10-08','2004-05-22','Neque expedita quis ','Voluptate sed reicie','Aspernatur esse dolo','Aut praesentium sit','Sandra Vaughan','Minus recusandae Qu','rokepec@mailinator.com','+1 (667) 728-1991','uploads/passport_photos/1738126225_passport.jpeg','uploads/certificates/1738126225_Gideon_Azuka_QAQC_ENGINEER-_TRAINEE.pdf');

/*Table structure for table `employees_details` */

DROP TABLE IF EXISTS `employees_details`;

CREATE TABLE `employees_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employeeId` varchar(20) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `maritalStatus` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `dateOfEmployment` date NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `stateOfOrigin` varchar(50) NOT NULL,
  `lga` varchar(50) NOT NULL,
  `nextOfKinFullName` varchar(100) NOT NULL,
  `nextOfKinRelationship` varchar(50) NOT NULL,
  `nextOfKinEmail` varchar(100) DEFAULT NULL,
  `nextOfKinPhone` varchar(20) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employeeId` (`employeeId`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `employees_details` */

insert  into `employees_details`(`id`,`employeeId`,`firstName`,`lastName`,`maritalStatus`,`gender`,`email`,`phone`,`dateOfEmployment`,`nationality`,`religion`,`stateOfOrigin`,`lga`,`nextOfKinFullName`,`nextOfKinRelationship`,`nextOfKinEmail`,`nextOfKinPhone`,`createdAt`,`updatedAt`) values 
(1,'EMP001','John','Doe','Single','Male','johndoe@example.com','1234567890','2025-01-01','American','Christianity','New York','Manhattan','Jane Doe','Sister','janedoe@example.com','0987654321','2025-01-19 15:30:25','2025-01-19 15:30:25'),
(2,'EMP002','Mary','Smith','Married','Female','marysmith@example.com','2345678901','2024-05-15','British','Islam','London','Camden','Alan Smith','Husband','alansmith@example.com','9876543210','2025-01-19 15:30:25','2025-01-19 15:30:25'),
(3,'EMP003','James','Brown','Divorced','Male','jamesbrown@example.com','3456789012','2023-11-12','Canadian','Atheism','Ontario','Toronto','Sarah Brown','Daughter','sarahbrown@example.com','8765432109','2025-01-19 15:30:25','2025-01-19 15:30:25'),
(4,'EMP004','Anna','Williams','Single','Female','annawilliams@example.com','4567890123','2022-07-20','Nigerian','Christianity','Lagos','Ikeja','Victor Williams','Father','victorw@example.com','7654321098','2025-01-19 15:30:25','2025-01-19 15:30:25'),
(5,'EMP005','Michael','Johnson','Married','Male','michaeljohnson@example.com','5678901234','2025-03-05','South African','Judaism','Gauteng','Johannesburg','Emily Johnson','Wife','emilyj@example.com','6543210987','2025-01-19 15:30:25','2025-01-19 15:30:25'),
(6,'EMP006','Patricia','Taylor','Widowed','Female','patriciataylor@example.com','6789012345','2024-09-17','Indian','Hinduism','Delhi','South Delhi','Rajesh Kumar','Brother','rajeshk@example.com','5432109876','2025-01-19 15:30:25','2025-01-19 15:30:25'),
(7,'EMP007','Robert','Anderson','Single','Male','robertanderson@example.com','7890123456','2021-06-10','Australian','Christianity','Sydney','Parramatta','Laura Anderson','Mother','lauraa@example.com','4321098765','2025-01-19 15:30:25','2025-01-19 15:30:25'),
(8,'EMP008','Linda','Harris','Married','Female','lindaharris@example.com','8901234567','2020-02-28','Kenyan','Islam','Nairobi','Westlands','Mark Harris','Husband','markh@example.com','3210987654','2025-01-19 15:30:25','2025-01-19 15:30:25'),
(9,'EMP009','William','Clark','Single','Male','williamclark@example.com','9012345678','2025-01-01','Ghanaian','Christianity','Accra','Tema','Nana Clark','Sister','nanaclark@example.com','2109876543','2025-01-19 15:30:25','2025-01-19 15:30:25'),
(10,'EMP010','Elizabeth','Lewis','Married','Female','elizabethlewis@example.com','1230987654','2023-05-05','American','Judaism','California','Los Angeles','Henry Lewis','Husband','henryl@example.com','1098765432','2025-01-19 15:30:25','2025-01-19 15:30:25'),
(11,'EMP011','Christopher','Lee','Single','Male','christopherlee@example.com','2349876543','2022-03-15','Chinese','Buddhism','Beijing','Chaoyang','Ming Lee','Father','minglee@example.com','9876543211','2025-01-19 15:30:25','2025-01-19 15:30:25'),
(12,'EMP012','Susan','Martin','Divorced','Female','susanmartin@example.com','3458765432','2024-06-30','Irish','Christianity','Dublin','Fingal','Tom Martin','Son','tommartin@example.com','8765432110','2025-01-19 15:30:25','2025-01-19 15:30:25'),
(13,'EMP013','Daniel','Hall','Married','Male','danielhall@example.com','4567654321','2023-10-10','German','Christianity','Berlin','Mitte','Jessica Hall','Wife','jessicah@example.com','7654321109','2025-01-19 15:30:25','2025-01-19 15:30:25'),
(14,'EMP014','Jessica','Young','Single','Female','jessicayoung@example.com','5676543210','2021-01-22','Japanese','Shinto','Tokyo','Shinjuku','Ken Young','Brother','keny@example.com','6543211098','2025-01-19 15:30:25','2025-01-19 15:30:25'),
(15,'EMP015','Matthew','King','Married','Male','matthewking@example.com','6785432109','2022-12-12','British','Christianity','Manchester','Trafford','Emma King','Wife','emmak@example.com','5432110987','2025-01-19 15:30:25','2025-01-19 15:30:25'),
(16,'EMP016','Dorothy','Allen','Widowed','Female','dorothyallen@example.com','7894321098','2024-01-01','Canadian','Judaism','Quebec','Montreal','Samuel Allen','Son','samallen@example.com','4321109876','2025-01-19 15:30:25','2025-01-19 15:30:25'),
(17,'EMP017','Joseph','Scott','Single','Male','josephscott@example.com','8903210987','2023-07-07','South African','Christianity','KwaZulu-Natal','Durban','Rachel Scott','Sister','rachels@example.com','3211098765','2025-01-19 15:30:25','2025-01-19 15:30:25'),
(18,'EMP018','Nancy','Adams','Married','Female','nancyadams@example.com','9012109876','2022-04-25','Nigerian','Islam','Abuja','Garki','Abdul Adams','Husband','abdula@example.com','2109876544','2025-01-19 15:30:25','2025-01-19 15:30:25')