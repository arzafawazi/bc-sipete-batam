# Host: localhost  (Version 8.0.30)
# Date: 2024-11-08 15:29:08
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "cache"
#

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "cache"
#


#
# Structure for table "cache_locks"
#

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "cache_locks"
#


#
# Structure for table "failed_jobs"
#

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "failed_jobs"
#


#
# Structure for table "job_batches"
#

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "job_batches"
#


#
# Structure for table "jobs"
#

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "jobs"
#


#
# Structure for table "migrations"
#

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "migrations"
#

INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1);

#
# Structure for table "password_reset_tokens"
#

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "password_reset_tokens"
#


#
# Structure for table "sessions"
#

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "sessions"
#

INSERT INTO `sessions` VALUES ('0BWFs3QtRJtxXe3H3ehPZlHymCCwoGySoMKisVWU',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUldGS3NOdEtDSXU3QkFCWUp4VGpOcm40cXk4YXN2SHZMTnZsTkxjMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9Eb2twZW5pbmRha2FuL0RhZnRhclNicC9jcmVhdGU/bm9tb3JfbGFwb3Jhbj0xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9',1731052884);

#
# Structure for table "tbl_admin"
#

CREATE TABLE `tbl_admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_admin` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `nama_admin` varchar(60) NOT NULL DEFAULT '',
  `nip` varchar(35) NOT NULL,
  `pangkat` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `otoritas` varchar(25) NOT NULL DEFAULT '',
  `status` varchar(15) NOT NULL DEFAULT '',
  `tgl_insert` varchar(12) NOT NULL DEFAULT '',
  `wkt_insert` varchar(12) NOT NULL DEFAULT '',
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=167 DEFAULT CHARSET=latin1;

#
# Data for table "tbl_admin"
#

INSERT INTO `tbl_admin` VALUES (1,'BCKNO-00001','admin','22c85690d8ac2f8bf1b59cad6a8e0bb9','DEV. BEACUKAI KUALANAMU','---','---','---','ADMINISTRATOR','AKTIF','2016-09-04','00:00:00',NULL),(4,'BCKNO-00004','lando.ringo','effebf7b7ac984310f79f126edea710f','LANDO A. SIRINGO RINGO','198505172004121001','Penata Muda Tk. I- III/b','Kepala Subseksi Administrasi Manifes','PERBEN','AKTIF','2020-03-02','11:02:09',NULL),(37,'BCKNO-00037','tea.kirana','fc1cd60470d7575289ef9b731e05d7c3','TEA KIRANA','199504202015022003','Pengatur - II/c','Pelaksana Pemeriksa Pada Seksi P2','ANALIS','AKTIF','2024-08-01','20:33:17',NULL),(41,'BCKNO-00041','superadmin','bdcb5cb786e38d9a3321c9934dca4184','ADMINISTRATOR KODIC','---','-','-','ADMINISTRATOR','AKTIF','2018-10-08','21:45:09',NULL),(49,'BCKNO-00049','daniel.marnala','06293387f0c050d81e76cee5b91d599b','DANIEL MARNALA LUMBANTORUAN','199105032010121004','Pengatur Tk. I - II/d','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','AKTIF','2019-02-11','13:37:12',NULL),(53,'BCKNO-00053','dedy.sandy','d370bcab785bf27688ad0ce731145512','DEDY SANDY RAY SITANGGANG','199905082018121001','Pengatur Muda - II/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','NON-AKTIF','2023-03-21','14:36:33',NULL),(57,'BCKNO-00057','ellen.theresia','e99a2a814784ee45ea355baf425e831f','ELLEN THERESIA SITOMPUL','199607102018012001','Pengatur Tk.I- II/d','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','NON-AKTIF','2024-02-21','12:25:51',NULL),(58,'BCKNO-00058','annisyah.pratiwi','883b081ea5388e858778b7af2ad26ddf','ANNISYAH PRATIWI','199911112018122002','Pengatur Muda - II/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','NON-AKTIF','2023-12-11','13:39:13',NULL),(62,'BCKNO-00062','alfiatun.marfuah','310cccdd257994102c05a42be5bdaff1','ALFIATUN MARFUAH','199810162018122001','Pengatur Muda - II/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','NON-AKTIF','2023-03-21','14:35:38',NULL),(72,'BCKNO-00072','elfi.haris','9d593c86354b57a773d81abdd53f6a47','ELFI HARIS','197206021998031001','Pembina Tk.I - IV/b','Kepala Kantor','KA. KANTOR','NON-AKTIF','2023-09-19','16:11:49',NULL),(74,'BCKNO-00074','athur.morris','1edfd9e0e08a9dcef47c1f0171d9a61c','ATHUR MORRIS SIREGAR','198501152004121002','Penata Muda - III/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','NON-AKTIF','2024-01-17','13:26:49',NULL),(75,'BCKNO-00075','berkat.s','9b2a6af9a995884ad81bec2b08157dbe','BERKAT M.K SIAHAAN','198410242004121003','Penata Muda - III/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','AKTIF','2020-01-13','09:54:27',NULL),(77,'BCKNO-00077','yosia.sitindaon','2fda795791045f41c0d7a33b9ce31f50','YOSIA SITINDAON','199007032010011004','Pengatur Tk.I - II/d','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','AKTIF','2020-01-13','09:58:33',NULL),(80,'BCKNO-00080','rio.nanda','dc203bcf32f8aa7627f6e8014bd7ab84','RIO NANDA FERNANDO SINAGA','199906082018121003','Pengatur Muda - II/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','NON-AKTIF','2023-12-11','13:41:15',NULL),(81,'BCKNO-00081','andreas.turnip','b2861f10666cb38563ecd2a6dcdc8898','ANDREAS TURNIP','198401272003121004','Penata Muda Tk.I - III/b','Pemeriksa Bea dan Cukai Ahli Pertama','KASUBSI','NON-AKTIF','2023-09-19','16:11:00',NULL),(84,'BCKNO-00084','wilken.saragih','3bd32cc9499429e999f66fff24c3ed20','WILKEN FRANS FELLA SARAGIH','199008232009121001','Pengatur Tk.I - II/d','Pelaksana Pemeriksa pada Seksi Penindakan dan Penyidikan','PEMERIKSA','AKTIF','2020-04-22','09:20:17',NULL),(85,'BCKNO-00085','nuranisa.a','93fead413bf0f932ba9553d4936b4cb5','NURANISA','199905032018122002','Pengatur Muda Tk. I - II/b','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','AKTIF','2020-04-22','09:19:40',NULL),(86,'BCKNO-320044','dedew','c6ac923906dbfbedb34355bbc9601a93','DEWANGGA ARDALEFA ARITONANG','199809062018011003','Pengatur Muda Tk.I - II/b','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','NON-AKTIF','2023-12-11','13:40:07',NULL),(89,'BCKNO-674002','mutaqin','62a6d6c6cda06420783b382d4aee358b','MOHAMAD MUTAQIN','197606301999031001','Penata Tk.I - III/d','KEPALA SEKSI PENINDAKAN DAN PENYIDIKAN','KA. SEKSE','NON-AKTIF','2024-03-18','08:46:24',NULL),(90,'BCKNO-00000','-','bdcb5cb786e38d9a3321c9934dca4184','','','','','','AKTIF','','',NULL),(92,'BCKNO-495044','mahardhika.aryadhana','27d6589a25b37a2961fde89ed226da53','MAHARDHIKA ARYADHANA JATTIN','199710112018121001','Pengatur - II/c','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','NON-AKTIF','2023-12-11','13:40:49',NULL),(96,'BCKNO-903048','michael.sianipar','4be886729ef0b88baff61777f5361124','MICHAEL PARIWARA SIANIPAR','199203252012101001','Pengatur - II/c','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','NON-AKTIF','2023-12-11','13:40:56',NULL),(98,'BCKNO-315050','nizar.zulmi','c531a4f247cc0b028cd7f384949c0aed','NIZAR ZULMI','199102022012101001','Pengatur - II/c','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','AKTIF','2024-07-26','12:04:39',NULL),(99,'BCKNO-154051','davy.frederick','4650f58348623b9a1e3a78cf8af1ea59','DAVY FREDERICK HUTAGALUNG','198509092004121001','Penata Muda - III/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','NON-AKTIF','2023-09-19','16:11:19',NULL),(100,'BCKNO-982052','rahmadhani','d41c47d9689b70516efbddb9c787dbc8','RAHMADHANI','199203282013101001','Pengatur - II/c','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','NON-AKTIF','2023-09-19','16:12:12',NULL),(101,'BCKNO-102054','chandra.situmorang','e10adc3949ba59abbe56e057f20f883e','CHANDRA S. SITUMORANG','199012012010011001','Pengatur Tk.I - II/d','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','NON-AKTIF','2024-02-21','12:25:14',NULL),(102,'BCKNO-615055','bernard.pranoto','c9fbab7eea2df7b13db0b1104cfb18fd','BERNARD PRANOTO SAMOSIR','198503162006021001','Penata Muda - III/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','NON-AKTIF','2023-12-11','13:39:26',NULL),(103,'BCKNO-242056','bobby.hartanto','a5caf39af9cf6f0b40e09edb9eac6b55','BOBBY HARTANTO SINAGA','198609012006021002','Penata Muda Tk. I - III/b','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','AKTIF','2021-01-26','10:43:20',NULL),(106,'BCKNO-990059','bayu.prakoso','7922fa1f45cd2ed2bfe780939c3ba65c','BAYU PRAKOSO','198806012007011002','Penata Muda - III/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','NON-AKTIF','2023-03-21','14:35:33',NULL),(110,'BCKNO-677053','hannes.bakti','6440b43b994a5c88c46a6b108335ef23','HANNES BAKTI MANURUNG','199210012012101001','Pengatur - II/c','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','NON-AKTIF','2023-12-11','13:40:27',NULL),(112,'BCKNO-733050','godwind.lothar','75a2eeedf7d7094be6a5bc2195dc53ba','GODWIND LOTHAR MARUASA SINAGA','199012272013101001','Penata Muda - III/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','NON-AKTIF','2023-09-19','16:11:38',NULL),(117,'BCKNO-490003','adminkodic','98f73c4e5fd70bf6cd6a8f566aa6624d','ADMINISTRATOR KODIC','-','-','-','ADMINISTRATOR','AKTIF','2022-01-28','13:45:58',NULL),(118,'BCKNO-798038','perben.kno','5fcb24fa3be5875b37efc528e47c76df','SEKSI PERBENDAHARAAN','-','-','-','PERBEN','AKTIF','2022-08-15','10:28:23',NULL),(119,'BCKNO-525038','riri.rena','0644bb2d1f6a6aa9c90653f18438a91d','RIRI RENA DAHLIANA ZAI','199804102018122001','Pengatur Muda Tk. I - II/b','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','AKTIF','2022-05-14','10:01:11',NULL),(120,'BCKNO-798039','maria.novalina','e9de80137a46d83c4ee8d11fa142edce','MARIA NOVALINA SIMANGUNSONG','200010022018122001','Pengatur Muda Tk. I - II/b','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','AKTIF','2022-05-14','10:02:47',NULL),(121,'BCKNO-526040','fitri.malinda','5005e8d527426553779d22df72d5612f','FITRI MALINDA HARAHAP','199801292018122001','Pengatur Muda Tk. I - II/b','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','AKTIF','2022-05-14','10:04:19',NULL),(122,'BCKNO-777041','cristianto','be33bd14052af42de3be863e33c52413','CRISTIANTO','199312172013101001','Pengatur - II/c','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','AKTIF','2022-05-14','10:05:55',NULL),(123,'BCKNO-323042','tri.handoko','b71a9ceebd028cb1023ac059c00157a2','TRI HANDOKO','199505232015021003','Pengatur - II/c','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','AKTIF','2022-05-14','10:07:48',NULL),(125,'BCKNO-893044','febryan.praja','e55b2813378fd219254838643f14e8ee','FEBRYAN PRAJA SIMBOLON','198902122010011008','Penata Muda - III/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','AKTIF','2022-05-14','10:11:55',NULL),(126,'BCKNO-191004','pdad','e10adc3949ba59abbe56e057f20f883e','PDAD','-','-','Seksi PDAD','ADMINISTRATOR','AKTIF','2024-02-21','12:26:59',NULL),(127,'BCKNO-699040','dimas.giotiffano','b5a90f0cdf04f0707398150cfd701a7f','DIMAS GIOTIFFANO PUTRA','199105182013101004','Penata Muda - III/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA','AKTIF','2022-09-05','09:59:22',NULL),(128,'BCKNO-900041','nency_dewi','7b8e4bb85c16e9ce137a79314424ca8f','NENCY DEWI NAPITUPULU','197804182003122002','III/c','Pelaksana Pemeriksa','PEMERIKSA','NON-AKTIF','2023-03-21','14:35:53',NULL),(129,'BCKNO-366004','aan.sundari','2cc08b55ecaafb95e0b602f6c7b73323','AAN SUNDARI','198109132000121001','Penata Muda Tk.I - III/b','Pemeriksa Bea dan Cukai Ahli Pertama','KASUBSI','NON-AKTIF','2024-02-07','16:31:52',NULL),(130,'BCKNO-345005','joi.simorangkir','0fd061b3ec4740078fdcf31e993128a7','JOI ARIANTO SIMORANGKIR','198002182000011001','Penata Muda Tk.I - III/b','Pemeriksa Bea dan Cukai Ahli Pertama','KASUBSI','NON-AKTIF','2023-12-11','13:40:36',NULL),(131,'BCKNO-110038','irfan.sinaga','9f8e91f76ca9217e4e579c4e91064c94','IRFAN H. SINAGA','199106112014111001','Penata Muda - III/a','Pelaksana Pada Seksi P2','PEMERIKSA','AKTIF','2023-01-17','14:15:47',NULL),(132,'BCKNO-901039','mutammimul.ula','900b9671126dd82d06ad83582c3555a3','MUTAMMIMUL ULA','199302112012101001','Pengatur Tk.I - II/d','Pelaksana Pemeriksa pada Seksi Penindakan dan Penyidikan','PEMERIKSA','AKTIF','2023-01-17','14:23:31',NULL),(133,'BCKNO-551040','boy.tarsan','c9b2377991d2360ce836303b49bb056c','BOY TARSAN PANGARIBUAN','199311162013101002','Pengatur - II/c','Pelaksana Pada Seksi P2','PEMERIKSA','AKTIF','2023-01-17','14:23:38',NULL),(134,'BCKNO-220041','ferdi.gunawan','afa96eb39568816532d556425c9720eb','FERDI RIZKY GUNAWAN','199805102018121001','Pengatur Muda Tk. I - II/b','Pelaksana Pada Seksi P2','PEMERIKSA','AKTIF','2023-01-17','14:25:11',NULL),(135,'BCKNO-715036','ferizal.gunawan','301feea4a05fe4ce351dfcb1ab94054b','FERIZAL GUNAWAN','199812012018121001','Pengatur Muda - II.a','Pelaksana Pemeriksa','PEMERIKSA','NON-AKTIF','2024-01-17','13:26:34',NULL),(136,'BCKNO-403037','hariyani.dewi','c052b1d96dddc13e976770a806f4e9b0','HARIYANI KURNIA DEWI','199805172018122001','Pengatur Muda Tk. I - II/b','Pelaksana Pemeriksa','PEMERIKSA','AKTIF','2023-03-21','14:41:26',NULL),(137,'BCKNO-486038','christin.oktaviana','4c02abfad5eb2b51f91a22fc809c10d0','CHRISTIN OKTAVIANA','199510102015122001','Pengatur Muda Tk.I - II.b','Pelaksana Pemeriksa','PEMERIKSA','AKTIF','2023-03-21','14:43:31',NULL),(138,'BCKNO-338039','frans.pasaribu','b1eb0b88184cce26dc27af5f448722a6','FRANS AFRIANDI PASARIBU','197704271996031001','Penata - III.c','Pelaksana Pemeriksa','PEMERIKSA','AKTIF','2023-03-21','14:46:24',NULL),(139,'BCKNO-509040','melinton. nababan','90073e6a2e31fca4b9790d1737cdbdc5','MELINTON SORITUA NABABAN','198905252010011002','Pengatur Tk. I / II.d','Pelaksana Pemeriksa','PEMERIKSA','AKTIF','2023-06-06','09:40:43',NULL),(140,'BCKNO-945041','rinaldi.ginting','e10adc3949ba59abbe56e057f20f883e','M. RINALDI GINTING','198604272007101001','Penata Muda - III/a','Pelaksana Pemeriksa','PEMERIKSA','AKTIF','2023-06-06','09:52:55',NULL),(141,'BCKNO-409042','regita.ayu','0b2e134de6091f5e37bd92b09cc95c6b','REGITA AYU CAHYANI SURBAKTI','199707092018012001','Pengatur Muda Tk.I / II.b','Pelaksana Pemeriksa','PEMERIKSA','AKTIF','2023-06-06','09:55:55',NULL),(142,'BCKNO-963043','lewi.kuasa','83450bcf053393302c20f9e23d823cee','LEWI KUASA HUTABARAT','200006112018121001','Pengatur Muda Tk.I','Pelaksana Pemeriksa','PEMERIKSA','NON-AKTIF','2024-09-11','13:18:13',NULL),(143,'BCKNO-638044','ericco.fatwa','3fb6ef42240656e81d644c59a98c282f','ERICCO FATWA M','199904252018121001','Pengatur Muda Tk.I / II.b','Pelaksana Pemeriksa','PEMERIKSA','AKTIF','2023-06-06','10:01:26',NULL),(144,'BCKNO-324005','muhammad.syah putra','cf89a48b0b5c47bee4fd6e1730acf1cb','MUHAMMAD SYAH PUTRA','198209192000121002','III/c','Pemeriksa Bea Cukai Ahli Pertama','KASUBSI','NON-AKTIF','2024-01-17','11:22:55',NULL),(145,'BCKNO-562045','daniel.bryan','12d57ed953d634e77128b6ad1d2ff1f8','DANIEL BRYAN','199403122015021001','Penata Muda - III/a','Pelaksana Pemeriksa','PEMERIKSA','AKTIF','2023-11-22','17:10:46',NULL),(146,'BCKNO-787046','urie.dinure','543cfd2fbb391d028c5be2b05f263e3a','URIE DINURE TERRANOVA','199504122015022001','Pengatur / II.c','Pelaksana Pemeriksa','PEMERIKSA','AKTIF','2023-11-22','17:16:44',NULL),(148,'BCKNO-974048','agung.tasyakury','10d9819b0e2d4800b4d955fc2ac3aa80','AGUNG TASYAKURY','199508182016121001','Pengatur Tk. I / II.d','Pelaksana Pemeriksa','PEMERIKSA','AKTIF','2023-11-22','17:23:19',NULL),(150,'BCKNO-253050','ahmad.zakiy','e219aef7c49e62bfa376312d814431c4','AHMAD ZAKIY','198910172010011002','Pengatur Tk. I / II.d','Pelaksana Pemeriksa','PEMERIKSA','AKTIF','2023-11-22','17:22:48',NULL),(151,'BCKNO-187051','yowanda.pramana','1e7e7729f7431ef2392e3cc48d18c285','YOWANDA PRAMANA','199001252009121001','III.a','Pelaksana Pemeriksa','PEMERIKSA','AKTIF','2023-11-22','17:26:43',NULL),(152,'BCKNO-726051','loksa.restu','971c6f4142e6b29120e93d26c1fe097f','LOKSA RESTU SIANTURI','199210262013101001','Penata Muda - III/a','Pelaksana Pemeriksa','PEMERIKSA','AKTIF','2023-11-29','16:40:27',NULL),(153,'BCKNO-486052','zulfahmi','1820307bbf020cd021a13309e9ad5941','ZULFAHMI','198211062001121001','Penata Muda Tk. I','Pelaksana Pemeriksa','PEMERIKSA','AKTIF','2023-12-11','13:34:40',NULL),(154,'BCKNO-283053','mouchlizar','86c9f2b8b2b3ad1bc6a3651a2aec98b6','MOUCHLIZAR','198505162004121003','Penata Muda - III/a','Pelaksana Pemeriksa','PEMERIKSA','AKTIF','2023-12-11','13:36:35',NULL),(155,'BCKNO-650054','cintami.efrika','0e648eccd757b2fb8f5e02af85e58a31','CINTAMI EFRIKA ENJELINA BR HUTABARAT','199904212018122002','Penata Muda Tk.I','Pelaksana Pemeriksa','PEMERIKSA','NON-AKTIF','2024-09-11','13:10:53',NULL),(156,'BCKNO-147006','dian.eka','d9158aa20cf9b5a212fc8e21d96970ba','DIAN EKA SAPUTRA','198211062002121002','Penata Muda Tk. I - III/b','PEMERIKSA BEA CUKAI PERTAMA','KASUBSI','AKTIF','2024-01-08','10:51:15',NULL),(157,'BCKNO-646007','duly.endewi','312ee5dde135a3504de7f2ab660ac574','DULY ENDEWI','198406292004121003','III.B / PENATA MUDA TINGKAT I','PEMERIKSA BEA CUKAI PERTAMA','KASUBSI','NON-AKTIF','2024-07-04','11:41:17',NULL),(158,'BCKNO-380054','Afifah Siregar','af0896a0a1a02a01077f802598907a96','AFIFAH WAHYUNI SIREGAR','199912032018122002','Pengatur Muda Tk.I','Pelaksana Pemeriksa','PEMERIKSA','AKTIF','2024-08-01','20:34:05',NULL),(160,'BCKNO-841007','hermansyah','3c4e14556cf92b906e4553356726861d','HERMANSYAH','198505242004121002','Penata Muda Tk. I / III.b','Pemeriksa Bea dan Cukai Pertama','KASUBSI','AKTIF','2024-03-06','11:01:41',NULL),(161,'BCKNO-687002','fadli.rahman','d41d8cd98f00b204e9800998ecf8427e','FADLI RAHMAN','198404272010121004','Penata Tk.I - III/d','KEPALA SEKSI PENINDAKAN DAN PENYIDIKAN','KA. SEKSE','AKTIF','2024-03-18','08:46:29',NULL),(162,'BCKNO-768002','Richi.Rizky','aa21393366593120409bb43ccf7d2744','RICHI RIZKY ALJAFARSYAH','1999021920181210011','Pengatur Muda Tk.I / II.b','Pelaksana Pemeriksa','ANALIS','AKTIF','2024-07-24','14:41:03',NULL),(163,'BCKNO-914001','Seksi.KI','fd9d84fce1bf293cba119621aa0e3bb7','SEKSI KEPATUHAN INTERNAL','1234','-','-','K.I','AKTIF','2024-08-01','15:31:51',NULL),(165,'BCKNO-536008','Fery.Alamsyah','70bcf3952257e6f0ab36e7483b4ad13a','FERY ALAMSYAH','198207262003121002','Penata Muda Tk.I / III.b','Pemeriksa Bea dan Cukai Pertama','KASUBSI','AKTIF','2024-08-06','15:50:06',NULL),(166,'BCKNO-673055','Robert.Tanta','efe85fcd4b00814b7166c1ef4f01f78e','ROBERT TANTA PERANGIN-ANGIN','199509082018011002','Pengatur Tk.I / II.d','Pelaksana Pemeriksa','PEMERIKSA','AKTIF','2024-08-11','11:08:54',NULL);

#
# Structure for table "tbl_akses_menu"
#

CREATE TABLE `tbl_akses_menu` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_admin` varchar(30) NOT NULL DEFAULT '',
  `username` varchar(25) NOT NULL DEFAULT '',
  `kode_menu` varchar(10) NOT NULL DEFAULT '',
  `opsi` varchar(5) NOT NULL DEFAULT '',
  `tgl_insert` varchar(12) NOT NULL DEFAULT '',
  `wkt_insert` varchar(12) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33681 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

#
# Data for table "tbl_akses_menu"
#

INSERT INTO `tbl_akses_menu` VALUES (33602,'PENGUASA','arza','01','YES','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33603,'PENGUASA','arza','02','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33604,'PENGUASA','arza','021','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33605,'PENGUASA','arza','022','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33606,'PENGUASA','arza','03','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33607,'PENGUASA','arza','031','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33608,'PENGUASA','arza','04','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33609,'PENGUASA','arza','041','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33610,'PENGUASA','arza','05','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33611,'PENGUASA','arza','051','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33612,'PENGUASA','arza','052','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33613,'PENGUASA','arza','06','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33614,'PENGUASA','arza','061','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33615,'PENGUASA','arza','062','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33616,'PENGUASA','arza','063','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33617,'PENGUASA','arza','07','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33618,'PENGUASA','arza','071','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33619,'PENGUASA','arza','072','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33620,'PENGUASA','arza','073','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33621,'PENGUASA','arza','08','YES','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33622,'PENGUASA','arza','081','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33623,'PENGUASA','arza','082','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33624,'PENGUASA','arza','083','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33625,'PENGUASA','arza','084','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33626,'PENGUASA','arza','085','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33627,'PENGUASA','arza','086','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33628,'PENGUASA','arza','087','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33629,'PENGUASA','arza','088','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33630,'PENGUASA','arza','089','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33631,'PENGUASA','arza','0810','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33632,'PENGUASA','arza','0811','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33633,'PENGUASA','arza','0812','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33634,'PENGUASA','arza','0813','YES','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33635,'PENGUASA','arza','0814','YES','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33636,'PENGUASA','arza','0815','YES','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33637,'PENGUASA','arza','0816','YES','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33638,'PENGUASA','arza','09','YES','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33639,'PENGUASA','arza','091','YES','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33640,'PENGUASA','arza','092','YES','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33641,'PENGUASA','arza','093','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33642,'PENGUASA','arza','10','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33643,'PENGUASA','arza','101','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33644,'PENGUASA','arza','102','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33645,'PENGUASA','arza','11','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33646,'PENGUASA','arza','111','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33647,'PENGUASA','arza','112','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33648,'PENGUASA','arza','113','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33649,'PENGUASA','arza','114','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33650,'PENGUASA','arza','12','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33651,'PENGUASA','arza','121','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33652,'PENGUASA','arza','122','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33653,'PENGUASA','arza','123','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33654,'PENGUASA','arza','124','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33655,'PENGUASA','arza','13','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33656,'PENGUASA','arza','131','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33657,'PENGUASA','arza','132','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33658,'PENGUASA','arza','133','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33659,'PENGUASA','arza','134','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33660,'PENGUASA','arza','135','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33661,'PENGUASA','arza','14','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33662,'PENGUASA','arza','141','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33663,'PENGUASA','arza','142','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33664,'PENGUASA','arza','143','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33665,'PENGUASA','arza','144','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33666,'PENGUASA','arza','145','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33667,'PENGUASA','arza','146','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33668,'PENGUASA','arza','15','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33669,'PENGUASA','arza','151','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33670,'PENGUASA','arza','152','NO','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33671,'PENGUASA','arza','20','YES','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33672,'PENGUASA','arza','201','YES','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33673,'PENGUASA','arza','202','YES','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33674,'PENGUASA','arza','203','YES','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33675,'PENGUASA','arza','18','YES','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33676,'PENGUASA','arza','181','YES','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33677,'PENGUASA','arza','182','YES','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33678,'PENGUASA','arza','183','YES','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33679,'PENGUASA','arza','184','YES','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43'),(33680,'PENGUASA','arza','185','YES','2024-11-07','06:14:43','2024-11-07 06:14:43','2024-11-07 06:14:43');

#
# Structure for table "tbl_bc"
#

CREATE TABLE `tbl_bc` (
  `id_ttd` int NOT NULL AUTO_INCREMENT,
  `tempat_ttd` varchar(25) DEFAULT NULL,
  `penerbit_prin` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id_ttd`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_bc"
#


#
# Structure for table "tbl_ctp"
#

CREATE TABLE `tbl_ctp` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `id_ctp` varchar(25) DEFAULT NULL,
  `no_ctp` varchar(11) DEFAULT NULL,
  `tgl_ctp` varchar(11) DEFAULT NULL,
  `id_ttd` int DEFAULT NULL,
  `no_prin` varchar(25) DEFAULT NULL,
  `tanggal_print` varchar(15) DEFAULT NULL,
  `id_admin` varchar(50) DEFAULT NULL,
  `nama_saksi` varchar(55) DEFAULT NULL,
  `alamat_saksi` varchar(255) DEFAULT NULL,
  `pekerjaan_saksi` varchar(35) DEFAULT NULL,
  `no_identitas_saksi` varchar(25) DEFAULT NULL,
  `kontak_saksi` varchar(20) DEFAULT NULL,
  `nama_jenis_sarkut` varchar(255) DEFAULT NULL,
  `no_flight` varchar(15) DEFAULT NULL,
  `kapasitas_muatan` varchar(25) DEFAULT NULL,
  `pengemudi` varchar(55) DEFAULT NULL,
  `no_identitas_pengemudi` varchar(25) DEFAULT NULL,
  `KdEdi` varchar(2) DEFAULT NULL,
  `no_polisi` varchar(25) DEFAULT NULL,
  `jumlah_jenis_ukuran_no` varchar(55) DEFAULT NULL,
  `id_kemasan` varchar(25) DEFAULT NULL,
  `jumlah_barang` varchar(255) DEFAULT NULL,
  `jenis_barang` varchar(255) DEFAULT NULL,
  `jenis_no_tgl_dok` varchar(255) DEFAULT NULL,
  `pemilik` varchar(55) DEFAULT NULL,
  `no_identitas_pemilik` varchar(255) DEFAULT NULL,
  `alamat_bangunan` varchar(255) DEFAULT NULL,
  `no_bangunan` varchar(255) DEFAULT NULL,
  `nama_pemilik_bangunan` varchar(25) DEFAULT NULL,
  `no_identitas_pemilik_bangunan` varchar(255) DEFAULT NULL,
  `id_jenis_ctp` varchar(15) DEFAULT NULL,
  `jumlah_ctp` varchar(25) DEFAULT NULL,
  `peletakan_ctp` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_ctp"
#


#
# Structure for table "tbl_jenis_ctp"
#

CREATE TABLE `tbl_jenis_ctp` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `id_jenis_ctp` varchar(15) DEFAULT NULL,
  `jenis_ctp` varchar(55) DEFAULT NULL,
  `nomor_ctp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_jenis_ctp"
#


#
# Structure for table "tbl_jenis_npp"
#

CREATE TABLE `tbl_jenis_npp` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `id_jenis_npp` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_jenis_npp"
#


#
# Structure for table "tbl_jenis_pelanggaran"
#

CREATE TABLE `tbl_jenis_pelanggaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_jenis_pelanggaran` varchar(25) DEFAULT NULL,
  `alasan_penindakan` text,
  `jenis_pelanggaran` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_jenis_pelanggaran"
#

INSERT INTO `tbl_jenis_pelanggaran` VALUES (1,'id_penindakan_1','Salah memberitahukan barang Larangan dan Pembatasan dari/ke dalam Kawasan Perdagangan Bebas dan Pelabuhan Bebas','Pasal 71 ayat (1) PP No. 41 Tahun 2021'),(2,'id_penindakan_2','Tidak memberitahukan/ memberitahukan secara tidak benar barang Larangan dan Pembatasan dari/ke dalam Kawasan Perdagangan Bebas dan Pelabuhan Bebas','Pasal 71 ayat (2) PP No. 41 Tahun 2021'),(3,'id_penindakan_3','Mengangkut barang impor yang tidak tercantum dalam manifes','Pasal 102 huruf (a) UU NO. 17 Tahun 2006'),(4,'id_penindakan_4','Membongkar barang impor di luar kawasan pabean tanpa izin','Pasal 102 huruf (b) UU NO. 17 Tahun 2006'),(5,'id_penindakan_5','Membongkar barang impor selain dalam pemberitahuan pabean','Pasal 102 huruf (c) UU NO. 17 Tahun 2006'),(6,'id_penindakan_6','Membongkar / menimbun barang impor dalam pengawasan di tempat lain ','Pasal 102 huruf (d) UU NO. 17 Tahun 2006'),(7,'id_penindakan_7','Menyembunyikan barang impor secara melawan hukum ','Pasal 102 huruf (e) UU NO. 17 Tahun 2006'),(8,'id_penindakan_8','Mengeluarkan barang impor tanpa izin petugas Bea dan Cukai','Pasal 102 huruf (f) UU NO. 17 Tahun 2006'),(9,'id_penindakan_9','Mengangkut barang impor bukan ke kantor pabean','Pasal 102 huruf (g) UU NO. 17 Tahun 2006'),(10,'id_penindakan_10','Memberitahukan salah jenis dan/atau jumlah barang impor dengan sengaja','Pasal 102 huruf (h) UU NO. 17 Tahun 2006'),(11,'id_penindakan_11','Menyerahkan pemberitahuan pabean palsu / dipalsukan','Pasal 103 huruf (a) UU NO. 17 Tahun 2006'),(12,'id_penindakan_12','Menimbun/membeli/menjual barang impor berasal dari tindak pidana','Pasal 103 huruf (d) UU NO. 17 Tahun 2006'),(13,'id_penindakan_13','Mengangkut barang hasil tindak pidana pasal 102, 102A atau 102B','Pasal 104 huruf (a) UU NO. 17 Tahun 2006'),(14,'id_penindakan_14','Memberitahukan salah jenis dan/atau jumlah barang impor yang mengakibatkan kekurangan pembayaran','Pasal 82 ayat 5 UU NO. 17 Tahun 2006'),(15,'id_penindakan_15','Salah memberitahukan barang yang dilarang/ dibatasi yg tidak memenuhi syarat-syarat diimpor / diekspor','Pasal 53 ayat 3 UU NO. 17 Tahun 2006'),(16,'id_penindakan_16','Tidak memberitahukan dan /atau memberitahukan secara tidak benar barang yg dilarang atau dibatasi diimpor atau diekspor','Pasal 53 ayat 4 UU NO. 17 Tahun 2006'),(17,'id_penindakan_17','Salah memberitahukan nilai pabean sehingga mengakibatkan kekurangan pembayaran','Pasal 16 ayat 4 UU NO. 17 Tahun 2006'),(18,'id_penindakan_18','Membongkar barang impor kurang dari RKSP','Pasal 10 A ayat 3 UU NO. 17 Tahun 2006'),(19,'id_penindakan_19','Membongkar barang impor lebih dari RKSP','Pasal 10 A ayat 4 UU NO. 17 Tahun 2006'),(20,'id_penindakan_20','Pengangkut yang tidak menyerahkan RKSP sesuai ketentuan','Pasal 7 A ayat 7 UU NO. 17 Tahun 2006'),(21,'id_penindakan_21','Pengangkut yang tidak menyerahkan manifest sesuai ketentuan','Pasal 7 A ayat 8 UU NO. 17 Tahun 2006'),(22,'id_penindakan_22','Membongkar barang impor yang kurang dari manifes','Pasal 8 A ayat 2 UU NO. 17 Tahun 2006'),(23,'id_penindakan_23','Membongkar barang impor yang lebih dari manifes','Pasal 8 A ayat 3 UU NO. 17 Tahun 2006'),(24,'id_penindakan_24','Mengeluarkan barang impor dari TPS sebelum persetujuan tanpa bermaksud mengelak kewajiban pabean','Pasal 10 A ayat 8 UU NO. 17 Tahun 2006'),(25,'id_penindakan_25','Tidak melunasi Bea masuk dalam jangka waktu yang ditetapkan ','Pasal 10 B ayat 6 UU NO. 17 Tahun 2006'),(26,'id_penindakan_26','Terlambat mere-ekspor barang impor sementara ','Pasal 10 D ayat 5 UU NO. 17 Tahun 2006'),(27,'id_penindakan_27','Tidak mere-ekspor barang impor sementara ','Pasal 10 D ayat 6 UU NO. 17 Tahun 2006'),(28,'id_penindakan_28','Tidak melaporkan pembatalan ekspor','Pasal 11 A ayat 6 UU NO. 17 Tahun 2006'),(29,'id_penindakan_29','Penetapan kembali Nilai Pabean akibat kesalahan nilai transaksi yang mengakibatkan kekurangan pembayaran ','Pasal 17 ayat 4 UU NO. 17 Tahun 2006'),(30,'id_penindakan_30','Tidak memenuhi ketentuan pembebasan Bea Masuk','Pasal 25 ayat 4 UU NO. 17 Tahun 2006'),(31,'id_penindakan_31','Tidak memenuhi ketentuan pembebasan / keringanan Bea Masuk','Pasal 26 ayat 4 UU NO. 17 Tahun 2006'),(32,'id_penindakan_32','Pengusaha TPS yang tidak dapat mempertanggung jawabkan barang yang seharusnya berada di tempat tersebut','Pasal 43 ayat 3 UU NO. 17 Tahun 2006'),(33,'id_penindakan_33','Mengangkut barang tertentu yang kurang/lebih dari pemberitahuan','Pasal 8 C ayat 3 UU NO. 17 Tahun 2006'),(34,'id_penindakan_34','Mengangkut barang tertentu yang tidak dilindungi dokumen sah','Pasal 8 C ayat 4 UU NO. 17 Tahun 2006'),(35,'id_penindakan_35','Tidak menyelenggarakan pembukuan yang diwajibkan ','Pasal 52 ayat 1 UU NO. 17 Tahun 2006'),(36,'id_penindakan_36','Tidak memenuhi ketentuan pembukuan yang diwajibkan','Pasal 52 ayat 2 UU NO. 17 Tahun 2006'),(37,'id_penindakan_37','Mengakses sistem elektronik kepabeanan secara tidak sah','Pasal 103 A ayat 1 UU NO. 17 Tahun 2006'),(38,'id_penindakan_38','Memusnahkan buku / catatan yang seharusnya disimpan','Pasal 104 huruf (b) UU NO. 17 Tahun 2006'),(39,'id_penindakan_39','Menghilangkan keterangan dalam pemberitahuan pabean','Pasal 104 huruf (c) UU NO. 17 Tahun 2006'),(40,'id_penindakan_40','Menyimpan / menyediakan blangko faktur yang bukan miliknya','Pasal 104 huruf (d) UU NO. 17 Tahun 2006'),(41,'id_penindakan_41','Merusak segel / tanda pengaman dengan sengaja / tanpa hak','Pasal 105 UU NO. 17 Tahun 2006'),(42,'id_penindakan_42','Mengangkut barang tertentu tidak sampai ke kantor pabean tujuan','Pasal 102 D UU NO. 17 Tahun 2006'),(43,'id_penindakan_43','Memalsukan data ke buku atau catatan','Pasal 103 huruf (b) UU NO. 17 Tahun 2006'),(44,'id_penindakan_44','Memberikan keterangan lisan atau tulisan yang tidak benar','Pasal 103 huruf (c) UU NO. 17 Tahun 2006'),(45,'id_penindakan_45','Ditemukan adanya kekurangan pembayaran BM dalam audit kepabeanan karena salah pemberitahuan jumlah dan/atau jenis barang ','Pasal 86 A UU NO. 17 Tahun 2006'),(46,'id_penindakan_46','Mengekspor barang tanpa pemberitahuan pabean','Pasal 102 A huruf (a) UU NO. 17 Tahun 2006'),(47,'id_penindakan_47','Memberitahukan salah jenis dan/atau jumlah barang ekspor dengan sengaja','Pasal 102 A huruf (b) UU NO. 17 Tahun 2006'),(48,'id_penindakan_48','Memuat barang ekspor di luar kawasan pabean','Pasal 102 A huruf (c) UU NO. 17 Tahun 2006'),(49,'id_penindakan_49','Membongkar barang ekspor tanpa izin kepala kantor pabean','Pasal 102 A huruf (d) UU NO. 17 Tahun 2006'),(50,'id_penindakan_50','Memberitahukan salah jenis dan/atau jumlah barang ekspor yg mengakibatkan tidak terpenuhinya pungutan ekspor','Pasal 82 ayat 6 UU NO. 17 Tahun 2006'),(51,'id_penindakan_51','Tidak melaporkan pembatalan ekspor','Pasal 11 A ayat 6 UU NO. 17 Tahun 2006'),(52,'id_penindakan_52','Mengangkut barang ekspor tanpa menyerahkan manifest sebelum keberangkatan ','Pasal 9 A ayat 3 UU NO. 17 Tahun 2006'),(53,'id_penindakan_53','Menyerahkan pemberitahuan pabean palsu / dipalsukan','Pasal 103 huruf (a) UU NO. 17 Tahun 2006'),(54,'id_penindakan_54','Memalsukan data ke buku atau catatan','Pasal 103 huruf (b) UU NO. 17 Tahun 2006'),(55,'id_penindakan_55','Memberikan keterangan lisan atau tulisan yang tidak benar','Pasal 103 huruf (c) UU NO. 17 Tahun 2006'),(56,'id_penindakan_56','Mengangkut barang tertentu yang kurang/lebih dari pemberitahuan','Pasal 8 C ayat 3 UU NO. 17 Tahun 2006'),(57,'id_penindakan_57','Mengangkut barang tertentu yang tidak dilindungi dokumen sah','Pasal 8 C ayat 4 UU NO. 17 Tahun 2006'),(58,'id_penindakan_58','Tidak menyelenggarakan pembukuan yang diwajibkan ','Pasal 52 ayat 1 UU NO. 17 Tahun 2006'),(59,'id_penindakan_59','Tidak memenuhi ketentuan pembukuan yang diwajibkan','Pasal 52 ayat 2 UU NO. 17 Tahun 2006'),(60,'id_penindakan_60','Mengakses sistem elektronik kepabeanan secara tidak sah','Pasal 103 A ayat 1 UU NO. 17 Tahun 2006'),(61,'id_penindakan_61','Memusnahkan buku / catatan yang seharusnya disimpan','Pasal 104 huruf (b) UU NO. 17 Tahun 2006'),(62,'id_penindakan_62','Menghilangkan keterangan dalam pemberitahuan pabean','Pasal 104 huruf (c) UU NO. 17 Tahun 2006'),(63,'id_penindakan_63','Menyimpan / menyediakan blangko faktur yang bukan miliknya','Pasal 104 huruf (d) UU NO. 17 Tahun 2006'),(64,'id_penindakan_64','Merusak segel / tanda pengaman dengan sengaja / tanpa hak','Pasal 105 UU NO. 17 Tahun 2006'),(65,'id_penindakan_65','Mengangkut barang tertentu tidak sampai ke kantor pabean tujuan','Pasal 102 D UU NO. 17 Tahun 2006'),(66,'id_penindakan_66','Memalsukan data ke buku atau catatan','Pasal 103 huruf (b) UU NO. 17 Tahun 2006'),(67,'id_penindakan_67','Memberikan keterangan lisan atau tulisan yang tidak benar','Pasal 103 huruf (c) UU NO. 17 Tahun 2006'),(68,'id_penindakan_68','Mengeluarkan barang dari TPB sebelum persetujuan tanpa bermaksud mengelakkan kewajiban pabean','Pasal 45 ayat 3 UU NO. 17 Tahun 2006'),(69,'id_penindakan_69','Pengusaha TPB yang tidak dapat mempertanggungjawabkan barang yang seharusnya berada di tempat tersebut','Pasal 45 ayat 4 UU NO. 17 Tahun 2006'),(70,'id_penindakan_70','Tidak menyelenggarakan pembukuan yang diwajibkan ','Pasal 52 ayat 1 UU NO. 17 Tahun 2006'),(71,'id_penindakan_71','Tidak memenuhi ketentuan pembukuan yang diwajibkan','Pasal 52 ayat 2 UU NO. 17 Tahun 2006'),(72,'id_penindakan_72','Tidak memenuhi ketentuan pembebasan Bea Masuk','Pasal 25 ayat 4 UU NO. 17 Tahun 2006'),(73,'id_penindakan_73','Tidak memenuhi ketentuan pembebasan / keringanan Bea Masuk','Pasal 26 ayat 4 UU NO. 17 Tahun 2006'),(74,'id_penindakan_74','Membongkar barang impor di luar kawasan pabean tanpa izin','Pasal 102 huruf (b) UU NO. 17 Tahun 2006'),(75,'id_penindakan_75','Membongkar barang impor selain dalam pemberitahuan pabean','Pasal 102 huruf (c) UU NO. 17 Tahun 2006'),(76,'id_penindakan_76','Membongkar / menimbun barang impor dalam pengawasan di tempat lain ','Pasal 102 huruf (d) UU NO. 17 Tahun 2006'),(77,'id_penindakan_77','Menyembunyikan barang impor secara melawan hukum ','Pasal 102 huruf (e) UU NO. 17 Tahun 2006'),(78,'id_penindakan_78','Mengeluarkan barang impor tanpa izin petugas Bea dan Cukai','Pasal 102 huruf (f) UU NO. 17 Tahun 2006'),(79,'id_penindakan_79','Mengangkut barang impor bukan ke kantor pabean','Pasal 102 huruf (g) UU NO. 17 Tahun 2006'),(80,'id_penindakan_80','Memberitahukan salah jenis dan/atau jumlah barang impor dengan sengaja','Pasal 102 huruf (h) UU NO. 17 Tahun 2006'),(81,'id_penindakan_81','Menyerahkan pemberitahuan pabean palsu / dipalsukan','Pasal 103 huruf (a) UU NO. 17 Tahun 2006'),(82,'id_penindakan_82','Menimbun/membeli/menjual barang impor berasal dari tindak pidana','Pasal 103 huruf (d) UU NO. 17 Tahun 2006'),(83,'id_penindakan_83','Mengangkut barang hasil tindak pidana pasal 102, 102A atau 102B','Pasal 104 huruf (a) UU NO. 17 Tahun 2006'),(84,'id_penindakan_84','Memberitahukan salah jenis dan/atau jumlah barang impor yang mengakibatkan kekurangan pembayaran','Pasal 82 ayat 5 UU NO. 17 Tahun 2006'),(85,'id_penindakan_85','Salah memberitahukan barang yang dilarang/ dibatasi yg tidak memenuhi syarat-syarat diimpor / diekspor','Pasal 53 ayat 3 UU NO. 17 Tahun 2006'),(86,'id_penindakan_86','Tidak memberitahukan dan /atau memberitahukan secara tidak benar barang yg dilarang atau dibatasi diimpor atau diekspor','Pasal 53 ayat 4 UU NO. 17 Tahun 2006'),(87,'id_penindakan_87','Mengakses sistem elektronik kepabeanan secara tidak sah','Pasal 103 A ayat 1 UU NO. 17 Tahun 2006'),(88,'id_penindakan_88','Memusnahkan buku / catatan yang seharusnya disimpan','Pasal 104 huruf (b) UU NO. 17 Tahun 2006'),(89,'id_penindakan_89','Menghilangkan keterangan dalam pemberitahuan pabean','Pasal 104 huruf (c) UU NO. 17 Tahun 2006'),(90,'id_penindakan_90','Menyimpan / menyediakan blangko faktur yang bukan miliknya','Pasal 104 huruf (d) UU NO. 17 Tahun 2006'),(91,'id_penindakan_91','Merusak segel / tanda pengaman dengan sengaja / tanpa hak','Pasal 105 UU NO. 17 Tahun 2006'),(92,'id_penindakan_92','Mengangkut barang tertentu tidak sampai ke kantor pabean tujuan','Pasal 102 D UU NO. 17 Tahun 2006'),(93,'id_penindakan_93','Memalsukan data ke buku atau catatan','Pasal 103 huruf (b) UU NO. 17 Tahun 2006'),(94,'id_penindakan_94','Memberikan keterangan lisan atau tulisan yang tidak benar','Pasal 103 huruf (c) UU NO. 17 Tahun 2006'),(95,'id_penindakan_95','Menyerahkan buku, catatan, dan dokumen cukai lain yang palsu / dipalsukan ','Pasal 53 UU NO. 39 Tahun 2007'),(96,'id_penindakan_96','Tidak melunasi cukai melewati jangka waktu pembayaran berkala','Pasal 7 A ayat 7 UU NO. 39 Tahun 2007'),(97,'id_penindakan_97','Tidak melunasi cukai melewati jatuh tempo penundaan','Pasal 7 A ayat 8 UU NO. 39 Tahun 2007'),(98,'id_penindakan_98','Melanggar ketentuan tentang tidak dipungutnya cukai','Pasal 8 ayat 3 UU NO. 39 Tahun 2007'),(99,'id_penindakan_99','Melanggar ketentuan tentang pembebasan cukai','Pasal 9 ayat 3 UU NO. 39 Tahun 2007'),(100,'id_penindakan_100','Membayar utang cukai, kekurangan cukai, denda melewati jangka waktu','Pasal 10 ayat 2A UU NO. 39 Tahun 2007'),(101,'id_penindakan_101','Kedapatan kekurangan / kelebihan BKC dari batas kelonggaran','Pasal 23 ayat 2 UU NO. 39 Tahun 2007'),(102,'id_penindakan_102','Tidak melaporkan pemindahan BKC  karena keadaan darurat ','Pasal 26 ayat 3 UU NO. 39 Tahun 2007'),(103,'id_penindakan_103','Menyimpan barang di Tempat Penimbunan selain BKC yang diizinkan','Pasal 31 ayat 3 UU NO. 39 Tahun 2007'),(104,'id_penindakan_104','Menyimpan / menyediakan pengemas BKC bekas dengan Pita Cukai yang masih utuh','Pasal 32 ayat 2 UU NO. 39 Tahun 2007'),(105,'id_penindakan_105','Menyebabkan pejabat Bea dan Cukai tidak dapat melaksanakan pemeriksaan','Pasal 35 ayat 4 UU NO. 39 Tahun 2007'),(106,'id_penindakan_106','Tidak menyediakan tenaga / peralatan atau menyerahkan buku, catatan, dan/atau dokumen saat pemeriksaan','Pasal 36 ayat 2 UU NO. 39 Tahun 2007'),(107,'id_penindakan_107','Menghalangi Pejabat Bea dan Cukai untuk menghentikan, memeriksa saran pengangkut dan memeriksa BKC di atasnya','Pasal 37 ayat 4 UU NO. 39 Tahun 2007'),(108,'id_penindakan_108','Tidak dapat menunjukkan dokumen cukai / pelengkap cukai','Pasal 37 ayat 4 UU NO. 39 Tahun 2007'),(109,'id_penindakan_109','Menghalangi audit cukai','Pasal 39 ayat 4 UU NO. 39 Tahun 2007'),(110,'id_penindakan_110','Tidak menyelenggarakan pembukuan yang diwajibkan','Pasal 16 ayat 4 UU NO. 39 Tahun 2007'),(111,'id_penindakan_111','Tidak melakukan pencatatan yang diwajibkan','Pasal 16 ayat 5 UU NO. 39 Tahun 2007'),(112,'id_penindakan_112','Tidak memberitahukan BKC yang selesai dibuat','Pasal 16 ayat 6 UU NO. 39 Tahun 2007'),(113,'id_penindakan_113','Tidak melaksanakan ketentuan pembukuan sesuai pasal 16A','Pasal 16 B UU NO. 39 Tahun 2007'),(114,'id_penindakan_114','Mengangkut BKC yang belum dilunasi cukainya tanpa dilindungi dokumen Cukai','Pasal 27 ayat 3 UU NO. 39 Tahun 2007'),(115,'id_penindakan_115','Mengangkut BKC tertentu, walaupun sudah dilunasi cukainya, tanpa dilindungi  dokumen Cukai','Pasal 27 ayat 4 UU NO. 39 Tahun 2007'),(116,'id_penindakan_116','Persyaratan NPPBKC','Pasal 14 ayat 3a dan Pasal 14 ayat 4 UU NO. 39 Tahun 2007'),(117,'id_penindakan_117','Menjalankan kegiatan tanpa memiliki ijin (NPPBKC)','Pasal 14 ayat 7 UU NO. 39 Tahun 2007'),(118,'id_penindakan_118','Menjalankan usaha tanpa izin (NPPBKC) dengan maksud mengelakan pembayaran cukai','Pasal 50 UU NO. 39 Tahun 2007'),(119,'id_penindakan_119','Menimbun/membeli/menjual BKC berasal dari tindak pidana','Pasal 56 UU NO. 39 Tahun 2007'),(120,'id_penindakan_120','Merusak segel / tanda pengaman  tanpa izin','Pasal 57 UU NO. 39 Tahun 2007'),(121,'id_penindakan_121','Mengakses sistem elektronik cukai secara tidak sah','Pasal 58 A ayat 1 UU NO. 39 Tahun 2007'),(122,'id_penindakan_122','Mengeluarkan BKC dari pabrik atau Tempat Penimbunan tanpa pemberitahuan dan tidak dilindungi dokumen Cukai','Pasal 25 ayat 4 UU NO. 39 Tahun 2007'),(123,'id_penindakan_123','Memasukkan BKC ke pabrik atau Tempat Penimbunan tanpa pembaritahuan dan tidak dilindungi dokumen Cukai','Pasal 25 ayat 4A UU NO. 39 Tahun 2007'),(124,'id_penindakan_124','Mengeluarkan BKC tanpa dokumen dengan maksud mengelak cukai','Pasal 52 UU NO. 39 Tahun 2007'),(125,'id_penindakan_125','Menjualbelikan/menawarkan/menyediakan/menggunakan Pita Cukai bekas','Pasal 55 huruf (c) UU NO. 39 Tahun 2007'),(126,'id_penindakan_126','Menyimpan / menyediakan Pita Cukai bekas pakai','Pasal 32 ayat 2 UU NO. 39 Tahun 2007'),(127,'id_penindakan_127','Menjualbelikan/menawarkan/menyediakan/menggunakan Pita Cukai palsu','Pasal 55 huruf (b) UU NO. 39 Tahun 2007'),(128,'id_penindakan_128','Membuat Pita Cukai palsu secara melawan hukum','Pasal 55 huruf (a) UU NO. 39 Tahun 2007'),(132,'id_penindakan_129','Menjualbelikan/menawarkan/menyerahkan Pita Cukai kepada yg tidak berhak','Pasal 58 UU NO. 39 Tahun 2007'),(133,'id_penindakan_130','Menyediakan / menjualbelikan BKC tidak sesuai ketentuan (tidak dilekati / salah) ','Pasal 54 UU NO. 39 Tahun 2007'),(134,'id_penindakan_131','Melekatkan Pita Cukai pada BKC tidak sesuai  yang diwajibkan, mengakibatkan kekurangan pembayaran cukai','Pasal 29 ayat 2A UU NO. 39 Tahun 2007'),(135,'id_penindakan_132','Memproduksi/ Mengedarkan/ Menyalurkan/ Menyerahkan/ Menerima Psikotropika selain yang ditetapkan','Pasal 60 ayat (2) UU NO. 5 Tahun 1997'),(136,'id_penindakan_133','Tanpa hak atau melawan hukum menguasai/ menyediakan/ memproduksi/ mengimpor/ mengekspor/ menyalurkan Narkotika','UU NO. 35 Tahun 2009'),(137,'id_penindakan_134','….',NULL);

#
# Structure for table "tbl_jenis_segel"
#

CREATE TABLE `tbl_jenis_segel` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `id_jenis_segel` varchar(15) DEFAULT NULL,
  `jenis_segel` varchar(25) DEFAULT NULL,
  `nomor_segel` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_jenis_segel"
#


#
# Structure for table "tbl_kategori_penindakan"
#

CREATE TABLE `tbl_kategori_penindakan` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `id_kategori_penindakan` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_kategori_penindakan"
#


#
# Structure for table "tbl_kemasan"
#

CREATE TABLE `tbl_kemasan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_kemasan` varchar(25) DEFAULT NULL,
  `nama_kemasan` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_kemasan"
#

INSERT INTO `tbl_kemasan` VALUES (1,'id_kemasan_1','Ampoule'),(2,'id_kemasan_2','Bag'),(3,'id_kemasan_3','Bale'),(4,'id_kemasan_4','Batang'),(5,'id_kemasan_5','Botol'),(6,'id_kemasan_6','Box'),(7,'id_kemasan_7','Bundle'),(8,'id_kemasan_8','Bungkus'),(9,'id_kemasan_9','Butir'),(10,'id_kemasan_10','Carton'),(11,'id_kemasan_11','Case'),(12,'id_kemasan_12','Coil'),(13,'id_kemasan_13','Colly'),(14,'id_kemasan_14','Container'),(15,'id_kemasan_15','Crate'),(16,'id_kemasan_16','Curah/Bulk'),(17,'id_kemasan_17','Drum'),(18,'id_kemasan_18','Ekor'),(19,'id_kemasan_19','Gram'),(20,'id_kemasan_20','Jerigen'),(21,'id_kemasan_21','Kaleng'),(22,'id_kemasan_22','Karung'),(23,'id_kemasan_23','Kilo Liter (KL)'),(24,'id_kemasan_24','Kilogram'),(25,'id_kemasan_25','Lembar'),(26,'id_kemasan_26','Liter'),(27,'id_kemasan_27','Meter'),(28,'id_kemasan_28','Metric Ton (MT)'),(29,'id_kemasan_29','Not Defined'),(30,'id_kemasan_30','Number Of Pair (NPR)'),(31,'id_kemasan_31','Package (Pce)'),(32,'id_kemasan_32','Pallet'),(33,'id_kemasan_33','Pieces (Pcs)'),(34,'id_kemasan_34','Roll'),(35,'id_kemasan_35','Set'),(36,'id_kemasan_36','Slop'),(37,'id_kemasan_37','TNE'),(38,'id_kemasan_38','Unit'),(39,'id_kemasan_39','Yard');

#
# Structure for table "tbl_komoditi_barang"
#

CREATE TABLE `tbl_komoditi_barang` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `id_komoditi_barang` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_komoditi_barang"
#


#
# Structure for table "tbl_li"
#

CREATE TABLE `tbl_li` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_li` varchar(55) DEFAULT NULL,
  `tgl_li` varchar(20) DEFAULT NULL,
  `media_informasi` varchar(255) DEFAULT NULL,
  `isi_informasi` text,
  `catatan` text,
  `id_pejabat_li_1` varchar(55) DEFAULT NULL,
  `id_pejabat_li_2` varchar(55) DEFAULT NULL,
  `id_pejabat_li_3` varchar(55) DEFAULT NULL,
  `no_urut_lap` int DEFAULT NULL,
  `no_lap` varchar(55) DEFAULT NULL,
  `sumber_lap` varchar(255) DEFAULT NULL,
  `pelaku` varchar(5) DEFAULT NULL,
  `keterangan_pelaku` text,
  `dugaan_pelanggaran` varchar(5) DEFAULT NULL,
  `keterangan_dugaan_pelanggaran` text,
  `locus` varchar(5) DEFAULT NULL,
  `keterangan_locus` text,
  `tempus` varchar(5) DEFAULT NULL,
  `keterangan_tempus` text,
  `prosedural` varchar(20) DEFAULT NULL,
  `ket_prosedural` text,
  `sdm` varchar(10) DEFAULT NULL,
  `ket_sdm` text,
  `sarana_prasarana` varchar(10) DEFAULT NULL,
  `ket_sarana_prasarana` text,
  `anggaran` varchar(10) DEFAULT NULL,
  `ket_anggaran` text,
  `layak_penindakan` varchar(5) DEFAULT NULL,
  `skem_layak_penindakan` varchar(255) DEFAULT NULL,
  `ket_layak_penindakan` text,
  `layak_patroli` varchar(5) DEFAULT NULL,
  `skem_layak_patroli` varchar(255) DEFAULT NULL,
  `ket_layak_patroli` text,
  `tidak_layak` varchar(5) DEFAULT NULL,
  `ket_tidak_layak` text,
  `kesimpulan_lap` text,
  `id_pejabat_lap_1` varchar(55) DEFAULT NULL,
  `id_pejabat_lap_2` varchar(55) DEFAULT NULL,
  `id_pejabat_lap_3` varchar(55) DEFAULT NULL,
  `no_npi` varchar(55) DEFAULT NULL,
  `sumber_npi` varchar(255) DEFAULT NULL,
  `unit_penerbit_npi` text,
  `alasan_npi` text,
  `id_pejabat_npi` varchar(55) DEFAULT NULL,
  `no_print` varchar(55) DEFAULT NULL,
  `ket_perundang` text,
  `dasar_sp` text,
  `id_pejabat_sp_1` varchar(55) DEFAULT NULL,
  `perintah_sp` text,
  `wilayah` varchar(25) DEFAULT NULL,
  `tanggal_mulai_print` varchar(25) DEFAULT NULL,
  `tanggal_berakhir_print` varchar(25) DEFAULT NULL,
  `ketentuan_baju` varchar(30) DEFAULT NULL,
  `ketentuan_lain` text,
  `id_pejabat_sp_2` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_li"
#

INSERT INTO `tbl_li` VALUES (1,'1','2024-11-06','Media Informasi','Isi Informasi','Catatan','BCKNO-719','PENGUASA','PENGUASA',1,'1','Sumber LAP','YA','Keterangan Pelaku','YA','Keterangan Dugaan Pelanggaran','YA','Keterangan Locus','TIDAK','Keterangan Tempus','Kewenangan DJBC','Keterangan Prosedural','TERSEDIA','Keterangan SDM','TIDAK',NULL,'TERSEDIA','Keterangan Anggaran','TIDAK','DENGAN INSTANSI LAIN','Keterangan Skema Penindakan','TIDAK','MANDIRI','Keterangan Skema Patroli','TIDAK','Keterangan Tidak Layak Melakukan Operasi Penindakan atau Patroli','Kesimpulan','PENGUASA','PENGUASA','PENGUASA','1','Sumber Informasi','Unit Penebit Informasi','Alasan','PENGUASA','1','Pertimbangan Surat Perintah','Dasar Hukum','PENGUASA','Perintah','Wilayah','2024-11-19','2024-11-18','Berpakaian Non PDH','Ketentuan Lain','PENGUASA','2024-11-05 04:13:21','2024-11-05 04:13:21');

#
# Structure for table "tbl_lp"
#

CREATE TABLE `tbl_lp` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `id_lphp` varchar(15) DEFAULT NULL,
  `id_uraian_modus` varchar(15) DEFAULT NULL,
  `pasal_pelanggaran` varchar(55) DEFAULT NULL,
  `alamat_pemilik` text,
  `no_identitas_pemilik` varchar(25) DEFAULT NULL,
  `id_admin` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_lp"
#


#
# Structure for table "tbl_lphp"
#

CREATE TABLE `tbl_lphp` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `id_lphp` varchar(15) DEFAULT NULL,
  `no_lphp` varchar(255) DEFAULT NULL,
  `id_lptp` varchar(15) DEFAULT NULL,
  `tgl_lphp` varchar(255) DEFAULT NULL,
  `analisis_hasil_penindakan` text,
  `kategori_locus` varchar(25) DEFAULT NULL,
  `asal_muat_tujuan_bongkar` varchar(255) DEFAULT NULL,
  `id_admin` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_lphp"
#


#
# Structure for table "tbl_lpt"
#

CREATE TABLE `tbl_lpt` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `objek_pengawasan` varchar(255) DEFAULT NULL,
  `id_sbp` varchar(11) DEFAULT NULL,
  `id_admin` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_lpt"
#


#
# Structure for table "tbl_lptp"
#

CREATE TABLE `tbl_lptp` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `id_lptp` varchar(11) DEFAULT NULL,
  `no_lptp` varchar(25) DEFAULT NULL,
  `id_kategori_penindakan` varchar(11) DEFAULT NULL,
  `id_komoditi_barang` varchar(11) DEFAULT NULL,
  `id_sbp` varchar(11) DEFAULT NULL,
  `id_admin` varchar(255) DEFAULT NULL,
  `tgl_lptp` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_lptp"
#


#
# Structure for table "tbl_menu"
#

CREATE TABLE `tbl_menu` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL DEFAULT '',
  `sub` varchar(10) NOT NULL DEFAULT '',
  `sub_sub` varchar(10) NOT NULL DEFAULT '',
  `uraian_menu` varchar(50) NOT NULL DEFAULT '',
  `fd` varchar(50) NOT NULL DEFAULT '',
  `dt` varchar(50) NOT NULL DEFAULT '',
  `icon` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

#
# Data for table "tbl_menu"
#

INSERT INTO `tbl_menu` VALUES (1,'01','NO','','Dashboard','home','','home'),(2,'02','NO','','Master Data','form','','database'),(3,'021','02','','Data Perusahaan','','data_perusahaan',''),(4,'022','02','','Input Data Perusahaan','','tambah_data_perusahaan',''),(5,'03','NO','','BROWSE','browse','','fa fa-tasks'),(6,'031','03','','Browse Dokumen','','track_dokumen',''),(7,'04','NO','','DOKUMEN','dokumen','','fa fa-book'),(8,'041','04','','Input Dokumen','','input_dokumen',''),(9,'05','NO','','ATENSI','atensi','','fa fa-exclamation-triangle'),(10,'051','05','','Atensi Negara Asal','','atensi_negara_asal',''),(11,'052','05','','Atensi Shipper','','atensi_shiper',''),(12,'06','NO','','KEDATANGAN','bc12','','fa fa-book'),(13,'061','06','','Daftar Kedatangan Sarkut','','dok_bc12',''),(14,'062','06','','Grafik & Laporan Kedatangan Sarkut','','grafik_bc12',''),(15,'063','06','','Laporan Trend Penumpang','','trend_penumpang',''),(16,'07','NO','','KEBERANGKATAN','keberangkatan','','fa fa-book'),(17,'071','07','','Daftar Keberangkatan Sarkut','','dok_keberangkatan',''),(18,'072','07','','Grafik & Laporan Keberangkatan Sarkut','','grafik_keberangkatan',''),(19,'073','07','','Laporan Trend Penumpang','','trend_penumpang_keberangkatan',''),(20,'08','NO','','Dok. Penindakan','sbp','','alert-triangle'),(21,'081','08','','Catatan Pelekatan Tanda Pengaman','pelekatan','catatan_pelekatan',''),(22,'082','08','','Catatan Pelepasan Tanda Pengaman','pelekatan','catatan_pelepasan',''),(23,'083','08','','Penindakan','Dokpenindakan/DaftarSbp','',''),(24,'084','08','','Daftar BA. Segel-Non SBP','','bap_non_sbp',''),(25,'085','08','','Daftar BAST-Non SBP','','bast_non_sbp',''),(26,'086','08','','Daftar BA. Buka Segel','','daftar_buka_segel',''),(27,'087','08','','Daftar Dok. LPTP','','daftar_dok_lptp',''),(28,'088','08','','Grafik SBP','','grafik_sbp',''),(29,'089','08','','Lap. Rekap Sbp','laporan','laporan_sbp',''),(30,'09','NO','','Dok. Penyidikan','sbp','','search'),(31,'091','09','','Daftar Dok. LPP','Dokpenyidikan/daftar-dok-lpp','daftar_dok_lpp',''),(32,'092','09','','Lembar Monitoring Barang (LMB)','Dokpenyidikan/lembar-monitoring-barang','lembar_monitoring_barang',''),(33,'10','NO','','DOK. PENGAWASAN','bapp','','fa fa-book'),(34,'101','10','','Daftar Laporan Pengawasan Pemuatan','','dok_bapp',''),(35,'11','NO','','BUKU CAT. PABEAN','laporan','','fa fa-book'),(36,'111','11','','Lap. BCP-SBP','','laporan_bcpsbp',''),(37,'112','11','','Lap. BCP-BA. Serah Terima','','laporan_bcpbast',''),(38,'113','11','','Lap. BCP-BA. Penyegelan','','laporan_bcpbap',''),(39,'114','11','','Lap. BCP-BA. Buka Segel','','laporan_bcpbukasegel',''),(40,'12','NO','','ANALISA','analisa','','fa fa-search'),(41,'121','12','','Analisa Data & Dokumen','','analisa_data',''),(42,'122','12','','Perusahaan Ibt','','data_perusahaan_ibt',''),(43,'123','12','','Grafik Perusahaan Ibt','','grafik_perusahaan_ibt',''),(44,'124','12','','Grafik Perusahaan Ibt Harian','','grafik_perusahaan_ibt_harian',''),(45,'13','NO','','GRAFIK','grafik','','fa fa-bar-chart'),(46,'131','13','','Grafik IMP / EKS','','grafik_ie',''),(47,'132','13','','Grafik IMP / EKS Harian','','grafik_ie_harian',''),(48,'133','13','','Grafik CN / PIBK','','grafik_cn',''),(49,'134','13','','Grafik CN / PIBK Harian','','grafik_cn_harian',''),(50,'135','13','','Grafik Perbandingan','','grafik_perbandingan',''),(51,'14','NO','','LAPORAN','laporan','','fa fa-copy'),(52,'141','14','','Lap. Profil Perusahaan','','profil_pt',''),(53,'142','14','','Lap. Detil Dokumen','','detil_dokumen',''),(54,'143','14','','Lap. Penerimaan','','penerimaan',''),(55,'144','14','','Lap. Komoditi','','komoditi',''),(56,'145','14','','Laporan Sarkut','','sarkut',''),(57,'15','NO','','LAPORAN CN / PIBK','laporan','','fa fa-file'),(58,'151','15','','Lap. CN / PIBK','','dok_cn',''),(59,'152','15','','Lap. Rekap CN / PIBK','','dok_rekap_cn',''),(62,'162','16','','Master Flight','master_flight','data_flight',''),(65,'165','16','','Tambah Menu','','tambah_menu',''),(66,'102','10','','Lap. Pengawasan Pengeluaran Barang Sebagian','','dok_ppbs','fa fa-users'),(67,'0810','08','','Daftar Ba Pengambilan Barang Contoh','bapbc','ba_barang_contoh',''),(68,'146','14','','Laporan Patroli','','lap_patroli','fa fa-users'),(69,'166','16','','Tambah Kategori Barang','','kategori_barang','fa fa-users'),(70,'0811','08','','Daftar SBP NPP','','periksa_fisik_npp','fa fa-users'),(71,'0812','08','','Daftar Dok. LPTP NPP','','daftar_dok_lptp_npp',''),(72,'093','09','','Daftar Dok. LPP NPP','','daftar_dok_lpp_npp',''),(73,'0813','08','','Pra Penindakan','Dokpenindakan/pra-penindakan','',''),(74,'0814','08','','Pra Penindakan NPP','Dokpenindakan/pra-penindakan-npp','',''),(75,'0815','08','','Penindakan','Dokpenindakan/DaftarSbp','',''),(76,'0815','08','','Penindakan NPP','Dokpenindakan/penindakan-npp','',''),(77,'0816','08','','Pasca Penindakan','Dokpenindakan/pasca-penindakan','',''),(78,'0816','08','','Pasca Penindakan NPP','Dokpenindakan/pasca-penindakan-npp','',''),(79,'18','NO','','Pengawasan Lainnya','','','alert-triangle'),(80,'181','18','','BA Pembukaan Segel','Pengawasanlain/ba-pembukaan-segel','',''),(81,'182','18','','BA Segel CTP','Pengawasanlain/ba-segel-ctp','',''),(82,'183','18','','BA Buka Segel CTP','Pengawasanlain/ba-buka-segel-ctp','',''),(83,'183','18','','BA Pengawasan Bongkar','Pengawasanlain/ba-pengawasan-bongkar','',''),(84,'184','18','','BA Cacah Amunisi','Pengawasanlain/ba-cacah-amunisi','',''),(85,'185','18','','BAST Senjata Api','Pengawasanlain/bast-senjata-api','',''),(86,'20','NO','','Tools','#','#','tool'),(87,'201','20','','Management User','tools/users','',''),(88,'202','20','','Set Nomor Dokumen','tools/setNomorDokumen','',''),(89,'203','20','','Tambah Aturan Lartas','tools/tambahAturanLartas','','');

#
# Structure for table "tbl_no_reff"
#

CREATE TABLE `tbl_no_reff` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `no_sbp` varchar(11) NOT NULL DEFAULT '',
  `no_li` int DEFAULT NULL,
  `no_npi` int DEFAULT NULL,
  `no_print` int DEFAULT NULL,
  `no_urut_lap` int DEFAULT NULL,
  `no_sbp_npp` varchar(11) NOT NULL DEFAULT '',
  `no_ba_segel` varchar(11) NOT NULL DEFAULT '',
  `no_ba_segel_npp` varchar(11) NOT NULL DEFAULT '',
  `no_ba_serah` varchar(11) NOT NULL DEFAULT '',
  `no_ba_serah_npp` varchar(11) NOT NULL DEFAULT '',
  `no_ba_musnah` varchar(11) NOT NULL DEFAULT '',
  `no_ba_musnah_npp` varchar(11) NOT NULL DEFAULT '',
  `no_ba_tegah` varchar(11) NOT NULL,
  `no_ba_tegah_npp` varchar(11) NOT NULL,
  `no_ba_bast_barang` varchar(11) DEFAULT NULL,
  `no_ba_buka_segel` varchar(11) NOT NULL DEFAULT '',
  `no_lptp` varchar(11) NOT NULL DEFAULT '',
  `no_lptp_npp` varchar(11) NOT NULL DEFAULT '',
  `no_lpp` varchar(11) NOT NULL DEFAULT '',
  `no_lpp_npp` varchar(11) NOT NULL DEFAULT '',
  `no_sp_cacah` varchar(11) NOT NULL DEFAULT '',
  `no_ba_cacah` varchar(11) NOT NULL DEFAULT '',
  `no_pelekatan` varchar(11) NOT NULL DEFAULT '',
  `no_pelepasan` varchar(11) NOT NULL DEFAULT '',
  `no_bapp` varchar(11) NOT NULL DEFAULT '',
  `no_ppbs` varchar(11) NOT NULL DEFAULT '',
  `no_menu` varchar(11) NOT NULL DEFAULT '',
  `no_bapbc` varchar(11) NOT NULL DEFAULT '',
  `no_patroli` varchar(11) NOT NULL DEFAULT '',
  `no_bcl12` varchar(11) NOT NULL DEFAULT '',
  `no_ba_riksa` varchar(255) NOT NULL DEFAULT '',
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "tbl_no_reff"
#

INSERT INTO `tbl_no_reff` VALUES (1,'0',1,1,1,1,'00','0000','0000','0000','0000','0000','00','0258','0108','0000','00','258','3','000','N-0','0000','0000','00','00','00','11','0','0','0','787','0000','2024-11-05 04:55:03');

#
# Structure for table "tbl_np"
#

CREATE TABLE `tbl_np` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `id_np` varchar(255) DEFAULT NULL,
  `id_admin` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_np"
#


#
# Structure for table "tbl_pegawai"
#

CREATE TABLE `tbl_pegawai` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `id_pegawai` varchar(11) DEFAULT NULL,
  `nama_pegawai` varchar(25) DEFAULT NULL,
  `nip_pegawai` varchar(20) DEFAULT NULL,
  `nama_kasi_indak` varchar(25) DEFAULT NULL,
  `nip_kasi_indak` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_pegawai"
#


#
# Structure for table "tbl_penindakan"
#

CREATE TABLE `tbl_penindakan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_penindakan` varchar(55) DEFAULT NULL,
  `alasan_penindakan` varchar(255) DEFAULT NULL,
  `jenis_pelanggaran` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_penindakan"
#


#
# Structure for table "tbl_sbp"
#

CREATE TABLE `tbl_sbp` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `no_li` int DEFAULT NULL,
  `id_sbp` varchar(25) DEFAULT NULL,
  `no_sbp` varchar(11) DEFAULT NULL,
  `tgl_sbp` varchar(11) DEFAULT NULL,
  `no_prin` varchar(25) DEFAULT NULL,
  `tanggal_print` varchar(15) DEFAULT NULL,
  `id_petugas_1_sbp` varchar(50) DEFAULT NULL,
  `id_petugas_2_sbp` varchar(50) DEFAULT NULL,
  `nama_saksi` varchar(55) DEFAULT NULL,
  `alamat_saksi` text,
  `pekerjaan_saksi` varchar(35) DEFAULT NULL,
  `no_identitas_saksi` varchar(25) DEFAULT NULL,
  `kontak_saksi` varchar(20) DEFAULT NULL,
  `data_sarkut` varchar(5) DEFAULT NULL,
  `nama_jenis_sarkut` varchar(255) DEFAULT NULL,
  `no_flight` varchar(15) DEFAULT NULL,
  `kapasitas_muatan` varchar(25) DEFAULT NULL,
  `pengemudi` varchar(55) DEFAULT NULL,
  `no_identitas_pengemudi` varchar(25) DEFAULT NULL,
  `bendera` text,
  `no_polisi` varchar(25) DEFAULT NULL,
  `data_barang` varchar(5) DEFAULT NULL,
  `jumlah_jenis_ukuran_no` varchar(55) DEFAULT NULL,
  `id_kemasan` varchar(25) DEFAULT NULL,
  `jumlah_barang` varchar(10) DEFAULT NULL,
  `jenis_barang` varchar(15) DEFAULT NULL,
  `jenis_no_tgl_dok` varchar(55) DEFAULT NULL,
  `pemilik` text,
  `no_identitas_pemilik` varchar(25) DEFAULT NULL,
  `data_bangunan` varchar(5) DEFAULT NULL,
  `alamat_bangunan` text,
  `no_bangunan` varchar(35) DEFAULT NULL,
  `nama_pemilik_bangunan` text,
  `no_identitas_pemilik_bangunan` varchar(55) DEFAULT NULL,
  `lokasi_penindakan` varchar(55) DEFAULT NULL,
  `uraian_penindakan` text,
  `id_penindakan` varchar(25) DEFAULT NULL,
  `tgl_mulai` varchar(15) DEFAULT NULL,
  `jam_mulai` varchar(15) DEFAULT NULL,
  `tgl_selesai` varchar(15) DEFAULT NULL,
  `jam_selesai` varchar(15) DEFAULT NULL,
  `hal_yang_terjadi` text,
  `ba_tegah` varchar(15) DEFAULT NULL,
  `no_ba_tegah` varchar(15) DEFAULT NULL,
  `ba_riksa` varchar(15) DEFAULT NULL,
  `no_ba_riksa` varchar(15) DEFAULT NULL,
  `lokasi_pemeriksaan` varchar(35) DEFAULT NULL,
  `jumlah_lampiran_pemeriksaan` varchar(55) DEFAULT NULL,
  `rincian_hasil_pemeriksaan` text,
  `ba_segel` varchar(5) DEFAULT NULL,
  `no_ba_segel` varchar(15) DEFAULT NULL,
  `id_segel` varchar(25) DEFAULT NULL,
  `jumlah_segel` varchar(11) DEFAULT NULL,
  `peletakan_segel` varchar(20) DEFAULT NULL,
  `ba_ctp` varchar(5) DEFAULT NULL,
  `no_ba_ctp` varchar(15) DEFAULT NULL,
  `jumlah_ctp` varchar(10) DEFAULT NULL,
  `peletakan_ctp` varchar(55) DEFAULT NULL,
  `ba_sarkut` varchar(5) DEFAULT NULL,
  `no_ba_sarkut` varchar(15) DEFAULT NULL,
  `dibawa_dari` varchar(55) DEFAULT NULL,
  `tujuan` varchar(55) DEFAULT NULL,
  `alasan` text,
  `tanggal_berangkat` varchar(15) DEFAULT NULL,
  `pukul_berangkat` varchar(10) DEFAULT NULL,
  `tanggal_tiba` varchar(15) DEFAULT NULL,
  `pukul_tiba` varchar(10) DEFAULT NULL,
  `ba_riksa_badan` varchar(5) DEFAULT NULL,
  `no_ba_riksa_badan` varchar(15) DEFAULT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `alias` varchar(15) DEFAULT NULL,
  `TTL` varchar(25) DEFAULT NULL,
  `jenis_kelamin` varchar(15) DEFAULT NULL,
  `kewarganegaraan` varchar(15) DEFAULT NULL,
  `alamat_tempat_tinggal` text,
  `alamat_ktp` text,
  `nomor_ktp` varchar(50) DEFAULT NULL,
  `tempat_pejabat` varchar(55) DEFAULT NULL,
  `datang_dari` varchar(55) DEFAULT NULL,
  `tempat_tujuan` varchar(55) DEFAULT NULL,
  `nama_orang_bersamanya` varchar(55) DEFAULT NULL,
  `jenis_dokumen` varchar(55) DEFAULT NULL,
  `lokasi_pemeriksaan_badan` varchar(55) DEFAULT NULL,
  `rincian_pemeriksaan_badan` varchar(55) DEFAULT NULL,
  `hasil_pemeriksaan_badan` text,
  `ba_barcon` varchar(5) DEFAULT NULL,
  `no_ba_barcon` varchar(15) DEFAULT NULL,
  `jumlah_jenis_barang_contoh` varchar(25) DEFAULT NULL,
  `lokasi_barcon` varchar(55) DEFAULT NULL,
  `ba_tolak_1` varchar(5) DEFAULT NULL,
  `agama` varchar(15) DEFAULT NULL,
  `alasan_tolak_1` text,
  `ba_tolak_2` varchar(5) DEFAULT NULL,
  `alasan_tolak_2` text,
  `ba_bast` varchar(5) DEFAULT NULL,
  `menyerahkan_atas_nama` varchar(55) DEFAULT NULL,
  `nama_penerima` varchar(55) DEFAULT NULL,
  `nip_penerima` varchar(55) DEFAULT NULL,
  `atas_nama` varchar(55) DEFAULT NULL,
  `dalam_rangka` text,
  `id_pegawai` varchar(11) DEFAULT NULL,
  `id_jenis_npp` varchar(11) DEFAULT NULL,
  `lokasi_pengujian` text,
  `importir` varchar(20) DEFAULT NULL,
  `uraian_baarang` text,
  `bentuk` varchar(20) DEFAULT NULL,
  `warna` varchar(15) DEFAULT NULL,
  `bau` varchar(10) DEFAULT NULL,
  `analisis` text,
  `kesimpulan` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_sbp"
#


#
# Structure for table "tbl_segel"
#

CREATE TABLE `tbl_segel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_segel` varchar(25) DEFAULT NULL,
  `jenis_segel` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_segel"
#

INSERT INTO `tbl_segel` VALUES (1,'id_segel_1','Kertas'),(2,'id_segel_2','Gembok'),(3,'id_segel_3','Pita'),(4,'id_segel_4','Timah'),(5,'id_segel_5','E-Seal');

#
# Structure for table "tbl_titip"
#

CREATE TABLE `tbl_titip` (
  `Id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_titip"
#


#
# Structure for table "tbl_uraian_modus"
#

CREATE TABLE `tbl_uraian_modus` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `id_uraian_modus` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "tbl_uraian_modus"
#


#
# Structure for table "tblnegara"
#

CREATE TABLE `tblnegara` (
  `KdEdi` varchar(2) NOT NULL DEFAULT '',
  `UrEdi` varchar(40) DEFAULT NULL,
  `benua` varchar(15) NOT NULL DEFAULT '',
  `group$` varchar(2) NOT NULL DEFAULT '',
  PRIMARY KEY (`KdEdi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "tblnegara"
#


#
# Structure for table "users"
#

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_admin` varchar(15) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_admin` varchar(60) DEFAULT NULL,
  `nip` varchar(60) DEFAULT NULL,
  `pangkat` varchar(100) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `otoritas` varchar(25) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=265 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "users"
#

INSERT INTO `users` VALUES (1,'BCKNO-00001','admin','22c85690d8ac2f8bf1b59cad6a8e0bb9','DEV. BEACUKAI KUALANAMU','---','---','---','ADMINISTRATOR',NULL,'2024-11-07 04:02:15','AKTIF'),(2,'PENGUASA','arza','$2y$12$IHUYd3IFvRaAaOpaNlZslOD7/AUKpsj9ew2cRgd7L0zLyCCKcw5Fe','Arza Fawazi','0068700043','Penguasa','Jendral','ANALIS','2024-10-24 02:42:18','2024-11-07 04:02:03','AKTIF'),(4,'BCKNO-00004','lando.ringo','effebf7b7ac984310f79f126edea710f','LANDO A. SIRINGO RINGO','198505172004121001','Penata Muda Tk. I- III/b','Kepala Subseksi Administrasi Manifes','PERBEN',NULL,NULL,'AKTIF'),(37,'BCKNO-00037','tea.kirana','fc1cd60470d7575289ef9b731e05d7c3','TEA KIRANA','199504202015022003','Pengatur - II/c','Pelaksana Pemeriksa Pada Seksi P2','ANALIS',NULL,NULL,'AKTIF'),(41,'BCKNO-00041','superadmin','bdcb5cb786e38d9a3321c9934dca4184','ADMINISTRATOR KODIC','---','-','-','ADMINISTRATOR',NULL,NULL,'AKTIF'),(49,'BCKNO-00049','daniel.marnala','06293387f0c050d81e76cee5b91d599b','DANIEL MARNALA LUMBANTORUAN','199105032010121004','Pengatur Tk. I - II/d','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'AKTIF'),(53,'BCKNO-00053','dedy.sandy','d370bcab785bf27688ad0ce731145512','DEDY SANDY RAY SITANGGANG','199905082018121001','Pengatur Muda - II/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(57,'BCKNO-00057','ellen.theresia','e99a2a814784ee45ea355baf425e831f','ELLEN THERESIA SITOMPUL','199607102018012001','Pengatur Tk.I- II/d','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(58,'BCKNO-00058','annisyah.pratiwi','883b081ea5388e858778b7af2ad26ddf','ANNISYAH PRATIWI','199911112018122002','Pengatur Muda - II/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(62,'BCKNO-00062','alfiatun.marfuah','310cccdd257994102c05a42be5bdaff1','ALFIATUN MARFUAH','199810162018122001','Pengatur Muda - II/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(72,'BCKNO-00072','elfi.haris','9d593c86354b57a773d81abdd53f6a47','ELFI HARIS','197206021998031001','Pembina Tk.I - IV/b','Kepala Kantor','KA. KANTOR',NULL,NULL,'NON-AKTIF'),(74,'BCKNO-00074','athur.morris','1edfd9e0e08a9dcef47c1f0171d9a61c','ATHUR MORRIS SIREGAR','198501152004121002','Penata Muda - III/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(75,'BCKNO-00075','berkat.s','9b2a6af9a995884ad81bec2b08157dbe','BERKAT M.K SIAHAAN','198410242004121003','Penata Muda - III/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'AKTIF'),(77,'BCKNO-00077','yosia.sitindaon','2fda795791045f41c0d7a33b9ce31f50','YOSIA SITINDAON','199007032010011004','Pengatur Tk.I - II/d','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'AKTIF'),(80,'BCKNO-00080','rio.nanda','dc203bcf32f8aa7627f6e8014bd7ab84','RIO NANDA FERNANDO SINAGA','199906082018121003','Pengatur Muda - II/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(81,'BCKNO-00081','andreas.turnip','b2861f10666cb38563ecd2a6dcdc8898','ANDREAS TURNIP','198401272003121004','Penata Muda Tk.I - III/b','Pemeriksa Bea dan Cukai Ahli Pertama','KASUBSI',NULL,NULL,'NON-AKTIF'),(84,'BCKNO-00084','wilken.saragih','3bd32cc9499429e999f66fff24c3ed20','WILKEN FRANS FELLA SARAGIH','199008232009121001','Pengatur Tk.I - II/d','Pelaksana Pemeriksa pada Seksi Penindakan dan Penyidikan','PEMERIKSA',NULL,NULL,'AKTIF'),(85,'BCKNO-00085','nuranisa.a','93fead413bf0f932ba9553d4936b4cb5','NURANISA','199905032018122002','Pengatur Muda Tk. I - II/b','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'AKTIF'),(86,'BCKNO-320044','dedew','c6ac923906dbfbedb34355bbc9601a93','DEWANGGA ARDALEFA ARITONANG','199809062018011003','Pengatur Muda Tk.I - II/b','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(89,'BCKNO-674002','mutaqin','62a6d6c6cda06420783b382d4aee358b','MOHAMAD MUTAQIN','197606301999031001','Penata Tk.I - III/d','KEPALA SEKSI PENINDAKAN DAN PENYIDIKAN','KA. SEKSE',NULL,NULL,'NON-AKTIF'),(90,'BCKNO-00000','-','bdcb5cb786e38d9a3321c9934dca4184',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'AKTIF'),(92,'BCKNO-495044','mahardhika.aryadhana','27d6589a25b37a2961fde89ed226da53','MAHARDHIKA ARYADHANA JATTIN','199710112018121001','Pengatur - II/c','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(96,'BCKNO-903048','michael.sianipar','4be886729ef0b88baff61777f5361124','MICHAEL PARIWARA SIANIPAR','199203252012101001','Pengatur - II/c','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(98,'BCKNO-315050','nizar.zulmi','c531a4f247cc0b028cd7f384949c0aed','NIZAR ZULMI','199102022012101001','Pengatur - II/c','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'AKTIF'),(99,'BCKNO-154051','davy.frederick','4650f58348623b9a1e3a78cf8af1ea59','DAVY FREDERICK HUTAGALUNG','198509092004121001','Penata Muda - III/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(100,'BCKNO-982052','rahmadhani','d41c47d9689b70516efbddb9c787dbc8','RAHMADHANI','199203282013101001','Pengatur - II/c','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(101,'BCKNO-102054','chandra.situmorang','e10adc3949ba59abbe56e057f20f883e','CHANDRA S. SITUMORANG','199012012010011001','Pengatur Tk.I - II/d','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(102,'BCKNO-615055','bernard.pranoto','c9fbab7eea2df7b13db0b1104cfb18fd','BERNARD PRANOTO SAMOSIR','198503162006021001','Penata Muda - III/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(103,'BCKNO-242056','bobby.hartanto','a5caf39af9cf6f0b40e09edb9eac6b55','BOBBY HARTANTO SINAGA','198609012006021002','Penata Muda Tk. I - III/b','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'AKTIF'),(106,'BCKNO-990059','bayu.prakoso','7922fa1f45cd2ed2bfe780939c3ba65c','BAYU PRAKOSO','198806012007011002','Penata Muda - III/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(110,'BCKNO-677053','hannes.bakti','6440b43b994a5c88c46a6b108335ef23','HANNES BAKTI MANURUNG','199210012012101001','Pengatur - II/c','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(112,'BCKNO-733050','godwind.lothar','75a2eeedf7d7094be6a5bc2195dc53ba','GODWIND LOTHAR MARUASA SINAGA','199012272013101001','Penata Muda - III/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(117,'BCKNO-490003','adminkodic','98f73c4e5fd70bf6cd6a8f566aa6624d','ADMINISTRATOR KODIC','-','-','-','ADMINISTRATOR',NULL,NULL,'AKTIF'),(118,'BCKNO-798038','perben.kno','5fcb24fa3be5875b37efc528e47c76df','SEKSI PERBENDAHARAAN','-','-','-','PERBEN',NULL,NULL,'AKTIF'),(119,'BCKNO-525038','riri.rena','0644bb2d1f6a6aa9c90653f18438a91d','RIRI RENA DAHLIANA ZAI','199804102018122001','Pengatur Muda Tk. I - II/b','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'AKTIF'),(120,'BCKNO-798039','maria.novalina','e9de80137a46d83c4ee8d11fa142edce','MARIA NOVALINA SIMANGUNSONG','200010022018122001','Pengatur Muda Tk. I - II/b','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'AKTIF'),(121,'BCKNO-526040','fitri.malinda','5005e8d527426553779d22df72d5612f','FITRI MALINDA HARAHAP','199801292018122001','Pengatur Muda Tk. I - II/b','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'AKTIF'),(122,'BCKNO-777041','cristianto','be33bd14052af42de3be863e33c52413','CRISTIANTO','199312172013101001','Pengatur - II/c','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'AKTIF'),(123,'BCKNO-323042','tri.handoko','b71a9ceebd028cb1023ac059c00157a2','TRI HANDOKO','199505232015021003','Pengatur - II/c','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'AKTIF'),(125,'BCKNO-893044','febryan.praja','e55b2813378fd219254838643f14e8ee','FEBRYAN PRAJA SIMBOLON','198902122010011008','Penata Muda - III/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'AKTIF'),(126,'BCKNO-191004','pdad','e10adc3949ba59abbe56e057f20f883e','PDAD','-','-','Seksi PDAD','ADMINISTRATOR',NULL,NULL,'AKTIF'),(127,'BCKNO-699040','dimas.giotiffano','b5a90f0cdf04f0707398150cfd701a7f','DIMAS GIOTIFFANO PUTRA','199105182013101004','Penata Muda - III/a','Pelaksana Pemeriksa Pada Seksi P2','PEMERIKSA',NULL,NULL,'AKTIF'),(128,'BCKNO-900041','nency_dewi','7b8e4bb85c16e9ce137a79314424ca8f','NENCY DEWI NAPITUPULU','197804182003122002','III/c','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(129,'BCKNO-366004','aan.sundari','2cc08b55ecaafb95e0b602f6c7b73323','AAN SUNDARI','198109132000121001','Penata Muda Tk.I - III/b','Pemeriksa Bea dan Cukai Ahli Pertama','KASUBSI',NULL,NULL,'NON-AKTIF'),(130,'BCKNO-345005','joi.simorangkir','0fd061b3ec4740078fdcf31e993128a7','JOI ARIANTO SIMORANGKIR','198002182000011001','Penata Muda Tk.I - III/b','Pemeriksa Bea dan Cukai Ahli Pertama','KASUBSI',NULL,NULL,'NON-AKTIF'),(131,'BCKNO-110038','irfan.sinaga','9f8e91f76ca9217e4e579c4e91064c94','IRFAN H. SINAGA','199106112014111001','Penata Muda - III/a','Pelaksana Pada Seksi P2','PEMERIKSA',NULL,NULL,'AKTIF'),(132,'BCKNO-901039','mutammimul.ula','900b9671126dd82d06ad83582c3555a3','MUTAMMIMUL ULA','199302112012101001','Pengatur Tk.I - II/d','Pelaksana Pemeriksa pada Seksi Penindakan dan Penyidikan','PEMERIKSA',NULL,NULL,'AKTIF'),(133,'BCKNO-551040','boy.tarsan','c9b2377991d2360ce836303b49bb056c','BOY TARSAN PANGARIBUAN','199311162013101002','Pengatur - II/c','Pelaksana Pada Seksi P2','PEMERIKSA',NULL,NULL,'AKTIF'),(134,'BCKNO-220041','ferdi.gunawan','afa96eb39568816532d556425c9720eb','FERDI RIZKY GUNAWAN','199805102018121001','Pengatur Muda Tk. I - II/b','Pelaksana Pada Seksi P2','PEMERIKSA',NULL,NULL,'AKTIF'),(135,'BCKNO-715036','ferizal.gunawan','301feea4a05fe4ce351dfcb1ab94054b','FERIZAL GUNAWAN','199812012018121001','Pengatur Muda - II.a','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(136,'BCKNO-403037','hariyani.dewi','c052b1d96dddc13e976770a806f4e9b0','HARIYANI KURNIA DEWI','199805172018122001','Pengatur Muda Tk. I - II/b','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'AKTIF'),(137,'BCKNO-486038','christin.oktaviana','4c02abfad5eb2b51f91a22fc809c10d0','CHRISTIN OKTAVIANA','199510102015122001','Pengatur Muda Tk.I - II.b','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'AKTIF'),(138,'BCKNO-338039','frans.pasaribu','b1eb0b88184cce26dc27af5f448722a6','FRANS AFRIANDI PASARIBU','197704271996031001','Penata - III.c','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'AKTIF'),(139,'BCKNO-509040','melinton. nababan','90073e6a2e31fca4b9790d1737cdbdc5','MELINTON SORITUA NABABAN','198905252010011002','Pengatur Tk. I / II.d','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'AKTIF'),(140,'BCKNO-945041','rinaldi.ginting','e10adc3949ba59abbe56e057f20f883e','M. RINALDI GINTING','198604272007101001','Penata Muda - III/a','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'AKTIF'),(141,'BCKNO-409042','regita.ayu','0b2e134de6091f5e37bd92b09cc95c6b','REGITA AYU CAHYANI SURBAKTI','199707092018012001','Pengatur Muda Tk.I / II.b','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'AKTIF'),(142,'BCKNO-963043','lewi.kuasa','83450bcf053393302c20f9e23d823cee','LEWI KUASA HUTABARAT','200006112018121001','Pengatur Muda Tk.I','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(143,'BCKNO-638044','ericco.fatwa','3fb6ef42240656e81d644c59a98c282f','ERICCO FATWA M','199904252018121001','Pengatur Muda Tk.I / II.b','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'AKTIF'),(144,'BCKNO-324005','muhammad.syah putra','cf89a48b0b5c47bee4fd6e1730acf1cb','MUHAMMAD SYAH PUTRA','198209192000121002','III/c','Pemeriksa Bea Cukai Ahli Pertama','KASUBSI',NULL,NULL,'NON-AKTIF'),(145,'BCKNO-562045','daniel.bryan','12d57ed953d634e77128b6ad1d2ff1f8','DANIEL BRYAN','199403122015021001','Penata Muda - III/a','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'AKTIF'),(146,'BCKNO-787046','urie.dinure','543cfd2fbb391d028c5be2b05f263e3a','URIE DINURE TERRANOVA','199504122015022001','Pengatur / II.c','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'AKTIF'),(148,'BCKNO-974048','agung.tasyakury','10d9819b0e2d4800b4d955fc2ac3aa80','AGUNG TASYAKURY','199508182016121001','Pengatur Tk. I / II.d','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'AKTIF'),(150,'BCKNO-253050','ahmad.zakiy','e219aef7c49e62bfa376312d814431c4','AHMAD ZAKIY','198910172010011002','Pengatur Tk. I / II.d','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'AKTIF'),(151,'BCKNO-187051','yowanda.pramana','1e7e7729f7431ef2392e3cc48d18c285','YOWANDA PRAMANA','199001252009121001','III.a','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'AKTIF'),(152,'BCKNO-726051','loksa.restu','971c6f4142e6b29120e93d26c1fe097f','LOKSA RESTU SIANTURI','199210262013101001','Penata Muda - III/a','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'AKTIF'),(153,'BCKNO-486052','zulfahmi','1820307bbf020cd021a13309e9ad5941','ZULFAHMI','198211062001121001','Penata Muda Tk. I','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'AKTIF'),(154,'BCKNO-283053','mouchlizar','86c9f2b8b2b3ad1bc6a3651a2aec98b6','MOUCHLIZAR','198505162004121003','Penata Muda - III/a','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'AKTIF'),(155,'BCKNO-650054','cintami.efrika','0e648eccd757b2fb8f5e02af85e58a31','CINTAMI EFRIKA ENJELINA BR HUTABARAT','199904212018122002','Penata Muda Tk.I','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'NON-AKTIF'),(156,'BCKNO-147006','dian.eka','d9158aa20cf9b5a212fc8e21d96970ba','DIAN EKA SAPUTRA','198211062002121002','Penata Muda Tk. I - III/b','PEMERIKSA BEA CUKAI PERTAMA','KASUBSI',NULL,NULL,'AKTIF'),(157,'BCKNO-646007','duly.endewi','312ee5dde135a3504de7f2ab660ac574','DULY ENDEWI','198406292004121003','III.B / PENATA MUDA TINGKAT I','PEMERIKSA BEA CUKAI PERTAMA','KASUBSI',NULL,NULL,'NON-AKTIF'),(158,'BCKNO-380054','Afifah Siregar','af0896a0a1a02a01077f802598907a96','AFIFAH WAHYUNI SIREGAR','199912032018122002','Pengatur Muda Tk.I','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'AKTIF'),(160,'BCKNO-841007','hermansyah','3c4e14556cf92b906e4553356726861d','HERMANSYAH','198505242004121002','Penata Muda Tk. I / III.b','Pemeriksa Bea dan Cukai Pertama','KASUBSI',NULL,NULL,'AKTIF'),(161,'BCKNO-687002','fadli.rahman','d41d8cd98f00b204e9800998ecf8427e','FADLI RAHMAN','198404272010121004','Penata Tk.I - III/d','KEPALA SEKSI PENINDAKAN DAN PENYIDIKAN','KA. SEKSE',NULL,NULL,'AKTIF'),(162,'BCKNO-768002','Richi.Rizky','aa21393366593120409bb43ccf7d2744','RICHI RIZKY ALJAFARSYAH','1999021920181210011','Pengatur Muda Tk.I / II.b','Pelaksana Pemeriksa','ANALIS',NULL,NULL,'AKTIF'),(163,'BCKNO-914001','Seksi.KI','fd9d84fce1bf293cba119621aa0e3bb7','SEKSI KEPATUHAN INTERNAL','1234','-','-','K.I',NULL,NULL,'AKTIF'),(165,'BCKNO-536008','Fery.Alamsyah','70bcf3952257e6f0ab36e7483b4ad13a','FERY ALAMSYAH','198207262003121002','Penata Muda Tk.I / III.b','Pemeriksa Bea dan Cukai Pertama','KASUBSI',NULL,NULL,'AKTIF'),(166,'BCKNO-673055','Robert.Tanta','efe85fcd4b00814b7166c1ef4f01f78e','ROBERT TANTA PERANGIN-ANGIN','199509082018011002','Pengatur Tk.I / II.d','Pelaksana Pemeriksa','PEMERIKSA',NULL,NULL,'AKTIF');
