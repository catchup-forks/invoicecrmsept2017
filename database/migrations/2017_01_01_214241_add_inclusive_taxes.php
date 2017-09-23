<?php
use Illuminate\Database\Migrations\Migration;

class AddInclusiveTaxes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lookup__taxrates', function ($table) {
            $table->boolean('is_inclusive')->default(false);
        });
/*        Schema::table('companies__settings', function ($table) {
            $table->enum('bluevine_status', ['ignored', 'signed_up'])->nullable();
        });*/
        /*DB::statement('UPDATE companies
            LEFT JOIN accounts ON accounts.company_id = companies.id AND accounts.bluevine_status IS NOT NULL
            SET companies.bluevine_status = accounts.bluevine_status');*/





        Schema::table('companies__settings', function ($table) {
            //$table->dropColumn('bluevine_status');
            $table->text('bcc_email')->nullable();
            $table->text('client_number_prefix')->nullable();
            $table->integer('client_number_counter')->default(0)->nullable();
            $table->text('client_number_pattern')->nullable();
            $table->tinyInteger('domain_id')->default(1)->nullable()->unsigned();
            $table->tinyInteger('payment_terms_id')->nullable();
        });
        Schema::table('activities', function ($table) {
            $table->text('notes')->nullable();
        });
        Schema::table('lookup__dateformats', function ($table) {
            $table->string('format_moment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lookup__taxrates', function ($table) {
            $table->dropColumn('is_inclusive');
        });
/*        Schema::table('companies__settings', function ($table) {
            $table->dropColumn('bluevine_status');
        });*/
        Schema::table('companies', function ($table) {
            $table->enum('bluevine_status', ['ignored', 'signed_up'])->nullable();
            if (Schema::hasColumn('companies', 'bcc_email')) {
                $table->dropColumn('bcc_email');
            }
            $table->dropColumn('client_number_prefix');
            $table->dropColumn('client_number_counter');
            $table->dropColumn('client_number_pattern');
            $table->dropColumn('domain_id');
            $table->dropColumn('lookup__payment_terms');
        });
        Schema::table('activities', function ($table) {
            $table->dropColumn('notes');
        });
        Schema::table('lookup__dateformats', function ($table) {
            $table->dropColumn('format_moment');
        });
    }
}
