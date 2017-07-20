-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 172.17.0.1
-- Tempo de geração: 19/07/2017 às 22:36
-- Versão do servidor: 5.7.16
-- Versão do PHP: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mt4_contatos_avaliacao`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `contatos`
--

CREATE TABLE `contatos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Fazendo dump de dados para tabela `contatos`
--

INSERT INTO `contatos` (`id`, `nome`, `criado`) VALUES
(1, 'Jhonata Menezes', '2017-07-19 01:14:52'),
(2, 'Mariana Crisllayne', '2017-07-19 01:14:52'),
(3, 'jhonata menezes', '2017-07-19 20:14:20'),
(4, 'jhonata menezes', '2017-07-19 20:14:41'),
(5, 'jhonata menezes', '2017-07-19 20:15:15'),
(6, 'jhonata menezes', '2017-07-19 20:15:55'),
(7, 'jhonata menezes', '2017-07-19 20:18:35'),
(8, 'jhonata menezes', '2017-07-19 21:47:43'),
(9, 'jhonata menezes', '2017-07-19 21:49:03'),
(10, 'jhonata menezes', '2017-07-19 21:49:44');

-- --------------------------------------------------------

--
-- Estrutura para tabela `email`
--

CREATE TABLE `email` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('pessoal','trabalho') COLLATE utf8mb4_unicode_ci NOT NULL,
  `contatos_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Fazendo dump de dados para tabela `email`
--

INSERT INTO `email` (`id`, `email`, `tipo`, `contatos_id`) VALUES
(1, 'jhonatamenezes10@gmail.com', 'pessoal', 1),
(2, 'mariana@gmail.com', 'trabalho', 2),
(3, 'jj@jj.com', 'pessoal', 8),
(4, 'jj@jj.com', 'pessoal', 9),
(5, 'jj@jj.com', 'pessoal', 10),
(6, 'uu@uu.com', 'trabalho', 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `telefone`
--

CREATE TABLE `telefone` (
  `id` int(10) UNSIGNED NOT NULL,
  `telefone` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('celular','residencial','trabalho') COLLATE utf8mb4_unicode_ci NOT NULL,
  `contatos_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Fazendo dump de dados para tabela `telefone`
--

INSERT INTO `telefone` (`id`, `telefone`, `tipo`, `contatos_id`) VALUES
(1, '11967438081', 'celular', 1),
(2, '11978675867', 'celular', 8),
(3, '11978675867', 'celular', 9),
(4, '11978675867', 'celular', 10),
(5, '1999999991', 'residencial', 10);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contatos_id` (`contatos_id`);

--
-- Índices de tabela `telefone`
--
ALTER TABLE `telefone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contatos_id` (`contatos_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `contatos`
--
ALTER TABLE `contatos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de tabela `email`
--
ALTER TABLE `email`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `telefone`
--
ALTER TABLE `telefone`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `fk_contatos_email` FOREIGN KEY (`contatos_id`) REFERENCES `contatos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `telefone`
--
ALTER TABLE `telefone`
  ADD CONSTRAINT `fk_contatos_telefone` FOREIGN KEY (`contatos_id`) REFERENCES `contatos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;