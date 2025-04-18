<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240626000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create categories and items tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE categories_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE items_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE categories (id INT NOT NULL, name VARCHAR(255) NOT NULL, emoji VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE items (id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, emoji VARCHAR(10) NOT NULL, is_available BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E11EE94D12469DE2 ON items (category_id)');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94D12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE items DROP CONSTRAINT FK_E11EE94D12469DE2');
        $this->addSql('DROP SEQUENCE categories_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE items_id_seq CASCADE');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE items');
    }
} 