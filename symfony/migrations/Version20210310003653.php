<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210310003653 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE budget DROP FOREIGN KEY FK_73F2F77BA76ED395');
        $this->addSql('DROP INDEX IDX_73F2F77BA76ED395 ON budget');
        $this->addSql('ALTER TABLE budget CHANGE user_id users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE budget ADD CONSTRAINT FK_73F2F77B67B3B43D FOREIGN KEY (users_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_73F2F77B67B3B43D ON budget (users_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE budget DROP FOREIGN KEY FK_73F2F77B67B3B43D');
        $this->addSql('DROP INDEX IDX_73F2F77B67B3B43D ON budget');
        $this->addSql('ALTER TABLE budget CHANGE users_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE budget ADD CONSTRAINT FK_73F2F77BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_73F2F77BA76ED395 ON budget (user_id)');
    }
}
