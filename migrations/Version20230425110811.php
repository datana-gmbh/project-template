<?php

declare(strict_types=1);

namespace LamaMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230425110811 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        return;
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException();
    }
}
