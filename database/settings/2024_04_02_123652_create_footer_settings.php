<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class () extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('footer.copyright', 'Pegasus5330');
        $this->migrator->add('footer.label', 'Pegasus5330');
        $this->migrator->add('footer.url', 'Pegasus5330');
    }
};
