<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ModelBase extends Model{

public static function getAllAttributes()
{
   $columns = Model::getFillable();
   // Another option is to get all columns for the table like so:
   // $columns = \Schema::getColumnListing($this->table);
   // but it's safer to just get the fillable fields

   $attributes = $this->getAttributes();

   foreach ($columns as $column)
   {
       if (!array_key_exists($column, $attributes))
       {
           $attributes[$column] = null;
       }
   }
   return $attributes;
}

public static function getPossibleEnumValues($column) {
   // Create an instance of the model to be able to get the table name
   $instance = new static;

   // Pulls column string from DB
   $enumStr = \DB::select(\DB::raw('SHOW COLUMNS FROM '.$instance->getTable().' WHERE Field = "'.$column.'"'))[0]->Type;

   // Parse string
   preg_match_all("/'([^']+)'/", $enumStr, $matches);

   // Return matches
   return isset($matches[1]) ? array_combine($matches[1], $matches[1])  : [];
}

}
