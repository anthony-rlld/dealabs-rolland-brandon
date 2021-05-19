<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210519071209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, deal_id_id INT NOT NULL, user_id_id INT NOT NULL, title VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, description VARCHAR(255) NOT NULL, rating INT DEFAULT NULL, INDEX IDX_9474526C399B5D4B (deal_id_id), INDEX IDX_9474526C9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deal (id INT AUTO_INCREMENT NOT NULL, website_id_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, degree INT DEFAULT NULL, groups_list INT NOT NULL, INDEX IDX_E3FEC116282E2E9B (website_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE good_deal (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, degree INT DEFAULT NULL, groups_list INT NOT NULL, actual_price DOUBLE PRECISION DEFAULT NULL, new_price DOUBLE PRECISION DEFAULT NULL, free_delivery TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotionnal_code (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, degree INT DEFAULT NULL, groups_list INT NOT NULL, reduction_type VARCHAR(255) NOT NULL, code VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vote (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, deal_id_id INT NOT NULL, notation INT NOT NULL, INDEX IDX_5A1085649D86650F (user_id_id), INDEX IDX_5A108564399B5D4B (deal_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE website (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C399B5D4B FOREIGN KEY (deal_id_id) REFERENCES deal (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC116282E2E9B FOREIGN KEY (website_id_id) REFERENCES website (id)');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A1085649D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564399B5D4B FOREIGN KEY (deal_id_id) REFERENCES deal (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C399B5D4B');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A108564399B5D4B');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C9D86650F');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A1085649D86650F');
        $this->addSql('ALTER TABLE deal DROP FOREIGN KEY FK_E3FEC116282E2E9B');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE deal');
        $this->addSql('DROP TABLE good_deal');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE promotionnal_code');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vote');
        $this->addSql('DROP TABLE website');
    }
}
