CREATE TABLE `action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `class` varchar(200) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Действаия которые будут выполняться при успешном выполнении политики';

CREATE TABLE `policy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Политика ( может быть активной. не активной (проверки в ней выполняться не бдут), и удаленной (необходимо для растаскивания информации по серверам))';

CREATE TABLE `policy_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_id` varchar(45) DEFAULT NULL,
  `policy_id` varchar(45) DEFAULT NULL,
  `variables` json DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='тут реализованны политики =эта табица говорит о том какие классы будут реализовывать какие проверки и передавать в них параметры для построения заепросов';

CREATE TABLE `rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `class` varchar(200) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

CREATE TABLE `target_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `target_id` int(11) DEFAULT NULL,
  `policy_id` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Тут реализуется связь между обектами (Ролями пользователей и политиками)';
