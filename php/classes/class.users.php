<?php
  require_once("class.database.php");
  require_once("class.databaseObject.php");

  class User extends databaseObject{

    protected static $table_name="users";
    public $company_id;
    public $email_address;
    public $password;
    public $title;
    public $forename;
    public $surname;
    public $address1;
    public $address2;
    public $city;
    public $county;
    public $country
    public $postCode;
    public $job_title
    public $department;
    public $landline_prefix;
    public $landline_ext;
    public $landline_number;
    public $mobile_prefix;
    public $mobile_ext;
    public $mobile_number;
    public $fax_prefix;
    public $fax_ext;
    public $fax_number;
    public $legal_check;
    public $data_check;
    public $primaryUser;
    public $Admin;
    public $addCards;
    public $editCards;
    public $deleteCards;
    public $addCompanies;
    public $editCompanies;
    public $deleteCompanies;
    public $editContactFormMessages;
    public $deleteContactFormMessages;
    public $addDatabases;
    public $editDatabases;
    public $deleteDatabases;
    public $addGraphics;
    public $editGraphics;
    public $deleteGraphics;
    public $addLogos;
    public $editLogos;
    public $deleteLogos;
    public $addNotes;
    public $editNotes;
    public $deleteNotes;
    public $addOther;
    public $editOther;
    public $deleteOther;
    public $addProjects;
    public $editProjects;
    public $deleteProjects;
    public $addServices;
    public $editServices;
    public $deleteServices;
    public $addUsers;
    public $editUsers;
    public $deleteUsers;
    public $addWebsites;
    public $editWebsites;
    public $deleteWebsites;
    public $account_status;

    public function full_name(){
      if(isset($this->title) && isset($this->forename) && isset($this->surname)){
        return $this->title . " " . $this->forename . " " . $this->surname;
      }else{
        return "";
      }
    }

    public static function authenticate($email_address="", $password=""){
      global $connection;
      $email_address= $database->escape_value($email_address);
      $password= $database->escape_value($password);
      $sql = "SELECT * FROM users ";
      $sql.= "WHERE email_address = '{$email_address}' ";
      $sql.= "AND password = '{$password}' ";
      $sql.="LIMIT 1";
    }

    //common database methods
    public static function find_all(){
      return self::find_by_sql("SELECT * FROM " . self::$table_name)
    }

    public static function find_by_id($id=0){
      global $database;

      $result_array = self::find_by_sql("SELECT * FROM ". self::$table_name . " WHERE id={$id} LIMIT 1");
      return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_sql($sql=""){
      global $database;
      $result_set = $database->query($sql);
      $object_array=new array();
      while($row = $database->fetch_array($result_set)){
        $object_array[] = self::instantiate($row);
      }
      return $object_array;
    }

    private static function instantiate($record){
      $object= new self;

      foreach ($record as $attribute => $value) {
        if($object->has_attribute($attribute)){
          $object->$attribute=$value;
        }
      }

      return $object;
    }

    private function has_attribute($attribute){
      $object_vars=get_object_vars($this);
      return array_key_exists($attribute, $object_vars);
    }

    public function create(){
      global $database;

      //secures the password
      $securedPassword=securePassword($data['password']);

      $sql = "INSERT INTO users ";
      $sql .=

      $query.="(
                company_id,
                email_address,
                password,
                title,
                forename,
                surname,
                address1,
                address2,
                city,
                county,
                country,
                postCode,
                job_title,
                department,
                landline_prefix,
                landline_ext,
                landline_number,
                mobile_prefix,
                mobile_ext,
                mobile_number,
                fax_prefix,
                fax_ext,
                fax_number,
                legal_check,
                data_check,
                primaryUser,
                Admin,
                addCards,
                editCards,
                deleteCards,
                addCompanies,
                editCompanies,
                deleteCompanies,
                editContactFormMessages,
                deleteContactFormMessages,
                addDatabases,
                editDatabases,
                deleteDatabases,
                addGraphics,
                editGraphics,
                deleteGraphics,
                addLogos,
                editLogos,
                deleteLogos,
                addNotes,
                editNotes,
                deleteNotes,
                addOther,
                editOther,
                deleteOther,
                addProjects,
                editProjects,
                deleteProjects,
                addServices,
                editServices,
                deleteServices,
                addUsers,
                editUsers,
                deleteUsers,
                addWebsites,
                editWebsites,
                deleteWebsites,
                account_status
              )";
      $query.=" VALUES ";
      $query.="(
                  {$companyID},
                  '{$data['email']}',
                  '{$securedPassword}',
                  '{$data['title']}',
                  '{$data['forename']}',
                  '{$data['surname']}',
                  '{$data['address1']}',
                  '{$data['address2']}',
                  '{$data['city']}',
                  '{$data['county']}',
                  '{$data['country']}',
                  '{$data['postCode']}',
                  '{$data['jobTitle']}',
                  '{$data['department']}',
                  '{$data['landlinePrefix']}',
                  '{$data['landlineExt']}',
                  '{$data['landlineNumber']}',
                  '{$data['mobilePrefix']}',
                  '{$data['mobileExt']}',
                  '{$data['mobileNumber']}',
                  '{$data['faxPrefix']}',
                  '{$data['faxExt']}',
                  '{$data['faxNumber']}',
                  {$data['legalChecked']},
                  {$data['dataChecked']},
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  1,
                  'active'
    }

    public function update(){

    }

    public function delete(){

    }

  }
?>
