<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215054825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add test data in storage table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        for ($i = 1; $i < 11; $i++) {
            $this->addSql(
                "INSERT INTO storage(id, name, accessibility) VALUES ({$i}, 'name {$i}', 1)"
            );
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE FROM storage');
    }
}
