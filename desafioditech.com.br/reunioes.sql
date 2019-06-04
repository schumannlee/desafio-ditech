-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04-Jun-2019 às 03:54
-- Versão do servidor: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `reunioes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `sala_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `horario` time NOT NULL,
  `criado` datetime NOT NULL,
  `alterado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `reservas`
--

INSERT INTO `reservas` (`id`, `usuario_id`, `sala_id`, `data`, `horario`, `criado`, `alterado`) VALUES
(1, 2, 1, '2019-06-04', '07:00:00', '2019-06-03 21:40:45', '2019-06-03 21:40:45'),
(2, 2, 1, '2019-06-04', '08:00:00', '2019-06-03 21:41:15', '2019-06-03 21:41:15'),
(3, 2, 1, '2019-06-04', '09:45:00', '2019-06-03 21:42:07', '2019-06-03 21:42:07'),
(4, 2, 1, '2019-06-04', '12:00:00', '2019-06-03 21:42:56', '2019-06-03 21:42:56'),
(5, 2, 1, '2019-06-04', '10:59:00', '2019-06-03 21:44:14', '2019-06-03 21:44:14'),
(6, 2, 1, '2019-06-04', '12:00:00', '2019-06-03 21:47:26', '2019-06-03 21:47:26'),
(8, 2, 1, '2019-06-04', '06:00:00', '2019-06-03 21:57:53', '2019-06-03 21:57:53'),
(10, 2, 1, '2019-06-04', '13:00:00', '2019-06-03 22:08:45', '2019-06-03 22:08:45'),
(11, 2, 1, '2019-06-04', '05:00:00', '2019-06-03 22:10:18', '2019-06-03 22:10:18'),
(12, 1, 2, '2019-06-05', '10:00:00', '2019-06-03 22:34:39', '2019-06-03 22:34:39'),
(13, 1, 2, '2019-06-04', '08:00:00', '2019-06-03 22:34:59', '2019-06-03 22:34:59'),
(14, 1, 2, '2019-06-04', '10:30:00', '2019-06-03 22:36:01', '2019-06-03 22:36:01'),
(15, 1, 2, '2019-06-04', '09:20:00', '2019-06-03 22:36:45', '2019-06-03 22:36:45');

-- --------------------------------------------------------

--
-- Estrutura da tabela `salas`
--

CREATE TABLE `salas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `capacidade` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `criado` datetime NOT NULL,
  `alterado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `salas`
--

INSERT INTO `salas` (`id`, `nome`, `capacidade`, `status`, `criado`, `alterado`) VALUES
(1, 'Sala 001', 250, 'Ativa', '2019-06-02 16:05:45', '2019-06-02 16:05:45'),
(2, 'Sala 002', 120, 'Ativa', '2019-06-03 22:28:21', '2019-06-03 22:28:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `situacao`
--

CREATE TABLE `situacao` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `situacao`
--

INSERT INTO `situacao` (`id`, `status`) VALUES
(2, 'ativo'),
(4, 'cancelado'),
(1, 'pendente'),
(3, 'suspenso');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `login` varchar(30) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `permissao` varchar(30) DEFAULT 'membro',
  `status_id` int(11) NOT NULL DEFAULT '1',
  `criado` datetime NOT NULL,
  `alterado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `login`, `senha`, `permissao`, `status_id`, `criado`, `alterado`) VALUES
(1, 'mail01@mail.com', 'user01', '123456', 'admin', 2, '2019-06-02 01:37:59', '2019-06-02 01:38:02'),
(2, 'mail02@mail.com', 'user02', '123456', 'membro', 2, '2019-06-03 15:51:53', '2019-06-03 15:51:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `situacao`
--
ALTER TABLE `situacao`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status` (`status`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `salas`
--
ALTER TABLE `salas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `situacao`
--
ALTER TABLE `situacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;
