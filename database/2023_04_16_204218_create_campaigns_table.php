<?php

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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->bigInteger('fundraising_source_id')->unsigned()->nullable();
            $table->foreign('fundraising_source_id')->references('id')->on('fundraising_sources');
            $table->string('fundraising_for',191)->nullable();
            $table->double('raising_goal',10,2)->nullable();
            $table->double('total_collection',10,2)->nullable();
            $table->string('image',191)->nullable();
            $table->string('video_link',191)->nullable();
            $table->longText('title')->nullable();
            $table->longText('story')->nullable();
            $table->string('fund_raising_type',191)->nullable();
            $table->longText('tagline')->nullable();
            $table->longText('category')->nullable();
            $table->longText('location')->nullable();
            $table->longText('funding_type')->nullable();
            $table->longText('end_date')->nullable();
            $table->longText('email')->nullable();
            $table->longText('name')->nullable();
            $table->longText('family_name')->nullable();
            $table->longText('dob')->nullable();
            $table->longText('phone')->nullable();
            $table->longText('country_address')->nullable();
            $table->longText('address')->nullable();
            $table->longText('city')->nullable();
            $table->longText('street_name')->nullable();
            $table->longText('town')->nullable();
            $table->longText('postcode')->nullable();
            $table->longText('gov_issue_id')->nullable();
            $table->longText('currency')->nullable();
            $table->longText('name_of_account')->nullable();
            $table->longText('bank_account_country')->nullable();
            $table->longText('bank_name')->nullable();
            $table->longText('bank_account_number')->nullable();
            $table->longText('bank_sort_code')->nullable();
            $table->longText('bank_account_class')->nullable();
            $table->longText('bank_account_type')->nullable();
            $table->longText('bank_routing')->nullable();
            $table->longText('iban')->nullable();
            $table->longText('bank_verification_doc')->nullable();
            $table->longText('ref_ids')->nullable();
            $table->tinyInteger('approved')->default(0);
            $table->tinyInteger('terminate')->default(0);
            $table->tinyInteger('disable')->default(0);
            $table->tinyInteger('admin_notification')->default(0);
            $table->tinyInteger('user_notification')->default(0);
            $table->tinyInteger('user_status')->default(0);
            $table->boolean('homepage')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('updated_by')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
};
