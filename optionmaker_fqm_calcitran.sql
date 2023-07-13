-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Jun-2023 às 01:52
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `optionmaker_fqm_calcitran`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_login` varchar(255) DEFAULT NULL,
  `admin_senha` varchar(255) DEFAULT NULL,
  `admin_nome` varchar(255) DEFAULT NULL,
  `admin_permissao` int(11) DEFAULT NULL,
  `admin_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_login`, `admin_senha`, `admin_nome`, `admin_permissao`, `admin_created`, `admin_updated`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador 01', 1, '2023-05-29 17:59:56', '2023-05-29 17:59:56');

-- --------------------------------------------------------

--
-- Estrutura da tabela `alternativa`
--

CREATE TABLE `alternativa` (
  `alternativa_id` int(11) NOT NULL,
  `alternativa_texto` text DEFAULT NULL,
  `alternativa_indicador` varchar(3) DEFAULT NULL,
  `alternativa_correta` int(1) DEFAULT 0,
  `alternativa_pergunta` int(11) DEFAULT NULL,
  `alternativa_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `alternativa_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `alternativa`
--

INSERT INTO `alternativa` (`alternativa_id`, `alternativa_texto`, `alternativa_indicador`, `alternativa_correta`, `alternativa_pergunta`, `alternativa_created`, `alternativa_updated`) VALUES
(16, 'Aumenta a absorção de cálcio nos ossos, ajudando a preservar a massa óssea. Agora com maior concentração de Vitamina D.', '', 2, 6, '2023-06-02 20:24:50', '2023-06-02 20:24:50'),
(17, 'Com maior absorção, é de fato, melhor aproveitado pelo organismo e proporciona maior segurança, protegendo a formação de cálculos renais.', '', 1, 6, '2023-06-02 20:25:36', '2023-06-02 20:25:36'),
(18, 'Participa da ativação da Vitamina D, melhorando o transporte do cálcio, fortalecendo a massa óssea.', '', 2, 6, '2023-06-02 20:26:03', '2023-06-02 20:26:03'),
(19, 'Com menor absorção de cálcio nos ossos, tem menor aproveitamento pelo organismo, proporcionando maior segurança, protegendo a formação de cálculos renais.', '', 2, 6, '2023-06-02 20:26:58', '2023-06-02 20:26:58'),
(20, 'Aumenta a absorção de cálcio nos ossos, ajudando a preservar a massa óssea. Agora com maior concentração de Vitamina D.', '', 2, 7, '2023-06-02 20:27:51', '2023-06-02 20:27:51'),
(21, 'Com maior absorção, é de fato, melhor aproveitado pelo organismo e proporciona maior segurança, protegendo a formação de cálculos renais.', '', 2, 7, '2023-06-02 20:28:11', '2023-06-02 20:28:11'),
(22, 'Auxiliar no combate da inflamação nas articulações, lesões em cartilagem e artrite reumatóide, diminuí dores nas articulações, melhora a elasticidade e nutrição do tecido cartilaginoso.', '', 1, 7, '2023-06-02 20:29:07', '2023-06-02 20:29:40'),
(23, 'Com menor absorção de cálcio nos ossos, tem menor aproveitamento pelo organismo, proporcionando maior segurança, protegendo a formação de cálculos renais.', '', 2, 7, '2023-06-02 20:29:20', '2023-06-02 20:29:20'),
(24, 'Articulações, Circulação e Ossos;', '', 2, 8, '2023-06-02 20:31:31', '2023-06-02 20:31:31'),
(25, 'Articulações, Ossos e Sistema respiratório;', '', 2, 8, '2023-06-02 20:31:48', '2023-06-02 20:31:48'),
(26, 'Ossos, Músculos e Circulação;', '', 2, 8, '2023-06-02 20:32:01', '2023-06-02 20:32:01'),
(27, 'Articulações, Ossos e Músculos;', '', 1, 8, '2023-06-02 20:32:16', '2023-06-02 20:32:25'),
(28, 'Nos ossos - Auxilia o fortalecimento dos ossos e na prevenção de perda da massa óssea.', '', 2, 9, '2023-06-02 20:33:10', '2023-06-02 20:33:10'),
(29, 'Nas articulações - Diminuindo a degradação das articulações e auxiliando na manutenção da função articular;', '', 2, 9, '2023-06-02 20:33:41', '2023-06-02 20:33:41'),
(30, 'Nos Músculos - Auxilia no fortalecimento muscular e alivia as dores e desconfortos nas articulações.', '', 2, 9, '2023-06-02 20:34:37', '2023-06-02 20:34:37'),
(31, 'Todas as alternativas estão corretas.', '', 1, 9, '2023-06-02 20:34:49', '2023-06-02 20:34:49'),
(32, 'Calcitran B12;', '', 2, 10, '2023-06-02 20:37:26', '2023-06-02 20:37:26'),
(33, 'Calcitran MDK;', '', 2, 10, '2023-06-02 20:37:34', '2023-06-02 20:37:34'),
(34, 'Calcitran Triflex;', '', 1, 10, '2023-06-02 20:37:43', '2023-06-02 20:44:38'),
(35, 'Calcitran D3;', '', 2, 10, '2023-06-02 20:38:06', '2023-06-02 20:38:06'),
(36, 'Colágeno Tipo II e maior concentração de Vitamina D', '', 2, 11, '2023-06-02 20:42:35', '2023-06-02 20:42:35'),
(37, 'Cálcio Citrato Malato e maior concentração de Vitamina D', '', 1, 11, '2023-06-02 20:42:58', '2023-06-02 20:43:51'),
(38, 'Carbonato de Cálcio e maior concentração de Vitamina D', '', 2, 11, '2023-06-02 20:43:15', '2023-06-02 20:43:15'),
(39, 'Cálcio Citrato Malato e menor concentração de Vitamina D', '', 2, 11, '2023-06-02 20:43:33', '2023-06-02 20:43:33'),
(40, 'Verdadeira;', '', 1, 12, '2023-06-02 20:47:38', '2023-06-02 20:47:38'),
(41, 'Falsa;', '', 2, 12, '2023-06-02 20:47:45', '2023-06-02 20:47:45');

-- --------------------------------------------------------

--
-- Estrutura da tabela `participante`
--

CREATE TABLE `participante` (
  `participante_id` int(11) NOT NULL,
  `participante_nome` varchar(255) DEFAULT NULL,
  `participante_funcao` varchar(255) DEFAULT NULL,
  `participante_cpf` varchar(40) DEFAULT NULL,
  `participante_farmacia` varchar(255) DEFAULT NULL,
  `participante_farmacia_cnpj` varchar(24) DEFAULT NULL,
  `participante_telefone` varchar(18) DEFAULT NULL,
  `participante_email` varchar(255) DEFAULT NULL,
  `participante_acertos` int(1) DEFAULT NULL,
  `participante_hora_voto` datetime DEFAULT NULL,
  `participante_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `participante_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `participante_resposta`
--

CREATE TABLE `participante_resposta` (
  `participante_resposta_id` int(11) NOT NULL,
  `participante_resposta_participante` int(11) DEFAULT NULL,
  `participante_resposta_pergunta` int(11) DEFAULT NULL,
  `participante_resposta_resposta` int(11) DEFAULT NULL,
  `participante_resposta_certa` int(1) DEFAULT 0,
  `participante_resposta_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `participante_resposta_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pergunta`
--

CREATE TABLE `pergunta` (
  `pergunta_id` int(11) NOT NULL,
  `pergunta_texto` text DEFAULT NULL,
  `pergunta_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `pergunta_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `pergunta`
--

INSERT INTO `pergunta` (`pergunta_id`, `pergunta_texto`, `pergunta_created`, `pergunta_updated`) VALUES
(6, 'Calcitran Triflex, Calcitran MDK e Calcitran D3 possuem na formulação o Citrato de Cálcio Malato, que tem por benefício: (Assinale a alternativa correta)', '2023-06-02 19:22:29', '2023-06-02 19:22:29'),
(7, 'Calcitran Triflex, possui em sua formulação 40mg de Colágeno Tipo II que tem a função de:', '2023-06-02 19:24:09', '2023-06-02 19:24:09'),
(8, 'Calcitran Triflex entrega triplo benéfico, que são: (Assinale as alternativas corretas)', '2023-06-02 19:25:11', '2023-06-02 19:25:11'),
(9, 'Como Calcitran Triflex entrega triplo benefício? (Assinale a alternativa correta)', '2023-06-02 19:26:07', '2023-06-02 19:26:07'),
(10, 'Qual é a forma mais completa de manter a saúde dos ossos, músculos e articulações?: (Assinale a alternativa correta)', '2023-06-02 19:26:40', '2023-06-02 19:26:40'),
(11, 'A família Calcitran traz na nova formulação de Calcitran Triflex, Calcitran MDK comprimidos e Calcitran D3, 2 diferenciais, são eles: (Assinale a alternativa correta)', '2023-06-02 19:27:20', '2023-06-02 19:27:20'),
(12, 'Calcitran Triflex é um suplemento alimentar com triplo benefício, possui em sua formulação: Calcio + Colágeno Tipo II + Magnésio + Vitamina D + Vitamina K2. Essa afirmação é:', '2023-06-02 19:28:29', '2023-06-02 19:28:29');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Índices para tabela `alternativa`
--
ALTER TABLE `alternativa`
  ADD PRIMARY KEY (`alternativa_id`);

--
-- Índices para tabela `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`participante_id`);

--
-- Índices para tabela `participante_resposta`
--
ALTER TABLE `participante_resposta`
  ADD PRIMARY KEY (`participante_resposta_id`);

--
-- Índices para tabela `pergunta`
--
ALTER TABLE `pergunta`
  ADD PRIMARY KEY (`pergunta_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `alternativa`
--
ALTER TABLE `alternativa`
  MODIFY `alternativa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `participante`
--
ALTER TABLE `participante`
  MODIFY `participante_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de tabela `participante_resposta`
--
ALTER TABLE `participante_resposta`
  MODIFY `participante_resposta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT de tabela `pergunta`
--
ALTER TABLE `pergunta`
  MODIFY `pergunta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
