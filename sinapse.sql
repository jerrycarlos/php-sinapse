-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Tempo de geração: 06/05/2018 às 23:02
-- Versão do servidor: 5.7.22-0ubuntu0.16.04.1
-- Versão do PHP: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sinapse`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento`
--

CREATE TABLE `evento` (
  `id` int(11) NOT NULL,
  `tema` varchar(100) CHARACTER SET latin1 NOT NULL,
  `descricao` varchar(250) CHARACTER SET latin1 NOT NULL,
  `fk_instituicao` int(11) DEFAULT NULL,
  `fk_palestrante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `evento`
--

INSERT INTO `evento` (`id`, `tema`, `descricao`, `fk_instituicao`, `fk_palestrante`) VALUES
(1, 'revisao', 'revisao dos calouros', 1, 1),
(2, 'revisao', 'revisao dos calouros', 9, 1),
(3, 'treinamento', 'excel', 2, 2),
(4, 'massoterapia', 'massoterapia no trabalho', 3, 2),
(5, 'aula android', 'android', 3, 9),
(6, 'contabilidade', 'o uso do dia a dia', 3, 9),
(7, 'aula', 'revisao', 7, 2),
(11, 'teste', 'primeiro evento cadastrado via php', 8, 36),
(12, 'evento 2', 'teste evento 2 php', 9, 36),
(13, 'teste2', 'teste de cadastro\n', 1, 36),
(14, 'fkslrpp', 'ldodls', 1, 36),
(15, 'fodork', 'lrlflsll', 7, 36),
(16, 'direcao', 'direcao defensiva', 4, 36),
(17, 'gera evento', 'evento do gera', 2, 112);

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento_participante`
--

CREATE TABLE `evento_participante` (
  `id` int(11) NOT NULL,
  `fk_evento` int(11) DEFAULT NULL,
  `fk_participante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `evento_participante`
--

INSERT INTO `evento_participante` (`id`, `fk_evento`, `fk_participante`) VALUES
(1, 4, 36),
(4, 5, 112);

-- --------------------------------------------------------

--
-- Estrutura para tabela `instituicoes`
--

CREATE TABLE `instituicoes` (
  `cnpj` varchar(14) CHARACTER SET utf8 NOT NULL,
  `nome` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `nome_fantasia` varchar(34) CHARACTER SET utf8 DEFAULT NULL,
  `logradouro` varchar(34) CHARACTER SET utf8 DEFAULT NULL,
  `numero` varchar(4) CHARACTER SET utf8 DEFAULT NULL,
  `cep` varchar(11) CHARACTER SET utf8 DEFAULT NULL,
  `bairro` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `cidade` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `uf` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `telefone` varchar(14) CHARACTER SET utf8 DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `instituicoes`
--

INSERT INTO `instituicoes` (`cnpj`, `nome`, `nome_fantasia`, `logradouro`, `numero`, `cep`, `bairro`, `cidade`, `uf`, `email`, `telefone`, `id`) VALUES
('02608755000107', 'IREP SOCIEDADE DE ENSINO SUPERIOR', 'ESTACIO', 'R PROMOTOR GABRIEL NETUZZI PEREZ', '108', '04.743-020', 'SANTO AMARO', 'SAO PAULO', 'SP', '', '', 1),
('06083327000150', 'SOCIEDADE EDUCACIONAL CARVALHO GOMES LTDA', 'SECARGO', 'AV ENGENHEIRO ROBERTO FREIRE', '1422', '59.082-095', 'CAPIM MACIO', 'NATAL', 'RN', 'CONTABILIDADE@SEREDUCACIONAL.COM', '(81) 3413-4611', 2),
('08226789000105', 'IRANY XAVIER DE ANDRADE EIRELI ', 'COMPLEXO EDUCACIONAL CONTEMPORANEO', 'R DO COBRE ', '18', '59.076-210', 'LAGOA NOVA', 'NATAL ', 'RN', '-', '-', 3),
('08241911000112', 'CENTRO INTEGRADO PARA FORMACAO DE EXECUTIVOS', 'FACEX', 'R ORLANDO SILVA', '2897', '59.080-020', 'CAPIM MACIO ', 'NATAL', 'RN', 'karina_neres@hotmail.com', '(84) 9113-1328', 4),
('08340515000142', 'LIGA DE ENSINO DO RIO GRANDE DO NORTE', 'ESCOLA DOMESTICA DE NATAL', 'AV HERMES DA FONSECA ', '789', '59.014-615', 'TIROL', 'NATAL', 'RN', '-', '-', 5),
('08480071000140', 'APEC - SOCIEDADE POTIGUAR DE EDUCACAO E CULTURA LTDA', 'APEC', 'AV FLORIANO PEIXOTO', '295', '59.072-520', 'PETROPOLIS', 'NATAL', 'RN', 'JURIDICO@UNP.BR', '(84) 3216-8622', 6),
('10877412000168', 'INSTITUTO FEDERAL DE EDUCACAO CIENCIA E TECNOLOGIA DO RIO GRANDE DO NORTE ', 'IFRN', 'R DOUTOR NILO BEZERRA RAMALHO', 'S/N', '59.015-300', 'TIROL', 'NATAL', 'RN', 'GABINETE.REITORIA@IFRN.EDU.BR', '(84) 4005-2608', 7),
('11888849000160', 'ASPER ENSINO SUPERIOR DA PARAIBA S/S LTDA', 'INPER - FPPD - FANEC', 'R JOAQUIM FRANCISCO VELOSO GALVAO ', '1860', '58.031-130', 'B.DOS ESTADOS ', 'JOAO PESSOA ', 'PB', 'FISCALPAULISTA@UNIP.BR', '(83) 2106-9600', 8),
('24365710000183', 'UNIVERSIDADE FEDERAL DO RIO GRANDE DO NORTE', 'UFRN', 'AV SENADOR SALGADO FILHO', '3000', '59.078-970', 'LAGOA NOVA', 'NATAL', 'RN', 'dcf@reitoria.ufrn.br', '(84) 3215-3380', 9),
('33583592000170', 'INSPETORIA SAO JOAO BOSCO ', 'SALESIANO', 'AV 31 DE MARCO ', '435 ', '30.535-000 ', 'CORACAO EUCARISTICO ', 'BELO HORIZONTE ', 'MG ', 'NFE01@SALESIANO.BR ', '(31) 2103-1200', 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) CHARACTER SET latin1 NOT NULL,
  `email` varchar(150) CHARACTER SET latin1 NOT NULL,
  `senha` varchar(16) CHARACTER SET latin1 NOT NULL,
  `login` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `telefone` varchar(12) CHARACTER SET latin1 NOT NULL,
  `instituicao` varchar(100) CHARACTER SET latin1 NOT NULL,
  `curso` varchar(50) CHARACTER SET latin1 NOT NULL,
  `periodo` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `ocupacao` varchar(50) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `login`, `telefone`, `instituicao`, `curso`, `periodo`, `ocupacao`) VALUES
(1, 'jerry', 'jerry@gmail.com', '123456', 'jerrycarlos', '84996354426', 'estacio de sa', 'ads', '4', NULL),
(2, 'junior', 'junior@gmail.com', '123456', 'junior123', '9999999999', 'unp', 'ciencomp', NULL, 'TI'),
(9, 'chico da silva', 'chico@gmail.com', '123456', 'chicocezar', '7894561230', 'mauricio de nassau', 'redes', '5', NULL),
(10, 'josefino jose da silva', 'josefino@gmail.com', '123456', 'josefino', '1234567890', '', 'recursos humanos', '5', 'corte e costura'),
(12, 'Carlos antonio', 'carlos@gmail.com', '123456', 'carlos123', '4659708312', '', 'direito', '9', 'mentir'),
(13, 'Adalberto angelo', 'teste@gmail.com', '123456', 'adalberto', '4970813645', '', 'redes de computadores', '3', 'passar cabo'),
(15, 'teste ', 'teste@tesre.com', '123446', 'test1', '13455629790', '', 'teste', '1', 'djfoa'),
(16, 'neto', 'jsjss@gmail.com', '123456', 'neto', '8196696737', '', 'dndnnd', '89979', 'jdjjdhs'),
(36, 'daychupeta', 'daychupa@gmail.com', '123456', 'daychupa', '84981828705', 'unp', 'adm', '5', 'rapariga'),
(41, 'paulo', 'pauloppk@gmail.com', '123456', 'paulo', '84988888586', 'ifrn', 'adm', '3', 'estudante'),
(52, 'rogerio', 'rogerio@gmail.com', '123456', 'rogerio@gmail.com', '084996363235', 'ufrn', 'pedagogia', '2', 'estudante'),
(54, 'Jefferson Aquiles', 'aquiles@gmail.com', '123456', 'aquiles@gmail.com', '84981828566', 'ufrn', 'geografia', '5', 'manifestante'),
(109, 'teste', 'liang.cunha@gmail.com', '123456', 'liangcunha', '465983261956', 'tste', 'fkdl', '5', 'dslw'),
(110, 'liang', 'liang.cunha@hotmail.com', '123456', 'liang.cunha@hotmail.com', '84998201524', 'estacio', 'ads', '3', 'ti'),
(111, 'philipe bruno', 'philipe@gmail.com', '123456', 'Philipe', '84991665522', 'estacio', 'ads', '5', 'estudante'),
(112, 'gerudson', 'gerudson@gmail.com', '123456', 'gera', '84553366221', 'COMPLEXO EDUCACIONAL CONTEMPORANEO', 'ads', '5', 'estudante');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_instituicao` (`fk_instituicao`),
  ADD KEY `fk_palestrante` (`fk_palestrante`);

--
-- Índices de tabela `evento_participante`
--
ALTER TABLE `evento_participante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_evento` (`fk_evento`),
  ADD KEY `fk_participante` (`fk_participante`);

--
-- Índices de tabela `instituicoes`
--
ALTER TABLE `instituicoes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_instituicao` (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `cnpj` (`cnpj`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `telefone` (`telefone`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de tabela `evento_participante`
--
ALTER TABLE `evento_participante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `instituicoes`
--
ALTER TABLE `instituicoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`fk_instituicao`) REFERENCES `instituicoes` (`id`),
  ADD CONSTRAINT `evento_ibfk_2` FOREIGN KEY (`fk_palestrante`) REFERENCES `usuario` (`id`);

--
-- Restrições para tabelas `evento_participante`
--
ALTER TABLE `evento_participante`
  ADD CONSTRAINT `evento_participante_ibfk_1` FOREIGN KEY (`fk_evento`) REFERENCES `evento` (`id`),
  ADD CONSTRAINT `evento_participante_ibfk_2` FOREIGN KEY (`fk_participante`) REFERENCES `usuario` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
