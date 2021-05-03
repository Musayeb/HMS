   <?php
   
  	use App\Http\helpers as Helpers;
    use App\Models\PurchaselabMaterial;
    use App\Models\PurchaseMidicines;
    use App\Models\patientOperation;
    use Composer\DependencyResolver\Request;

class Helper{
    
    // medicine
    public static function getmedicinequantity($id){
      $total=PurchaseMidicines::where('midi_id',$id)->sum('quantity');
      return $total;
    }
    public static function getmedicinesaleprice($id){
      $sale=PurchaseMidicines::select('sale_price')->where('midi_id',$id)->orderBy('created_at','DESC')->limit(1)->get();
    
      foreach ($sale as $key => $item) {
      return $item;
    }
      
    }
    public static function getmedicinepurchaseprice($id){
      $purchase=PurchaseMidicines::select('purchase_price')->where('midi_id',$id)->orderBy('created_at','DESC')->limit(1)->get();
    
      foreach ($purchase as $key => $item) {
      return $item;
    }
      
    }
    public static function getmedicineexpirydate($id){
      $expire=PurchaseMidicines::select('expiry_date')->where('midi_id',$id)->orderBy('created_at','DESC')->limit(1)->get();
    
      foreach ($expire as $key => $item) {
      return $item;
    }
      
    }
   
  //lab 
    public static function getquantity($id){
      $total=PurchaselabMaterial::where('lab_m_id',$id)->sum('quantity');
      return $total;
    }
        public static function getlabsaleprice($id){
      $sale=PurchaselabMaterial::select('sale_price')->where('lab_m_id',$id)->orderBy('created_at','DESC')->limit(1)->get();
    
      foreach ($sale as $key => $item) {
      return $item;
    }
      
    }
    public static function getlabpurchaseprice($id){
      $purchase=PurchaselabMaterial::select('purchase_price')->where('lab_m_id',$id)->orderBy('created_at','DESC')->limit(1)->get();
    
      foreach ($purchase as $key => $item) {
      return $item;
    }
      
    }
    public static function getlabexpirydate($id){
      $expire=PurchaselabMaterial::select('expiry_date')->where('lab_m_id',$id)->orderBy('created_at','DESC')->limit(1)->get();
    
      foreach ($expire as $key => $item) {
      return $item;
    }
      
    }

    public static function getsurgery($id)
    {
      $patient=patientOperation::select('surgery_name')
      ->join('surgeries','patient_operations.surgery_id','surgeries.surgery_id')
      ->where('patient_s_del_pro_id',$id)->get();
      return $patient;
    }
    public static function getprocedure($id)
    {
      $patient=patientOperation::select('procedure_name')
      ->join('procedures','patient_operations.procedure_id','procedures.procedure_id')
      ->where('patient_s_del_pro_id',$id)->get();
      return $patient;
    }
    
    
    
  }