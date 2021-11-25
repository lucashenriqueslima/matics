-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/11/2021 às 12:05
-- Versão do servidor: 10.4.18-MariaDB
-- Versão do PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `matics2`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddProcedure` (IN `TriggerType` INT, IN `DateVerify` VARCHAR(10), IN `ValueFinance` DECIMAL(15,2), IN `UserId` INT)  BEGIN
	DECLARE error_sql tinyint default false;
    DECLARE IdVerify int;
    
    DECLARE continue handler for sqlexception set error_sql = true;
	START TRANSACTION;
    
    SET IdVerify = (SELECT id_finance_month FROM finance_month WHERE MONTH(date) = MONTH(DateVerify) AND YEAR(date) = YEAR(DateVerify) AND id_user = UserId);
    IF IdVerify > 0 THEN
		CASE
			WHEN TriggerType = 1 THEN UPDATE finance_month SET credit = credit + ValueFinance WHERE id_finance_month = IdVerify; INSERT INTO credits VALUES(NULL, UserId, ValueFinance);
			WHEN TriggerType = 2 THEN UPDATE finance_month SET earning = earning + ValueFinance WHERE id_finance_month = IdVerify; INSERT INTO earnings VALUES(NULL, UserId, ValueFinance);
			WHEN TriggerType = 3 THEN UPDATE finance_month SET expense = expense + ValueFinance WHERE id_finance_month = IdVerify; INSERT INTO expense VALUES(NULL, UserId, ValueFinance);
		END CASE;
	ELSE
		CASE
			WHEN TriggerType = 1 THEN INSERT INTO finance_month VALUES(NULL, UserId, DateVerify, ValueFinance, 0.00, 0.00); INSERT INTO credits VALUES(NULL, UserId, ValueFinance);
            		WHEN TriggerType = 2 THEN INSERT INTO finance_month VALUES(NULL, UserId, DateVerify, 0.00, ValueFinance, 0.00); INSERT INTO earnings VALUES(NULL, UserId, ValueFinance);
			WHEN TriggerType = 3 THEN INSERT INTO finance_month VALUES(NULL, UserId, DateVerify, 0.00, 0.00, ValueFinance);	INSERT INTO expense VALUES(NULL, UserId, ValueFinance);
		END CASE;
    END IF;

	IF error_sql = false
		THEN COMMIT;
	ELSE 
		ROLLBACK; 
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteProcedure` (IN `TriggerType` INT, IN `DateVerify` VARCHAR(10), IN `ValueFinance` DECIMAL(15,2), IN `FinanceId` INT, IN `UserId` INT)  BEGIN
	DECLARE error_sql tinyint default false;
    
	DECLARE continue handler for sqlexception set error_sql = true;
	START TRANSACTION;
	CASE
		WHEN TriggerType = 1 THEN DELETE FROM credits WHERE id_credit = FinanceId AND id_user = UserId AND value = ValueFinance; UPDATE finance_month SET credit = credit - ValueFinance WHERE id_user = UserId AND MONTH(date) = MONTH(DateVerify) AND YEAR(date) = YEAR(DateVerify);
        WHEN TriggerType = 2 THEN DELETE FROM earnings WHERE id_earning = FinanceId AND id_user = UserId AND value = ValueFinance; UPDATE finance_month SET earning = earning - ValueFinance WHERE id_user = UserId AND MONTH(date) = MONTH(DateVerify) AND YEAR(date) = YEAR(DateVerify) ;
        WHEN TriggerType = 3 THEN DELETE FROM expense WHERE id_expense = FinanceId AND id_user = UserId AND value = ValueFinance; UPDATE finance_month SET expense = expense - ValueFinance WHERE id_user = UserId AND MONTH(date) = MONTH(DateVerify) AND YEAR(date) = YEAR(DateVerify);
    END CASE;
    
    IF (SELECT credit + earning + expense FROM finance_month WHERE MONTH(date) = MONTH(DateVerify) AND YEAR(date) = YEAR(DateVerify) AND id_user = UserId) = 0
		THEN DELETE FROM finance_month WHERE MONTH(date) = MONTH(DateVerify) AND YEAR(date) = YEAR(DateVerify) AND id_user = UserId;
	END IF;
    
    	IF error_sql = false
		THEN COMMIT;
	ELSE 
		ROLLBACK; 
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MainProcedure` (IN `TriggerType` INT, IN `DateVerify` VARCHAR(10), IN `ValueFinance` DECIMAL(15,2), IN `UserId` INT)  BEGIN
	
    DECLARE IdVerify int;
    
    SET IdVerify = (SELECT id_finance_month FROM finance_month WHERE MONTH(date) = MONTH(DateVerify) AND YEAR(date) = YEAR(DateVerify) AND id_user = UserId);
    IF IdVerify > 0 THEN
		CASE
			WHEN TriggerType = 1 THEN UPDATE finance_month SET credit = credit + ValueFinance WHERE id_finance_month = IdVerify;
			WHEN TriggerType = 2 THEN UPDATE finance_month SET earning = earning + ValueFinance WHERE id_finance_month = IdVerify; 
			WHEN TriggerType = 3 THEN UPDATE finance_month SET expense = expense + ValueFinance WHERE id_finance_month = IdVerify; 
		END CASE;
	ELSE
		CASE
			WHEN TriggerType = 1 THEN INSERT INTO finance_month VALUES(NULL, UserId, DateVerify, ValueFinance, 0.00, 0.00);
            		WHEN TriggerType = 2 THEN INSERT INTO finance_month VALUES(NULL, UserId, DateVerify, 0.00, ValueFinance, 0.00);
			WHEN TriggerType = 3 THEN INSERT INTO finance_month VALUES(NULL, UserId, DateVerify, 0.00, 0.00, ValueFinance);
		END CASE;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `access_alerts`
--

CREATE TABLE `access_alerts` (
  `id_user` int(11) NOT NULL,
  `id_sub_user` int(11) NOT NULL,
  `id_alert` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `alerts`
--

CREATE TABLE `alerts` (
  `id_alert` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `icon_type` varchar(30) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `date` varchar(10) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `alerts`
--

INSERT INTO `alerts` (`id_alert`, `id_user`, `link`, `icon_type`, `icon`, `date`, `message`) VALUES
(1, 1, 'http://google.com.br', 'warning', 'fas fa-car', '10/10/2021', 'Lucas Lindo, tesão, bonito e gostosão'),
(2, 1, 'asd', 'success', 'fas fa-dog', '08/10/2021', 'Seja bem-vindo a aplicação Matics 2');

-- --------------------------------------------------------

--
-- Estrutura para tabela `earnings`
--

CREATE TABLE `earnings` (
  `id_earning` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `value` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `finance_month`
--

CREATE TABLE `finance_month` (
  `id_finance_month` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` date NOT NULL,
  `credit` decimal(15,2) DEFAULT 0.00,
  `earning` decimal(15,2) DEFAULT 0.00,
  `expense` decimal(15,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `finance_month`
--

INSERT INTO `finance_month` (`id_finance_month`, `id_user`, `date`, `credit`, `earning`, `expense`) VALUES
(25, 1, '2021-11-01', '210.00', '1223.00', '12312.00'),
(26, 1, '2021-12-01', '300.00', '300.00', '500.00'),
(27, 1, '2021-10-07', '312.00', '123.00', '3213.00'),
(29, 1, '2021-09-01', '100.00', '100000.00', '0.00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sub_users`
--

CREATE TABLE `sub_users` (
  `id_sub_user` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `passwd` varchar(60) NOT NULL,
  `access` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `sub_users`
--

INSERT INTO `sub_users` (`id_sub_user`, `id_user`, `name`, `email`, `cpf`, `passwd`, `access`) VALUES
(1, 1, 'Lucas Henrique Souza', 'lucas@hotmail.com', '123', '123', '111111111111');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `msg_counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id_user`, `cpf`, `msg_counter`) VALUES
(1, '00423430114', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `access_alerts`
--
ALTER TABLE `access_alerts`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_sub_user` (`id_sub_user`),
  ADD KEY `id_alert` (`id_alert`);

--
-- Índices de tabela `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id_alert`) USING BTREE;

--
-- Índices de tabela `earnings`
--
ALTER TABLE `earnings`
  ADD PRIMARY KEY (`id_earning`);

--
-- Índices de tabela `finance_month`
--
ALTER TABLE `finance_month`
  ADD PRIMARY KEY (`id_finance_month`);

--
-- Índices de tabela `sub_users`
--
ALTER TABLE `sub_users`
  ADD PRIMARY KEY (`id_sub_user`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id_alert` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `earnings`
--
ALTER TABLE `earnings`
  MODIFY `id_earning` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `finance_month`
--
ALTER TABLE `finance_month`
  MODIFY `id_finance_month` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `sub_users`
--
ALTER TABLE `sub_users`
  MODIFY `id_sub_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
