<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Post;


return new class extends Migration
{
    
    public function up(): void
    {
        $guru = DB::select('SELECT * FROM guru');
        $guru = Post::all();
        /*
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        */
    }

    

    /*
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
    */

};