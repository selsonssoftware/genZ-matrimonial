<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (
            DB::getDriverName() === 'mysql'
            && Schema::hasTable('vendor')
            && Schema::hasColumn('vendor', 'vendor_mobile')
        ) {
            DB::statement('ALTER TABLE `vendor` MODIFY `vendor_mobile` VARCHAR(20) NULL');
        }
    }

    public function down(): void
    {
        // Phone numbers must remain strings to preserve leading zeros and long numbers.
    }
};
