# Host: localhost  (Version 5.5.5-10.4.10-MariaDB)
# Date: 2022-07-07 20:29:58
# Generator: MySQL-Front 6.1  (Build 1.11)


#
# Structure for table "faskes"
#

DROP TABLE IF EXISTS `faskes`;
CREATE TABLE `faskes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `latlong` varchar(40) DEFAULT NULL,
  `jenis_id` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `skor_rating` double DEFAULT NULL,
  `foto1` text DEFAULT NULL,
  `foto2` text DEFAULT NULL,
  `foto3` text DEFAULT NULL,
  `kecamatan_id` int(11) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `jumlah_dokter` int(11) DEFAULT NULL,
  `jumlah_pegawai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_produk_jenis_produk_idx` (`jenis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "faskes"
#

INSERT INTO `faskes` VALUES (1,'RSUD Depok','Jl. Mana aja kek','25000',5,'2022-06-30',0,'1657197032111-1112273_ken-kaneki-tokyo-ghoul-hd-wallpaper-4k.jpg','ahmad fathan','seminar1.png',1,NULL,NULL,NULL),(2,'Puskesmas Grogol','Alamaat doang ko','200001',2,'2022-07-09',0,'1657197032111-1112273_ken-kaneki-tokyo-ghoul-hd-wallpaper-4k.jpg','sony wakwaw','1656993239640628296e5d6ba71daa2d906bb4d6d4.gif',2,NULL,NULL,NULL);

#
# Structure for table "jenis_faskes"
#

DROP TABLE IF EXISTS `jenis_faskes`;
CREATE TABLE `jenis_faskes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

#
# Data for table "jenis_faskes"
#

INSERT INTO `jenis_faskes` VALUES (1,'Rumah Sakit'),(2,'Apotek'),(3,'Bidan'),(4,'Puskesmas'),(5,'Posyandu');

#
# Structure for table "kecamatan"
#

DROP TABLE IF EXISTS `kecamatan`;
CREATE TABLE `kecamatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

#
# Data for table "kecamatan"
#

INSERT INTO `kecamatan` VALUES (1,'Limo'),(2,'Cinere'),(3,'Pancoran Mas'),(4,'Beji'),(5,'Sawangan'),(6,'Tanah Baru');

#
# Structure for table "komentar"
#

DROP TABLE IF EXISTS `komentar`;
CREATE TABLE `komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `faskes_id` int(11) NOT NULL DEFAULT 0,
  `nilai_rating_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Data for table "komentar"
#

INSERT INTO `komentar` VALUES (3,'2022-06-12','ingin kuliah di luar negeri',2,1,2),(5,'2022-07-06','pengen aja',5,2,2),(6,'2022-07-07','kurang orang',5,1,1);

#
# Structure for table "nilai_rating"
#

DROP TABLE IF EXISTS `nilai_rating`;
CREATE TABLE `nilai_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#
# Data for table "nilai_rating"
#

INSERT INTO `nilai_rating` VALUES (1,'Buruk'),(2,'Bagus');

#
# Structure for table "users"
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Data for table "users"
#

INSERT INTO `users` VALUES (1,'admin','202cb962ac59075b964b07152d234b70','admin@gmail.com','2022-06-12 07:07:42','2022-06-12 07:07:42',1,'administrator'),(2,'aminah','90b74c589f46e8f3a484082d659308bd','aminah@gmail.com','2022-06-12 07:07:44','2022-06-12 07:07:44',0,'public'),(5,'ilham','202cb962ac59075b964b07152d234b70','ilham@gmail.com','2022-07-06 14:37:51',NULL,1,'public');
