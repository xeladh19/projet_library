<?php
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('slug');
            $table->string('image');
            $table->timestamps();
            $table->integer('user_id');
            // $table->foreignIdFor(User::class); //Un post appartiendra à un utilisateur ||  A post will belong to a user
            // $table->foreignIdFor(Category::class); //Un post appartiendra à une categorie || A post will belong to a category
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
