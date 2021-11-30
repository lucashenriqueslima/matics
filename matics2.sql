-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           10.4.20-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para matics2
CREATE DATABASE IF NOT EXISTS `matics2` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `matics2`;

-- Copiando estrutura para tabela matics2.access_alerts
CREATE TABLE IF NOT EXISTS `access_alerts` (
  `id_user` int(11) NOT NULL,
  `id_sub_user` int(11) NOT NULL,
  `id_alert` int(11) NOT NULL,
  KEY `id_user` (`id_user`),
  KEY `id_sub_user` (`id_sub_user`),
  KEY `id_alert` (`id_alert`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela matics2.access_alerts: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `access_alerts` DISABLE KEYS */;
/*!40000 ALTER TABLE `access_alerts` ENABLE KEYS */;

-- Copiando estrutura para tabela matics2.alerts
CREATE TABLE IF NOT EXISTS `alerts` (
  `id_alert` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `icon_type` varchar(30) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `date` varchar(10) NOT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id_alert`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela matics2.alerts: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `alerts` DISABLE KEYS */;
INSERT INTO `alerts` (`id_alert`, `id_user`, `link`, `icon_type`, `icon`, `date`, `message`) VALUES
	(1, 1, 'http://google.com.br', 'warning', 'fas fa-car', '10/10/2021', 'Lucas Lindo, tesão, bonito e gostosão'),
	(2, 1, 'asd', 'success', 'fas fa-dog', '08/10/2021', 'Seja bem-vindo a aplicação Matics 2');
/*!40000 ALTER TABLE `alerts` ENABLE KEYS */;

-- Copiando estrutura para tabela matics2.clients
CREATE TABLE IF NOT EXISTS `clients` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `cellphone` varchar(255) NOT NULL DEFAULT '',
  `cpf` varchar(255) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_client`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela matics2.clients: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Copiando estrutura para tabela matics2.companies
CREATE TABLE IF NOT EXISTS `companies` (
  `id_company` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `razao_social` varchar(250) DEFAULT NULL,
  `nome_fantasia` varchar(250) DEFAULT NULL,
  `cnpj` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_company`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela matics2.companies: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;

-- Copiando estrutura para tabela matics2.credits
CREATE TABLE IF NOT EXISTS `credits` (
  `id_credit` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_company` int(11) NOT NULL DEFAULT 0,
  `description` varchar(255) NOT NULL DEFAULT '0',
  `value` decimal(12,2) NOT NULL DEFAULT 0.00,
  `date` date NOT NULL,
  PRIMARY KEY (`id_credit`) USING BTREE,
  KEY `id_user` (`id_user`),
  KEY `id_company` (`id_company`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela matics2.credits: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `credits` DISABLE KEYS */;
/*!40000 ALTER TABLE `credits` ENABLE KEYS */;

-- Copiando estrutura para tabela matics2.earnings
CREATE TABLE IF NOT EXISTS `earnings` (
  `id_earning` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_company` int(11) NOT NULL DEFAULT 0,
  `description` varchar(255) NOT NULL DEFAULT '0',
  `value` decimal(15,2) NOT NULL DEFAULT 0.00,
  `date` date DEFAULT NULL,
  `date_payed` date DEFAULT NULL,
  PRIMARY KEY (`id_earning`),
  KEY `id_user` (`id_user`),
  KEY `id_company` (`id_company`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela matics2.earnings: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `earnings` DISABLE KEYS */;
/*!40000 ALTER TABLE `earnings` ENABLE KEYS */;

-- Copiando estrutura para tabela matics2.expenses
CREATE TABLE IF NOT EXISTS `expenses` (
  `id_expense` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `description` varchar(255) NOT NULL DEFAULT '0',
  `value` decimal(15,2) NOT NULL DEFAULT 0.00,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id_expense`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela matics2.expenses: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;

-- Copiando estrutura para tabela matics2.finance_month
CREATE TABLE IF NOT EXISTS `finance_month` (
  `id_finance_month` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `date` date NOT NULL,
  `credit` decimal(15,2) DEFAULT 0.00,
  `earning` decimal(15,2) DEFAULT 0.00,
  `expense` decimal(15,2) DEFAULT 0.00,
  PRIMARY KEY (`id_finance_month`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela matics2.finance_month: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `finance_month` DISABLE KEYS */;
/*!40000 ALTER TABLE `finance_month` ENABLE KEYS */;

-- Copiando estrutura para tabela matics2.sub_users
CREATE TABLE IF NOT EXISTS `sub_users` (
  `id_sub_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `passwd` varchar(60) NOT NULL,
  `access` varchar(20) NOT NULL,
  PRIMARY KEY (`id_sub_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela matics2.sub_users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `sub_users` DISABLE KEYS */;
INSERT INTO `sub_users` (`id_sub_user`, `id_user`, `name`, `email`, `cpf`, `passwd`, `access`) VALUES
	(1, 1, 'Lucas Henrique Souza', 'lucas@hotmail.com', '00423430114', '123', '111111111111');
/*!40000 ALTER TABLE `sub_users` ENABLE KEYS */;

-- Copiando estrutura para tabela matics2.users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(11) NOT NULL,
  `msg_counter` int(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela matics2.users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id_user`, `cpf`, `msg_counter`) VALUES
	(1, '00423430114', 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Copiando estrutura para procedure matics2.AddProcedure
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddProcedure`(IN `TriggerType` INT, IN `DateVerify` VARCHAR(10), IN `ValueFinance` DECIMAL(15,2), IN `UserId` INT)
BEGIN
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
END//
DELIMITER ;

-- Copiando estrutura para procedure matics2.DeleteProcedure
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteProcedure`(
	IN `TriggerType` INT,
	IN `DateVerify` VARCHAR(10),
	IN `ValueFinance` DECIMAL(15,2),
	IN `FinanceId` INT,
	IN `UserId` INT
)
BEGIN
	DECLARE error_sql tinyint default false;
    
	DECLARE continue handler for sqlexception set error_sql = true;
	START TRANSACTION;
	CASE
		WHEN TriggerType = 1 THEN DELETE FROM credits WHERE id_credit = FinanceId AND id_user = UserId; UPDATE finance_month SET credit = credit - ValueFinance WHERE id_user = UserId AND MONTH(date) = MONTH(DateVerify) AND YEAR(date) = YEAR(DateVerify);
        WHEN TriggerType = 2 THEN DELETE FROM earnings WHERE id_earning = FinanceId AND id_user = UserId; UPDATE finance_month SET earning = earning - ValueFinance WHERE id_user = UserId AND MONTH(date) = MONTH(DateVerify) AND YEAR(date) = YEAR(DateVerify) ;
        WHEN TriggerType = 3 THEN DELETE FROM expenses WHERE id_expense = FinanceId AND id_user = UserId; UPDATE finance_month SET expense = expense - ValueFinance WHERE id_user = UserId AND MONTH(date) = MONTH(DateVerify) AND YEAR(date) = YEAR(DateVerify);
    END CASE;
    
    IF (SELECT credit + earning + expense FROM finance_month WHERE MONTH(date) = MONTH(DateVerify) AND YEAR(date) = YEAR(DateVerify) AND id_user = UserId) = 0
		THEN DELETE FROM finance_month WHERE MONTH(date) = MONTH(DateVerify) AND YEAR(date) = YEAR(DateVerify) AND id_user = UserId;
	END IF;
    
    	IF error_sql = false
		THEN COMMIT;
	ELSE 
		ROLLBACK; 
	END IF;
END//
DELIMITER ;

-- Copiando estrutura para procedure matics2.MainProcedure
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `MainProcedure`(
	IN `TriggerType` INT,
	IN `DateVerify` VARCHAR(10),
	IN `ValueFinance` DECIMAL(15,2),
	IN `UserId` INT
)
BEGIN
   DECLARE IdVerify int;
   DECLARE error_sql tinyint default false;
   
   DECLARE continue handler for sqlexception set error_sql = true;
	START TRANSACTION;
    SET IdVerify = (SELECT id_finance_month FROM finance_month WHERE MONTH(date) = MONTH(DateVerify) AND YEAR(date) = YEAR(DateVerify) AND id_user = UserId);
    IF IdVerify > 0 THEN
		CASE
			WHEN TriggerType = 1 THEN UPDATE finance_month SET credit = credit + ValueFinance WHERE id_finance_month = IdVerify;
			WHEN TriggerType = 2 THEN UPDATE finance_month SET earning = earning + ValueFinance, credit = credit - ValueFinance WHERE id_finance_month = IdVerify; 
			WHEN TriggerType = 3 THEN UPDATE finance_month SET expense = expense + ValueFinance WHERE id_finance_month = IdVerify; 
		END CASE;
	ELSE
		CASE
			WHEN TriggerType = 1 THEN INSERT INTO finance_month VALUES(NULL, UserId, DateVerify, ValueFinance, 0.00, 0.00);
			WHEN TriggerType = 3 THEN INSERT INTO finance_month VALUES(NULL, UserId, DateVerify, 0.00, 0.00, ValueFinance);
		END CASE;
    END IF;
    
    IF error_sql = false
		THEN COMMIT;
	ELSE 
		ROLLBACK; 
	END IF;
END//
DELIMITER ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
