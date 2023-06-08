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
        Schema::create('dentals', function (Blueprint $table) {
            $table->id();
            $table->date('examination_date')->nullable();
            $table->integer('age_last_birthday')->nullable();
            //labio-buccal upper
            $table->boolean('lb_up_55')->default(false);
            $table->boolean('lb_up_54')->default(false);
            $table->boolean('lb_up_53')->default(false);
            $table->boolean('lb_up_52')->default(false);
            $table->boolean('lb_up_51')->default(false);
            $table->boolean('lb_up_61')->default(false);
            $table->boolean('lb_up_62')->default(false);
            $table->boolean('lb_up_63')->default(false);
            $table->boolean('lb_up_64')->default(false);
            $table->boolean('lb_up_65')->default(false);
            //labio-buccal upper operation
            $table->boolean('lb_op_up_55')->default(false);
            $table->boolean('lb_op_up_54')->default(false);
            $table->boolean('lb_op_up_53')->default(false);
            $table->boolean('lb_op_up_52')->default(false);
            $table->boolean('lb_op_up_51')->default(false);
            $table->boolean('lb_op_up_61')->default(false);
            $table->boolean('lb_op_up_62')->default(false);
            $table->boolean('lb_op_up_63')->default(false);
            $table->boolean('lb_op_up_64')->default(false);
            $table->boolean('lb_op_up_65')->default(false);
            //labio-buccal upper condition
            $table->boolean('lb_cond_up_55')->default(false);
            $table->boolean('lb_cond_up_54')->default(false);
            $table->boolean('lb_cond_up_53')->default(false);
            $table->boolean('lb_cond_up_52')->default(false);
            $table->boolean('lb_cond_up_51')->default(false);
            $table->boolean('lb_cond_up_61')->default(false);
            $table->boolean('lb_cond_up_62')->default(false);
            $table->boolean('lb_cond_up_63')->default(false);
            $table->boolean('lb_cond_up_64')->default(false);
            $table->boolean('lb_cond_up_65')->default(false);
            // labio-buccal upper
            $table->boolean('lb_up_18')->default(false);
            $table->boolean('lb_up_17')->default(false);
            $table->boolean('lb_up_16')->default(false);
            $table->boolean('lb_up_15')->default(false);
            $table->boolean('lb_up_14')->default(false);
            $table->boolean('lb_up_13')->default(false);
            $table->boolean('lb_up_12')->default(false);
            $table->boolean('lb_up_11')->default(false);
            $table->boolean('lb_up_21')->default(false);
            $table->boolean('lb_up_22')->default(false);
            $table->boolean('lb_up_23')->default(false);
            $table->boolean('lb_up_24')->default(false);
            $table->boolean('lb_up_25')->default(false);
            $table->boolean('lb_up_26')->default(false);
            $table->boolean('lb_up_27')->default(false);
            $table->boolean('lb_up_28')->default(false);

            //labio-buccal upper operation
            $table->boolean('lb_op_up_18')->default(false);
            $table->boolean('lb_op_up_17')->default(false);
            $table->boolean('lb_op_up_16')->default(false);
            $table->boolean('lb_op_up_15')->default(false);
            $table->boolean('lb_op_up_14')->default(false);
            $table->boolean('lb_op_up_13')->default(false);
            $table->boolean('lb_op_up_12')->default(false);
            $table->boolean('lb_op_up_11')->default(false);
            $table->boolean('lb_op_up_21')->default(false);
            $table->boolean('lb_op_up_22')->default(false);
            $table->boolean('lb_op_up_23')->default(false);
            $table->boolean('lb_op_up_24')->default(false);
            $table->boolean('lb_op_up_25')->default(false);
            $table->boolean('lb_op_up_26')->default(false);
            $table->boolean('lb_op_up_27')->default(false);
            $table->boolean('lb_op_up_28')->default(false);
            //labio-buccal upper condition
            $table->boolean('lb_cond_up_18')->default(false);
            $table->boolean('lb_cond_up_17')->default(false);
            $table->boolean('lb_cond_up_16')->default(false);
            $table->boolean('lb_cond_up_15')->default(false);
            $table->boolean('lb_cond_up_14')->default(false);
            $table->boolean('lb_cond_up_13')->default(false);
            $table->boolean('lb_cond_up_12')->default(false);
            $table->boolean('lb_cond_up_11')->default(false);
            $table->boolean('lb_cond_up_21')->default(false);
            $table->boolean('lb_cond_up_22')->default(false);
            $table->boolean('lb_cond_up_23')->default(false);
            $table->boolean('lb_cond_up_24')->default(false);
            $table->boolean('lb_cond_up_25')->default(false);
            $table->boolean('lb_cond_up_26')->default(false);
            $table->boolean('lb_cond_up_27')->default(false);
            $table->boolean('lb_cond_up_28')->default(false);

            //labio-buccal lower
            $table->boolean('lb_low_48')->default(false);
            $table->boolean('lb_low_47')->default(false);
            $table->boolean('lb_low_46')->default(false);
            $table->boolean('lb_low_45')->default(false);
            $table->boolean('lb_low_44')->default(false);
            $table->boolean('lb_low_43')->default(false);
            $table->boolean('lb_low_42')->default(false);
            $table->boolean('lb_low_41')->default(false);
            $table->boolean('lb_low_31')->default(false);
            $table->boolean('lb_low_32')->default(false);
            $table->boolean('lb_low_33')->default(false);
            $table->boolean('lb_low_34')->default(false);
            $table->boolean('lb_low_35')->default(false);
            $table->boolean('lb_low_36')->default(false);
            $table->boolean('lb_low_37')->default(false);
            $table->boolean('lb_low_38')->default(false);
            //labio-buccal lower operation
            $table->boolean('lb_op_low_48')->default(false);
            $table->boolean('lb_op_low_47')->default(false);
            $table->boolean('lb_op_low_46')->default(false);
            $table->boolean('lb_op_low_45')->default(false);
            $table->boolean('lb_op_low_44')->default(false);
            $table->boolean('lb_op_low_43')->default(false);
            $table->boolean('lb_op_low_42')->default(false);
            $table->boolean('lb_op_low_41')->default(false);
            $table->boolean('lb_op_low_31')->default(false);
            $table->boolean('lb_op_low_32')->default(false);
            $table->boolean('lb_op_low_33')->default(false);
            $table->boolean('lb_op_low_34')->default(false);
            $table->boolean('lb_op_low_35')->default(false);
            $table->boolean('lb_op_low_36')->default(false);
            $table->boolean('lb_op_low_37')->default(false);
            $table->boolean('lb_op_low_38')->default(false);
            //labio-buccal lower condition
            $table->boolean('lb_cond_low_48')->default(false);
            $table->boolean('lb_cond_low_47')->default(false);
            $table->boolean('lb_cond_low_46')->default(false);
            $table->boolean('lb_cond_low_45')->default(false);
            $table->boolean('lb_cond_low_44')->default(false);
            $table->boolean('lb_cond_low_43')->default(false);
            $table->boolean('lb_cond_low_42')->default(false);
            $table->boolean('lb_cond_low_41')->default(false);
            $table->boolean('lb_cond_low_31')->default(false);
            $table->boolean('lb_cond_low_32')->default(false);
            $table->boolean('lb_cond_low_33')->default(false);
            $table->boolean('lb_cond_low_34')->default(false);
            $table->boolean('lb_cond_low_35')->default(false);
            $table->boolean('lb_cond_low_36')->default(false);
            $table->boolean('lb_cond_low_37')->default(false);
            $table->boolean('lb_cond_low_38')->default(false);
            //labio-buccal lower
            $table->boolean('lb_low_85')->default(false);
            $table->boolean('lb_low_84')->default(false);
            $table->boolean('lb_low_83')->default(false);
            $table->boolean('lb_low_82')->default(false);
            $table->boolean('lb_low_81')->default(false);
            $table->boolean('lb_low_71')->default(false);
            $table->boolean('lb_low_72')->default(false);
            $table->boolean('lb_low_73')->default(false);
            $table->boolean('lb_low_74')->default(false);
            $table->boolean('lb_low_75')->default(false);

            //labio-buccal lower operation
            $table->boolean('lb_op_low_85')->default(false);
            $table->boolean('lb_op_low_84')->default(false);
            $table->boolean('lb_op_low_83')->default(false);
            $table->boolean('lb_op_low_82')->default(false);
            $table->boolean('lb_op_low_81')->default(false);
            $table->boolean('lb_op_low_71')->default(false);
            $table->boolean('lb_op_low_72')->default(false);
            $table->boolean('lb_op_low_73')->default(false);
            $table->boolean('lb_op_low_74')->default(false);
            $table->boolean('lb_op_low_75')->default(false);

            //labio-buccal lower condition
            $table->boolean('lb_cond_low_85')->default(false);
            $table->boolean('lb_cond_low_84')->default(false);
            $table->boolean('lb_cond_low_83')->default(false);
            $table->boolean('lb_cond_low_82')->default(false);
            $table->boolean('lb_cond_low_81')->default(false);
            $table->boolean('lb_cond_low_71')->default(false);
            $table->boolean('lb_cond_low_72')->default(false);
            $table->boolean('lb_cond_low_73')->default(false);
            $table->boolean('lb_cond_low_74')->default(false);
            $table->boolean('lb_cond_low_75')->default(false);

            $table->boolean('dental_caries')->default(false);
            $table->boolean('gingivitis')->default(false);
            $table->boolean('periodontal_pocket')->default(false);
            $table->boolean('debris')->default(false);
            $table->boolean('calculus')->default(false);
            $table->boolean('neoplasm')->default(false);
            $table->boolean('dento_facial')->default(false);

            $table->integer('cnt_prst_teeth')->default(0); // number of present teeth
            $table->integer('cnt_indct_filing')->default(0); // number of caries indicated for filling
            $table->integer('cnt_indct_extraction')->default(0); // number of caries indicated for extraction
            $table->integer('root_frgmt')->default(0); // number of root
            $table->integer('cnt_mssng_due_caries')->default(0); // number of missing teeth due to caries
            $table->integer('filled_restored')->default(0); // number of filled restored
            $table->integer('cnt_df_dmf')->default(0); // number of decayed, filled, missing teeth
            $table->integer('flouride_app')->default(0); // number of flouride application
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dentals');
    }
};
