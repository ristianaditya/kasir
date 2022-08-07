/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 5.7.33 : Database - kasir
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`kasir` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `kasir`;

/*Table structure for table `detail_order` */

DROP TABLE IF EXISTS `detail_order`;

CREATE TABLE `detail_order` (
  `id_detail_order` int(10) NOT NULL AUTO_INCREMENT,
  `id_order` int(10) NOT NULL,
  `id_masakan` int(10) NOT NULL,
  `qty` int(5) NOT NULL,
  PRIMARY KEY (`id_detail_order`),
  KEY `id_order` (`id_order`),
  KEY `id_masakan` (`id_masakan`),
  CONSTRAINT `detail_order_ibfk_2` FOREIGN KEY (`id_masakan`) REFERENCES `masakan` (`id_masakan`),
  CONSTRAINT `detail_order_ibfk_3` FOREIGN KEY (`id_order`) REFERENCES `orderan` (`id_order`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=latin1;

/*Data for the table `detail_order` */

insert  into `detail_order`(`id_detail_order`,`id_order`,`id_masakan`,`qty`) values 
(137,9,32,3),
(138,10,32,1);

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `kategori` */

insert  into `kategori`(`id`,`nama_kategori`) values 
(1,'Makanan'),
(2,'Minuman');

/*Table structure for table `level` */

DROP TABLE IF EXISTS `level`;

CREATE TABLE `level` (
  `id_level` int(1) NOT NULL,
  `nama_level` enum('administrator','waiter','kasir','owner','pelanggan') NOT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `level` */

insert  into `level`(`id_level`,`nama_level`) values 
(1,'administrator'),
(2,'waiter'),
(3,'kasir'),
(4,'owner'),
(5,'pelanggan');

/*Table structure for table `masakan` */

DROP TABLE IF EXISTS `masakan`;

CREATE TABLE `masakan` (
  `id_masakan` int(10) NOT NULL AUTO_INCREMENT,
  `nama_masakan` varchar(25) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(10) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `status_masakan` enum('ready','belum ready') NOT NULL,
  `soft_delete` int(11) NOT NULL,
  PRIMARY KEY (`id_masakan`),
  KEY `id_kategori` (`id_kategori`),
  CONSTRAINT `masakan_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Data for the table `masakan` */

insert  into `masakan`(`id_masakan`,`nama_masakan`,`deskripsi`,`harga`,`gambar`,`id_kategori`,`status_masakan`,`soft_delete`) values 
(2,'Ayam Bakar','Enak pisan',50000,'ayam_bakar2.jpg',1,'ready',1),
(3,'Ayam Geprek','Ayam geprek dengan varian level pedan dan bumbu rahasia.',50000,'ayam geprek.jpg',1,'belum ready',1),
(4,'Ayam Goreng','Ayam Goreng dengan tingkat kerenyahan yang mantul',50000,'ayam goreng.jpg',1,'ready',1),
(5,'Ayam penyet','Ayam penyet yang pedas dan nikmat',50000,'ayam penyet.jpg',1,'belum ready',1),
(6,'Capcay','Capcay dengan sayuran dan rempah pilihan yang fresh waw',25000,'capcay.jpg',1,'ready',1),
(7,'Es Dawet','Es dawet yang segar untuk siang hari.',25000,'es dawet.jpg',2,'ready',1),
(8,'Es Manado','Es manado yang kaya dengan rasa dan segar.',25000,'es manado.jpg',2,'ready',1),
(9,'Es Oyen','Es oyen dengan buah buahan yang segar.',25000,'es oyen.jpg',2,'ready',1),
(10,'Gulai Kambing','Gulai kambing dengan gulai yang sangat kental dan kaya akan rempah.',50000,'gulai kambing.jpg',1,'ready',1),
(11,'Jus Buah Naga','Jus buah naga yang segar dengan susu kental manis yang sangat mantul.',25000,'jus buah naga.jpg',2,'ready',1),
(12,'Kangkung ','Kangkung dengan kankung yang baru di panen dari sawah langsung.',30000,'kangkung.jpg',1,'ready',1),
(13,'Mie Baso','Mie Baso dengan baso urat dan kuah yang kaya bumbu',30000,'mie baso.jpg',1,'ready',1),
(14,'Nasi Goreng Spesial','Nasi goreng yang lengkap dengan daging dan sosis.',30000,'nasi goreng s.jpg',1,'ready',1),
(15,'Nasi Rawon','Nasi rawon dengan rawon sapi yang hitam dan pedas.',30000,'nasi rawon.jpg',1,'ready',1),
(16,'Nasi Timbel','Nasi timbel yang memiliki cita rasa yang khas.',30000,'nasi timbel.jpg',1,'ready',1),
(17,'pecel lele','Pecel lele dengan bumbu kacang yang sangat nikmat',45000,'pecel lele.jpg',1,'ready',1),
(18,'Puding Buah Naga','Puding buah naga dengan buah yang segar dan enak untuk dimakan di siang hari.',25000,'puding buah naga.jpg',2,'ready',1),
(19,'Salad','Salah buah yang nikmat.',15000,'salad.jpg',2,'ready',1),
(20,'Sate Ayam Madura','Sate ayam yang kaya akan bumbu kacang dan kecap.',25000,'sate ayam madura.jpg',1,'ready',1),
(21,'Sate Sapi','Sate sapi dengan daging sapi dari pasar.',40000,'sate sapi.jpg',1,'ready',1),
(22,'Selai Nanas','Dengan nanas pilihan yang baru di petik.',15000,'selai nanas.jpg',2,'ready',1),
(23,'Sop Buntut','Sop buntut dengan buntut sapi yang baru beli di pasar tiap pagi.',40000,'sop buntut.jpg',1,'ready',1),
(24,'Sop Iga Sapi','Sop iga sapi dengan daging baru beli tadi pagi.',50000,'sop iga sapi.jpg',1,'ready',1),
(25,'Sop Kambing','Dengan kambing yang di potong di toko.',40000,'sop kambing.jpg',1,'ready',1),
(26,'Susu Kedelai','Susu yang di import langsung dari coblong.',80000,'susu kedelai.jpg',2,'ready',1),
(27,'Tongseng Bebek','Tongseng dengan daging yang segar dengan kualitas yang baik.',40000,'tongseng bebek.jpg',1,'ready',1),
(28,'Tongseng Kambing','Tongseng Kambing dengan daging kambing segar pilihan.',50000,'tongseng kambing.jpg',1,'ready',1),
(29,'Mie Godok Jawa','Dengan mie yang lembut dan sedikit tebal dengan bumbu kaya rasa.',25000,'Mie_Godok_Jawa.jpg',1,'ready',1),
(32,'Ati Ampela','Ati ampela dari ayam yang di sembelih di depan pelanggan ',80000,'ati_ampela.jpg',1,'ready',1),
(33,'masakan baru123 ','maskan 123',123,'IMG_5235_cop2.jpg',2,'ready',0);

/*Table structure for table `orderan` */

DROP TABLE IF EXISTS `orderan`;

CREATE TABLE `orderan` (
  `id_order` int(10) NOT NULL AUTO_INCREMENT,
  `no_meja` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `id_user` varchar(25) NOT NULL,
  `keterangan` enum('dibuat','selesai') NOT NULL,
  `status_order` enum('belum selesai','selesai') NOT NULL,
  PRIMARY KEY (`id_order`),
  KEY `status_order` (`status_order`),
  KEY `no_meja` (`no_meja`),
  KEY `tanggal` (`tanggal`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `orderan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `orderan` */

insert  into `orderan`(`id_order`,`no_meja`,`tanggal`,`id_user`,`keterangan`,`status_order`) values 
(9,'Meja 6','2022-08-07','10','selesai','selesai'),
(10,'Meja 6','2022-08-07','10','selesai','selesai');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(40) NOT NULL,
  `id_order` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `total_bayar` int(10) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `id_order` (`id_order`),
  KEY `id_order_2` (`id_order`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orderan` (`id_order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`id_transaksi`,`id_order`,`tanggal`,`total_bayar`) values 
('20220808015639-001',9,'2022-08-07',240000),
('20220808025259-002',10,'2022-08-07',80000);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` varchar(25) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` text NOT NULL,
  `nama_user` varchar(25) NOT NULL,
  `id_level` int(1) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_level` (`id_level`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`username`,`password`,`nama_user`,`id_level`) values 
('1','admin','0192023a7bbd73250516f069df18b500','super_admin',1),
('10','m6','0192023a7bbd73250516f069df18b500','Meja 6',5),
('13','m9','0192023a7bbd73250516f069df18b500','Meja 9',5),
('14','m10','0192023a7bbd73250516f069df18b500','Meja 10',5),
('15','m11','0192023a7bbd73250516f069df18b500','Meja 11',5),
('16','m12','0192023a7bbd73250516f069df18b500','Meja 12',5),
('17','m13','0192023a7bbd73250516f069df18b500','Meja 13',5),
('18','m14','0192023a7bbd73250516f069df18b500','Meja 14',5),
('19','m15','0192023a7bbd73250516f069df18b500','Meja 15',5),
('2','admin','0192023a7bbd73250516f069df18b500','admin',1),
('20','m16','0192023a7bbd73250516f069df18b500','Meja 16',5),
('21','m17','0192023a7bbd73250516f069df18b500','Meja 17',5),
('22','m18','0192023a7bbd73250516f069df18b500','Meja 18',5),
('23','meja 21','0192023a7bbd73250516f069df18b500','meja 21',5),
('3','kasir','0192023a7bbd73250516f069df18b500','kasir',3),
('4','owner','0192023a7bbd73250516f069df18b500','owner',4),
('5','m1','0192023a7bbd73250516f069df18b500','Meja 1 ',5),
('6','m2','0192023a7bbd73250516f069df18b500','Meja 2',5),
('7','m3','0192023a7bbd73250516f069df18b500','Meja 3',5),
('8','m4','0192023a7bbd73250516f069df18b500','Meja 4',5),
('9','m5','0192023a7bbd73250516f069df18b500','Meja 5',5),
('WA-022','waiter','0192023a7bbd73250516f069df18b500','waiter',2);

/* Trigger structure for table `transaksi` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `update_transaksi` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `update_transaksi` AFTER INSERT ON `transaksi` FOR EACH ROW BEGIN
	UPDATE orderan SET status_order = 'selesai' where id_order = new.id_order;
    END */$$


DELIMITER ;

/* Trigger structure for table `user` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `delete_user` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `delete_user` BEFORE DELETE ON `user` FOR EACH ROW BEGIN
	DELETE detail_order FROM detail_order RIGHT JOIN orderan ON orderan.`id_order` = detail_order.`id_order` LEFT JOIN USER ON user.`id_user` = orderan.`id_user` where user.`id_user` = old.id_user;
	DELETE transaksi FROM transaksi LEFT JOIN orderan ON orderan.`id_order` = transaksi.`id_order` LEFT JOIN USER ON user.`id_user` = orderan.`id_user` WHERE user.`id_user` = old.id_user;
	DELETE orderan FROM orderan LEFT JOIN USER ON user.`id_user` = orderan.`id_user` WHERE user.`id_user` = old.id_user;
    END */$$


DELIMITER ;

/* Function  structure for function  `edit_user` */

/*!50003 DROP FUNCTION IF EXISTS `edit_user` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `edit_user`(
	username VARCHAR(64),
	new_password VARCHAR(64),
	confirm_password VARCHAR(64),
	nama_user VARCHAR(64),
	id_level INT,
	id_getuser VARCHAR(32)
    ) RETURNS int(11)
BEGIN
	DECLARE cek_password int;
	DECLARE cek_null INT;
	declare status_hasil int;
	
	set cek_password = (STRCMP(new_password, confirm_password)); # CEK PASSWORD
	SET cek_null = (isnull(new_password * confirm_password)); # CEK NULL 	
	
	# CEK DATA KOSONG
	IF cek_null = 1 or new_password = '' and confirm_password = '' THEN
		UPDATE USER SET username = username, nama_user = nama_user, id_level = id_level WHERE id_user = id_getuser;
		# STATUS BERHASIL
		RETURN status_hasil = 1; 
	ELSE
		# CEK CONFIRM PASSWORD
		IF cek_password = 0 THEN
			UPDATE USER SET username = username, PASSWORD = MD5(confirm_password), nama_user = nama_user, id_level = id_level WHERE id_user = id_getuser;
			# STATUS BERHASIL
			RETURN status_hasil = 1;
		ELSE
			# STATUS GAGAL
			RETURN status_hasil = 0;
		END IF;
	END IF;
	
END */$$
DELIMITER ;

/* Function  structure for function  `id_custome_transaksi` */

/*!50003 DROP FUNCTION IF EXISTS `id_custome_transaksi` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `id_custome_transaksi`(
    ) RETURNS varchar(40) CHARSET latin1
BEGIN
	DECLARE id_custom VARCHAR(40) CHARSET latin1;
	SET id_custom = (SELECT CONCAT_WS('-', LOCALTIMESTAMP()+1 , LPAD(COUNT(*) + 1, 3, 0)) AS id_custom  FROM transaksi);
	RETURN id_custom;
END */$$
DELIMITER ;

/* Function  structure for function  `id_custome_user` */

/*!50003 DROP FUNCTION IF EXISTS `id_custome_user` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `id_custome_user`(
	level int
    ) RETURNS varchar(40) CHARSET latin1
BEGIN
	DECLARE id_custom VARCHAR(40) CHARSET latin1;
	IF level = 1 THEN
		SET id_custom = (SELECT CONCAT_WS('-', 'AD', LPAD(COUNT(*) + 1, 3, 0)) AS id_custom  FROM USER);
		RETURN id_custom;
	ELSEIF LEVEL = 2 THEN
		SET id_custom = (SELECT CONCAT_WS('-', 'WA', LPAD(COUNT(*) + 1, 3, 0)) AS id_custom  FROM USER);
		RETURN id_custom;
	ELSEIF LEVEL = 3 THEN
		SET id_custom = (SELECT CONCAT_WS('-', 'KA', LPAD(COUNT(*) + 1, 3, 0)) AS id_custom  FROM USER);
		RETURN id_custom;
	ELSEIF LEVEL = 4 THEN
		SET id_custom = (SELECT CONCAT_WS('-', 'OW', LPAD(COUNT(*) + 1, 3, 0)) AS id_custom  FROM USER);
		RETURN id_custom;
	ELSE
		SET id_custom = (SELECT CONCAT_WS('-', 'PE', LPAD(COUNT(*) + 1, 3, 0)) AS id_custom  FROM USER);
		RETURN id_custom;
	END IF;
END */$$
DELIMITER ;

/* Function  structure for function  `jml_masakan` */

/*!50003 DROP FUNCTION IF EXISTS `jml_masakan` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `jml_masakan`(
    
    ) RETURNS int(16)
BEGIN
	DECLARE jml_masakan INT;
	SET jml_masakan = (SELECT COUNT(id_masakan) FROM masakan where soft_delete = 1);
	RETURN jml_masakan;
    END */$$
DELIMITER ;

/* Function  structure for function  `jml_pesanan` */

/*!50003 DROP FUNCTION IF EXISTS `jml_pesanan` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `jml_pesanan`(
    
    ) RETURNS int(16)
BEGIN
	DECLARE jml_pesanan INT;
	SET jml_pesanan = (SELECT COUNT(*) FROM orderan WHERE status_order = 'belum selesai');
	RETURN jml_pesanan;
    END */$$
DELIMITER ;

/* Function  structure for function  `jml_pesanan_kasir` */

/*!50003 DROP FUNCTION IF EXISTS `jml_pesanan_kasir` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `jml_pesanan_kasir`(
    
    ) RETURNS int(16)
BEGIN
	DECLARE jml_pesanan INT;
	SET jml_pesanan = (SELECT COUNT(*) FROM orderan o WHERE o.keterangan = 'selesai' AND o.status_order = 'belum selesai');
	RETURN jml_pesanan;
    END */$$
DELIMITER ;

/* Function  structure for function  `jml_pesanan_waiter` */

/*!50003 DROP FUNCTION IF EXISTS `jml_pesanan_waiter` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `jml_pesanan_waiter`(
    
    ) RETURNS int(16)
BEGIN
	DECLARE jml_pesanan INT;
	SET jml_pesanan = (SELECT COUNT(*) FROM orderan o WHERE o.keterangan = 'dibuat' AND o.status_order = 'belum selesai');
	RETURN jml_pesanan;
    END */$$
DELIMITER ;

/* Function  structure for function  `jml_transaksi` */

/*!50003 DROP FUNCTION IF EXISTS `jml_transaksi` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `jml_transaksi`(
    
    ) RETURNS int(16)
BEGIN
	DECLARE jml_pesanan INT;
	SET jml_pesanan = (SELECT COUNT(*) FROM transaksi);
	RETURN jml_pesanan;
    END */$$
DELIMITER ;

/* Function  structure for function  `jml_user` */

/*!50003 DROP FUNCTION IF EXISTS `jml_user` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `jml_user`(
    
    ) RETURNS int(32)
BEGIN
	DECLARE jml_user INT;
	SET jml_user = (SELECT COUNT(id_user) FROM user);
	RETURN jml_user;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `barcode_login` */

/*!50003 DROP PROCEDURE IF EXISTS  `barcode_login` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `barcode_login`(
	IN userparam VARCHAR(64),
	IN passparam VARCHAR(64)
    )
BEGIN
		SELECT * FROM USER WHERE username = userparam AND PASSWORD = passparam;
				
	END */$$
DELIMITER ;

/* Procedure structure for procedure `list_detail_pesanan` */

/*!50003 DROP PROCEDURE IF EXISTS  `list_detail_pesanan` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `list_detail_pesanan`(
	IN idParam INT
    )
BEGIN
		SELECT  r.id_detail_order, o.tanggal, o.keterangan, o.no_meja ,o.id_order, m.nama_masakan, m.harga, r.qty, (m.harga * r.qty) AS total_harga 
		FROM orderan o 
		INNER JOIN detail_order r ON o.id_order = r.id_order 
		INNER JOIN masakan m ON r.`id_masakan` = m.`id_masakan`
		WHERE o.status_order = 'belum selesai' AND r.id_order = idParam;
				
	END */$$
DELIMITER ;

/* Procedure structure for procedure `list_masakan_ready` */

/*!50003 DROP PROCEDURE IF EXISTS  `list_masakan_ready` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `list_masakan_ready`(
	IN kategoriParam INT
    )
BEGIN
		SELECT * from data_masakan where id_kategori = kategoriParam AND status_masakan = 'ready';
				
	END */$$
DELIMITER ;

/* Procedure structure for procedure `tambah_user` */

/*!50003 DROP PROCEDURE IF EXISTS  `tambah_user` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_user`(
	IN namaparam VARCHAR(64),
	IN userparam VARCHAR(64),
	IN passparam VARCHAR(64),
	IN levelparam INT
    )
BEGIN
		INSERT INTO user (id_user, username, password, nama_user, id_level)VALUES(id_custome_user(levelparam), userparam, md5(passparam), namaparam, levelparam);		
	END */$$
DELIMITER ;

/* Procedure structure for procedure `transaksi_proses` */

/*!50003 DROP PROCEDURE IF EXISTS  `transaksi_proses` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `transaksi_proses`(
	IN id_orderparam int,
	IN tanggalparam date,
	IN totalparam int
    )
BEGIN
		INSERT into transaksi (id_transaksi, id_order, tanggal, total_bayar) Values (id_custome_transaksi(), id_orderparam, tanggalparam, totalparam);		
	END */$$
DELIMITER ;

/* Procedure structure for procedure `validate_login` */

/*!50003 DROP PROCEDURE IF EXISTS  `validate_login` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `validate_login`(
	IN userparam varchar(64),
	in passparam varchar(64)
    )
BEGIN
		SELECT * FROM USER WHERE username = userparam AND PASSWORD = MD5(passparam);
				
	END */$$
DELIMITER ;

/*Table structure for table `data_masakan` */

DROP TABLE IF EXISTS `data_masakan`;

/*!50001 DROP VIEW IF EXISTS `data_masakan` */;
/*!50001 DROP TABLE IF EXISTS `data_masakan` */;

/*!50001 CREATE TABLE  `data_masakan`(
 `id_masakan` int(10) ,
 `nama_masakan` varchar(25) ,
 `deskripsi` text ,
 `harga` int(10) ,
 `gambar` varchar(50) ,
 `kategori` varchar(30) ,
 `id_kategori` int(10) ,
 `status_masakan` enum('ready','belum ready') 
)*/;

/*Table structure for table `data_user_level` */

DROP TABLE IF EXISTS `data_user_level`;

/*!50001 DROP VIEW IF EXISTS `data_user_level` */;
/*!50001 DROP TABLE IF EXISTS `data_user_level` */;

/*!50001 CREATE TABLE  `data_user_level`(
 `id_user` varchar(25) ,
 `username` varchar(15) ,
 `nama_user` varchar(25) ,
 `password` text ,
 `id_level` int(1) ,
 `nama_level` enum('administrator','waiter','kasir','owner','pelanggan') 
)*/;

/*Table structure for table `list_pesanan` */

DROP TABLE IF EXISTS `list_pesanan`;

/*!50001 DROP VIEW IF EXISTS `list_pesanan` */;
/*!50001 DROP TABLE IF EXISTS `list_pesanan` */;

/*!50001 CREATE TABLE  `list_pesanan`(
 `id_order` int(10) ,
 `no_meja` varchar(10) ,
 `tanggal` date ,
 `id_user` varchar(25) ,
 `keterangan` enum('dibuat','selesai') ,
 `status_order` enum('belum selesai','selesai') 
)*/;

/*Table structure for table `list_pesanan_kasir` */

DROP TABLE IF EXISTS `list_pesanan_kasir`;

/*!50001 DROP VIEW IF EXISTS `list_pesanan_kasir` */;
/*!50001 DROP TABLE IF EXISTS `list_pesanan_kasir` */;

/*!50001 CREATE TABLE  `list_pesanan_kasir`(
 `id_order` int(10) ,
 `no_meja` varchar(10) ,
 `tanggal` date ,
 `id_user` varchar(25) ,
 `keterangan` enum('dibuat','selesai') ,
 `status_order` enum('belum selesai','selesai') 
)*/;

/*Table structure for table `list_pesanan_waiter` */

DROP TABLE IF EXISTS `list_pesanan_waiter`;

/*!50001 DROP VIEW IF EXISTS `list_pesanan_waiter` */;
/*!50001 DROP TABLE IF EXISTS `list_pesanan_waiter` */;

/*!50001 CREATE TABLE  `list_pesanan_waiter`(
 `id_order` int(10) ,
 `no_meja` varchar(10) ,
 `tanggal` date ,
 `id_user` varchar(25) ,
 `keterangan` enum('dibuat','selesai') ,
 `status_order` enum('belum selesai','selesai') 
)*/;

/*View structure for view data_masakan */

/*!50001 DROP TABLE IF EXISTS `data_masakan` */;
/*!50001 DROP VIEW IF EXISTS `data_masakan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_masakan` AS (select `masakan`.`id_masakan` AS `id_masakan`,`masakan`.`nama_masakan` AS `nama_masakan`,`masakan`.`deskripsi` AS `deskripsi`,`masakan`.`harga` AS `harga`,`masakan`.`gambar` AS `gambar`,`kategori`.`nama_kategori` AS `kategori`,`masakan`.`id_kategori` AS `id_kategori`,`masakan`.`status_masakan` AS `status_masakan` from (`masakan` left join `kategori` on((`masakan`.`id_kategori` = `kategori`.`id`))) where (`masakan`.`soft_delete` = 1) order by `masakan`.`id_masakan` desc) */;

/*View structure for view data_user_level */

/*!50001 DROP TABLE IF EXISTS `data_user_level` */;
/*!50001 DROP VIEW IF EXISTS `data_user_level` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_user_level` AS (select `user`.`id_user` AS `id_user`,`user`.`username` AS `username`,`user`.`nama_user` AS `nama_user`,`user`.`password` AS `password`,`level`.`id_level` AS `id_level`,`level`.`nama_level` AS `nama_level` from (`user` left join `level` on((`level`.`id_level` = `user`.`id_level`))) order by `user`.`id_user`) */;

/*View structure for view list_pesanan */

/*!50001 DROP TABLE IF EXISTS `list_pesanan` */;
/*!50001 DROP VIEW IF EXISTS `list_pesanan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `list_pesanan` AS (select `o`.`id_order` AS `id_order`,`o`.`no_meja` AS `no_meja`,`o`.`tanggal` AS `tanggal`,`o`.`id_user` AS `id_user`,`o`.`keterangan` AS `keterangan`,`o`.`status_order` AS `status_order` from `orderan` `o` where (`o`.`status_order` = 'belum selesai')) */;

/*View structure for view list_pesanan_kasir */

/*!50001 DROP TABLE IF EXISTS `list_pesanan_kasir` */;
/*!50001 DROP VIEW IF EXISTS `list_pesanan_kasir` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `list_pesanan_kasir` AS (select `o`.`id_order` AS `id_order`,`o`.`no_meja` AS `no_meja`,`o`.`tanggal` AS `tanggal`,`o`.`id_user` AS `id_user`,`o`.`keterangan` AS `keterangan`,`o`.`status_order` AS `status_order` from `orderan` `o` where ((`o`.`status_order` = 'belum selesai') and (`o`.`keterangan` = 'selesai'))) */;

/*View structure for view list_pesanan_waiter */

/*!50001 DROP TABLE IF EXISTS `list_pesanan_waiter` */;
/*!50001 DROP VIEW IF EXISTS `list_pesanan_waiter` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `list_pesanan_waiter` AS (select `o`.`id_order` AS `id_order`,`o`.`no_meja` AS `no_meja`,`o`.`tanggal` AS `tanggal`,`o`.`id_user` AS `id_user`,`o`.`keterangan` AS `keterangan`,`o`.`status_order` AS `status_order` from `orderan` `o` where ((`o`.`keterangan` = 'dibuat') and (`o`.`status_order` = 'belum selesai'))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
