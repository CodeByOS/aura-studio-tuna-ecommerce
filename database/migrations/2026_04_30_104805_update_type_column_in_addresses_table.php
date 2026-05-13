<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement(
            "alter table \"addresses\" alter column \"type\" type varchar(255) using \"type\"::text"
        );

        DB::statement(
            "alter table \"addresses\" alter column \"type\" set default 'both'"
        );

        DB::statement(
            "alter table \"addresses\" drop constraint if exists \"addresses_type_check\""
        );

        DB::statement(
            "alter table \"addresses\" add constraint \"addresses_type_check\" check (\"type\" in ('billing', 'shipping', 'both'))"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverting this Postgres-specific migration is intentionally left as a no-op.
    }
};
