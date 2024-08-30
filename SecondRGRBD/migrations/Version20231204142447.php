<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231204142447 extends AbstractMigration
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
        $this->addSql('CREATE SEQUENCE insurance_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE agents DROP CONSTRAINT code_filial');
        $this->addSql('DROP INDEX IDX_9596AB6E8ADFCFFB');
        $this->addSql('ALTER TABLE agents DROP code_filial');
        $this->addSql('ALTER TABLE agents ALTER agent_name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE agents ALTER agent_surname TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE agents ALTER agent_patronymic TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE agents ALTER addres TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE agents ALTER phone TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE agreement DROP CONSTRAINT code_agent');
        $this->addSql('ALTER TABLE agreement DROP CONSTRAINT code_insurance_type');
        $this->addSql('DROP INDEX IDX_2E655A24CADE85D1');
        $this->addSql('DROP INDEX IDX_2E655A2419C6DF7A');
        $this->addSql('ALTER TABLE agreement DROP CONSTRAINT agreement_pkey');
        $this->addSql('ALTER TABLE agreement ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE agreement ADD code_agent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE agreement ADD code_insurance_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE agreement DROP code_agreement');
        $this->addSql('ALTER TABLE agreement DROP code_agent');
        $this->addSql('ALTER TABLE agreement DROP code_insurance_type');
        $this->addSql('ALTER TABLE agreement ALTER date_of_conclusion TYPE DATE');
        $this->addSql('ALTER TABLE agreement ALTER sum_insured TYPE DOUBLE PRECISION');
        $this->addSql('ALTER TABLE agreement RENAME COLUMN tariff_rate TO tarrif_rate');
        $this->addSql('ALTER TABLE agreement ADD CONSTRAINT FK_2E655A24CD950920 FOREIGN KEY (code_agent_id) REFERENCES agents (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agreement ADD CONSTRAINT FK_2E655A244B8096FA FOREIGN KEY (code_insurance_type_id) REFERENCES insurance_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2E655A24CD950920 ON agreement (code_agent_id)');
        $this->addSql('CREATE INDEX IDX_2E655A244B8096FA ON agreement (code_insurance_type_id)');
        $this->addSql('ALTER TABLE agreement ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE filial ADD agent_entity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE filial ALTER phone TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE filial ADD CONSTRAINT FK_F55997597671FB19 FOREIGN KEY (agent_entity_id) REFERENCES agents (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F55997597671FB19 ON filial (agent_entity_id)');
        $this->addSql('ALTER TABLE insurance_type DROP CONSTRAINT insurance_type_pkey');
        $this->addSql('ALTER TABLE insurance_type RENAME COLUMN code_insurance_type TO id');
        $this->addSql('ALTER TABLE insurance_type ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE agents_code_agent_seq CASCADE');
        $this->addSql('DROP SEQUENCE agreement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE filial_code_filial_seq CASCADE');
        $this->addSql('DROP SEQUENCE insurance_type_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE agent_entity_code_agent_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE filial DROP CONSTRAINT FK_F55997597671FB19');
        $this->addSql('DROP INDEX IDX_F55997597671FB19');
        $this->addSql('ALTER TABLE filial DROP agent_entity_id');
        $this->addSql('ALTER TABLE filial ALTER phone TYPE NUMERIC(10, 0)');
        $this->addSql('ALTER TABLE filial ALTER phone TYPE NUMERIC(10, 0)');
        $this->addSql('ALTER TABLE agents ADD code_filial INT NOT NULL');
        $this->addSql('ALTER TABLE agents ALTER agent_name TYPE VARCHAR(10)');
        $this->addSql('ALTER TABLE agents ALTER agent_surname TYPE VARCHAR(10)');
        $this->addSql('ALTER TABLE agents ALTER agent_patronymic TYPE VARCHAR(10)');
        $this->addSql('ALTER TABLE agents ALTER addres TYPE VARCHAR(40)');
        $this->addSql('ALTER TABLE agents ALTER phone TYPE NUMERIC(10, 0)');
        $this->addSql('ALTER TABLE agents ADD CONSTRAINT code_filial FOREIGN KEY (code_filial) REFERENCES filial (code_filial) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9596AB6E8ADFCFFB ON agents (code_filial)');
        $this->addSql('ALTER TABLE agreement DROP CONSTRAINT FK_2E655A24CD950920');
        $this->addSql('ALTER TABLE agreement DROP CONSTRAINT FK_2E655A244B8096FA');
        $this->addSql('DROP INDEX IDX_2E655A24CD950920');
        $this->addSql('DROP INDEX IDX_2E655A244B8096FA');
        $this->addSql('DROP INDEX agreement_pkey');
        $this->addSql('ALTER TABLE agreement ADD code_agent INT NOT NULL');
        $this->addSql('ALTER TABLE agreement ADD code_insurance_type INT NOT NULL');
        $this->addSql('ALTER TABLE agreement DROP code_agent_id');
        $this->addSql('ALTER TABLE agreement DROP code_insurance_type_id');
        $this->addSql('ALTER TABLE agreement ALTER date_of_conclusion TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE agreement ALTER sum_insured TYPE NUMERIC(10, 0)');
        $this->addSql('ALTER TABLE agreement RENAME COLUMN id TO code_agreement');
        $this->addSql('ALTER TABLE agreement RENAME COLUMN tarrif_rate TO tariff_rate');
        $this->addSql('ALTER TABLE agreement ADD CONSTRAINT code_agent FOREIGN KEY (code_agent) REFERENCES agents (code_agent) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agreement ADD CONSTRAINT code_insurance_type FOREIGN KEY (code_insurance_type) REFERENCES insurance_type (code_insurance_type) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2E655A24CADE85D1 ON agreement (code_agent)');
        $this->addSql('CREATE INDEX IDX_2E655A2419C6DF7A ON agreement (code_insurance_type)');
        $this->addSql('ALTER TABLE agreement ADD PRIMARY KEY (code_agreement)');
        $this->addSql('DROP INDEX insurance_type_pkey');
        $this->addSql('ALTER TABLE insurance_type RENAME COLUMN id TO code_insurance_type');
        $this->addSql('ALTER TABLE insurance_type ADD PRIMARY KEY (code_insurance_type)');
    }
}
