-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/11/2025 às 22:09
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
-- Banco de dados: `locarro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluguel`
--

CREATE TABLE `aluguel` (
  `id_aluguel` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_carro` int(11) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date DEFAULT NULL,
  `horario_inicio` time NOT NULL,
  `horario_fim` time NOT NULL,
  `lugar` varchar(20) NOT NULL,
  `valor_pago` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluguel`
--

INSERT INTO `aluguel` (`id_aluguel`, `id_usuario`, `id_carro`, `data_inicio`, `data_fim`, `horario_inicio`, `horario_fim`, `lugar`, `valor_pago`) VALUES
(13, 2, 12, '2025-11-17', '2025-11-26', '13:30:00', '13:30:00', 'São Paulo', 1170.00),
(14, 2, 6, '2025-11-14', '2025-11-17', '06:30:00', '23:00:00', 'Rio de Janeiro', 960.00),
(15, 11, 3, '2025-11-28', '2025-12-01', '06:10:00', '06:30:00', 'Rio Grande do Sul', 477.00),
(16, 12, 4, '2025-11-06', '2025-11-10', '14:30:00', '14:30:00', 'Rio de Janeiro', 652.00),
(17, 13, 1, '2025-11-17', '2025-11-20', '09:00:00', '18:00:00', 'São Paulo', 1200.00),
(18, 14, 2, '2025-11-17', '2025-11-22', '08:30:00', '17:30:00', 'Rio de Janeiro', 950.00),
(19, 15, 3, '2025-11-17', '2025-11-21', '10:00:00', '16:00:00', 'Belo Horizonte', 800.00),
(20, 16, 4, '2025-11-17', '2025-11-25', '07:45:00', '19:00:00', 'Curitiba', 1500.00),
(21, 17, 5, '2025-11-17', '2025-11-23', '09:15:00', '18:30:00', 'Porto Alegre', 1100.00),
(22, 18, 6, '2025-11-17', '2025-11-27', '08:00:00', '17:45:00', 'Salvador', 1300.00),
(23, 13, 7, '2025-11-17', '2025-11-19', '09:30:00', '18:00:00', 'São Paulo', 900.00),
(24, 14, 8, '2025-11-14', '2025-11-17', '08:00:00', '17:00:00', 'Rio de Janeiro', 1100.00),
(25, 15, 9, '2025-11-13', '2025-11-17', '09:15:00', '18:30:00', 'Belo Horizonte', 950.00),
(26, 16, 10, '2025-11-12', '2025-11-17', '07:30:00', '18:00:00', 'Curitiba', 1250.00),
(27, 17, 11, '2025-11-10', '2025-11-17', '08:45:00', '17:45:00', 'Porto Alegre', 1000.00),
(28, 18, 12, '2025-11-11', '2025-11-17', '09:00:00', '18:00:00', 'Salvador', 1150.00),
(35, 13, 7, '2025-11-18', '2025-11-18', '09:00:00', '18:00:00', 'São Paulo', 500.00),
(36, 14, 8, '2025-11-18', '2025-11-18', '08:30:00', '17:30:00', 'Rio de Janeiro', 550.00),
(37, 15, 9, '2025-11-18', '2025-11-18', '10:00:00', '16:00:00', 'Belo Horizonte', 600.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `carro`
--

CREATE TABLE `carro` (
  `id_carro` int(11) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `placa` varchar(7) NOT NULL,
  `ano` int(11) DEFAULT NULL,
  `cor` varchar(30) DEFAULT NULL,
  `tanque` int(11) NOT NULL,
  `cambio` varchar(15) NOT NULL,
  `capacidade` int(11) NOT NULL,
  `descricao` varchar(420) NOT NULL,
  `imagem` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carro`
--

INSERT INTO `carro` (`id_carro`, `modelo`, `tipo`, `preco`, `placa`, `ano`, `cor`, `tanque`, `cambio`, `capacidade`, `descricao`, `imagem`) VALUES
(1, 'Fiat Argo', 'Hatch', 149.00, 'LVT3721', 2000, 'Preto', 47, 'Manual', 5, 'Argo é um automóvel hatch da Fiat, que foi lançado no Brasil no dia 31 de maio de 2017, para substituir o Punto, Bravo e o Palio. Seu nome remete ao mito grego de Jasão e os Argonautas que viajavam a bordo da nau Argo, construída pelo semideus Argos, sob orientação da deusa Atena.', 'https://file.garden/Zdftnpzmo3pLm05y/trabalho3daw/FiatArgo.png'),
(2, 'Hyundai HB20', 'Hatch', 130.00, 'CYU0528', 2000, 'Cinza', 50, 'Automático', 5, 'Opção com bloco e cabeçote de alumínio, 3 cilindros, 12 válvulas e 80 cv de potência, ele oferece performance de um motor maior com consumo de um motor menor. O sistema de partida a frio E-start dispensa reservatório de gasolina, melhorando a performance e reduzindo emissões de poluentes.', 'https://file.garden/Zdftnpzmo3pLm05y/trabalho3daw/HyundaiHB20.png'),
(3, 'Renault Kwid', 'Hatch', 159.00, 'JVU5866', 2000, 'Azul', 70, 'Manual', 5, 'Compacto e atraente, o Renault Kwid se destaca por seu design de SUV: altura do solo de 185 mm, revestido com placas de proteção de carroceria e dianteiras. Esse SUV chama atenção com sua nova cor cinza cassiopée, adesivos laterais exclusivos e os detalhes marcantes na cor citron.', 'https://file.garden/Zdftnpzmo3pLm05y/trabalho3daw/RenaultKwid%20.png'),
(4, 'Chevrolet Prisma', 'Sedan', 163.00, 'HPB5591', 2000, 'Preto', 44, 'Automático', 5, 'Ele suporta uma carga útil de 375 kg e tem um tanque de combustível para 54 litros. O sedan Prisma Joy 2019 tem 4.275 mm de comprimento, 1.484 mm de altura, 1.705 mm de largura, vão livre do solo de 120 mm e espaço entre os eixos de 2.528 mm. O peso total é de 1.035 kg.', 'https://file.garden/Zdftnpzmo3pLm05y/trabalho3daw/ChevroletPrisma.png'),
(5, 'Civic G10', 'Sedan', 355.00, 'MZN1524', 2000, 'Preto', 56, 'Manual', 5, 'O Civic Geração 10 possui linhas elegantes e fluídas e grades frontais cromadas* que desenham o para- choque e se combinam com as luzes diurnas em LED (DRL). Na traseira, um design marcante e as lanternas em LED em formato “C” conferem ainda mais sofisticação. CONVENIÊNCIA É GARANTIR CONFORTO COM MÁXIMA SOFISTICAÇÃO.', 'https://file.garden/Zdftnpzmo3pLm05y/trabalho3daw/CivicG10.png'),
(6, 'Hyundai Tucson', 'SUV', 320.00, 'JVM8443', 2000, 'Branco', 80, 'Automático', 5, 'O propulsor permanece o 1.6 16v T-GDI a gasolina, que rende 177 cv e 27 kgfm, acoplado à transmissão automatizada de dupla embreagem (Ecoshift) de 7 velocidades. O SUV tem 4475 mm de comprimento, 1850 mm de largura, 1660 mm de altura, 2670 mm de distância entre-eixos e 513 litros de volume no porta-malas.', 'https://file.garden/Zdftnpzmo3pLm05y/trabalho3daw/HyundaiTucson.png'),
(7, 'Renault Fluence', 'Sedan', 240.00, 'JHJ4846', 200, 'Branco', 60, 'Manual', 5, 'O Novo Renault Fluence é um automóvel robusto - sensação reforçada pela elevada linha de cintura e sua musculatura acentuada – e equilibrada – com um porta-malas bem integrado ao design do veículo. Suas dimensões imponentes dão a impressão de se tratar de um veículo de segmento superior.', 'https://file.garden/Zdftnpzmo3pLm05y/trabalho3daw/RenaultFluence.png'),
(8, 'CR-V', 'SUV', 250.00, 'MZG0496', 2000, 'Branco', 53, 'Manual', 6, 'O sistema e:HEV apresenta um motor a combustão de altíssima eficiência, com 147 cv de potência máxima e 19,4 kgfm de torque máximo, complementado por um e-CVT que abriga os motores elétricos. Carregamento automático das baterias, sem necessidade de tomadas e plugues.', 'https://file.garden/Zdftnpzmo3pLm05y/trabalho3daw/CRV.png'),
(9, 'Volvo XC60', 'SUV', 399.00, 'MSU5516', 2000, 'Branco', 70, 'Automático', 6, 'O Volvo XC60 é um SUV lançado pela Volvo em 2007 no North American International Auto Show, em Detroit, Michigan. De acordo com Wheels24, o Premier Automotive Group tinha planeado lançar o crossover compacto para o público em finais de 2006, mas não deu certo. Ele está programado para ir à venda em 2009. Este modelo foi o mais vendido da Volvo Cars em 2016.', 'https://file.garden/Zdftnpzmo3pLm05y/trabalho3daw/VolvoXC60.png'),
(10, 'Fiat Uno', 'Hatch', 110.00, 'LVS2459', 2000, 'Branco', 50, 'Manual', 5, 'O Uno é um automóvel compacto fabricado pela Fiat, lançado na Europa em 1983. Foi lançado no Brasil no ano seguinte, e sua nova geração (projetada no Brasil) só foi lançada em 2010, direcionada aos países da América Latina. A versão antiga foi produzida até dezembro de 2013 sendo vendida como Fiat Mille nome adotado inicialmente em 1990, quando adotou um motor com menos de 1 000cc no Brasil. O nome é uma referência a', 'https://file.garden/Zdftnpzmo3pLm05y/trabalho3daw/FiatUno.png'),
(11, 'Jeep Renegade', 'SUV', 275.00, 'AMB6498', 2000, 'Preto', 55, 'Automático', 5, 'O Renegade é um SUV crossover compacto, produzido pela Jeep, bandeira da Stellantis, lançado em 2014. É fabricado em Melfi (na Itália) e também em Rüsselsheim (na Alemanha), e em Goiana, PE, Brasil, tendo sua produção começado em março de 2015.', 'https://file.garden/Zdftnpzmo3pLm05y/trabalho3daw/JeepRenegade.png'),
(12, 'Fiat Mobi', 'Hatch', 130.00, 'KKB2847', 2000, 'Branco', 47, 'Manual', 4, 'Central multimídia com tela de 7 polegadas e conectividade com Apple CarPlay e Android Auto; Banco do motorista com regulagem de altura; Direção hidráulica; Calotas exclusivas escurecidas — e muito mais!', 'https://file.garden/Zdftnpzmo3pLm05y/trabalho3daw/FiatMobi.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` char(15) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `cpf`, `telefone`, `endereco`, `id_usuario`) VALUES
(1, 'Fulano de Tal', '123.456.789-00', '(21) 99999-9999', 'Rua dos Bobos, 100', 2),
(9, 'Vinicius Nunes', '982.327.230-17', '(55) 2012-1666', 'Rua dos Anjos, 35', 11),
(10, 'Thiago Farias', '796.275.380-35', '(21) 2734-3215', 'Rua do Colégio, 42', 12),
(17, 'Ana Souza', '123.456.789-67', '(11) 90000-1111', 'Rua das Flores, 120 – São Paulo', 13),
(18, 'João Lima', '987.654.321-00', '(21) 98888-2222', 'Av. Atlântica, 500 – Rio de Janeiro', 14),
(19, 'Maria Oliveira', '456.789.123-55', '(31) 97777-3333', 'Rua Tiradentes, 90 – Belo Horizonte', 15),
(20, 'Carlos Silva', '112.233.445-56', '(41) 96666-4444', 'Rua Paraná, 410 – Curitiba', 16),
(21, 'Júlia Mendes', '554.433.221-10', '(51) 95555-5555', 'Av. Ipiranga, 890 – Porto Alegre', 17),
(22, 'Pedro Santos', '998.877.665-44', '(71) 94444-6666', 'Rua Imperial, 77 – Salvador', 18);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `email`, `senha`) VALUES
(-1, 'adm@adm', '4DM'),
(2, 'teste@gmail.com', 'teste'),
(11, 'vzn@gmail.com', 'vzn123'),
(12, 'thiagoF@gmail.com', 'TheGoat'),
(13, 'ana.souza@gmail.com', '123'),
(14, 'joao.lima@hotmail.com', 'abc'),
(15, 'maria.oliveira@yahoo.com', '321'),
(16, 'carlos.silva@gmail.com', 'senha1'),
(17, 'julia.mendes@outlook.com', 'teste2024'),
(18, 'pedro.santos@gmail.com', '987');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluguel`
--
ALTER TABLE `aluguel`
  ADD PRIMARY KEY (`id_aluguel`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_carro` (`id_carro`);

--
-- Índices de tabela `carro`
--
ALTER TABLE `carro`
  ADD PRIMARY KEY (`id_carro`),
  ADD UNIQUE KEY `placa` (`placa`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluguel`
--
ALTER TABLE `aluguel`
  MODIFY `id_aluguel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `carro`
--
ALTER TABLE `carro`
  MODIFY `id_carro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `aluguel`
--
ALTER TABLE `aluguel`
  ADD CONSTRAINT `aluguel_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `aluguel_ibfk_2` FOREIGN KEY (`id_carro`) REFERENCES `carro` (`id_carro`);

--
-- Restrições para tabelas `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
