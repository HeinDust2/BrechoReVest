-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 19/09/2025 às 04:48
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bazar`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `nome_evento` varchar(255) NOT NULL,
  `data_inicio_evento` date NOT NULL,
  `data_termino_evento` date DEFAULT NULL,
  `data_evento` date NOT NULL,
  `hora_evento` time NOT NULL,
  `local_evento` varchar(255) NOT NULL,
  `descricao_evento` text DEFAULT NULL,
  `imagem_evento` varchar(255) DEFAULT NULL,
  `confirmacoes` int(11) DEFAULT 0,
  `resumo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`id`, `nome_evento`, `data_inicio_evento`, `data_termino_evento`, `data_evento`, `hora_evento`, `local_evento`, `descricao_evento`, `imagem_evento`, `confirmacoes`, `resumo`) VALUES
(3, 'Feria de Brecho ', '2025-08-19', '2025-08-28', '0000-00-00', '12:44:00', 'Rua AvenidaCidade,  - AM, 68097-157', 'Evento de ', 'event_68a5dba290135.png', 2, '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `id` int(11) NOT NULL,
  `remetente_id` int(11) NOT NULL,
  `destinatario_id` int(11) NOT NULL,
  `mensagem` text NOT NULL,
  `data_envio` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `corpo_do_texto` text NOT NULL,
  `data_de_publicacao` date NOT NULL,
  `referencias` varchar(500) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `resumo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `noticias`
--

INSERT INTO `noticias` (`id`, `autor`, `corpo_do_texto`, `data_de_publicacao`, `referencias`, `imagem`, `resumo`) VALUES
(13, 'Loja da Tia', 'Amazonas – Em um cenário onde a moda rápida domina o mercado, uma nova iniciativa surge para oferecer um caminho diferente. O Bazar Usados, um e-commerce inovador, acaba de ser lançado com a missão de transformar a maneira como consumimos moda, promovendo um futuro mais sustentável e consciente para todos.\n\nA plataforma, que se autodenomina um \"novo ecossistema para a moda circular\", vai muito além de ser apenas um brechó online. Ela foi desenhada para criar uma comunidade de entusiastas de moda que buscam peças de alta qualidade, únicas e com um impacto positivo no planeta. Ao dar uma nova vida a roupas e acessórios, o Bazar Usados combate o desperdício têxtil, uma das maiores fontes de poluição da indústria da moda.\n\nQualidade e Estilo sem Culpa\nNo Bazar Usados, a curadoria é o ponto central. A plataforma oferece uma vasta gama de produtos, desde peças vintage raras até itens seminovos em perfeito estado, garantindo que o estilo e a qualidade andem de mãos dadas com a sustentabilidade. A navegação intuitiva, com funcionalidades como um carrossel interativo e um sistema de pesquisa otimizado, torna a experiência de compra tão prazerosa quanto a de um e-commerce tradicional.\n\nPara os usuários, a experiência é completa. Além de poder encontrar verdadeiros tesouros a preços acessíveis, eles também podem se tornar vendedores, contribuindo ativamente para a economia circular. A plataforma oferece todas as ferramentas necessárias para que qualquer pessoa possa fazer parte desse movimento e monetizar suas peças não utilizadas.\n\nPor que a Moda Sustentável Importa?\nA indústria da moda é uma das mais poluentes do mundo, consumindo grandes quantidades de água e gerando toneladas de resíduos. Ao escolher o consumo de segunda mão, cada pessoa se torna uma agente de mudança. O Bazar Usados não é apenas um site de compras; é uma declaração de que a moda pode ser ética, estilosa e benéfica para o meio ambiente.\n\n\"Acreditamos que cada peça de roupa tem uma história a contar e um valor que transcende a primeira compra,\" afirma a equipe por trás do projeto. \"Estamos construindo um espaço onde a paixão por moda encontra a responsabilidade ambiental, provando que é possível ser estiloso sem comprometer o nosso planeta.\"\n\nO Bazar Usados está agora disponível para o público. Para explorar o catálogo e fazer parte desta revolução, visite o site e comece a descobrir peças únicas que unem estilo, propósito e um futuro mais verde.', '2025-08-20', 'http://localhost/bazar-usados/public/cadastro_jornal.php', 'img_68a6219819900.jpg', 'Uma Revolução Silenciosa na Moda: Bazar Usados Lança Novo E-commerce para o Consumo Consciente');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `imagem` text DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `tamanho` varchar(50) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `pagamento` varchar(255) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `status_reserva` enum('disponivel','reservado','vendido') NOT NULL DEFAULT 'disponivel',
  `tipo_roupa` varchar(50) DEFAULT NULL,
  `estilo` varchar(50) DEFAULT NULL,
  `cor` varchar(50) DEFAULT NULL,
  `materiais` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'disponivel',
  `comprador_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `preco`, `imagem`, `data_cadastro`, `tamanho`, `telefone`, `pagamento`, `usuario_id`, `status_reserva`, `tipo_roupa`, `estilo`, `cor`, `materiais`, `bairro`, `status`, `comprador_id`) VALUES
(300, 'Saia Preta', 'Está em condição muito boa. Apresenta sinais mínimos de uso, como um leve desbotamento natural do tecido. Não há furos, rasgos, manchas ou danos nos zíperes e botões. A peça foi bem cuidada e ainda tem uma longa vida útil.', 21.00, 'a:1:{i:0;s:17:\"vestido preto.png\";}', '2025-09-05 22:11:29', 'G', '', 'a:2:{i:0;s:3:\"Pix\";i:1;s:8:\"Dinheiro\";}', 171, 'disponivel', 'Saia', 'Casual', 'Preto', 'Poliéster', NULL, 'disponivel', NULL),
(301, '6 Camisas Sociais e Causais', 'Todas as 6 camisas por um preço', 50.00, 'a:1:{i:0;s:27:\"camisas social e casual.png\";}', '2025-09-05 22:27:36', 'G', '', 'a:2:{i:0;s:3:\"Pix\";i:1;s:8:\"Dinheiro\";}', 172, 'disponivel', 'Blusa', 'Social', 'Variados', 'Lã', NULL, 'disponivel', NULL),
(302, 'Camisa Azul', 'Usada com um visual desgastado. A cor está bem desbotada, e o tecido pode apresentar pequenas falhas ou marcas. Embora não esteja em perfeito estado, a camisa ainda é funcional e confortável, perfeita para quem busca uma peça de baixo custo para o dia a dia.', 10.00, 'a:1:{i:0;s:39:\"Captura de tela_2025-08-03_17-52-44.png\";}', '2025-09-05 22:43:52', 'GG', '', 'a:1:{i:0;s:3:\"Pix\";}', 171, 'disponivel', 'Blusa', 'Casual', 'Azul', 'Algodão', NULL, 'disponivel', NULL),
(307, 'Saia de praia listrada transparente', 'Saia de praia feminina, listrada e transparente, leve e confortável. Ideal para usar sobre biquínis ou maiôs, proporcionando um look descontraído e elegante à beira-mar ou na piscina.\r\nCondições de uso: Usada, em bom estado, sem rasgos ou manchas visíveis. Lavar à mão ou em ciclo delicado e evitar secagem em máquina para preservar o tecido.', 27.00, 'a:1:{i:0;s:16:\"transparente.png\";}', '2025-09-05 23:59:53', 'PP', '', 'a:3:{i:0;s:3:\"Pix\";i:1;s:8:\"Crédito\";i:2;s:8:\"Dinheiro\";}', 1, 'reservado', 'Saia', 'Festa', 'Branca', 'Croché', NULL, 'disponivel', 170),
(308, 'Camisa Listrada', 'Combine sua camisa listrada (pense em listras finas, talvez azul marinho e branco) com jeans skinny, sapatilhas ou tênis brancos e uma jaqueta de couro para um look casual, mas elegante.', 25.00, 'a:1:{i:0;s:12:\"listrada.png\";}', '2025-09-06 00:44:52', 'PP', '', 'a:2:{i:0;s:3:\"Pix\";i:1;s:8:\"Dinheiro\";}', 171, 'disponivel', 'Blusa', 'Social', 'Preto e Branco', 'Algodão', NULL, 'disponivel', 1),
(309, 'Blusa Listrada', 'tecido leve e confortável, ideal para o dia a dia. Apresenta listras clássicas que dão um toque moderno e versátil ao look. Possui caimento ajustado ao corpo, decote simples e manga longa ou curta, dependendo do modelo. Fácil de combinar com calças, saias ou shorts, perfeita para ocasiões casuais ou descontraídas.', 12.00, 'a:1:{i:0;s:12:\"listrada.png\";}', '2025-09-06 19:26:50', 'P', '', 'a:4:{i:0;s:3:\"Pix\";i:1;s:8:\"Crédito\";i:2;s:8:\"Dinheiro\";i:3;s:6:\"Boleto\";}', 172, 'reservado', 'Blusa', 'Social', 'Preto e Branco', '', NULL, 'disponivel', 171),
(310, 'Calça Laranja', 'Em tecido confortável e resistente, com caimento que valoriza o corpo. Apresenta cor laranja vibrante, perfeita para looks casuais e descontraídos. Possui cintura ajustável ou elástica (dependendo do modelo), bolsos funcionais e fechamento por zíper ou botão. Versátil, combina facilmente com camisetas, blusas ou jaquetas neutras.', 20.00, 'a:1:{i:0;s:39:\"Captura de tela_2025-08-03_17-53-37.png\";}', '2025-09-06 19:29:39', 'M', '', 'a:3:{i:0;s:3:\"Pix\";i:1;s:8:\"Crédito\";i:2;s:8:\"Dinheiro\";}', 171, 'disponivel', 'Calça', 'Casual', 'Laranja', 'Algodão', NULL, 'disponivel', NULL),
(311, 'Calça Jeans Feminina Rasgada', 'em bom estado, sem rasgos ou manchas significativas. Pode apresentar leves sinais de uso, característicos de roupas previamente cuidadas.', 33.00, 'a:1:{i:0;s:37:\"Captura de tela 2025-08-04 111059.png\";}', '2025-09-06 19:31:57', 'G', '', 'a:2:{i:0;s:3:\"Pix\";i:1;s:8:\"Crédito\";}', 171, 'disponivel', 'Calça', 'Casual', 'Azul Escuro', 'Linho', NULL, 'disponivel', NULL),
(312, 'Camisa Social Branca Feminina', 'Sem manchas ou rasgos visíveis. Pode apresentar leves sinais de uso, típicos de roupas bem cuidadas.', 14.00, 'a:1:{i:0;s:37:\"Captura de tela 2025-07-30 161329.png\";}', '2025-09-06 19:34:03', 'PP', '', 'a:2:{i:0;s:3:\"Pix\";i:1;s:8:\"Dinheiro\";}', 171, 'disponivel', 'Blusa', 'Social', 'Branco', 'Algodão', NULL, 'disponivel', 1),
(313, 'Blusa e Bermuda Cinza', 'Conjunto composto por blusa e bermuda confeccionados em tecido leve e confortável, ideal para o dia a dia ou momentos de lazer. A blusa apresenta corte clássico e a bermuda possui cintura ajustável para maior conforto. A cor cinza neutra permite diversas combinações com outras peças do guarda-roupa, tornando o conjunto versátil, prático e fácil de usar.', 53.00, 'a:1:{i:0;s:37:\"Captura de tela 2025-07-30 161300.png\";}', '2025-09-06 19:36:49', 'M', '', 'a:4:{i:0;s:3:\"Pix\";i:1;s:8:\"Crédito\";i:2;s:8:\"Dinheiro\";i:3;s:6:\"Boleto\";}', 171, 'disponivel', 'Blusa', '', 'Cinza', 'Linho', NULL, 'disponivel', NULL),
(314, 'Blusa Florida Verde', 'Blusa confeccionada em tecido leve e confortável, com estampa floral verde que adiciona frescor e estilo ao look. Corte clássico, ideal para o dia a dia ou ocasiões casuais. A peça está em bom estado, sem manchas ou rasgos visíveis, podendo apresentar leves sinais de uso típicos de roupas bem cuidadas.', 14.00, 'a:1:{i:0;s:17:\"blusa florida.png\";}', '2025-09-06 19:39:32', 'PP', '', 'a:2:{i:0;s:3:\"Pix\";i:1;s:8:\"Dinheiro\";}', 1, 'disponivel', 'Blusa', 'Casual', 'Verde', 'Algodão', NULL, 'disponivel', NULL),
(315, 'dsdsf', 'fdsfdsf', 130.00, 'a:1:{i:0;s:12:\"listrada.png\";}', '2025-09-15 16:53:00', 'P', '', 'a:1:{i:0;s:3:\"Pix\";}', 1, 'reservado', 'Blusa', 'Casual', 'Preto', 'Lã', NULL, 'disponivel', 170),
(317, 'Camisa Marrom', 'camisa social marrom em tecido de alta qualidade, como a seda ou o cetim, pode ser combinada com calças de alfaiataria em tons de preto, cinza ou azul-marinho. Para completar o visual, adicione um blazer ou paletó.', 15.00, 'a:1:{i:0;s:17:\"camisa marrom.png\";}', '2025-09-15 23:26:12', 'P', '', 'a:4:{i:0;s:3:\"Pix\";i:1;s:8:\"Crédito\";i:2;s:8:\"Dinheiro\";i:3;s:6:\"Boleto\";}', 1, 'disponivel', 'Blusa', 'Casual', 'Marrom', 'Poliéster', NULL, 'disponivel', NULL);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `relatorio_vendas_do_vendedor`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `relatorio_vendas_do_vendedor` (
`usuario_id` int(11)
,`total_itens_vendidos` bigint(21)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `relatorio_vendas_por_usuario`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `relatorio_vendas_por_usuario` (
`usuario_id` int(11)
,`total_produtos` bigint(21)
,`total_disponiveis` decimal(22,0)
,`total_reservados` decimal(22,0)
,`total_vendidos` decimal(22,0)
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `data_reserva` datetime NOT NULL DEFAULT current_timestamp(),
  `data_limite_pagamento` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `tipo` enum('usuario','loja') DEFAULT 'usuario',
  `telefone` varchar(20) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `first_login` tinyint(1) DEFAULT 1,
  `nome_loja` varchar(255) DEFAULT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `rua` varchar(255) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`, `telefone`, `instagram`, `facebook`, `tiktok`, `twitter`, `whatsapp`, `first_login`, `nome_loja`, `foto_perfil`, `cep`, `rua`, `numero`, `complemento`, `bairro`, `cidade`, `estado`) VALUES
(1, 'Loja da Tia', 'email80@gmail.com', '$2y$10$JcvitkI8P9EYxeBSHhAopOmWAargmj7F9VCyft5RGoxLCJFxFTZ.G', 'usuario', '92988510037', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', '', 0, 'dsadasd', 'foto_68ccb890153c02.24902005.png', '69099069', 'Rua Exemplo de Outro', '170', '213123', 'Bairro da Paz', 'Cidade Ficiticia', 'AM'),
(141, 'Lucas da Silva', 'LucasdaSilva@gmail.com', '$2y$10$RRJyfU1AlzAQW9ERqvXmvuQD.OX2r09bjBVJJnq0r4UZyPkYxutGi', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(143, 'fsdfsdf', 'fsdfsdddfdfsfsd@gmail.com', '$2y$10$Nve7z57wKZrtRCRUhtaCV.5M6nxEz1rlWZr2QleI613QVJQbxEmLe', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(144, 'emairl80@gmail.com', 'emairl80@gmail.com', '$2y$10$urqybkoap29GAmXCRw3Q8eUSf9Ca.mO5ufV8vnPz4PjgI9uyiWLme', 'usuario', '', '', '', NULL, '', NULL, 0, NULL, 'uploads/perfil/689b3d7f3fe59_Captura de tela 2025-08-04 111059.png', 'e213123', 'ytryry', '170', '213123', 'dsda', 'eqdfd', 'sd'),
(146, 'emal15@gmail.com', 'emal15@gmail.com', '$2y$10$IN7.hGNmEyXYFrTYrjR68O7k8rq00U.peabXXho8hvEIAJDpRX7ri', 'usuario', '92988510037', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', NULL, '92988510037', 0, 'dsadasd', 'foto_perfil_689fa6237dc1d5.66951717.png', 'e213123', 'ytryry', '170', '213123', 'dsda', 'eqdfd', 'sd'),
(147, 'email81@gmail.com', 'email81@gmail.com', '$2y$10$0s.4VMdhkCc34rt9e36cj.IMmdLJCbwTlwisVgTzXWi.tjEIAE6zG', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(150, 'dsadasd', 'sdr32r1r2@gmail.com', '$2y$10$gbsOhSqYJOskaezcTcoOteGz6UUwrNlzij/siPfbCLLdZ4WmDpExm', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(152, 'email80@gmail.com', 'emssail80@gmail.com', '$2y$10$XBih2RpZ8h9OYir8z9.hjOz12/DzVcrVUHifFRqcSEEOKd.lg6Ld.', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(153, 'emailee80@gmail.com', 'email80ee@gmail.com', '$2y$10$39lt0qR8OrzduXsOv2zWie6Tfyqop8QGLi2gNtEs9S8GwjCUxaFO.', 'usuario', '92988510037', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', NULL, '988510037', 0, 'dsadasd', NULL, 'e213123', 'ytryry', '170', '213123', 'dsda', 'eqdfd', 'sd'),
(154, 'Raphael', 'Raphael.rh.harrisson@outlook.com', '$2y$10$nIvQTVB7pItjTmX/xIW.qeotQe0WtVw4Y3Q4/S2OHfj0GZwJgGeKW', 'usuario', '92988510037', 'http://192.168.0.233/bazar-usados/public/first_step.php?acao=configurar', 'http://192.168.0.233/bazar-usados/public/first_step.php?acao=configurar', 'http://192.168.0.233/bazar-usados/public/first_step.php?acao=configurar', NULL, '9288510037', 0, 'Bazar Derivados ', NULL, '69099068', 'Rua Joaquim Martins Santana ', '170', '', 'Novo Aleixo', 'Manaus', 'Am'),
(157, 'dfsdgfg', 'fgdfghdfg@gmail.com', '$2y$10$ZgXLt4CDRFDDFt66ElW6cu4atWP6CQKzyW9Dt4W978vDWdCGp4u.6', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(158, 'celular@gmail.com', 'celular@gmail.com', '$2y$10$u0iXGzaVZ/4jPXClzJT84.6EX0WB9IJ7XynKpY4CSi3e3zf1zPmg2', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(159, 'email8weq0@gmail.com', 'email8weq0@gmail.com', '$2y$10$Sb3/Sgt6OE2CeuV5Pmq1FO48XBSR3TSnuP/nxvRBARJgx3NIqfZOG', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(160, 'dsadasd', 'dsasdasd@gmail.com', '$2y$10$fI0SXE0n/B5WDyMZnGDq2.oFmpnMwcbU9sawejHKelaFCme/eZKsa', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(161, '2e23e2e@gmail.com', '2e23e2e@gmail.com', '$2y$10$U0IG2paVSyeQh9rYAOanm.bkZVhYRoZxvNCO8xuo6nKnwjm6MNGze', 'usuario', '92988510037', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', NULL, '988510037', 0, 'dafdsfdsf', 'foto_perfil_689de92dc37840.07508676.png', 'e213123', 'ytryry', '170', '213123', 'dsda', 'eqdfd', 'sd'),
(162, 'fsdfsdfd433@gmail.com', 'fsdfsdfd433@gmail.com', '$2y$10$5y.9depmJmYhNexhbpIyeuVjEhEdm9xQEJRIJxFNkoErGJbFcaGo6', 'usuario', '92988325132', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', 'adfdafadfad', NULL, '988510037', 0, 'fsdfsdfd433@gmail.com', 'foto_perfil_689e47a0787826.94130836.png', 'e213123', 'ytryry', '170', '213123', 'dsda', 'eqdfd', 'sd'),
(163, 'email2@gmail.com', 'email2@gmail.com', '$2y$10$.ZTj39AZLjYoDb.03SRMGOZ0JyJX/h88DTmCxKbh.KJrOulHV3ly.', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(164, 'email1@gmail.com', 'email1@gmail.com', '$2y$10$36gpltPUWqb3h/bEzJByReUWlh/1PnWtKg0Y4Cy8eTlK5JMmO2VLK', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(165, 'dffdsf@gmail.com', 'dffdsf@gmail.com', '$2y$10$nHjQLPvF48TZE9jMERXKE.QPyNe.cB6c9idvgyKHGPQc5mMWY5YSu', 'usuario', '92988510037', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', NULL, '988510037', 0, 'dsadasd', 'foto_perfil_68a39b19e53f67.46280612.png', 'e213123', 'ytryry', '170', '213123', 'yssrtebdv ', 'eqdfd', 'sd'),
(166, 'i2isjjsjsj@gmail.com', 'i2isjjsjsj@gmail.com', '$2y$10$hNpxAa1HZbpIPzoo8.tqqe4h959hfGf0Vyvkz0EOnNVmdsJGACmnW', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(167, 'evmai@gmail.com', 'evmai@gmail.com', '$2y$10$n252ukANrU2F7bphde.pBei1wS6PMJ8.zD4K0j4wHJyJ2k4xMt4b2', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(168, 'email82@gmail.com', 'email82@gmail.com', '$2y$10$NePINOqfs4rS91Dmn5oVfepVbu/2z9u.TjV2a4vi.WbHWVMHP/q3C', 'usuario', '92123123123', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', NULL, '92988326374', 0, 'erwrwer', NULL, '69099069', 'erwr', 'wer', 'ewrwe', 'rwe', 'rwer', 'er'),
(169, 'administrador@gmail.com', 'administrador@gmail.com', '$2y$10$Z1vdW9bw4UhYgRhaF65yt.wgRSLlRFUnjkYkmPhp.t9ZNdOfGTTtS', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(170, 'meunome2@gmail.com', 'meunome2@gmail.com', '$2y$10$5h5d6ZhTkD9xoYul2u0cNOvv.5wiQU4pyoQWbqtIgeLsi65p3UsWS', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(171, 'Luiza Queiroz', 'luizaqueiroz@gmail.com', '$2y$10$9bxhQgRo8ct.FS04w0HiP.FnJciVifWMSNeZhuHtkEXAKLF.IZ2C6', 'usuario', '92988510037', 'https://instagram/profile', 'https://pt-br.facebook.com/profile', 'https://tiktok/profile', NULL, '92988510037', 0, 'Luiza Queiroz de Souza', 'foto_68bb60cdbe6b84.25978743.png', '6190935', 'Rua Governador José Lindoso', '451', 'Centro', 'Centro', 'Rio Preto da Eva', 'Amazonas'),
(172, 'Ingrid Santana', 'ingridsantana@gmail.com', '$2y$10$KyBQJy0ccXALvuC07Tw87egWn0/Hc4affk/Wo6HHRKZmM76t824Ty', 'usuario', '92988510037', 'https://pt-br.facebook.com/', 'https://pt-br.facebook.com/', 'https://pt-br.facebook.com/', NULL, '92988510037', 0, 'Ingrid Santana de Lima', 'foto_68bb62369776e1.84344555.png', '6909315', 'Av. Carlos Drummond de Andrade,', '1.460', 'Distrito Industrial&#38;#38;#9;', 'Distrito Industrial', 'Manaus ', 'Amazonas'),
(173, 'fdsfdsf', 'dasdasd@gmail.com', '$2y$10$En7WVYsA576udcojFlUGl.YyRhUKwOhhmECGx4mKB4odeipYYWenG', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(174, 'fsdfsdf', 'sdfsdf@gmail.com', '$2y$10$ELAPjt2x6vLnG/.fskyHq.v/RZsRbgH4INHxvUj2gL7oBDIcDNPza', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `comprador_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `data_venda` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vendas`
--

INSERT INTO `vendas` (`id`, `produto_id`, `comprador_id`, `usuario_id`, `data_venda`) VALUES
(43, 308, 1, 171, '2025-09-06 00:45:18'),
(44, 312, 1, 171, '2025-09-19 02:12:31');

-- --------------------------------------------------------

--
-- Estrutura para view `relatorio_vendas_do_vendedor`
--
DROP TABLE IF EXISTS `relatorio_vendas_do_vendedor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `relatorio_vendas_do_vendedor`  AS SELECT `vendas`.`usuario_id` AS `usuario_id`, count(0) AS `total_itens_vendidos` FROM `vendas` GROUP BY `vendas`.`usuario_id` ;

-- --------------------------------------------------------

--
-- Estrutura para view `relatorio_vendas_por_usuario`
--
DROP TABLE IF EXISTS `relatorio_vendas_por_usuario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `relatorio_vendas_por_usuario`  AS SELECT `produtos`.`usuario_id` AS `usuario_id`, count(0) AS `total_produtos`, sum(case when `produtos`.`status_reserva` = 'disponivel' then 1 else 0 end) AS `total_disponiveis`, sum(case when `produtos`.`status_reserva` = 'reservado' then 1 else 0 end) AS `total_reservados`, sum(case when `produtos`.`status_reserva` = 'vendido' then 1 else 0 end) AS `total_vendidos` FROM `produtos` GROUP BY `produtos`.`usuario_id` ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `remetente_id` (`remetente_id`),
  ADD KEY `destinatario_id` (`destinatario_id`);

--
-- Índices de tabela `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id` (`produto_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id` (`produto_id`),
  ADD KEY `comprador_id` (`comprador_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `mensagens`
--
ALTER TABLE `mensagens`
  ADD CONSTRAINT `mensagens_ibfk_1` FOREIGN KEY (`remetente_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `mensagens_ibfk_2` FOREIGN KEY (`destinatario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vendas_ibfk_2` FOREIGN KEY (`comprador_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
