<?php

namespace Database\Seeders;

use App\Models\Pharmacy\Auth\Pharmacy;
use Illuminate\Database\Seeder;

class Pharmacyproductseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Pharmacy::find(1);

        $user->pharmacyproductcreatable()->create([
            'pharmacycategory_id' => 1,
            'pharmacysubcategory_id' => 1,
            'name' => 'Synthroid (levothyroxine)',
            'product_code' => 'levothyroxine',
            'product_sku' => 'SKU-124142',
            'hsn' => 'HSN-124142',
            'mrp' => "50",
            'min_stock' => "20",
            'stock_required' => true,
            'purchase_rate' => "42",
            'sgst' => "2.5",
            'cgst' => "2.5",
            'igst' => "0.69",
            'cess' => "0.55",
            'is_schedule' => true,
        ]);

        $user->pharmacyproductcreatable()->create([
            'pharmacycategory_id' => 1,
            'pharmacysubcategory_id' => 1,
            'name' => 'Crestor (rosuvastatin)',
            'product_code' => 'rosuvastatin',
            'product_sku' => 'SKU-124142',
            'hsn' => 'HSN-124142',
            'mrp' => "50",
            'purchase_rate' => "42",
            'sgst' => "2.5",
            'cgst' => "2.5",
            'igst' => "0.69",
            'cess' => "0.55",
            'is_schedule' => false,
        ]);

        $user->pharmacyproductcreatable()->create([
            'pharmacycategory_id' => 1,
            'pharmacysubcategory_id' => 1,
            'name' => 'Ventolin HFA (albuterol)',
            'product_code' => 'albuterol',
            'product_sku' => 'SKU-124142',
            'hsn' => 'HSN-124142',
            'mrp' => "50",
            'purchase_rate' => "42",
            'sgst' => "2.5",
            'cgst' => "2.5",
            'igst' => "0.69",
            'cess' => "0.55",
            'is_schedule' => false,
        ]);

        $user->pharmacyproductcreatable()->create([
            'pharmacycategory_id' => 1,
            'pharmacysubcategory_id' => 1,
            'name' => 'Nexium (esomeprazole)',
            'product_code' => 'esomeprazole',
            'product_sku' => 'SKU-124142',
            'hsn' => 'HSN-124142',
            'mrp' => "50",
            'purchase_rate' => "42",
            'sgst' => "2.5",
            'cgst' => "2.5",
            'igst' => "0.69",
            'cess' => "0.55",
            'is_schedule' => true,
        ]);

        $user->pharmacyproductcreatable()->create([
            'pharmacycategory_id' => 1,
            'pharmacysubcategory_id' => 1,
            'name' => 'Advair Diskus (fluticasone)',
            'product_code' => 'fluticasone',
            'product_sku' => 'SKU-124142',
            'hsn' => 'HSN-124142',
            'mrp' => "50",
            'purchase_rate' => "42",
            'sgst' => "2.5",
            'cgst' => "2.5",
            'igst' => "0.69",
            'cess' => "0.55",
            'is_schedule' => true,
        ]);

        $user->pharmacyproductcreatable()->create([
            'pharmacycategory_id' => 1,
            'pharmacysubcategory_id' => 1,
            'name' => 'Lyrica (Pfizer)',
            'product_code' => 'fluticasone',
            'product_sku' => 'SKU-124142',
            'hsn' => 'HSN-124142',
            'mrp' => "50",
            'purchase_rate' => "42",
            'sgst' => "2.5",
            'cgst' => "2.5",
            'igst' => "0.69",
            'cess' => "0.55",
            'is_schedule' => true,
        ]);

        $user->pharmacyproductcreatable()->create([
            'pharmacycategory_id' => 1,
            'pharmacysubcategory_id' => 1,
            'name' => 'Januvia (Merck)',
            'product_code' => 'fluticasone',
            'product_sku' => 'SKU-124142',
            'hsn' => 'HSN-124142',
            'mrp' => "50",
            'purchase_rate' => "42",
            'sgst' => "2.5",
            'cgst' => "2.5",
            'igst' => "0.69",
            'cess' => "0.55",
            'is_schedule' => true,
        ]);

        $user->pharmacyproductcreatable()->create([
            'pharmacycategory_id' => 1,
            'pharmacysubcategory_id' => 1,
            'name' => 'Nexium (AstraZeneca)',
            'product_code' => 'fluticasone',
            'product_sku' => 'SKU-124142',
            'hsn' => 'HSN-124142',
            'mrp' => "50",
            'purchase_rate' => "42",
            'sgst' => "2.5",
            'cgst' => "2.5",
            'igst' => "0.69",
            'cess' => "0.55",
            'is_schedule' => true,
        ]);

        $user->pharmacyproductcreatable()->create([
            'pharmacycategory_id' => 1,
            'pharmacysubcategory_id' => 1,
            'name' => 'Humira (Abbott)',
            'product_code' => 'fluticasone',
            'product_sku' => 'SKU-124142',
            'hsn' => 'HSN-124142',
            'mrp' => "50",
            'purchase_rate' => "42",
            'sgst' => "2.5",
            'cgst' => "2.5",
            'igst' => "0.69",
            'cess' => "0.55",
            'is_schedule' => true,
        ]);

        $user->pharmacyproductcreatable()->create([
            'pharmacycategory_id' => 1,
            'pharmacysubcategory_id' => 1,
            'name' => 'Sovaldi (Gilead Sciences)',
            'product_code' => 'fluticasone',
            'product_sku' => 'SKU-124142',
            'hsn' => 'HSN-124142',
            'mrp' => "50",
            'purchase_rate' => "42",
            'sgst' => "2.5",
            'cgst' => "2.5",
            'igst' => "0.69",
            'cess' => "0.55",
            'is_schedule' => true,
        ]);

        $user->pharmacyproductcreatable()->create([
            'pharmacycategory_id' => 1,
            'pharmacysubcategory_id' => 1,
            'name' => 'Lantus Solostar (Sanofi-Aventis)',
            'product_code' => 'fluticasone',
            'product_sku' => 'SKU-124142',
            'hsn' => 'HSN-124142',
            'mrp' => "50",
            'purchase_rate' => "42",
            'sgst' => "2.5",
            'cgst' => "2.5",
            'igst' => "0.69",
            'cess' => "0.55",
            'is_schedule' => true,
        ]);

        $user->pharmacyproductcreatable()->create([
            'pharmacycategory_id' => 1,
            'pharmacysubcategory_id' => 1,
            'name' => 'Enbrel (Amgen)',
            'product_code' => 'fluticasone',
            'product_sku' => 'SKU-124142',
            'hsn' => 'HSN-124142',
            'mrp' => "50",
            'purchase_rate' => "42",
            'sgst' => "2.5",
            'cgst' => "2.5",
            'igst' => "0.69",
            'cess' => "0.55",
            'is_schedule' => true,
        ]);

        $user->pharmacyproductcreatable()->create([
            'pharmacycategory_id' => 1,
            'pharmacysubcategory_id' => 1,
            'name' => 'Abilify (Otsuka)',
            'product_code' => 'fluticasone',
            'product_sku' => 'SKU-124142',
            'hsn' => 'HSN-124142',
            'mrp' => "50",
            'purchase_rate' => "42",
            'sgst' => "2.5",
            'cgst' => "2.5",
            'igst' => "0.69",
            'cess' => "0.55",
            'is_schedule' => true,
        ]);
    }
}
