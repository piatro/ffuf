/*
SQLyog Ultimate v8.55 
MySQL - 5.5.5-10.1.28-MariaDB : Database - ffuf_crud
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ffuf_crud` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ffuf_crud`;

/*Table structure for table `books` */

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) DEFAULT NULL,
  `genre` tinyint(1) DEFAULT NULL,
  `library_section` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `books` */

insert  into `books`(`id`,`title`,`author`,`genre`,`library_section`,`status`) values (1,'A Game of Thrones','George R. R. Martin',4,5,0),(2,'The Game','Neil Strauss',6,6,0),(3,'The Rise and Fall of Nations','Ruchir Sharma',7,3,0),(4,'The Adventures of Huckleberry Finn','Mark Twain',4,5,0),(5,'The Hobbit','J. R. R. Tolkien',4,5,0),(6,'Thirteen Reasons Why','Jay Asher',4,5,0),(7,'Romeo and Juliet','William Shakespeare',2,5,0);

/*Table structure for table `genre` */

DROP TABLE IF EXISTS `genre`;

CREATE TABLE `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `genre` */

insert  into `genre`(`id`,`genre`) values (1,'Horror'),(2,'Romance'),(3,'Thriller'),(4,'Fantasy'),(5,'Cookbook'),(6,'Autobiography'),(7,'History');

/*Table structure for table `library_section` */

DROP TABLE IF EXISTS `library_section`;

CREATE TABLE `library_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `library_section` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `library_section` */

insert  into `library_section`(`id`,`library_section`) values (1,'Circulation'),(2,'Periodical'),(3,'General Reference'),(4,'Children'),(5,'Fiction'),(6,'Non-Fiction');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
