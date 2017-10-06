-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2017 at 09:14 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_siobat`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_distributor`
--

CREATE TABLE IF NOT EXISTS `tb_distributor` (
`id_distributor` int(11) NOT NULL,
  `nama_distributor` varchar(64) DEFAULT NULL,
  `kontak` varchar(13) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_distributor`
--

INSERT INTO `tb_distributor` (`id_distributor`, `nama_distributor`, `kontak`, `alamat`) VALUES
(2, 'PT SANBE FARMA', '08948934', 'JAKARTA');

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokter`
--

CREATE TABLE IF NOT EXISTS `tb_dokter` (
`id_dokter` int(11) NOT NULL,
  `nama_dokter` varchar(64) DEFAULT NULL,
  `kontak` varchar(13) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dokter`
--

INSERT INTO `tb_dokter` (`id_dokter`, `nama_dokter`, `kontak`, `alamat`) VALUES
(2, 'Murti', '094048', 'Bandung');

-- --------------------------------------------------------

--
-- Table structure for table `tb_golongan_darah`
--

CREATE TABLE IF NOT EXISTS `tb_golongan_darah` (
`id_gol_darah` int(1) NOT NULL,
  `golongan_darah` varchar(64) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_golongan_darah`
--

INSERT INTO `tb_golongan_darah` (`id_gol_darah`, `golongan_darah`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'AB'),
(4, 'O');

-- --------------------------------------------------------

--
-- Table structure for table `tb_golongan_obat`
--

CREATE TABLE IF NOT EXISTS `tb_golongan_obat` (
`id_gol_obat` int(11) NOT NULL,
  `golongan_obat` varchar(64) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_golongan_obat`
--

INSERT INTO `tb_golongan_obat` (`id_gol_obat`, `golongan_obat`) VALUES
(1, 'Obat Bebas'),
(2, 'Obat Bebas Terbatas'),
(3, 'Obat Keras'),
(4, 'Psikotropika'),
(5, 'Narkotika'),
(6, 'Obat Wajib Apotek (OWA)');

-- --------------------------------------------------------

--
-- Table structure for table `tb_obat`
--

CREATE TABLE IF NOT EXISTS `tb_obat` (
`id_obat` int(11) NOT NULL,
  `kode_obat` varchar(11) DEFAULT NULL,
  `nama_obat` varchar(64) DEFAULT NULL,
  `id_distributor` int(11) DEFAULT NULL,
  `id_gol_obat` int(1) DEFAULT '6'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_obat`
--

INSERT INTO `tb_obat` (`id_obat`, `kode_obat`, `nama_obat`, `id_distributor`, `id_gol_obat`) VALUES
(1, 'B0012', 'PCC2', 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pasien`
--

CREATE TABLE IF NOT EXISTS `tb_pasien` (
`id_pasien` int(11) NOT NULL,
  `nama_pasien` varchar(64) DEFAULT NULL,
  `jenis_kelamin` varchar(1) DEFAULT NULL,
  `alamat` text,
  `tgl_lahir` date DEFAULT NULL,
  `id_gol_darah` int(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pasien`
--

INSERT INTO `tb_pasien` (`id_pasien`, `nama_pasien`, `jenis_kelamin`, `alamat`, `tgl_lahir`, `id_gol_darah`) VALUES
(1, 'Pasien 2', 'L', 'Alamat 2', '1993-08-27', 4),
(2, 'TEST', 'L', 'Test', '1995-04-04', 2),
(3, 'Mini', 'L', 'Indramayu', '1993-12-22', 4),
(4, 'ss', 'P', 'ddd', '1111-11-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE IF NOT EXISTS `tb_pengguna` (
`id_pengguna` int(11) NOT NULL,
  `nama_lengkap` varchar(64) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `hak_akses` varchar(1) DEFAULT NULL,
  `gambar` varchar(64) DEFAULT 'default.png'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama_lengkap`, `username`, `password`, `hak_akses`, `gambar`) VALUES
(1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ruangan`
--

CREATE TABLE IF NOT EXISTS `tb_ruangan` (
`id_ruangan` int(11) NOT NULL,
  `ruangan` varchar(64) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ruangan`
--

INSERT INTO `tb_ruangan` (`id_ruangan`, `ruangan`) VALUES
(7, 'Melati I'),
(8, 'Melati II'),
(9, 'Melati III'),
(10, 'Melati IV'),
(11, 'Melati V');

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE IF NOT EXISTS `tb_status` (
`id_status` int(11) NOT NULL,
  `status` varchar(64) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_status`
--

INSERT INTO `tb_status` (`id_status`, `status`) VALUES
(1, 'Selesai'),
(2, 'Belum');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi` (
`id_transaksi` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `id_ruangan` int(11) DEFAULT NULL,
  `id_obat` int(11) DEFAULT NULL,
  `id_status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_distributor`
--
ALTER TABLE `tb_distributor`
 ADD PRIMARY KEY (`id_distributor`);

--
-- Indexes for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
 ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `tb_golongan_darah`
--
ALTER TABLE `tb_golongan_darah`
 ADD PRIMARY KEY (`id_gol_darah`);

--
-- Indexes for table `tb_golongan_obat`
--
ALTER TABLE `tb_golongan_obat`
 ADD PRIMARY KEY (`id_gol_obat`);

--
-- Indexes for table `tb_obat`
--
ALTER TABLE `tb_obat`
 ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
 ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
 ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `tb_ruangan`
--
ALTER TABLE `tb_ruangan`
 ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
 ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
 ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_distributor`
--
ALTER TABLE `tb_distributor`
MODIFY `id_distributor` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_golongan_darah`
--
ALTER TABLE `tb_golongan_darah`
MODIFY `id_gol_darah` int(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_golongan_obat`
--
ALTER TABLE `tb_golongan_obat`
MODIFY `id_gol_obat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_obat`
--
ALTER TABLE `tb_obat`
MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_ruangan`
--
ALTER TABLE `tb_ruangan`
MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_status`
--
ALTER TABLE `tb_status`
MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
