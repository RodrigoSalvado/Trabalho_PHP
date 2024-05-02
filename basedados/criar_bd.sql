-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Maio-2024 às 20:25
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `trabalholpi`
--

    CREATE DATABASE TrabalhoLPI;
    USE TrabalhoLPI;
-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
                         `id_curso` int(11) NOT NULL,
                         `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_utilizador`
--

CREATE TABLE `tipo_utilizador` (
                                   `id` int(11) NOT NULL,
                                   `cargo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tipo_utilizador`
--

INSERT INTO `tipo_utilizador` (`id`, `cargo`) VALUES
                                                  (1, 'cliente'),
                                                  (2, 'aluno'),
                                                  (3, 'docente'),
                                                  (4, 'administrador'),
                                                  (5, 'apagado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE `utilizador` (
                              `id_utilizador` int(11) NOT NULL,
                              `username` varchar(50) NOT NULL,
                              `password` varchar(100) NOT NULL,
                              `email` varchar(150) NOT NULL,
                              `tipo_utilizador` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`id_utilizador`, `username`, `password`, `email`, `tipo_utilizador`) VALUES
                                                                                                   (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', 4),
                                                                                                   (2, 'docente', 'ac99fecf6fcb8c25d18788d14a5384ee', 'docente@docente.com', 3),
                                                                                                   (3, 'aluno', 'ca0cd09a12abade3bf0777574d9f987f', 'aluno@aluno.com', 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
    ADD PRIMARY KEY (`id_curso`);

--
-- Índices para tabela `tipo_utilizador`
--
ALTER TABLE `tipo_utilizador`
    ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `utilizador`
--
ALTER TABLE `utilizador`
    ADD PRIMARY KEY (`id_utilizador`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
    MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipo_utilizador`
--
ALTER TABLE `tipo_utilizador`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `utilizador`
--
ALTER TABLE `utilizador`
    MODIFY `id_utilizador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
