<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateRoleHelper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:role-helper';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a RoleHelper class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = app_path('Helpers/RoleHelper.php');

        // Check if the file already exists
        if (File::exists($path)) {
            $this->warn('RoleHelper already exists!');
            return;
        }

        // Create Helpers directory if it doesn't exist
        if (!File::isDirectory(app_path('Helpers'))) {
            File::makeDirectory(app_path('Helpers'), 0755, true);
        }

        // Define the RoleHelper class content
        $content = <<<PHP
        <?php

        namespace App\Helpers;

        class RoleHelper
        {
            const ROLES = [
                'admin' => 'Admin',
                'sub_admin' => 'Sub-Admin',
                'user' => 'User',
            ];

            public static function getRoles(): array
            {
                return self::ROLES;
            }

            public static function getRoleLabel(string \$key): ?string
            {
                return self::ROLES[\$key] ?? null;
            }
        }
        PHP;

        // Write the content to RoleHelper.php
        File::put($path, $content);

        $this->info('RoleHelper generated successfully!');
    }
}
