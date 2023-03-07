<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use App\Field;
use App\Table;


class tablefilesController extends Controller{
    

    public function generateFiles(Request $request)
    {
        $validatedData = $request->validate([
            'table-name' => 'required|string|max:255',
            'field-list' => 'required|string', 
            'model-name' => 'nullable|string|max:255',
            'controller-name' => 'nullable|string|max:255'
        ]);

        //Save table name in tables_list table
       
        // Save table name in tables_list table
        $table = new Table();
        $table->name = $validatedData['table-name'];
        $table->save();
       
        
        //Save fields in fieldslist table
        $fields = explode("\n", $validatedData['field-list']);

        foreach ($fields as $field) {
            // Parse the field data into an array
            $fieldArray = [];
            $fieldData = explode(',', $field);

            foreach ($fieldData as $data) {
                $data = trim($data);
                $keyValue = explode(':', $data);
                $key = trim($keyValue[0]);
                $value = trim($keyValue[1], ' "');

                // If the value is "true" or "false", convert it to a boolean
                if ($value === "true" || $value === "false") {
                    $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                }
if($key == "Name" || $key=="Type"){
                $fieldArray[$key] = $value;
            }
            $fieldArray2[$key] = $value;
            }
           
            $newField = new Field();
            $newField->table_id = $table->id;
            $newField->field_type = $fieldArray['Type'];
            $newField->database_column_name = $fieldArray['Name'];
            $newField->visual_title = $fieldArray2['Title'];
            $newField->in_list = $fieldArray2['In List'];
            $newField->in_create = $fieldArray2['In Create'];
            $newField->in_show = $fieldArray2['In Show'];
            $newField->in_edit = $fieldArray2['In Edit'];
            $newField->required = $fieldArray2['Required'];
            $newField->max = isset($fieldArray2['Max']) ? $fieldArray2['Max'] : null;
            $newField->min = isset($fieldArray2['Min']) ? $fieldArray2['Min'] : null;
            $newField->default_value = isset($fieldArray2['Default']) ? $fieldArray2['Default'] : null;
            $newField->edit = isset($fieldArray2['Edit']) ? $fieldArray2['Edit'] : true;
            $newField->delete = isset($fieldArray2['Delete']) ? $fieldArray2['Delete']:true;

            $newField->save();
        }


        // Call artisan command to generate files
        $modelName = $validatedData['model-name'] ?? Str::studly($table->name);
        $controllerName = $validatedData['controller-name'] ?? "{$modelName}Controller";
        $options = [
            'table' => $table->name,
            'fields' => $validatedData['field-list'], 
            '--model' => $modelName,
            '--controller' => $controllerName,
        ];
        Artisan::call('create:table', $options);

        
    }
    
    
}
//line to try 
//Type: "text", Name: "name", Title: "Name", In List: true, In Create: true, In Show: true, In Edit: true, Required: true
//Type: "email", Name: "email", Title: "Email", In List: true, In Create: true, In Show: true, In Edit: true, Required: true
//Type: "password", Name: "password", Title: "Password", In List: false, In Create: true, In Show: false, In Edit: true, Required: true, Min: 6