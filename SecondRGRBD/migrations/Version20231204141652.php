<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231204141652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE agent_entity_code_agent_seq CASCADE');
        $this->addSql('CREATE SEQUENCE agents_code_agent_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE agreement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE filial_code_filial_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE agents (code_agent INT NOT NULL, agent_name VARCHAR(255) NOT NULL, agent_surname VARCHAR(255) NOT NULL, agent_patronymic VARCHAR(255) NOT NULL, addres VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, PRIMARY KEY(code_agent))');
        $this->addSql('CREATE TABLE agreement (id INT NOT NULL, code_agent_id INT DEFAULT NULL, date_of_conclusion DATE NOT NULL, sum_insured DOUBLE PRECISION NOT NULL, tarrif_rate DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2E655A24CD950920 ON agreement (code_agent_id)');
        $this->addSql('CREATE TABLE filial (code_filial INT NOT NULL, agent_entity_id INT DEFAULT NULL, name_filial VARCHAR(30) NOT NULL, addres VARCHAR(50) NOT NULL, phone VARCHAR(20) NOT NULL, PRIMARY KEY(code_filial))');
        $this->addSql('CREATE INDEX IDX_F55997597671FB19 ON filial (agent_entity_id)');
        $this->addSql('ALTER TABLE agreement ADD CONSTRAINT FK_2E655A24CD950920 FOREIGN KEY (code_agent_id) REFERENCES agents (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE filial ADD CONSTRAINT FK_F55997597671FB19 FOREIGN KEY (agent_entity_id) REFERENCES agents (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE agent_entity');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE agents_code_agent_seq CASCADE');
        $this->addSql('DROP SEQUENCE agreement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE filial_code_filial_seq CASCADE');
        $this->addSql('CREATE SEQUENCE agent_entity_code_agent_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE agent_entity (code_agent INT NOT NULL, agent_name INT NOT NULL, agent_surname INT NOT NULL, PRIMARY KEY(code_agent))');
        $this->addSql('ALTER TABLE agreement DROP CONSTRAINT FK_2E655A24CD950920');
        $this->addSql('ALTER TABLE filial DROP CONSTRAINT FK_F55997597671FB19');
        $this->addSql('DROP TABLE agents');
        $this->addSql('DROP TABLE agreement');
        $this->addSql('DROP TABLE filial');
    }
}
