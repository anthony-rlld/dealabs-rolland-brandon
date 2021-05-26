<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526155150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, deal_id INT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, description VARCHAR(255) NOT NULL, rating INT DEFAULT NULL, INDEX IDX_9474526CF60E2305 (deal_id), INDEX IDX_9474526CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deal (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, degree INT DEFAULT NULL, website VARCHAR(255) NOT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deal_group (deal_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_2B1F87D9F60E2305 (deal_id), INDEX IDX_2B1F87D9FE54D947 (group_id), PRIMARY KEY(deal_id, group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE good_deal (id INT NOT NULL, actual_price DOUBLE PRECISION DEFAULT NULL, new_price DOUBLE PRECISION DEFAULT NULL, free_delivery TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotionnal_code (id INT NOT NULL, reduction_type VARCHAR(255) NOT NULL, code VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(180) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6495E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vote (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, deal_id INT NOT NULL, notation INT NOT NULL, INDEX IDX_5A108564A76ED395 (user_id), INDEX IDX_5A108564F60E2305 (deal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF60E2305 FOREIGN KEY (deal_id) REFERENCES deal (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE deal_group ADD CONSTRAINT FK_2B1F87D9F60E2305 FOREIGN KEY (deal_id) REFERENCES deal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE deal_group ADD CONSTRAINT FK_2B1F87D9FE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE good_deal ADD CONSTRAINT FK_41A27D84BF396750 FOREIGN KEY (id) REFERENCES deal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE promotionnal_code ADD CONSTRAINT FK_32934549BF396750 FOREIGN KEY (id) REFERENCES deal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564F60E2305 FOREIGN KEY (deal_id) REFERENCES deal (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF60E2305');
        $this->addSql('ALTER TABLE deal_group DROP FOREIGN KEY FK_2B1F87D9F60E2305');
        $this->addSql('ALTER TABLE good_deal DROP FOREIGN KEY FK_41A27D84BF396750');
        $this->addSql('ALTER TABLE promotionnal_code DROP FOREIGN KEY FK_32934549BF396750');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A108564F60E2305');
        $this->addSql('ALTER TABLE deal_group DROP FOREIGN KEY FK_2B1F87D9FE54D947');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A108564A76ED395');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE deal');
        $this->addSql('DROP TABLE deal_group');
        $this->addSql('DROP TABLE good_deal');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE promotionnal_code');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vote');
    }
}
