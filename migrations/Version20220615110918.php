<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615110918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, brand VARCHAR(255) NOT NULL, price INT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD created_user_id_id INT NOT NULL, ADD thumbnail_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D3C026CAE FOREIGN KEY (created_user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DBED34FF2 FOREIGN KEY (thumbnail_id_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_773DE69D3C026CAE ON car (created_user_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_773DE69DBED34FF2 ON car (thumbnail_id_id)');
        $this->addSql('ALTER TABLE rent ADD car_id_id INT NOT NULL, ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE rent ADD CONSTRAINT FK_2784DCCA0EF1B80 FOREIGN KEY (car_id_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE rent ADD CONSTRAINT FK_2784DCC9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2784DCCA0EF1B80 ON rent (car_id_id)');
        $this->addSql('CREATE INDEX IDX_2784DCC9D86650F ON rent (user_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE vehicle');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D3C026CAE');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DBED34FF2');
        $this->addSql('DROP INDEX IDX_773DE69D3C026CAE ON car');
        $this->addSql('DROP INDEX UNIQ_773DE69DBED34FF2 ON car');
        $this->addSql('ALTER TABLE car DROP created_user_id_id, DROP thumbnail_id_id');
        $this->addSql('ALTER TABLE rent DROP FOREIGN KEY FK_2784DCCA0EF1B80');
        $this->addSql('ALTER TABLE rent DROP FOREIGN KEY FK_2784DCC9D86650F');
        $this->addSql('DROP INDEX IDX_2784DCCA0EF1B80 ON rent');
        $this->addSql('DROP INDEX IDX_2784DCC9D86650F ON rent');
        $this->addSql('ALTER TABLE rent DROP car_id_id, DROP user_id_id');
    }
}
