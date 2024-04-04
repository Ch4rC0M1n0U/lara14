<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class () extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Pegasus5330');
        $this->migrator->add('general.site_active', true);
    }
};
