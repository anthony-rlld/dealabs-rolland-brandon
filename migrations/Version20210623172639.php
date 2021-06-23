<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623172639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_deal');
        $this->addSql('ALTER TABLE user ADD image_name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_deal (user_id INT NOT NULL, deal_id INT NOT NULL, INDEX IDX_997F8DDFA76ED395 (user_id), INDEX IDX_997F8DDFF60E2305 (deal_id), PRIMARY KEY(user_id, deal_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_deal ADD CONSTRAINT FK_997F8DDFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_deal ADD CONSTRAINT FK_997F8DDFF60E2305 FOREIGN KEY (deal_id) REFERENCES deal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP image_name');
    }
}
