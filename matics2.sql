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

-- Copiando dados para a tabela matics2.clients: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` (`id_client`, `id_user`, `name`, `cellphone`, `cpf`, `status`) VALUES
	(1, 1, 'Lucas Henrique', '123123123', '123123123', 0),
	(2, 1, 'a', 'a', 'teste', 0),
	(3, 1, 'Lucas Henrique Souza', '(62) 99439-0988', '004.234.301-14', 0),
	(4, 1, 'lucas', '85 99439-0988', '12344555', 0),
	(5, 1, 'Lucas', '(85) 99991-2931', '123.123.123-11', 0),
	(6, 1, 'Matheus', '(84) 23423-4234', '123.654.561-23', 0),
	(7, 1, 'Lucas Henrique Souza de Lima', '(62) 99439-9999', '004.234.301-11', 0),
	(8, 1, 'Lucas Henrique', '(62) 99439-0988', '004.234.301-11', 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela matics2.companies: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` (`id_company`, `id_user`, `razao_social`, `nome_fantasia`, `cnpj`, `status`) VALUES
	(211, 1, 'Lucas', 'Teste', '31.312.312/3123-12', 0),
	(212, 1, 'Cristima', 'Lembrar', '12.312.423/1423-54', 1),
	(213, 1, 'Lucas', '312312', '21.312.312/3123-13', 0),
	(214, 1, 'asdasd', '312312', '12.312.312/3123-12', 0),
	(215, 1, 'Lucas', '312312', '12.312.312/3123-12', 0),
	(216, 1, 'Lucas', 'Teste', '12.312.312/3123-21', 0),
	(217, 1, 'Lucas', 'Teste', '12.312.312/3123-21', 0),
	(218, 1, 'Lucas', 'Teste', '12.312.312/3123-12', 0),
	(219, 1, 'Lucas', 'Teste', '12.312.312/3123-21', 1);
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;

-- Copiando estrutura para tabela matics2.credits_earnings
CREATE TABLE IF NOT EXISTS `credits_earnings` (
  `id_credit_earning` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_company` int(11) NOT NULL DEFAULT 0,
  `value` decimal(12,2) NOT NULL DEFAULT 0.00,
  `date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_credit_earning`),
  KEY `id_user` (`id_user`),
  KEY `id_company` (`id_company`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela matics2.credits_earnings: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `credits_earnings` DISABLE KEYS */;
INSERT INTO `credits_earnings` (`id_credit_earning`, `id_user`, `id_company`, `value`, `date`, `status`) VALUES
	(1, 1, 212, 100.20, '2000-12-30', 1);
/*!40000 ALTER TABLE `credits_earnings` ENABLE KEYS */;

-- Copiando estrutura para tabela matics2.earnings
CREATE TABLE IF NOT EXISTS `earnings` (
  `id_earning` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_earning`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela matics2.earnings: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `earnings` DISABLE KEYS */;
/*!40000 ALTER TABLE `earnings` ENABLE KEYS */;

-- Copiando estrutura para tabela matics2.finance_month
CREATE TABLE IF NOT EXISTS `finance_month` (
  `id_finance_month` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `date` date NOT NULL,
  `credit` decimal(15,2) DEFAULT 0.00,
  `earning` decimal(15,2) DEFAULT 0.00,
  `expense` decimal(15,2) DEFAULT 0.00,
  PRIMARY KEY (`id_finance_month`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela matics2.finance_month: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `finance_month` DISABLE KEYS */;
INSERT INTO `finance_month` (`id_finance_month`, `id_user`, `date`, `credit`, `earning`, `expense`) VALUES
	(25, 1, '2021-11-01', 210.00, 1223.00, 12312.00),
	(26, 1, '2021-12-01', 300.00, 300.00, 500.00),
	(27, 1, '2021-10-07', 312.00, 123.00, 3213.00),
	(29, 1, '2021-09-01', 100.00, 100000.00, 0.00);
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
	(1, 1, 'Lucas Henrique Souza', 'lucas@hotmail.com', '123', '123', '111111111111');
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

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
