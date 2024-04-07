-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 07/04/2024 às 00:40
-- Versão do servidor: 8.2.0
-- Versão do PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ifgeolab`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `catmineral`
--

DROP TABLE IF EXISTS `catmineral`;
CREATE TABLE IF NOT EXISTS `catmineral` (
  `idcat` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`idcat`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `catmineral`
--

INSERT INTO `catmineral` (`idcat`, `nome`) VALUES
(1, 'Metálico'),
(2, 'Não metálico');

-- --------------------------------------------------------

--
-- Estrutura para tabela `catrocha`
--

DROP TABLE IF EXISTS `catrocha`;
CREATE TABLE IF NOT EXISTS `catrocha` (
  `idcat` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`idcat`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `catrocha`
--

INSERT INTO `catrocha` (`idcat`, `nome`) VALUES
(1, 'ígnea'),
(2, 'Metamórfica'),
(3, 'Sedmentar');

-- --------------------------------------------------------

--
-- Estrutura para tabela `img_rocha`
--

DROP TABLE IF EXISTS `img_rocha`;
CREATE TABLE IF NOT EXISTS `img_rocha` (
  `imgR` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `idrocha` int NOT NULL,
  `idimg` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idimg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mineral`
--

DROP TABLE IF EXISTS `mineral`;
CREATE TABLE IF NOT EXISTS `mineral` (
  `idmineral` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(10000) NOT NULL,
  `img` varchar(255) NOT NULL,
  `idcat` int NOT NULL,
  `sugestao` int NOT NULL,
  `3d` varchar(255) NOT NULL,
  PRIMARY KEY (`idmineral`),
  KEY `idcat` (`idcat`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `mineral`
--

INSERT INTO `mineral` (`idmineral`, `nome`, `descricao`, `img`, `idcat`, `sugestao`, `3d`) VALUES
(2, 'Ouro', '<p>O ouro é um metal de coloração dourada, de aspecto brilhante, resistente à corrosão, dúctil e maleável. Sua beleza fez desse metal um dos mais cobiçados ao longo da história da humanidade, seja por importância econômica, seja por questões religiosas e esotéricas. É considerado o mais nobre dos metais, embora não seja o mais caro nas cotações atuais.</p><p>O ouro é um metal imutável, uma vez que sua inércia química permite que sua aparência permaneça inalterada por milênios, como é o caso do ouro presente na máscara do faraó Tutancâmon, a qual se mantém como se tivesse sido confeccionada pouco tempo atrás. O ouro está amplamente disperso no mundo todo e, por isso, foi descoberto por vários grupos distintos em muitos locais e épocas diferentes, estando atrelado à cultura e história de diversas sociedades. Infelizmente, muitos lutaram e morreram por ele.</p>', 'ouro.jpg', 1, 0, 'gold.glb'),
(3, 'Ametista', '<p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:5pt;margin-bottom:0pt;padding:0pt 0pt 11pt 0pt;\"><font color=\"#202122\" face=\"Arial, sans-serif\"><span style=\"font-size: 16px; white-space-collapse: preserve;\">A ametista é uma variedade de quartzo conhecida por sua cor roxa característica, que varia de tons pálidos a profundos. Sua composição física inclui uma sobreposição irregular de lâminas alternadas de quartzo esquerdo e direito. Esta estrutura pode resultar de estresses mecânicos durante a formação da pedra. Como resultado dessa formação composta, a ametista pode apresentar características como fraturas onduladas, \"impressões digitais\" e até mesmo padrões que lembram um \"motor rodando\" quando há a interseção de dois conjuntos de ondulações curvas em uma superfície fraturada.\r\n\r\nAlguns mineralogistas, especialmente aqueles que seguem os conceitos de Sir David Brewster, aplicam o termo \"ametista\" a todos os quartzos que exibem essa estrutura, independentemente de sua cor. No entanto, a ametista é mais comumente associada à cor violeta, que é altamente valorizada.\r\n\r\nOs cristais de ametista geralmente crescem sobre uma base e podem ter formas variadas, incluindo pirâmides. Nas pontas dos cristais, a cor mais intensa tende a predominar. Algumas variedades de ametista podem exibir faixas brancas de quartzo leitoso, enquanto outras podem ter a cor violeta concentrada no centro dos cristais. Inclusões minerais, como aquelas de minerais aciculares, também são comuns na ametista.\r\n\r\nUma variedade de inclusões de minerais, como o rutilo, pode ocorrer na ametista, resultando em formações conhecidas como \"Cabeleiras-de-Vênus\". Essas inclusões adicionam interesse estético e valor à pedra.</span></font><br></p>', 'Ametista', 2, 0, ''),
(10, 'Teste', '<p>12121</p>', 'mineral_10.jpg', 1, 1, ''),
(12, 'Ferro', '<p>Batata</p>', 'Ferro', 1, 0, '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `rocha`
--

DROP TABLE IF EXISTS `rocha`;
CREATE TABLE IF NOT EXISTS `rocha` (
  `idrocha` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(10000) NOT NULL,
  `img` varchar(255) NOT NULL,
  `idcat` int NOT NULL,
  `sugestao` int NOT NULL,
  `3d` varchar(255) NOT NULL,
  PRIMARY KEY (`idrocha`),
  KEY `idcat` (`idcat`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `rocha`
--

INSERT INTO `rocha` (`idrocha`, `nome`, `descricao`, `img`, `idcat`, `sugestao`, `3d`) VALUES
(2, 'Granito', '<p>Granito e riolito, juntamente com suas rochas correlatas (como tonalito e granodiorito), são as mais amplamente distribuídas das rochas ígneas que compõem a crosta continental. Os granitos são formados pelo resfriamento do magma em profundidade, por isso são denominados de rochas plutônicas ou intrusivas. O magma que dá origem aos granitos é produto direto da fusão parcial da crosta terrestre, em zonas tectonicamente ativas, promovendo assim sua reciclagem. A composição química dos magmas graníticos reflete a composição química da própria crosta. O magma granítico é relativamente mais frio (700 – 900 °C) que o magma basáltico (1000 – 1200 °C), e também mais rico em sílica (SiO2 &gt; 63%), o que lhe confere uma característica menos fluida, mais viscosa, dificultando assim que chegue até à superfície, fazendo com que, em geral, cristalize em profundidade.</p><p><br></p><p>O granito é formado quando o magma resfria lentamente em porções profundas da crosta continental. O lento resfriamento do magma no interior da crosta permite promover o crescimento dos minerais, desenvolvendo uma textura denominada de fanerítica, na qual os minerais são distinguíveis a olho nu (&gt; 1mm). Riolito é o equivalente vulcânico do granito, ou seja, resultado do resfriamento e cristalização do magma que alcança a superfície terrestre, gerando desse modo uma rocha de mesma composição mineralógica, mas com textura afanítica, ou seja, com grãos muito finos não visíveis a olho nu (&lt; 1mm).</p><p><br></p><p>Feldspato alcalino, quartzo e plagioclásio perfazem geralmente mais de 80% do granito. Por isso, o granito é considerado uma rocha félsica, ou seja, uma rocha clara. Feldspato alcalino pode formar grandes cristais (megacristais), que se destacam em relação aos outros constituintes, conferindo ao granito uma textura porfirítica. Em geral, a cor do feldspato alcalino, branco, cinza, rosa, vermelho ou verde, determina a cor da rocha. Quando ocorre o predomínio do feldspato alcalino sobre o plagioclásio a rocha é denominada de sienogranito, já se o predomínio é do plagioclásio a rocha é denominada de monzogranito. Muscovita, biotita e anfibólio também são minerais comuns nessas rochas. Alguns granitos também podem conter piroxênio ou granada. Os minerais acessórios mais comuns nessas rochas são apatita, zircão, monazita, titanita, allanita, magnetita e ilmenita.</p><p><br></p><p>Pegmatito e aplito são rochas de mesma composição do granito, mas apresentam, respectivamente, grãos predominantemente muito grossos (&gt; 3 cm) e finos (≤ 1mm).</p><p><br></p><p>Granitos são rochas duras e resistentes amplamente utilizadas nas construções (brita, pavimentos, revestimentos de pisos e fachadas, e ornamentos) e monumentos.</p><p><br></p><p>O intemperismo promove a alteração química e física dos granitos quando expostos em superfície. A alteração dessas rochas em resposta à intempérie pode levar a formação de grandes blocos arredondados de granito soltos na superfície dos terrenos, resultado de esfoliação esferoidal, que promove a formação de estruturas concêntricas assemelhadas a cascas de cebola. Os blocos arredondados de granito podem se espalhar por uma extensa área, formando no relevo um mar de matacões, que quando presentes denunciam a natureza do substrato rochoso.</p>', 'rocha_11', 1, 0, 'granito.glb'),
(3, 'Arenito', '<p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:5pt;margin-bottom:0pt;padding:0pt 0pt 5pt 0pt;\"><span style=\"font-size:13.999999999999998pt;font-family:Arial,sans-serif;color:#202122;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Arenito</span><span style=\"font-size:13.999999999999998pt;font-family:Arial,sans-serif;color:#202122;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> ou </span><span style=\"font-size:13.999999999999998pt;font-family:Arial,sans-serif;color:#202122;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">grÃ©s</span><span style=\"font-size:13.999999999999998pt;font-family:Arial,sans-serif;color:#202122;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> Ã© uma rocha sedimentar que resulta da compactaÃ§Ã£o e litificaÃ§Ã£o de um material granular da dimensÃ£o das areias. O arenito Ã© composto normalmente por quartzo, mas pode ter quantidades apreciÃ¡veis de feldspato</span><span style=\"font-size:13.999999999999998pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">s</span><span style=\"font-size:13.999999999999998pt;font-family:Arial,sans-serif;color:#202122;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">, micas e/ou impurezas. Ã‰ a presenÃ§a e tipo de impurezas que determina a coloraÃ§Ã£o dos arenitos; por exemplo, grandes quantidades de Ã³xidos de ferro, fazem esta rocha vermelha. O arenito Ã© usado em diversas construÃ§Ãµes civis.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 5pt 0pt;\"><span style=\"font-size:13.999999999999998pt;font-family:Arial,sans-serif;color:#202122;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">O arenito Ã© depositado em ambiente continental, nos rios e lagos, ou em ambiente marinho, em praias, deltas ou nas sequÃªncias turbidÃ­ticas do talude continental.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 5pt 0pt;\"><span style=\"font-size:13.999999999999998pt;font-family:Arial,sans-serif;color:#202122;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Os arenitos sÃ£o rochas lapidificadas constituÃ­das por areias aglutinadas por um cimento natural, que geralmente caracteriza a rocha. SÃ£o rochas tambÃ©m designadas por grÃ©s e muitas vezes sÃ£o classificadas pela natureza do cimento. Os arenitos argilosos tÃªm um cimento constituÃ­do por argilas.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 5pt 0pt;\"><span style=\"font-size:13.999999999999998pt;font-family:Arial,sans-serif;color:#202122;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Os arenitos calcÃ¡rios sÃ£o fundidos por rochas magmÃ¡ticas e granito de cimento, em geral, de carbonato de cÃ¡lcio (calcite) fazer efervescÃªncia fÃ¡cil com os Ã¡cidos. Se o cimento do arenito for dolomi</span><span style=\"font-size:13.999999999999998pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">te</span><span style=\"font-size:13.999999999999998pt;font-family:Arial,sans-serif;color:#202122;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> (carbonato de cÃ¡lcio e magnÃ©sio) a efervescÃªncia Ã© menos nÃ­tida.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 5pt 0pt;\"><span style=\"font-size:13.999999999999998pt;font-family:Arial,sans-serif;color:#202122;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Economicamente, o arenito pode ter interesse se for associado a jazidas minerais do tipo plÃ¡cer, onde os metais interessantes se depositam como os grÃ£os de areia, integrando depois o arenito.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 5pt 0pt;\"><span style=\"font-size:13.999999999999998pt;font-family:Arial,sans-serif;color:#202122;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Em Sapucaia do Sul, municÃ­pio brasileiro do estado do Rio Grande do Sul, prÃ³ximo a Porto Alegre, hÃ¡ uma grande mineraÃ§Ã£o de arenito, pedras que sÃ£o extraÃ­das, recortadas e que servem Ã  construÃ§Ã£o civil, como pedras de alicerce. O arenito encontrado naquela regiÃ£o Ã© do tipo eÃ³lico, pertencente Ã  FormaÃ§Ã£o Botucatu. Formou-se pela compactaÃ§Ã£o de areias de um vasto deserto arenoso que existiu onde Ã© hoje a AmÃ©rica do Sul no perÃ­odo TriÃ¡ssico e que foi coberto pelas lavas basÃ¡lticas da FormaÃ§Ã£o Serra Geral.</span></p><p><span id=\"docs-internal-guid-4a2a6d90-7fff-685c-7221-74af23d0482c\"></span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:5pt;\"><span style=\"font-size:13.999999999999998pt;font-family:Arial,sans-serif;color:#202122;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Os arenitos sÃ£o rochas silicosas sedimentares, constituÃ­dos por grÃ£os de sÃ­lica ou quartzo, ligados por cimento silicoso, argiloso ou calcÃ¡rio. SÃ£o empregados em revestimentos, resistindo bem aos ataques de agentes agressivos da atmosfera.</span></p>', 'arenito.jpg', 3, 0, 'arenito.glb'),
(10, 'Ardósia', '<p><span id=\"docs-internal-guid-815643a9-7fff-699a-1d2c-438c8a6541e4\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space-collapse: preserve;\">A ardÃ³sia Ã© uma rocha metamÃ³rfica sÃ­lico-argilosa formada pela transformaÃ§Ã£o da argila sob pressÃ£o e temperatura, endurecida em finas lamelas. De baixo grau metamÃ³rfico, a ardÃ³sia Ã© formada sob as menores pressÃµes e temperaturas dentre as rochas metamÃ³rficas</span></span><br></p>', 'ardosia.jpg', 2, 0, 'rock.glb');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `tipo` smallint NOT NULL DEFAULT '1',
  `img` varchar(255) DEFAULT 'usuario.png',
  `matricula` int NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome`, `email`, `senha`, `telefone`, `tipo`, `img`, `matricula`) VALUES
(4, 'Lorenzo', '05500840029@gmail.com', '$2y$10$nW2qz6CrXXnpG2rFVzvV0OgyH3pllw0TCSpFkS66GNIDUgjEAww9C', '55996448396', 1, 'user-4.png', 2022310934),
(10, 'Teste', '010101@gmail.com', '$2y$10$PG7H9vfMnXsJfZQfRcCtBeevBTTcEsPplTHAzcCMFBqblWDieoiBq', '13113123', 1, 'user-10.png', 1312323123),
(11, 'Lorenzo', 'lorenzodreis@gmail.com', '$2y$10$cLqCGCpiOX/9zjJbln7/vOd4GZJUy9gAhmQaB1uXwr8smDMktXGHi', '55996448396', 2, 'user-.png', 2022310934);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `mineral`
--
ALTER TABLE `mineral`
  ADD CONSTRAINT `mineral_cat` FOREIGN KEY (`idcat`) REFERENCES `catmineral` (`idcat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `rocha`
--
ALTER TABLE `rocha`
  ADD CONSTRAINT `rocha_cat` FOREIGN KEY (`idcat`) REFERENCES `catrocha` (`idcat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
