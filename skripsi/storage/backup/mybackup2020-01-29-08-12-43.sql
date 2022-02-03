#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` int(11) NOT NULL,
  `gambar` varchar(128) NOT NULL DEFAULT 'default.png',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `level`, `gambar`) VALUES (1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '148e34a461f32b54d33e7abea3e5f0ae.jpg');
INSERT INTO `users` (`id`, `nama`, `username`, `password`, `level`, `gambar`) VALUES (3, 'aldhanbiuzar', 'aldhanbiuzar', '0aa8fedeba30a3b9a5d7ebf201f64bc4', 2, '86fce450b788f35ddb7fe3044d4c88f4.jpg');
INSERT INTO `users` (`id`, `nama`, `username`, `password`, `level`, `gambar`) VALUES (5, 'aldhanbiuzar1', 'aldhanbiuzar1', 'f3da059c889a14d9e263e0643fb2712c', 1, '2df031cb03e034a67e47b9d135fde5ee.jpg');
INSERT INTO `users` (`id`, `nama`, `username`, `password`, `level`, `gambar`) VALUES (6, 'aldhanbiuzar2', 'aldhanbiuzar2', 'e7f77cffdab25176d3828465910e546f', 1, 'ac250cc04ee9f56c4473070bbb6d4a9a.jpg');
INSERT INTO `users` (`id`, `nama`, `username`, `password`, `level`, `gambar`) VALUES (7, 'aldhanbiuzar3', 'aldhanbiuzar3', '27b751b37e026f4878160d1a58e42860', 1, 'default.png');


