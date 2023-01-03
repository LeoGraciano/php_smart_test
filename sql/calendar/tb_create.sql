--
-- Estrutura da tabela `calendário`
--

DROP TABLE IF EXISTS `calendario`;
CREATE TABLE IF NOT EXISTS `calendario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `data_agendamento` varchar(20) DEFAULT '',
  `titulo` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `id_update_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


INSERT INTO `calendario` (data_agendamento, titulo, id_updte_user)
VALUES (
  '2023-01-10' , 'Test de Titulo', '33'
);