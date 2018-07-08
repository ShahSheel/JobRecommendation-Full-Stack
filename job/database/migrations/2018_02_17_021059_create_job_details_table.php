
<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('job_search_id')->nullable(); // Sets unsigned to true 
            $table->json('api')->nullable(); //For Laravel 
            $table->text('redirect')->nullable(); // For python entry
            $table->string('company')->nullable();
            $table->string('title')->nullable();
            $table->string('location_of_job')->nullable();
            $table->string('date')->nullable();
            $table->text('description')->nullable(); // For python entry
            $table->string('salary')->nullable(); // For pythone entry
            $table->timestamps();

        });

        schema::table('job_details',function(Blueprint $table){
            $table->foreign('job_search_id')->references('id')->on('job_searches');
        });

    }

    /**
     * Reverse the migrations.
     *
    }
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_details');
    }

}

//Create DB Tables
//Get Each URL and get Redirected URL
//JobScrape on each URL that has a specific domain
//NLE algorithms
//Pass URL that is recommended (Array number) to laravel, laravel reads in API_URL and displays on webpage
