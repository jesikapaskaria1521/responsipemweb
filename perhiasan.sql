/*
SQLyog Ultimate v12.4.3 (32 bit)
MySQL - 10.1.38-MariaDB : Database - toko_perhiasan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`toko_perhiasan` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `toko_perhiasan`;

/*Table structure for table `detail_bayar` */

DROP TABLE IF EXISTS `detail_bayar`;

CREATE TABLE `detail_bayar` (
  `id_detail` varchar(50) NOT NULL,
  `id_perhiasan` varchar(50) DEFAULT NULL,
  `jumlah_beli` int(20) DEFAULT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `id_perhiasan` (`id_perhiasan`),
  CONSTRAINT `detail_bayar_ibfk_1` FOREIGN KEY (`id_perhiasan`) REFERENCES `perhiasan` (`id_perhiasan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detail_bayar` */

insert  into `detail_bayar`(`id_detail`,`id_perhiasan`,`jumlah_beli`) values 
('D1','B1',1),
('D10','B10',2),
('D11','B11',1),
('D12','B12',1),
('D2','B2',2),
('D3','B3',1),
('D4','B4',3),
('D5','B5',2),
('D6','B6',2),
('D7','B7',3),
('D8','B8',1),
('D9','B9',1);

/*Table structure for table `header_bayar` */

DROP TABLE IF EXISTS `header_bayar`;

CREATE TABLE `header_bayar` (
  `no_nota` varchar(50) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_detail` varchar(50) DEFAULT NULL,
  `total_pembelian` int(30) DEFAULT NULL,
  `bayar` int(30) DEFAULT NULL,
  `sisa_bayar` int(30) DEFAULT NULL,
  `cara_pembayaran` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`no_nota`),
  KEY `id_detail` (`id_detail`),
  CONSTRAINT `header_bayar_ibfk_1` FOREIGN KEY (`id_detail`) REFERENCES `detail_bayar` (`id_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `header_bayar` */

insert  into `header_bayar`(`no_nota`,`tanggal`,`id_detail`,`total_pembelian`,`bayar`,`sisa_bayar`,`cara_pembayaran`) values 
('Z01','2021-05-21','D1',25000000,25000000,0,'cash'),
('Z02','2021-05-11','D2',26000000,26000000,0,'kartu debit'),
('Z03','2021-05-12','D3',21000000,21000000,0,'kartu kredit'),
('Z04','2021-05-11','D4',30000000,30000000,0,'kartu kredit'),
('Z05','2021-05-13','D5',140000000,140000000,0,'kartu debit'),
('Z06','2021-05-25','D6',70000000,70000000,0,'cash'),
('Z07','2021-05-26','D7',33000000,33000000,0,'cash'),
('Z08','2021-05-10','D8',89000000,89000000,0,'kartu debit'),
('Z09','2021-05-10','D9',78000000,78000000,0,'kartu debit'),
('Z10','2021-05-11','D10',24000000,24000000,0,'kartu kredit'),
('Z11','2021-05-12','D11',29000000,29000000,0,'cash'),
('Z12','2021-05-12','D12',20000000,20000000,0,'kartu kredit');

/*Table structure for table `merk` */

DROP TABLE IF EXISTS `merk`;

CREATE TABLE `merk` (
  `id_merk` varchar(50) NOT NULL,
  `nama_merk` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_merk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `merk` */

insert  into `merk`(`id_merk`,`nama_merk`) values 
('A01','Tiffany & Co.'),
('A02','Cartier'),
('A03','BvLgari'),
('A04','Harry Winston'),
('A05','Hermes'),
('A06','Chanel'),
('A07','Dior'),
('A08','Mikimoto'),
('A09','H. Stern'),
('A10','Van Cleef & Arpels'),
('A11','David Yurman'),
('A12','Gucci');

/*Table structure for table `perhiasan` */

DROP TABLE IF EXISTS `perhiasan`;

CREATE TABLE `perhiasan` (
  `id_perhiasan` varchar(50) NOT NULL,
  `id_merk` varchar(50) DEFAULT NULL,
  `harga` int(20) DEFAULT NULL,
  `stok` int(20) DEFAULT NULL,
  PRIMARY KEY (`id_perhiasan`),
  KEY `id_merk` (`id_merk`),
  CONSTRAINT `perhiasan_ibfk_1` FOREIGN KEY (`id_merk`) REFERENCES `merk` (`id_merk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `perhiasan` */

insert  into `perhiasan`(`id_perhiasan`,`id_merk`,`harga`,`stok`) values 
('B1','A01',25000000,15),
('B10','A10',12000000,20),
('B11','A11',29000000,15),
('B12','A12',2000000,10),
('B2','A02',13000000,20),
('B3','A03',21000000,25),
('B4','A04',10000000,10),
('B5','A05',70000000,15),
('B6','A06',35000000,20),
('B7','A07',11000000,25),
('B8','A08',89000000,10),
('B9','A09',78000000,15);

/*Table structure for table `pemasukan_harian` */

DROP TABLE IF EXISTS `pemasukan_harian`;

/*!50001 DROP VIEW IF EXISTS `pemasukan_harian` */;
/*!50001 DROP TABLE IF EXISTS `pemasukan_harian` */;

/*!50001 CREATE TABLE  `pemasukan_harian`(
 `tanggal` date ,
 `SUM(total_pembelian)` decimal(51,0) 
)*/;

/*View structure for view pemasukan_harian */

/*!50001 DROP TABLE IF EXISTS `pemasukan_harian` */;
/*!50001 DROP VIEW IF EXISTS `pemasukan_harian` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pemasukan_harian` AS select `header_bayar`.`tanggal` AS `tanggal`,sum(`header_bayar`.`total_pembelian`) AS `SUM(total_pembelian)` from `header_bayar` group by `header_bayar`.`tanggal` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
