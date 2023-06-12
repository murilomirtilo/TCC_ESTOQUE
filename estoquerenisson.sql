-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Jun-2023 às 19:31
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `estoquerenisson`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `baixas`
--

CREATE TABLE `baixas` (
  `id_baixa` int(11) NOT NULL,
  `causa_baixa` varchar(45) NOT NULL,
  `data_baixa` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nome_baixa` varchar(45) NOT NULL,
  `responsavel` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `baixa_pr`
--

CREATE TABLE `baixa_pr` (
  `id_baixaPR` int(11) NOT NULL,
  `avaria_produtoR` varchar(45) NOT NULL,
  `data_PR` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nome_PR` varchar(45) NOT NULL,
  `patrimonio` varchar(405) NOT NULL,
  `responsavel` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `chaves`
--

CREATE TABLE `chaves` (
  `id_chave` int(11) NOT NULL,
  `nome_chave` varchar(45) NOT NULL,
  `vista_chave` varchar(45) NOT NULL,
  `data_chave` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `disponivel_chave` tinyint(1) NOT NULL,
  `responsavel` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimos`
--

CREATE TABLE `emprestimos` (
  `id_empr` int(11) NOT NULL,
  `mutuario_empr` varchar(45) NOT NULL,
  `quantidade_empr` int(45) NOT NULL,
  `data_empr` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `produto_empr` varchar(45) NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `unidade_empr` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empr_pr`
--

CREATE TABLE `empr_pr` (
  `id_emprPR` int(11) NOT NULL,
  `mutuario_empr` varchar(45) NOT NULL,
  `quantidade_empr` int(45) NOT NULL,
  `data_empr` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `produto_empr` varchar(45) NOT NULL,
  `patrimonio` varchar(405) NOT NULL,
  `responsavel` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrada`
--

CREATE TABLE `entrada` (
  `id_entrada` int(11) NOT NULL,
  `quantidade_entrada` varchar(45) DEFAULT NULL,
  `nome_entrada` varchar(45) DEFAULT NULL,
  `data_entrada` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `unidade_entrada` varchar(45) DEFAULT NULL,
  `user_entrada` varchar(45) DEFAULT NULL,
  `quantidadeAnterior_entrada` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `nome_produto` varchar(45) NOT NULL,
  `qtd_produto` varchar(45) NOT NULL,
  `valor_produto` varchar(45) NOT NULL,
  `cat_produto` varchar(45) NOT NULL,
  `unidade_produto` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtosretornaveis`
--

CREATE TABLE `produtosretornaveis` (
  `id_produtoR` int(11) NOT NULL,
  `nome_produtoR` varchar(45) NOT NULL,
  `qtd_produtoR` int(45) NOT NULL,
  `local_produtoR` varchar(45) NOT NULL,
  `situacao_produtoR` tinyint(1) NOT NULL,
  `qtd_emprR` int(45) NOT NULL,
  `vista_pR` varchar(45) NOT NULL,
  `data_emprR` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `patrimonio` varchar(405) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `baixas`
--
ALTER TABLE `baixas`
  ADD PRIMARY KEY (`id_baixa`);

--
-- Índices para tabela `baixa_pr`
--
ALTER TABLE `baixa_pr`
  ADD PRIMARY KEY (`id_baixaPR`);

--
-- Índices para tabela `chaves`
--
ALTER TABLE `chaves`
  ADD PRIMARY KEY (`id_chave`);

--
-- Índices para tabela `empr_pr`
--
ALTER TABLE `empr_pr`
  ADD PRIMARY KEY (`id_emprPR`);

--
-- Índices para tabela `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`id_entrada`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices para tabela `produtosretornaveis`
--
ALTER TABLE `produtosretornaveis`
  ADD PRIMARY KEY (`id_produtoR`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `baixas`
--
ALTER TABLE `baixas`
  MODIFY `id_baixa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `baixa_pr`
--
ALTER TABLE `baixa_pr`
  MODIFY `id_baixaPR` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `chaves`
--
ALTER TABLE `chaves`
  MODIFY `id_chave` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `empr_pr`
--
ALTER TABLE `empr_pr`
  MODIFY `id_emprPR` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `entrada`
--
ALTER TABLE `entrada`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtosretornaveis`
--
ALTER TABLE `produtosretornaveis`
  MODIFY `id_produtoR` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
