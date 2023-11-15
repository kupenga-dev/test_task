CREATE TABLE `info` (
    `id` int(11) NOT NULL auto_increment,
    `name` varchar(255) default NULL,
    `desc` text default NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

CREATE TABLE `data` (
    `id` int(11) NOT NULL auto_increment,
    `date` date default NULL,
    `value` INT(11) default NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

CREATE TABLE `link` (
    `data_id` int(11) NOT NULL,
    `info_id` int(11) NOT NULL,
    INDEX `idx_data_id` (`data_id`),
    INDEX `idx_info_id` (`info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;
