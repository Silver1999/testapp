<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manageUser = new Permission();
        $manageUser->name = 'Admin';
        $manageUser->slug = 'config-section';
        $manageUser->save();
        $createTasks = new Permission();
        $createTasks->name = 'Employer';
        $createTasks->slug = 'report-section';
        $createTasks->save();
    }
}
