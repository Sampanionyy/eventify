<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToEventsTable extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('date');
            $table->string('location');
            $table->foreignId('category_id')->constrained('categories');
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['title', 'description', 'date', 'location', 'category_id']);
        });
    }
}
