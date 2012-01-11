<?php     
class Quick_CSV_import
{
	var $table_name = 'leads'; //where to import to
  var $file_name;  //where to import from
  var $use_csv_header; //use first line of file OR generated columns names
  var $field_separate_char; //character to separate fields
  var $field_enclose_char; //character to enclose fields, which contain separator char into content
  var $field_escape_char;  //char to escape special symbols
  var $error; //error message
  var $arr_csv_columns; //array of columns
  var $table_exists; //flag: does table for import exist
  var $encoding; //encoding table, used to parse the incoming file. Added in 1.5 version
  
  function Quick_CSV_import($file_name="")
  {
    $this->file_name = $file_name;
    $this->arr_csv_columns = array();
    $this->use_csv_header = true;
    $this->field_separate_char = ",";
    $this->field_enclose_char  = "\"";
    $this->field_escape_char   = "\\";
    $this->table_exists = false;
  }
  
  function import()
  {
    if($this->table_name=="")
      $this->table_name = "temp_".date("d_m_Y_H_i_s");
    
    $this->table_exists = false;
    $this->create_import_table();
    
    if(empty($this->arr_csv_columns))
      $this->get_csv_header_fields();
    
    /* change start. Added in 1.5 version */
    if("" != $this->encoding && "default" != $this->encoding)
      $this->set_encoding();
    /* change end */
    
    if($this->table_exists)
    {
      $sql = "LOAD DATA INFILE '".@mysql_escape_string($this->file_name).
             "' INTO TABLE `".$this->table_name.
             "` FIELDS TERMINATED BY '".@mysql_escape_string($this->field_separate_char).
             "' OPTIONALLY ENCLOSED BY '".@mysql_escape_string($this->field_enclose_char).
             "' ESCAPED BY '".@mysql_escape_string($this->field_escape_char).
             "' ".
             ($this->use_csv_header ? " IGNORE 1 LINES " : "")
             ."(`".implode("`,`", $this->arr_csv_columns)."`)";
      $res = @mysql_query($sql);
      $this->error = mysql_error();
    }
  }
  
  //returns array of CSV file columns
  function get_csv_header_fields()
  {
    $this->arr_csv_columns = array();
    $fpointer = fopen($this->file_name, "r");
    if ($fpointer)
    {
      $arr = fgetcsv($fpointer, 10*1024, $this->field_separate_char);
      if(is_array($arr) && !empty($arr))
      {
        if($this->use_csv_header)
        {
          foreach($arr as $val)
            if(trim($val)!="")
              $this->arr_csv_columns[] = $val;
        }
        else
        {
          $i = 1;
          foreach($arr as $val)
            if(trim($val)!="")
              $this->arr_csv_columns[] = "column".$i++;
        }
      }
      unset($arr);
      fclose($fpointer);
    }
    else
      $this->error = "file cannot be opened: ".(""==$this->file_name ? "[empty]" : @mysql_escape_string($this->file_name));
    return $this->arr_csv_columns;
  }
  
  function create_import_table()
  {
    $sql = "CREATE TABLE IF NOT EXISTS ".$this->table_name." (";
    
    if(empty($this->arr_csv_columns))
      $this->get_csv_header_fields();
    
    if(!empty($this->arr_csv_columns))
    {
      $arr = array();
      for($i=0; $i<sizeof($this->arr_csv_columns); $i++)
          $arr[] = "`".$this->arr_csv_columns[$i]."` TEXT";
      $sql .= implode(",", $arr);
      $sql .= ")";
      $res = @mysql_query($sql);
      $this->error = mysql_error();
      $this->table_exists = ""==mysql_error();
    }
  }
  
  /* change start. Added in 1.5 version */
  //returns recordset with all encoding tables names, supported by your database
  function get_encodings()
  {
    $rez = array();
    $sql = "SHOW CHARACTER SET";
    $res = @mysql_query($sql);
    if(mysql_num_rows($res) > 0)
    {
      while ($row = mysql_fetch_assoc ($res))
      {
        $rez[$row["Charset"]] = ("" != $row["Description"] ? $row["Description"] : $row["Charset"]); //some MySQL databases return empty Description field
      }
    }
    return $rez;
  }
  
  //defines the encoding of the server to parse to file
  function set_encoding($encoding="")
  {
    if("" == $encoding)
      $encoding = $this->encoding;
    $sql = "SET SESSION character_set_database = " . $encoding; //'character_set_database' MySQL server variable is [also] to parse file with rigth encoding
    $res = @mysql_query($sql);
    return mysql_error();
  }
  /* change end */

}	

//connect to database
mysql_connect("localhost", "root", "ourlady");
mysql_select_db("zekeszoo_db"); //your database

$csv = new Quick_CSV_import();

$arr_encodings = $csv->get_encodings(); //take possible encodings list
$arr_encodings["default"] = "[default database encoding]"; //set a default (when the default database encoding should be used)

if(!isset($_POST["encoding"]))
  $_POST["encoding"] = "default"; //set default encoding for the first page show (no POST vars)

if(isset($_POST["Go"]) && ""!=$_POST["Go"]) //form was submitted
{
	

  $csv->file_name = $_FILES['file_source']['tmp_name'];
  
  //optional parameters
  $csv->use_csv_header = isset($_POST["use_csv_header"]);
  $csv->field_separate_char = $_POST["field_separate_char"][0];
  $csv->field_enclose_char = $_POST["field_enclose_char"][0];
  $csv->field_escape_char = $_POST["field_escape_char"][0];
  $csv->encoding = $_POST["encoding"];
  
  //start import now
  $csv->import();
}
else
  $_POST["use_csv_header"] = 1;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Quick CSV import</title>
  <style>
  .edt
  {
    background:#ffffff; 
    border:3px double #aaaaaa; 
    -moz-border-left-colors:  #aaaaaa #ffffff #aaaaaa; 
    -moz-border-right-colors: #aaaaaa #ffffff #aaaaaa; 
    -moz-border-top-colors:   #aaaaaa #ffffff #aaaaaa; 
    -moz-border-bottom-colors:#aaaaaa #ffffff #aaaaaa; 
    width: 350px;
  }
  .edt_30
  {
    background:#ffffff; 
    border:3px double #aaaaaa; 
    font-family: Courier;
    -moz-border-left-colors:  #aaaaaa #ffffff #aaaaaa; 
    -moz-border-right-colors: #aaaaaa #ffffff #aaaaaa; 
    -moz-border-top-colors:   #aaaaaa #ffffff #aaaaaa; 
    -moz-border-bottom-colors:#aaaaaa #ffffff #aaaaaa; 
    width: 30px;
  }
  </style>
</head>

<body bgcolor="#f2f2f2">
  <h2 align="center">Quick CSV import</h2>
  <form method="post" enctype="multipart/form-data">
    <table border="0" align="center">
      <tr>
      	<td>Source CSV file to import:</td>
      	<td rowspan="30" width="10px">&nbsp;</td>
      	<td><input type="file" name="file_source" id="file_source" class="edt" value="<?=$file_source?>"></td>
      </tr>
      <tr>
      	<td>Use CSV header:</td>
      	<td><input type="checkbox" name="use_csv_header" id="use_csv_header" checked /></td>
      </tr>
      <tr>
      	<td>Separate char:</td>
      	<td><input type="text" name="field_separate_char" id="field_separate_char" class="edt_30"  maxlength="1" value="," /></td>
      </tr>
      <tr>
      	<td>Enclose char:</td>
      	<td><input type="text" name="field_enclose_char" id="field_enclose_char" class="edt_30"  maxlength="1" value="<?php echo  htmlspecialchars("\"") ?>"/></td>
      </tr>
      <tr>
      	<td>Escape char:</td>
      	<td><input type="text" name="field_escape_char" id="field_escape_char" class="edt_30"  maxlength="1" value="<? echo "\\"?>"/></td>
      </tr>
      <tr>
      	<td>Encoding:</td>
      	<td>
          <select name="encoding" id="encoding" class="edt">
          <?
            if(!empty($arr_encodings))
              foreach($arr_encodings as $charset=>$description):
          ?>
            <option value="<?=$charset?>"<?=($charset == $_POST["encoding"] ? "selected=\"selected\"" : "")?>><?=$description?></option>
          <? endforeach;?>
          </select>
        </td>
      </tr>
      <tr>
      	<td colspan="3">&nbsp;</td>
      </tr>
      <tr>
      	<td colspan="3" align="center"><input type="Submit" name="Go" value="Import it" onclick=" var s = document.getElementById('file_source'); if(null != s && '' == s.value) {alert('Define file name'); s.focus(); return false;}"></td>
      </tr>
    </table>
  </form>
<?=(!empty($csv->error) ? "<hr/>Errors: ".$csv->error : "")?>
</body>
</html>