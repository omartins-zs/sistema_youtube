-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08-Set-2023 às 20:15
-- Versão do servidor: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistemayoutube`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nomefantasia` varchar(200) NOT NULL,
  `razaosocial` varchar(200) NOT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `telefone` varchar(15) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `email` varchar(200) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` char(2) NOT NULL,
  `cep` char(8) NOT NULL,
  `status` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nomefantasia`, `razaosocial`, `cnpj`, `cpf`, `telefone`, `celular`, `email`, `endereco`, `complemento`, `bairro`, `cidade`, `estado`, `cep`, `status`) VALUES
(1, 'Lucas Guima LTDA2', 'Lucas Guimaraes LTDA Industria', '63111344000198', '', '112365-4112', '112365-1222', 'lucasltda@email.com', 'Rua do Lucas 333', 'Complemento Rua do Lucas', 'Bairro do Lucas', 'Cidado do Lucas', 'SP', '15430970', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidoitens`
--

CREATE TABLE `pedidoitens` (
  `pedidoitemid` int(11) NOT NULL,
  `pedidoid` int(11) NOT NULL,
  `clienteid` int(11) NOT NULL,
  `usuarioid` int(11) NOT NULL,
  `produtoid` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valormercadoria` decimal(10,2) NOT NULL,
  `valorvenda` decimal(10,2) NOT NULL,
  `desconto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidoitens`
--

INSERT INTO `pedidoitens` (`pedidoitemid`, `pedidoid`, `clienteid`, `usuarioid`, `produtoid`, `quantidade`, `valormercadoria`, `valorvenda`, `desconto`) VALUES
(1, 1, 1, 2, 0, 0, '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `pedidoid` int(11) NOT NULL,
  `usuarioid` int(11) NOT NULL,
  `clienteid` int(11) NOT NULL,
  `codigopedido` varchar(20) NOT NULL,
  `valorbruto` varchar(20) NOT NULL,
  `valorliquido` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`pedidoid`, `usuarioid`, `clienteid`, `codigopedido`, `valorbruto`, `valorliquido`) VALUES
(1, 2, 1, '20230613152212', '0', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE `perfil` (
  `perfilid` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`perfilid`, `descricao`, `status`) VALUES
(1, 'SUPER ADMINISTRADOR', 1),
(2, 'ADMINISTRADOR (EMPRESA)', 1),
(3, 'DIRETOR', 1),
(4, 'GERENTE', 1),
(5, 'SUPERVISOR', 1),
(6, 'REPRESENTANTE (VENDEDOR)', 1),
(7, 'CLIENTE', 1),
(8, 'VISITANTE', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `descricaoproduto` varchar(100) NOT NULL,
  `unidade` int(11) NOT NULL,
  `valormercadoria` float NOT NULL,
  `valorvenda` float NOT NULL,
  `qtdeestoque` int(11) NOT NULL,
  `descontopermitido` int(11) NOT NULL,
  `alertaestoque` int(11) NOT NULL,
  `qtdevendaminima` int(11) NOT NULL,
  `qtdevalorminimo` float NOT NULL,
  `codigoean` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `descricaoproduto`, `unidade`, `valormercadoria`, `valorvenda`, `qtdeestoque`, `descontopermitido`, `alertaestoque`, `qtdevendaminima`, `qtdevalorminimo`, `codigoean`) VALUES
(1, 'Notebook ', 1, 1200, 1500, 50, 15, 20, 1, 1250, 0),
(2, 'Smartphone', 1, 2000, 2300, 100, 10, 20, 1, 1800, 2147483647);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `login` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `datacadastro` datetime NOT NULL,
  `dataultimoacesso` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `perfilid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `login`, `email`, `senha`, `datacadastro`, `dataultimoacesso`, `status`, `perfilid`) VALUES
(1, 'Administrador do Sistema', 'admin', 'jaquelinesensacao@gmail.com', '12345', '2017-10-10 14:58:00', '0000-00-00 00:00:00', 1, 1),
(2, 'Gabriel Matheus Alves Martins', 'gabriel', 'gabrielmatheus209@gmail.com', '123456', '2023-05-23 00:00:00', '0000-00-00 00:00:00', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pedidoitens`
--
ALTER TABLE `pedidoitens`
  ADD PRIMARY KEY (`pedidoitemid`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`pedidoid`);

--
-- Indexes for table `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`perfilid`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pedidoitens`
--
ALTER TABLE `pedidoitens`
  MODIFY `pedidoitemid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `pedidoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `perfil`
--
ALTER TABLE `perfil`
  MODIFY `perfilid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
