<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('photos', function (Blueprint $table) {
            // Identity Fields
            $table->string('participant_name')->nullable()->after('sync_id');
            $table->string('birth_place')->nullable()->after('participant_name');
            $table->date('birth_date')->nullable()->after('birth_place');
            $table->string('gender')->nullable()->after('birth_date');
            $table->text('address')->nullable()->after('gender');
            $table->string('district')->nullable()->after('address');
            $table->string('village')->nullable()->after('district');
            $table->string('whatsapp')->nullable()->after('village');
            $table->string('email')->nullable()->after('whatsapp');
            $table->string('instagram')->nullable()->after('email');
            $table->text('id_card_link')->nullable()->after('instagram');

            // Metadata & Verification
            $table->json('exif_data')->nullable()->after('id_card_link');
            $table->integer('health_score')->default(0)->after('exif_data');
            
            // Note: `status` already exists as an enum('pending', 'approved', 'disqualified')
            // To fulfill the requirement without breaking existing logic, we add a specific
            // verification workflow status and keep `status` as the macro status.
            $table->string('verification_status')->default('Waiting Verification')->after('status');
            $table->text('verification_notes')->nullable()->after('verification_status');
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete()->after('verification_notes');
            $table->timestamp('verified_at')->nullable()->after('verified_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->dropColumn([
                'participant_name',
                'birth_place',
                'birth_date',
                'gender',
                'address',
                'district',
                'village',
                'whatsapp',
                'email',
                'instagram',
                'id_card_link',
                'exif_data',
                'health_score',
                'verification_status',
                'verification_notes',
                'verified_by',
                'verified_at'
            ]);
        });
    }
};
