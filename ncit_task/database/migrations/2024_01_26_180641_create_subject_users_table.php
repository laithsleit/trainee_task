<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectUsersTable  extends Migration
{
    public function up()
    {
        Schema::create('subject_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('obtained_mark');
            $table->primary(['user_id', 'subject_id']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subject_user');
    }
}
