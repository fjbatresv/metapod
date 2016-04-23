<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1461435970.
 * Generated on 2016-04-23 18:26:10 
 */
class PropelMigration_1461435970
{

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `estado_usuario`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `estado_usuario_U_1` (`nombre`)
) ENGINE=MyISAM;

CREATE TABLE `usuario`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(45) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `salt` VARCHAR(255),
    `apellido` VARCHAR(45),
    `username` VARCHAR(45) NOT NULL,
    `password` VARCHAR(45) NOT NULL,
    `direccion` VARCHAR(100),
    `fecha_nacimiento` DATETIME,
    `ultimo_cambio_password` DATE,
    `estado_usuario_id` INTEGER NOT NULL,
    `record_password` TEXT,
    `avatar` TEXT,
    `conectado` TINYINT(1) DEFAULT 0 NOT NULL,
    `ultima_ip` VARCHAR(20),
    `empresa_id` INTEGER,
    `created_by` VARCHAR(50),
    `updated_by` VARCHAR(50),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `usuario_U_1` (`username`),
    INDEX `usuario_FI_1` (`estado_usuario_id`)
) ENGINE=MyISAM;

CREATE TABLE `bitacora`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `descripcion` TEXT NOT NULL,
    `direccion` VARCHAR(15) NOT NULL,
    `fecha_hora` DATETIME NOT NULL,
    `usuario_id` INTEGER,
    `tabla` VARCHAR(100),
    `dato_tabla` INTEGER,
    `error` VARCHAR(255),
    `dato_error` VARCHAR(255),
    `estado` INTEGER NOT NULL,
    `created_by` VARCHAR(50),
    `updated_by` VARCHAR(50),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `bitacora_FI_1` (`usuario_id`)
) ENGINE=MyISAM;

CREATE TABLE `menu`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(100) NOT NULL,
    `ruta` VARCHAR(100) NOT NULL,
    `superior` INTEGER NOT NULL,
    `mostrar` INTEGER(1) NOT NULL,
    `icono` VARCHAR(100),
    `created_by` VARCHAR(50),
    `updated_by` VARCHAR(50),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE `perfil_menu`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `perfil_id` INTEGER NOT NULL,
    `menu_id` INTEGER NOT NULL,
    `created_by` VARCHAR(50),
    `updated_by` VARCHAR(50),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `perfil_menu_FI_1` (`perfil_id`),
    INDEX `perfil_menu_FI_2` (`menu_id`)
) ENGINE=MyISAM;

CREATE TABLE `perfil`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(45) NOT NULL,
    `descripcion` VARCHAR(100),
    `created_by` VARCHAR(50),
    `updated_by` VARCHAR(50),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `perfil_U_1` (`nombre`)
) ENGINE=MyISAM;

CREATE TABLE `usuario_perfil`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `perfil_id` INTEGER NOT NULL,
    `usuario_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `usuario_perfil_FI_1` (`usuario_id`),
    INDEX `usuario_perfil_FI_2` (`perfil_id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `estado_usuario`;

DROP TABLE IF EXISTS `usuario`;

DROP TABLE IF EXISTS `bitacora`;

DROP TABLE IF EXISTS `menu`;

DROP TABLE IF EXISTS `perfil_menu`;

DROP TABLE IF EXISTS `perfil`;

DROP TABLE IF EXISTS `usuario_perfil`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}