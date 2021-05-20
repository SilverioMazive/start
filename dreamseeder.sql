-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08-Maio-2021 às 07:47
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dreamseeder`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcategorias`
--

CREATE TABLE `tbcategorias` (
  `categoriaid` int(11) NOT NULL,
  `nomecat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbcategorias`
--

INSERT INTO `tbcategorias` (`categoriaid`, `nomecat`) VALUES
(1, 'Fruta'),
(2, 'Horticula'),
(3, 'Legume'),
(4, 'Verdura'),
(5, 'Semente'),
(6, 'Cereal');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblevantamento`
--

CREATE TABLE `tblevantamento` (
  `levantamentoid` int(11) NOT NULL,
  `telefone` text NOT NULL,
  `valor` double NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblmpesarequest`
--

CREATE TABLE `tblmpesarequest` (
  `id` int(11) NOT NULL,
  `resposta` varchar(100) NOT NULL,
  `output_ResponseCode` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tblmpesarequest`
--

INSERT INTO `tblmpesarequest` (`id`, `resposta`, `output_ResponseCode`) VALUES
(1, 'Sucesso', 'INS-0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpaystate`
--

CREATE TABLE `tbpaystate` (
  `psid` int(11) NOT NULL,
  `res1` text NOT NULL,
  `res2` text NOT NULL,
  `res3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbpaystate`
--

INSERT INTO `tbpaystate` (`psid`, `res1`, `res2`, `res3`) VALUES
(1, 'sucesso', 'falha', 'erro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbprod`
--

CREATE TABLE `tbprod` (
  `prodid` int(11) NOT NULL,
  `nome` text NOT NULL,
  `views` int(11) NOT NULL,
  `preco` double NOT NULL,
  `descricao` text NOT NULL,
  `estado` text NOT NULL,
  `quantificadorid` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `datavalidade` datetime NOT NULL,
  `data` datetime NOT NULL,
  `categoriaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbprodimages`
--

CREATE TABLE `tbprodimages` (
  `imageid` int(11) NOT NULL,
  `prodid` int(11) NOT NULL,
  `imagem` text NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbprovincia`
--

CREATE TABLE `tbprovincia` (
  `provinciaid` int(11) NOT NULL,
  `nome` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbprovincia`
--

INSERT INTO `tbprovincia` (`provinciaid`, `nome`) VALUES
(1, 'Maputo'),
(2, 'Gaza'),
(3, 'Inhambane'),
(4, 'Sofala'),
(5, 'Manica'),
(6, 'Tete'),
(7, 'Zambezia'),
(8, 'Nampula'),
(9, 'Niassa'),
(10, 'Cabo Delgado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbquantificadores`
--

CREATE TABLE `tbquantificadores` (
  `quantificadorid` int(11) NOT NULL,
  `quantificador` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbquantificadores`
--

INSERT INTO `tbquantificadores` (`quantificadorid`, `quantificador`) VALUES
(1, 'Peso (Kg) - Quilogramas'),
(2, 'Numero de unidades'),
(3, 'Molho');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbrecarregamento`
--

CREATE TABLE `tbrecarregamento` (
  `recid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `telefone` text NOT NULL,
  `valor` double NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuarios`
--

CREATE TABLE `tbusuarios` (
  `uid` int(11) NOT NULL,
  `nome` text NOT NULL,
  `telefone` varchar(200) NOT NULL,
  `ganho` double NOT NULL,
  `tipo` text NOT NULL,
  `estado` text NOT NULL,
  `senha` text NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbusuarios`
--

INSERT INTO `tbusuarios` (`uid`, `nome`, `telefone`, `ganho`, `tipo`, `estado`, `senha`, `data`) VALUES
(1, 'Custom', '1', 26, 'cliente', 'permitido', '$2y$10$5oY6nlS9cz4eWsHuF70mC.b6kpEmaEFBkxD935rMdzXCribkIVvJy', '2021-01-12 01:16:54'),
(2, 'Bolador', '22', 48, 'vendedor', 'permitido', '$2y$10$ja7rT31NlX/Ia6F.m7an6ufKY15iT00///y8zVTutQCYSjncRH9Pe', '2021-01-12 01:18:10'),
(3, 'Silverio', '855400000', 8, 'cliente', 'permitido', '$2y$10$UNdv9jPzXOETlgmzmtpdv.Kyc0q2J5vFrGd3HZkxTcXcscDX6J2E.', '2021-01-12 03:39:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbcategorias`
--
ALTER TABLE `tbcategorias`
  ADD PRIMARY KEY (`categoriaid`);

--
-- Indexes for table `tblevantamento`
--
ALTER TABLE `tblevantamento`
  ADD PRIMARY KEY (`levantamentoid`);

--
-- Indexes for table `tblmpesarequest`
--
ALTER TABLE `tblmpesarequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbpaystate`
--
ALTER TABLE `tbpaystate`
  ADD PRIMARY KEY (`psid`);

--
-- Indexes for table `tbprod`
--
ALTER TABLE `tbprod`
  ADD PRIMARY KEY (`prodid`);

--
-- Indexes for table `tbprodimages`
--
ALTER TABLE `tbprodimages`
  ADD PRIMARY KEY (`imageid`);

--
-- Indexes for table `tbprovincia`
--
ALTER TABLE `tbprovincia`
  ADD PRIMARY KEY (`provinciaid`);

--
-- Indexes for table `tbquantificadores`
--
ALTER TABLE `tbquantificadores`
  ADD PRIMARY KEY (`quantificadorid`);

--
-- Indexes for table `tbrecarregamento`
--
ALTER TABLE `tbrecarregamento`
  ADD PRIMARY KEY (`recid`);

--
-- Indexes for table `tbusuarios`
--
ALTER TABLE `tbusuarios`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `telefone` (`telefone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbcategorias`
--
ALTER TABLE `tbcategorias`
  MODIFY `categoriaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblevantamento`
--
ALTER TABLE `tblevantamento`
  MODIFY `levantamentoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblmpesarequest`
--
ALTER TABLE `tblmpesarequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbpaystate`
--
ALTER TABLE `tbpaystate`
  MODIFY `psid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbprod`
--
ALTER TABLE `tbprod`
  MODIFY `prodid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbprodimages`
--
ALTER TABLE `tbprodimages`
  MODIFY `imageid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbprovincia`
--
ALTER TABLE `tbprovincia`
  MODIFY `provinciaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbquantificadores`
--
ALTER TABLE `tbquantificadores`
  MODIFY `quantificadorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbrecarregamento`
--
ALTER TABLE `tbrecarregamento`
  MODIFY `recid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbusuarios`
--
ALTER TABLE `tbusuarios`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
