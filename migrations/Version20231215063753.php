<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215063753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add test data in product table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        for ($i = 1; $i < 51; $i++) {
            $storageId = rand(1, 10);
            $size = rand(10,100);
            $code = bin2hex(random_bytes(5));
            $count = rand(10,100);
            $this->addSql(
                "INSERT INTO product(id, storage_id, name, size, code, count, reserved) VALUES ({$i}, {$storageId}, 'name {$i}', {$size}, 'name{$i}', {$count}, 0)"
            );
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE FROM product');
    }
}
