<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231204140830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE agents_code_agent_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE filial_code_filial_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE agreement DROP CONSTRAINT code_agent');
        $this->addSql('ALTER TABLE agreement DROP CONSTRAINT code_insurance_type');
        $this->addSql('DROP TABLE agreement');
        $this->addSql('DROP TABLE insurance_type');
        $this->addSql('ALTER TABLE agents DROP CONSTRAINT code_filial');
        $this->addSql('DROP INDEX IDX_9596AB6E8ADFCFFB');
        $this->addSql('ALTER TABLE agents DROP code_filial');
        $this->addSql('ALTER TABLE agents ALTER agent_name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE agents ALTER agent_surname TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE agents ALTER agent_patronymic TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE agents ALTER addres TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE agents ALTER phone TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE filial ADD agent_entity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE filial ALTER phone TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE filial ADD CONSTRAINT FK_F55997597671FB19 FOREIGN KEY (agent_entity_id) REFERENCES agents (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F55997597671FB19 ON filial (agent_entity_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE agents_code_agent_seq CASCADE');
        $this->addSql('DROP SEQUENCE filial_code_filial_seq CASCADE');
        $this->addSql('CREATE TABLE agreement (code_agreement INT NOT NULL, code_agent INT NOT NULL, code_insurance_type INT NOT NULL, date_of_conclusion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, sum_insured NUMERIC(10, 0) NOT NULL, tariff_rate DOUBLE PRECISION NOT NULL, PRIMARY KEY(code_agreement))');
        $this->addSql('CREATE INDEX IDX_2E655A24CADE85D1 ON agreement (code_agent)');
        $this->addSql('CREATE INDEX IDX_2E655A2419C6DF7A ON agreement (code_insurance_type)');
        $this->addSql('CREATE TABLE insurance_type (code_insurance_type INT NOT NULL, name_of_insurance VARCHAR(20) NOT NULL, PRIMARY KEY(code_insurance_type))');
        $this->addSql('ALTER TABLE agreement ADD CONSTRAINT code_agent FOREIGN KEY (code_agent) REFERENCES agents (code_agent) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agreement ADD CONSTRAINT code_insurance_type FOREIGN KEY (code_insurance_type) REFERENCES insurance_type (code_insurance_type) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agents ADD code_filial INT NOT NULL');
        $this->addSql('ALTER TABLE agents ALTER agent_name TYPE VARCHAR(10)');
        $this->addSql('ALTER TABLE agents ALTER agent_surname TYPE VARCHAR(10)');
        $this->addSql('ALTER TABLE agents ALTER agent_patronymic TYPE VARCHAR(10)');
        $this->addSql('ALTER TABLE agents ALTER addres TYPE VARCHAR(40)');
        $this->addSql('ALTER TABLE agents ALTER phone TYPE NUMERIC(10, 0)');
        $this->addSql('ALTER TABLE agents ADD CONSTRAINT code_filial FOREIGN KEY (code_filial) REFERENCES filial (code_filial) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9596AB6E8ADFCFFB ON agents (code_filial)');
        $this->addSql('ALTER TABLE filial DROP CONSTRAINT FK_F55997597671FB19');
        $this->addSql('DROP INDEX IDX_F55997597671FB19');
        $this->addSql('ALTER TABLE filial DROP agent_entity_id');
        $this->addSql('ALTER TABLE filial ALTER phone TYPE NUMERIC(10, 0)');
        $this->addSql('ALTER TABLE filial ALTER phone TYPE NUMERIC(10, 0)');
    }
}
