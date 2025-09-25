-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/09/2025 às 15:10
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
  `resumo` varchar(255) NOT NULL,
  `contador_participantes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`id`, `nome_evento`, `data_inicio_evento`, `data_termino_evento`, `data_evento`, `hora_evento`, `local_evento`, `descricao_evento`, `imagem_evento`, `confirmacoes`, `resumo`, `contador_participantes`) VALUES
(4, 'Feira de Brechó', '2025-08-20', '2025-08-27', '0000-00-00', '12:00:00', 'Rua Felipe Juliano da Cunha, 227 Cnj. Vila Real - Cetro, Rio Preto da Eva - AM, 61097-157', 'O objetivo é promover o consumo consciente, dando uma nova vida a peças de roupa, calçados e acessórios em ótimo estado, além de incentivar práticas de reutilização, troca e economia circular.', 'event_68caff7bb9883.png', 10, '', 0),
(5, 'Evento Sobre Sustentabilidade e Moda lenta', '2025-08-15', '2025-09-21', '0000-00-00', '12:00:00', 'Live no Youtube', 'A moda é uma das indústrias que mais impactam o meio ambiente. A proposta da Moda Lenta (Slow Fashion) é repensar o consumo, valorizar peças de maior qualidade, incentivar o reuso e apoiar práticas sustentáveis.\r\n\r\nNeste encontro online, vamos debater:\r\n\r\nOs desafios e oportunidades da moda sustentável.\r\n\r\nComo brechós, bazares e pequenos negócios podem transformar o setor.\r\n\r\nPráticas conscientes para consumidores e empreendedores.\r\n\r\nIniciativas colaborativas que unem impacto social e ambiental.\r\n\r\n👩‍🏫 Convidados/as especiais: [colocar nomes ou deixar “em breve”]\r\n🎤 Atividades: Palestras, rodas de conversa e espaço para perguntas ao vivo.', 'event_68cb061fc5fb8.png', 10, '', 0);

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
(15, 'Loja da Tia', 'Manaus – Em um cenário onde a moda rápida domina o mercado, uma nova iniciativa surge para oferecer um caminho diferente. O Bazar Usados, um e-commerce inovador, acaba de ser lançado com a missão de transformar a maneira como consumimos moda, promovendo um futuro mais sustentável e consciente para todos.\r\n\r\nA plataforma, que se autodenomina um \"novo ecossistema para a moda circular\", vai muito além de ser apenas um brechó online. Ela foi desenhada para criar uma comunidade de entusiastas de moda que buscam peças de alta qualidade, únicas e com um impacto positivo no planeta. Ao dar uma nova vida a roupas e acessórios, o Bazar Usados combate o desperdício têxtil, uma das maiores fontes de poluição da indústria da moda.\r\n\r\nQualidade e Estilo sem Culpa\r\nNo Bazar Usados, a curadoria é o ponto central. A plataforma oferece uma vasta gama de produtos, desde peças vintage raras até itens seminovos em perfeito estado, garantindo que o estilo e a qualidade andem de mãos dadas com a sustentabilidade. A navegação intuitiva, com funcionalidades como um carrossel interativo e um sistema de pesquisa otimizado, torna a experiência de compra tão prazerosa quanto a de um e-commerce tradicional.\r\n\r\nPara os usuários, a experiência é completa. Além de poder encontrar verdadeiros tesouros a preços acessíveis, eles também podem se tornar vendedores, contribuindo ativamente para a economia circular. A plataforma oferece todas as ferramentas necessárias para que qualquer pessoa possa fazer parte desse movimento e monetizar suas peças não utilizadas.\r\n\r\nPor que a Moda Sustentável Importa?\r\nA indústria da moda é uma das mais poluentes do mundo, consumindo grandes quantidades de água e gerando toneladas de resíduos. Ao escolher o consumo de segunda mão, cada pessoa se torna uma agente de mudança. O Bazar Usados não é apenas um site de compras; é uma declaração de que a moda pode ser ética, estilosa e benéfica para o meio ambiente.\r\n\r\n\"Acreditamos que cada peça de roupa tem uma história a contar e um valor que transcende a primeira compra,\" afirma a equipe por trás do projeto. \"Estamos construindo um espaço onde a paixão por moda encontra a responsabilidade ambiental, provando que é possível ser estiloso sem comprometer o nosso planeta.\"\r\n\r\nO Bazar Usados está agora disponível para o público. Para explorar o catálogo e fazer parte desta revolução, visite o site e comece a descobrir peças únicas que unem estilo, propósito e um futuro mais verde.', '2025-08-20', 'https://www.cnnbrasil.com.br/lifestyle/moda-sustentavel/', 'img_68cafed9e6cac.png', 'Uma Revolução Silenciosa na Moda: Bazar Usados Lança Novo E-commerce para o Consumo Consciente\r\n'),
(16, 'Loja da Tia', 'Com apelo sustentável e sempre na moda, brechós são uma ótima alternativa para quem quer empreender, tanto com uma loja física quanto com um e-commerce.\r\n\r\nOmundo da moda sempre dá voltas, e os brechós são a prova viva disto. Mas um brechó não é uma simples loja de roupas usadas. Neles, temos a oportunidade de passear por diversos estilos, de diferentes épocas, inclusive a atual. \r\n\r\nUm dos grandes apelos dos brechós é poder encontrar roupas e acessórios de qualidade, muitas vezes de marcas renomadas, por preços bem mais acessíveis. \r\n\r\nNão menos importante, ao comprarmos uma peça usada, estamos fazendo uma escolha mais sustentável, dando nova vida a um item que poderia parar no lixo ou ficar para sempre no fundo de um armário. \r\n\r\nAbrir um brechó pode ser um investimento interessante, principalmente para quem adora o universo da moda. Confira abaixo como montar um brechó físico, online ou no Instagram, e se prepare para garimpar muito. \r\n\r\nComo montar um brechó? \r\nIndependentemente do canal de vendas utilizado, há alguns passos básicos para começar um brechó com sucesso. Veja!\r\n\r\nFaça uma pesquisa de mercado\r\nEngana-se quem pensa que todo brechó é igual. Há muitas possibilidades de segmentação e estilos no ramo. Existem brechós masculinos, femininos, para todos os públicos; só para adultos, focados apenas em roupas vintage, entre outras variedades.\r\n\r\nAntes de escolher o seu enfoque, faça uma boa pesquisa de mercado para entender  as principais tendências, demandas e carências do setor. \r\n\r\nDefina o seu público-alvo\r\nA partir da sua pesquisa de mercado, você deve delimitar o seu público-alvo. Esta escolha vai guiar todas as suas decisões e estratégias. Uma boa dica para definir melhor o seu cliente é criar personas. \r\n\r\nSuponha que o seu foco seja um brechó de moda adulta masculina. Crie alguns perfis dos homens que você acredita que podem se interessar pela sua loja. Quantos anos eles têm? O que eles fazem? Quais são seus hobbies? Que tipo de música eles escutam? Quais são seus filmes preferidos? \r\n\r\nAo responder estas perguntas, você terá uma visão mais clara destes consumidores em potencial e conseguirá guiar a sua curadoria de roupas, a decoração do seu brechó, a escolha da localização, entre outros fatores importantes. \r\n\r\nDefina a sua identidade visual e o seu estilo\r\nA pesquisa de mercado e a definição do público-alvo vão te ajudar a compor a identidade visual e o estilo do seu brechó. \r\n\r\nA identidade visual traduz, em elementos gráficos, a personalidade da sua marca. São imagens, ícones e cores que vão contar a sua história e transmitir os seus valores e conceitos. \r\n\r\nCom uma identidade visual forte, clara e bem definida, a sua marca se diferencia das outras, gera reconhecimento e se torna memorável. \r\n\r\nObtenha os documentos exigidos para abrir um brechó\r\nPara abrir uma empresa, é preciso cumprir uma série de exigências legais e passar por alguns processos burocráticos. \r\n\r\nO primeiro passo é escolher o melhor enquadramento jurídico para abrir a sua empresa. O mais recomendado neste momento é contratar os serviços de um contador. \r\n\r\nEste profissional vai poder indicar o melhor regime de acordo com o porte do seu negócio e a previsão de faturamento. Pode ser MEI ou ME, por exemplo, dependendo da sua realidade. \r\n\r\nO contador também pode orientar em relação à tributação, que impacta bastante no dia a dia financeiro e, caso não seja feita corretamente, pode implicar em multas e outros contratempos. \r\n\r\nUma vez que o enquadramento jurídico for estabelecido, é hora de formalizar a abertura da empresa. Para tanto, você precisa de: \r\n\r\nRegistro na Receita Federal e obtenção do CNPJ; \r\nInscrição na Junta Comercial; \r\nAlvará de funcionamento; \r\nCadastro na Previdência Social (INSS); \r\nAlvará do Corpo de Bombeiros; \r\nAlvará de Licença Sanitária.\r\nCalcule os investimentos e custos necessários\r\nOs gastos envolvidos na montagem de um brechó podem variar muito, de acordo com fatores como valor do aluguel, escolha dos materiais, etc. Os principais tipos de custos e investimentos envolvem: \r\n\r\nContabilidade; \r\nAbertura da empresa;\r\nAluguel (em caso de loja física); \r\nE-commerce (em caso de loja online ou híbrida); \r\nArquitetura e decoração (loja física); \r\nContas fixas (loja física); \r\nCompra de equipamentos; \r\nMobiliário (loja física); \r\nMarketing. \r\nTambém é importante dispor de capital de giro, principalmente nos primeiros meses. O capital de giro é o montante de recursos necessários para manter a sua empresa em funcionamento. É como o combustível que o carro precisa para rodar.\r\n\r\nToda operação possui gastos fixos, e o capital de giro é a diferença entre o dinheiro que você tem em caixa e as suas contas a pagar. Portanto, na hora de fazer o seu planejamento financeiro, é preciso garantir esta reserva. Caso contrário, você pode ter dificuldades de honrar os seus compromissos e manter o seu negócio vivo. \r\n\r\nDivulgue o seu brechó\r\nO Marketing é a principal ferramenta de comunicação da sua marca. É por meio de estratégias inteligentes que você alcança o seu público-alvo, apresenta soluções e demonstra o seu valor ao consumidor.\r\n\r\nHá muitas estratégias e possibilidades para divulgar a sua marca, entre elas, o Marketing Digital. Com alcance ampliado, segmentações precisas e investimentos acessíveis, esta estratégia tornou-se um recurso fundamental para empresas em crescimento.\r\n\r\nVale a pena investir nestas táticas, seja contratando profissionais especializados ou aprendendo a fazer por conta própria. Técnicas como tráfego pago, otimização de mecanismos de busca (SEO) e outras iniciativas podem aumentar a visibilidade do seu brechó.\r\n\r\nQuer impulsionar os seus resultados? Conheça 10 cursos de Marketing Digital para você fazer e aplicar no seu negócio.\r\n\r\nFaça um bom controle de estoque\r\nA gestão correta do estoque é fundamental para o sucesso de qualquer negócio do varejo. No caso dos brechós, o controle do estoque tem algumas peculiaridades, a começar pelo fato de que cada peça é única. As roupas e acessórios não costumam se repetir, o que faz de cada um deles um item exclusivo. \r\n\r\nEsta característica tem as suas vantagens competitivas, no entanto, na mesma medida, representa um desafio. Se a peça não faz sucesso, ou se encalha por apresentar alguma imperfeição ou defeito, acaba onerando o empreendedor. \r\n\r\nPara otimizar ao máximo a gestão do estoque e minimizar as perdas das peças encalhadas, é preciso fazer o acompanhamento atento de alguns indicadores: \r\n\r\nGiro de estoque \r\nComo sugere o nome, é o indicador que quantifica quantas vezes os itens do estoque foram vendidos e repostos em um determinado período de tempo. Quanto maior o giro, melhor o desempenho das vendas; quanto menor, pior. \r\n\r\nPerdas\r\nÉ o cálculo do prejuízo no estoque, ou seja, de quantas peças estão encalhadas ou impossibilitadas de serem vendidas, por estarem danificadas. A meta é reduzir ao máximo o volume de perdas. \r\n\r\nCobertura de estoque\r\nRepresenta quantas peças você possui para atender à atual demanda, sem precisar repor o estoque. Brechós não precisam ter uma cobertura de estoque alta, justamente por serem peças únicas. Neste caso, quanto maior a cobertura, maior a probabilidade de ter peças encalhadas. \r\n\r\nEm suma, o ideal para um brechó é manter uma organização de estoque que tenha como objetivo o giro alto de peças estocadas e que minimize as perdas. \r\n\r\nOnde conseguir roupa para o brechó?\r\nO segredo do sucesso de qualquer brechó é uma boa curadoria. Para começar no ramo, você pode recorrer às próprias roupas, as de familiares e amigos. \r\n\r\nUm bom lugar para garimpar são os bazares. Você também pode criar uma rede de clientes, amigos e conhecidos de quem você compra ou recebe doações de peças usadas.  \r\n\r\nQuão mais barata é a roupa do brechó?\r\nGeralmente, as roupas de brechó costumam ser vendidas a preços 80% mais baixos do que nas lojas. Mas isto pode variar de acordo com a idade, qualidade e condições em que a roupa foi adquirida. \r\n\r\nQuanto um brechó paga pela roupa? \r\nTambém pode variar muito. Em alguns casos, o curador consegue a roupa de graça, em outros, costuma pagar 10% do valor da compra original. \r\n\r\nComo montar um brechó físico?\r\nUm brechó físico demanda mais investimentos com um imóvel e funcionários, mas também pode representar um faturamento maior. Veja abaixo o que você precisa para montar um brechó físico. \r\n\r\nEscolha bem a sua localização\r\nA escolha da localização deve ser orientada, principalmente, pelo perfil do seu público-alvo. Você precisa ir aonde ele está. Por exemplo, se o seu brechó é especializado em roupas de marcas mais refinadas, o ideal é um lugar de perfil mais requintado. \r\n\r\nNa hora de escolher uma localização para o seu brechó, leve em consideração os seguintes fatores: \r\n\r\nPerfil do público e do produto \r\nComo mencionado, é essencial posicionar-se onde o seu consumidor ideal transita. Um brechó focado em moda vintage, por exemplo, precisa considerar regiões que possam ter a ver com o gosto do público interessado neste estilo. Neste caso, áreas de bares e restaurantes, próximas a atrações culturais, podem ser uma boa.    \r\n\r\nEstrutura \r\nEscolha um lugar que conte com uma boa infraestrutura para receber o seu cliente. Estacionamento, sanitários, acessibilidade e provadores são elementos cruciais. Estes recursos garantem comodidade, influenciando diretamente a experiência do consumidor com o estabelecimento.\r\n\r\nCaracterística do comércio no entorno\r\nAnalise o movimento e a quantidade de concorrentes na região. Locais com intenso fluxo de pessoas oferecem maior visibilidade, mas podem representar desafios dependendo do modelo de negócio. Uma área com múltiplas lojas similares intensifica a competitividade, enquanto uma região com estabelecimentos complementares é um diferencial competitivo. \r\n\r\nValor do aluguel\r\nO valor do aluguel deve ser compatível com o seu orçamento. O planejamento econômico precisa definir prioridades, sendo o custo do imóvel um fator determinante na tomada de decisão.\r\n\r\nMonte e organize o brechó\r\nA montagem de um brechó passa por algumas etapas: projeto arquitetônico e decorativo, e aquisição de mobiliário e equipamentos. O design do ambiente deve ser pensado de modo a facilitar a circulação e a orientação das pessoas. Confira algumas dicas:\r\n\r\nDivida o brechó em seções (camisas, calçados, calças, etc.), isto ajuda o consumidor a encontrar o que precisa;\r\nTenha móveis funcionais, como prateleiras e araras;\r\nUtilize manequins para exibir as roupas;\r\nConte com provadores bem iluminados e confortáveis, e espelhos;\r\nMantenha o ambiente sempre limpo, organizado e perfumado.  \r\nPrepare a sua equipe\r\nUma loja física depende bastante de seus funcionários. São eles que representam o brechó e se relacionam diretamente com os clientes. Um bom atendimento passa por simpatia, agilidade e conhecimento. \r\n\r\nPara contar com bons colaboradores, é preciso ir além de uma seleção criteriosa. Capacite e mantenha os seus funcionários motivados. Entender de moda é fundamental neste ramo. \r\n\r\nGeralmente, um brechó precisa de uma equipe com a seguinte configuração: \r\n\r\nGerente; \r\nVendedores; \r\nFuncionários da limpeza;\r\nCostureiras e alfaiates, para reparo de roupas.  \r\nComo montar um brechó online?\r\nUm brechó virtual é uma excelente alternativa para entrar no ramo com investimentos mais modestos. Este modelo de negócio dispensa gastos com locação e costuma demandar uma equipe mais enxuta. Saiba tudo que é necessário para abrir um brechó na internet. \r\n\r\nMonte uma loja virtual\r\nAssim como em uma loja física, um brechó virtual precisa dispor de um ambiente atraente, boa circulação e praticidade. Sua plataforma de vendas deve ser esteticamente agradável e proporcionar navegação intuitiva.\r\n\r\nAo estruturar o seu e-commerce, considere: \r\n\r\nIncorporar a identidade visual da marca no design do site;\r\nDesenvolver uma interface fluida e inteligente;\r\nCriar um ambiente visual limpo e elegante;\r\nExplicar detalhadamente características das roupas e como funcionam os processos de compra e a logística de entrega;\r\nOferecer múltiplos canais de comunicação com os consumidores;\r\nPadronizar o formato das fotos do site e das redes sociais;\r\nFazer um site responsivo para dispositivos móveis;\r\nContar com um checkout simples e ágil. \r\nApresente bem as suas roupas na internet\r\nComprar roupas online é uma experiência bastante limitada se comparada à compra presencial. Quando vamos a uma loja, podemos experimentar a peça e ver como ela fica no nosso corpo. Sentimos a textura e testamos a qualidade do tecido. É um processo bem mais sensorial e completo. \r\n\r\nAo vender roupas na internet, precisamos nos esforçar ao máximo para diminuir esta diferença. Para tanto, é fundamental investir na produção de fotos e vídeos das suas peças. \r\n\r\nO ideal é contratar um fotógrafo profissional, mas, com um pouco de estudo e dedicação, é possível produzir as próprias fotos. Para saber mais sobre o assunto, veja estas 16 ideias de como tirar fotos de roupas para vender.\r\n\r\nPara apresentar bem as suas roupas na internet, você pode:\r\n\r\nUsar modelos ou manequins para mostrar o caimento; \r\nTirar fotos de detalhes para o cliente ver o acabamento e a textura das roupas; \r\nFazer vídeos para exibir a roupa em movimento; \r\nRelacionar o máximo de informações possível na legenda das fotos, como tamanhos, cores, medidas, etc.\r\nComo montar um brechó no Instagram?\r\nPara ter sucesso no ambiente digital, é fundamental estar presente no Instagram. Uma pesquisa realizada pela Nuvemshop, demonstrou que a rede social da Meta foi responsável por 89% das transações digitais brasileiras em 2024.\r\n\r\nEste dado comprova a relevância do Instagram para o Marketing Digital. Confira abaixo algumas dicas para potencializar a presença do seu brechó na rede social:\r\n\r\nCrie um perfil comercial  \r\nA conta comercial do Instagram possui recursos exclusivos, como loja virtual integrada e análise de desempenho. Desta forma, é fundamental para as vendas na rede social.\r\n\r\nOtimize a sua conta comercial \r\nPara otimizar o seu perfil comercial e melhorar o desempenho na rede, são recomendadas algumas ações simples:\r\n\r\nEscolha um nome de usuário claro e objetivo;\r\nInsira palavras-chave que descrevem bem o seu brechó;\r\nMantenha um visual limpo e atraente;\r\nUse calls to action; \r\nVincule o perfil à sua plataforma de vendas.\r\nEstude os seus concorrentes \r\nÉ sempre bom analisar as estratégias do mercado para entender o que está sendo feito. Depois de uma observação atenta, fica mais fácil desenvolver uma abordagem diferenciada.\r\n\r\nCapriche nas descrições  \r\nAs descrições das roupas e acessórios no Instagram precisam ser tão ricas quanto no site. Detalhe minuciosamente os seus produtos, informe as suas composições, dimensões, variações disponíveis, etc.\r\n\r\nFaça fotos e vídeos impecáveis das suas roupas\r\nFotos e vídeos são a sua vitrine no Instagram. Para contar com um material impecável, invista em uma produção profissional que evidencie as características, o caimento e os detalhes das suas roupas.\r\n\r\nFaça boas legendas \r\nCrie legendas com o máximo de informação possível sobre as roupas e acessórios. Além disto, utilize narrativas envolventes que despertem o interesse do consumidor, incorporando elementos de storytelling.\r\n\r\nOrganize um cronograma  \r\nConsistência é uma palavra-chave no Instagram. Mantenha publicações frequentes, em diversos formatos: bastidores, experiências do cliente, conteúdos colaborativos, etc. É muito importante humanizar a sua marca, e o conteúdo das redes sociais é ótimo para isto. \r\n\r\nComponha um feed harmonioso \r\nDesenvolva uma grade visual alinhada à identidade do seu brechó, que funcione como a sua vitrine digital. O seu feed precisa ter a cara da sua marca, ser bonito, elegante e transmitir a qualidade do seu produto. \r\n\r\nAtive os recursos do Instagram Shopping \r\nPara transformar o seu Instagram em uma vitrine poderosa, use o Instagram Shopping. Na funcionalidade de loja virtual da rede social, você coloca etiquetas nos seus produtos com todos os detalhes que o cliente precisa para comprar.\r\n\r\nÉ só um clique e ele já está no seu e-commerce, pronto para finalizar a compra. Uma forma simples e rápida de aumentar as suas vendas.\r\n', '2025-08-15', 'https://conteudo.stone.com.br/como-montar-um-brecho/', 'img_68cb044fb2683.png', 'Como montar um brechó? Passos básicos para abrir seu negócio\r\n');

-- --------------------------------------------------------

--
-- Estrutura para tabela `participantes_eventos`
--

CREATE TABLE `participantes_eventos` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data_participacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(300, 'Saia Preta', 'Está em condição muito boa. Apresenta sinais mínimos de uso, como um leve desbotamento natural do tecido. Não há furos, rasgos, manchas ou danos nos zíperes e botões. A peça foi bem cuidada e ainda tem uma longa vida útil.', 21.00, 'a:1:{i:0;s:17:\"vestido preto.png\";}', '2025-09-05 22:11:29', 'G', '', 'a:2:{i:0;s:3:\"Pix\";i:1;s:8:\"Dinheiro\";}', 171, 'reservado', 'Saia', 'Casual', 'Preto', 'Poliéster', NULL, 'disponivel', 1),
(301, '6 Camisas Sociais e Causais', 'Todas as 6 camisas por um preço', 50.00, 'a:1:{i:0;s:27:\"camisas social e casual.png\";}', '2025-09-05 22:27:36', 'G', '', 'a:2:{i:0;s:3:\"Pix\";i:1;s:8:\"Dinheiro\";}', 172, 'disponivel', 'Blusa', 'Social', 'Variados', 'Lã', NULL, 'disponivel', NULL),
(302, 'Camisa Azul', 'Usada com um visual desgastado. A cor está bem desbotada, e o tecido pode apresentar pequenas falhas ou marcas. Embora não esteja em perfeito estado, a camisa ainda é funcional e confortável, perfeita para quem busca uma peça de baixo custo para o dia a dia.', 10.00, 'a:1:{i:0;s:39:\"Captura de tela_2025-08-03_17-52-44.png\";}', '2025-09-05 22:43:52', 'GG', '', 'a:1:{i:0;s:3:\"Pix\";}', 171, 'reservado', 'Blusa', 'Casual', 'Azul', 'Algodão', NULL, 'disponivel', 1),
(307, 'Saia de praia listrada transparente', 'Saia de praia feminina, listrada e transparente, leve e confortável. Ideal para usar sobre biquínis ou maiôs, proporcionando um look descontraído e elegante à beira-mar ou na piscina.\r\nCondições de uso: Usada, em bom estado, sem rasgos ou manchas visíveis. Lavar à mão ou em ciclo delicado e evitar secagem em máquina para preservar o tecido.', 27.00, 'a:1:{i:0;s:16:\"transparente.png\";}', '2025-09-05 23:59:53', 'PP', '', 'a:3:{i:0;s:3:\"Pix\";i:1;s:8:\"Crédito\";i:2;s:8:\"Dinheiro\";}', 1, 'reservado', 'Saia', 'Festa', 'Branca', 'Croché', NULL, 'disponivel', 170),
(308, 'Camisa Listrada', 'Combine sua camisa listrada (pense em listras finas, talvez azul marinho e branco) com jeans skinny, sapatilhas ou tênis brancos e uma jaqueta de couro para um look casual, mas elegante.', 25.00, 'a:1:{i:0;s:12:\"listrada.png\";}', '2025-09-06 00:44:52', 'PP', '', 'a:2:{i:0;s:3:\"Pix\";i:1;s:8:\"Dinheiro\";}', 171, 'vendido', 'Blusa', 'Social', 'Preto e Branco', 'Algodão', NULL, 'disponivel', 1),
(309, 'Blusa Listrada', 'tecido leve e confortável, ideal para o dia a dia. Apresenta listras clássicas que dão um toque moderno e versátil ao look. Possui caimento ajustado ao corpo, decote simples e manga longa ou curta, dependendo do modelo. Fácil de combinar com calças, saias ou shorts, perfeita para ocasiões casuais ou descontraídas.', 12.00, 'a:1:{i:0;s:12:\"listrada.png\";}', '2025-09-06 19:26:50', 'P', '', 'a:4:{i:0;s:3:\"Pix\";i:1;s:8:\"Crédito\";i:2;s:8:\"Dinheiro\";i:3;s:6:\"Boleto\";}', 172, 'reservado', 'Blusa', 'Social', 'Preto e Branco', '', NULL, 'disponivel', 1),
(310, 'Calça Laranja', 'Em tecido confortável e resistente, com caimento que valoriza o corpo. Apresenta cor laranja vibrante, perfeita para looks casuais e descontraídos. Possui cintura ajustável ou elástica (dependendo do modelo), bolsos funcionais e fechamento por zíper ou botão. Versátil, combina facilmente com camisetas, blusas ou jaquetas neutras.', 20.00, 'a:1:{i:0;s:39:\"Captura de tela_2025-08-03_17-53-37.png\";}', '2025-09-06 19:29:39', 'M', '', 'a:3:{i:0;s:3:\"Pix\";i:1;s:8:\"Crédito\";i:2;s:8:\"Dinheiro\";}', 171, 'disponivel', 'Calça', 'Casual', 'Laranja', 'Algodão', NULL, 'disponivel', NULL),
(311, 'Calça Jeans Feminina Rasgada', 'em bom estado, sem rasgos ou manchas significativas. Pode apresentar leves sinais de uso, característicos de roupas previamente cuidadas.', 33.00, 'a:1:{i:0;s:37:\"Captura de tela 2025-08-04 111059.png\";}', '2025-09-06 19:31:57', 'G', '', 'a:2:{i:0;s:3:\"Pix\";i:1;s:8:\"Crédito\";}', 171, 'disponivel', 'Calça', 'Casual', 'Azul Escuro', 'Linho', NULL, 'disponivel', NULL),
(312, 'Camisa Social Branca Feminina', 'Sem manchas ou rasgos visíveis. Pode apresentar leves sinais de uso, típicos de roupas bem cuidadas.', 14.00, 'a:1:{i:0;s:37:\"Captura de tela 2025-07-30 161329.png\";}', '2025-09-06 19:34:03', 'PP', '', 'a:2:{i:0;s:3:\"Pix\";i:1;s:8:\"Dinheiro\";}', 171, 'vendido', 'Blusa', 'Social', 'Branco', 'Algodão', NULL, 'disponivel', 1),
(313, 'Blusa e Bermuda Cinza', 'Conjunto composto por blusa e bermuda confeccionados em tecido leve e confortável, ideal para o dia a dia ou momentos de lazer. A blusa apresenta corte clássico e a bermuda possui cintura ajustável para maior conforto. A cor cinza neutra permite diversas combinações com outras peças do guarda-roupa, tornando o conjunto versátil, prático e fácil de usar.', 53.00, 'a:1:{i:0;s:37:\"Captura de tela 2025-07-30 161300.png\";}', '2025-09-06 19:36:49', 'M', '', 'a:4:{i:0;s:3:\"Pix\";i:1;s:8:\"Crédito\";i:2;s:8:\"Dinheiro\";i:3;s:6:\"Boleto\";}', 171, 'reservado', 'Blusa', '', 'Cinza', 'Linho', NULL, 'disponivel', 1),
(314, 'Blusa Florida Verde', 'Blusa confeccionada em tecido leve e confortável, com estampa floral verde que adiciona frescor e estilo ao look. Corte clássico, ideal para o dia a dia ou ocasiões casuais. A peça está em bom estado, sem manchas ou rasgos visíveis, podendo apresentar leves sinais de uso típicos de roupas bem cuidadas.', 14.00, 'a:1:{i:0;s:17:\"blusa florida.png\";}', '2025-09-06 19:39:32', 'PP', '', 'a:2:{i:0;s:3:\"Pix\";i:1;s:8:\"Dinheiro\";}', 1, 'reservado', 'Blusa', 'Casual', 'Verde', 'Algodão', NULL, 'disponivel', 180),
(315, 'dsdsf', 'fdsfdsf', 130.00, 'a:1:{i:0;s:12:\"listrada.png\";}', '2025-09-15 16:53:00', 'P', '', 'a:1:{i:0;s:3:\"Pix\";}', 1, 'reservado', 'Blusa', 'Casual', 'Preto', 'Lã', NULL, 'disponivel', 170),
(317, 'Camisa Marrom', 'camisa social marrom em tecido de alta qualidade, como a seda ou o cetim, pode ser combinada com calças de alfaiataria em tons de preto, cinza ou azul-marinho. Para completar o visual, adicione um blazer ou paletó.', 15.00, 'a:1:{i:0;s:17:\"camisa marrom.png\";}', '2025-09-15 23:26:12', 'P', '', 'a:4:{i:0;s:3:\"Pix\";i:1;s:8:\"Crédito\";i:2;s:8:\"Dinheiro\";i:3;s:6:\"Boleto\";}', 1, 'disponivel', 'Blusa', 'Casual', 'Marrom', 'Poliéster', NULL, 'disponivel', NULL),
(320, 'Camisa Branca', 'peça versátil que combina com diferentes estilos e ocasiões. Confeccionada em tecido leve e confortável, possui modelagem tradicional, mangas curtas (ou longas, se preferir), gola padrão e fechamento por botões frontais. Ideal para compor looks casuais ou formais, sendo um item essencial no guarda-roupa.', 12.00, 'a:3:{i:0;s:15:\"images (1).jpeg\";i:1;s:17:\"imagesnn (1).jpeg\";i:2;s:11:\"images.jpeg\";}', '2025-09-17 14:46:45', 'M', '', 'a:4:{i:0;s:3:\"Pix\";i:1;s:8:\"Crédito\";i:2;s:8:\"Dinheiro\";i:3;s:6:\"Boleto\";}', 171, 'reservado', 'Blusa', 'Casual', 'Branca', 'Algodão', NULL, 'disponivel', 1);

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
  `estado` varchar(50) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_exp` datetime DEFAULT NULL,
  `reset_code` varchar(10) DEFAULT NULL,
  `reset_code_exp` datetime DEFAULT NULL,
  `senha_seguranca` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`, `telefone`, `instagram`, `facebook`, `tiktok`, `twitter`, `whatsapp`, `first_login`, `nome_loja`, `foto_perfil`, `cep`, `rua`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `reset_token`, `reset_token_exp`, `reset_code`, `reset_code_exp`, `senha_seguranca`) VALUES
(1, 'Loja da Tia', 'email80@gmail.com', '$2y$10$JcvitkI8P9EYxeBSHhAopOmWAargmj7F9VCyft5RGoxLCJFxFTZ.G', 'usuario', '92988510037', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', '', 0, 'dsadasd', 'foto_68cab2575b0f18.36323117.png', '69099069', 'Rua Exemplo de Outro', '170', '213123', 'Bairro da Paz', 'Cidade Ficiticia', 'AM', NULL, NULL, '902243', '2025-09-17 15:40:21', NULL),
(141, 'Lucas da Silva', 'LucasdaSilva@gmail.com', '$2y$10$RRJyfU1AlzAQW9ERqvXmvuQD.OX2r09bjBVJJnq0r4UZyPkYxutGi', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(143, 'fsdfsdf', 'fsdfsdddfdfsfsd@gmail.com', '$2y$10$Nve7z57wKZrtRCRUhtaCV.5M6nxEz1rlWZr2QleI613QVJQbxEmLe', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(144, 'emairl80@gmail.com', 'emairl80@gmail.com', '$2y$10$urqybkoap29GAmXCRw3Q8eUSf9Ca.mO5ufV8vnPz4PjgI9uyiWLme', 'usuario', '', '', '', NULL, '', NULL, 0, NULL, 'uploads/perfil/689b3d7f3fe59_Captura de tela 2025-08-04 111059.png', 'e213123', 'ytryry', '170', '213123', 'dsda', 'eqdfd', 'sd', NULL, NULL, NULL, NULL, NULL),
(146, 'emal15@gmail.com', 'emal15@gmail.com', '$2y$10$IN7.hGNmEyXYFrTYrjR68O7k8rq00U.peabXXho8hvEIAJDpRX7ri', 'usuario', '92988510037', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', NULL, '92988510037', 0, 'dsadasd', 'foto_perfil_689fa6237dc1d5.66951717.png', 'e213123', 'ytryry', '170', '213123', 'dsda', 'eqdfd', 'sd', NULL, NULL, NULL, NULL, NULL),
(147, 'email81@gmail.com', 'email81@gmail.com', '$2y$10$0s.4VMdhkCc34rt9e36cj.IMmdLJCbwTlwisVgTzXWi.tjEIAE6zG', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(150, 'dsadasd', 'sdr32r1r2@gmail.com', '$2y$10$gbsOhSqYJOskaezcTcoOteGz6UUwrNlzij/siPfbCLLdZ4WmDpExm', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(152, 'email80@gmail.com', 'emssail80@gmail.com', '$2y$10$XBih2RpZ8h9OYir8z9.hjOz12/DzVcrVUHifFRqcSEEOKd.lg6Ld.', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(153, 'emailee80@gmail.com', 'email80ee@gmail.com', '$2y$10$39lt0qR8OrzduXsOv2zWie6Tfyqop8QGLi2gNtEs9S8GwjCUxaFO.', 'usuario', '92988510037', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', NULL, '988510037', 0, 'dsadasd', NULL, 'e213123', 'ytryry', '170', '213123', 'dsda', 'eqdfd', 'sd', NULL, NULL, NULL, NULL, NULL),
(157, 'dfsdgfg', 'fgdfghdfg@gmail.com', '$2y$10$ZgXLt4CDRFDDFt66ElW6cu4atWP6CQKzyW9Dt4W978vDWdCGp4u.6', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(158, 'celular@gmail.com', 'celular@gmail.com', '$2y$10$u0iXGzaVZ/4jPXClzJT84.6EX0WB9IJ7XynKpY4CSi3e3zf1zPmg2', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(159, 'email8weq0@gmail.com', 'email8weq0@gmail.com', '$2y$10$Sb3/Sgt6OE2CeuV5Pmq1FO48XBSR3TSnuP/nxvRBARJgx3NIqfZOG', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(160, 'dsadasd', 'dsasdasd@gmail.com', '$2y$10$fI0SXE0n/B5WDyMZnGDq2.oFmpnMwcbU9sawejHKelaFCme/eZKsa', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(161, '2e23e2e@gmail.com', '2e23e2e@gmail.com', '$2y$10$U0IG2paVSyeQh9rYAOanm.bkZVhYRoZxvNCO8xuo6nKnwjm6MNGze', 'usuario', '92988510037', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', NULL, '988510037', 0, 'dafdsfdsf', 'foto_perfil_689de92dc37840.07508676.png', 'e213123', 'ytryry', '170', '213123', 'dsda', 'eqdfd', 'sd', NULL, NULL, NULL, NULL, NULL),
(162, 'fsdfsdfd433@gmail.com', 'fsdfsdfd433@gmail.com', '$2y$10$5y.9depmJmYhNexhbpIyeuVjEhEdm9xQEJRIJxFNkoErGJbFcaGo6', 'usuario', '92988325132', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', 'adfdafadfad', NULL, '988510037', 0, 'fsdfsdfd433@gmail.com', 'foto_perfil_689e47a0787826.94130836.png', 'e213123', 'ytryry', '170', '213123', 'dsda', 'eqdfd', 'sd', NULL, NULL, NULL, NULL, NULL),
(163, 'email2@gmail.com', 'email2@gmail.com', '$2y$10$.ZTj39AZLjYoDb.03SRMGOZ0JyJX/h88DTmCxKbh.KJrOulHV3ly.', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(164, 'email1@gmail.com', 'email1@gmail.com', '$2y$10$36gpltPUWqb3h/bEzJByReUWlh/1PnWtKg0Y4Cy8eTlK5JMmO2VLK', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(165, 'dffdsf@gmail.com', 'dffdsf@gmail.com', '$2y$10$nHjQLPvF48TZE9jMERXKE.QPyNe.cB6c9idvgyKHGPQc5mMWY5YSu', 'usuario', '92988510037', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', NULL, '988510037', 0, 'dsadasd', 'foto_perfil_68a39b19e53f67.46280612.png', 'e213123', 'ytryry', '170', '213123', 'yssrtebdv ', 'eqdfd', 'sd', NULL, NULL, NULL, NULL, NULL),
(166, 'i2isjjsjsj@gmail.com', 'i2isjjsjsj@gmail.com', '$2y$10$hNpxAa1HZbpIPzoo8.tqqe4h959hfGf0Vyvkz0EOnNVmdsJGACmnW', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(167, 'evmai@gmail.com', 'evmai@gmail.com', '$2y$10$n252ukANrU2F7bphde.pBei1wS6PMJ8.zD4K0j4wHJyJ2k4xMt4b2', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(168, 'email82@gmail.com', 'email82@gmail.com', '$2y$10$NePINOqfs4rS91Dmn5oVfepVbu/2z9u.TjV2a4vi.WbHWVMHP/q3C', 'usuario', '92123123123', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', 'https://www.facebook.com/?locale=pt_BR', NULL, '92988326374', 0, 'erwrwer', NULL, '69099069', 'erwr', 'wer', 'ewrwe', 'rwe', 'rwer', 'er', NULL, NULL, NULL, NULL, NULL),
(169, 'administrador@gmail.com', 'administrador@gmail.com', '$2y$10$Z1vdW9bw4UhYgRhaF65yt.wgRSLlRFUnjkYkmPhp.t9ZNdOfGTTtS', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(170, 'meunome2@gmail.com', 'meunome2@gmail.com', '$2y$10$5h5d6ZhTkD9xoYul2u0cNOvv.5wiQU4pyoQWbqtIgeLsi65p3UsWS', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(171, 'Luiza Queiroz', 'luizaqueiroz@gmail.com', '$2y$10$9bxhQgRo8ct.FS04w0HiP.FnJciVifWMSNeZhuHtkEXAKLF.IZ2C6', 'usuario', '92988510037', 'https://pt-br.facebook.com/', 'https://pt-br.facebook.com/', 'https://pt-br.facebook.com/', NULL, '92988510037', 0, 'Luiza Queiroz de Souza', 'foto_68bb60cdbe6b84.25978743.png', '670935', 'Rua Governador José Lindoso', '451', 'Centro', 'Centro', 'Rio Preto da Eva', 'Amazonas', NULL, NULL, NULL, NULL, NULL),
(172, 'Ingrid Santana', 'ingridsantana@gmail.com', '$2y$10$KyBQJy0ccXALvuC07Tw87egWn0/Hc4affk/Wo6HHRKZmM76t824Ty', 'usuario', '92988510037', 'https://pt-br.facebook.com/', 'https://pt-br.facebook.com/', 'https://pt-br.facebook.com/', NULL, '92988510037', 0, 'Ingrid Santana de Lima', NULL, '909315', 'Rua Governador José Lindoso', '1.460', 'Centro', 'Centro', 'Rio Preto da Eva', 'Amazonas', NULL, NULL, NULL, NULL, NULL),
(173, 'fdsfdsf', 'dasdasd@gmail.com', '$2y$10$En7WVYsA576udcojFlUGl.YyRhUKwOhhmECGx4mKB4odeipYYWenG', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(174, 'fsdfsdf', 'sdfsdf@gmail.com', '$2y$10$ELAPjt2x6vLnG/.fskyHq.v/RZsRbgH4INHxvUj2gL7oBDIcDNPza', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(175, '5f6eb924f2@webxios.pro', '5f6eb924f2@webxios.pro', '$2y$10$Y8b0wSy7p5.cP3OA7HLqYuQsgM30bmCf.L1WlVnSulkn/jrmcUbOS', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5dc1d1275a074f5abb3afbcb6a99fbc6e7b408a9d36046621f272a1816d00b59', '2025-09-17 16:21:39', NULL, NULL, NULL),
(176, 'novoemail@gmail.com', 'novoemail@gmail.com', '$2y$10$ilJEm8rbHcNRKvB0RoErfuzQCUNWcp9rI8zwYj632yA.O2e99HRO.', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$4RDCnbmmbmtPaX6MN7wVJ.4rHwVlJDkJiOfwwxfPysJiLqKjenEQq'),
(177, 'Camisa Laranja', 'CamisaLaranja@gmail.com', '$2y$10$b/NGDhNQZ2fy29hlS3S8Fu7dLopYKCZHIptT8FFXaHsA2qTzUAlg6', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$33nFk0weh22G.A64fz7AOe2LQ57wZogzgvg4mJGpxs5JVCp.9hAOq'),
(178, 'dsfdsf', 'sf4224@gmail.com', '$2y$10$MySp8WHIfIb6DSKkExAr5eXaxZ70hPtaBTVcL7TjsWCsRyrOPT3sG', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$NV9YHkEJhoQZpse5Ob7nveRgxMeqw98Ll12GqJFiwXqx/TnP1B1mK'),
(179, 'Wiwkwjjw', 'sjejej@gmail.com', '$2y$10$XE9ofDKHTq7qW137GAdCHeZfRsUi8JtJ9mct20HxYhOshzs54vBZq', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$8tKWbO8Lk4e48FfHCEaMsuzKLz7BTfUnJ/oJ5lmywN9j3A9Pa/z8m'),
(180, 'Shhsh', 'gwuwnw@gmail.com', '$2y$10$jytVE8Wsz2ayCXgjLAGQKeM/ZeijZoACa0C.elcuemssQh0zRTR/u', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$NCQYQPxUdt5Ui31y0E72sOycd4A9nXfiUCjS8yj1.e2tHWG7JmjQG'),
(181, 'sDASDSA', 'DASDA@gmail.com', '$2y$10$8vf8xMoHs/shXKguQtRJp.caCiJZN26gXTGLKjUdYLBzcWKZZcLra', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$uzLzSZBP3gC0Fn6G0H8m9.XvEol4pRlR6GhHlh8lKmUVckDG68.vi'),
(182, 'email80@gmail.com', 'qd23dswd2@gmail.com', '$2y$10$A7mbNsSl90pgYpicl2SM5ujtPSOMrzSXj5N51CtfW63CUMs6uLj/K', 'usuario', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Dht.fXZ8bMRDaXozbQIBHeyYKEwetv.Q09o4/ZTtGI6egXMFHhw4a');

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
(44, 312, 1, 171, '2025-09-17 15:28:52');

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
-- Índices de tabela `participantes_eventos`
--
ALTER TABLE `participantes_eventos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_participation` (`id_evento`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `participantes_eventos`
--
ALTER TABLE `participantes_eventos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

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
-- Restrições para tabelas `participantes_eventos`
--
ALTER TABLE `participantes_eventos`
  ADD CONSTRAINT `participantes_eventos_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `participantes_eventos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

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
