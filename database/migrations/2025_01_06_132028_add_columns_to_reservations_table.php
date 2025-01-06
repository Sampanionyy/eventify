<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToReservationsTable extends Migration
{
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('event_id')->constrained('events');
            $table->string('status')->default('En attente');
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['user_id', 'event_id', 'status']);
        });
    }
}
