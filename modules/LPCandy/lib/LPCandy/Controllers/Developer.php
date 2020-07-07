<?php

namespace LPCandy\Controllers;

class Developer extends \CMS\Controllers\Admin\BasePrivate {
    function update_tracks_type() {
        $this->em->getConnection()->executeQuery("
            UPDATE lp_entity SET type = '1' WHERE type = 'track';
            CREATE TABLE lp_entity_types (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(128) NOT NULL, public_create TINYINT(1) DEFAULT '0' NOT NULL, public_edit TINYINT(1) DEFAULT '0' NOT NULL, public_read TINYINT(1) DEFAULT '0' NOT NULL, upload TINYINT(1) DEFAULT '0' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
            INSERT INTO lp_entity_types (name, public_create, public_edit, public_read, upload) VALUES (\"track\",1,0,0,0);
            ALTER TABLE lp_entity CHANGE type type INT DEFAULT NULL;
            ALTER TABLE lp_entity ADD CONSTRAINT FK_9A798B1B8CDE5729 FOREIGN KEY (type) REFERENCES lp_entity_types (id);
            CREATE INDEX IDX_9A798B1B8CDE5729 ON lp_entity (type)
        ");
        
        echo 'Обновленно';
    }
}