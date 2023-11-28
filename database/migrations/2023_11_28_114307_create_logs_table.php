<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Post;


return new class extends Migration
{
    
    public function up(): void
    {
        $log_absensi_ekskul = DB::select('SELECT * FROM log_absensi_ekskul');
        $log_absensi_ekskul = Post::all();
        /*
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        */
    }
};