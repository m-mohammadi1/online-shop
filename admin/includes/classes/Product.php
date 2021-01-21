<?php
namespace classes;

class Product extends Main
{
    protected static $class_name = "classes\Product";
    protected static $db_name = "products";
    protected static $auto_inc = "id";

    /** Database Properties **/
    public $id;
    public $title;
    public $description;
    public $cat_id;
    public $price;
    public $photo;
    public $stock;
    public $created_at;

    /*** Upload photo Properties ***/

    protected $photo_name;
    protected $photo_tmp;


    /** Upload photo errors */

    protected static $upload_directory =  "products";

    protected $errors = array();
    protected $upload_errors = array(
        UPLOAD_ERR_OK => "اروری وجود ندارد",
        UPLOAD_ERR_INI_SIZE => "حجم فایل انتخابی بیشتر از حد مجاز سرور است",
        UPLOAD_ERR_FORM_SIZE => "حجم فایل آپلودی بیش از جد مجاز است",
        UPLOAD_ERR_PARTIAL => "فایل به صورت ناقص آپلود شده است",
        UPLOAD_ERR_NO_FILE => "هیچ فایلی آپلود نشده است",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temparory folder",
        UPLOAD_ERR_CANT_WRITE => "شکست در انتقال فایل و ذخیره روی دیسک",
        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload"
    );

    /*********************** Methods *************************** */

    /**
     *  set $_FILES variable's indexes to properties
     */
    /*
     public function setPhotoInfo(array $photo)
    {
        // die($this->upload_directory);
        if(empty($photo) || !is_array($photo) || !$photo) {
            $this->errors = "هیچ فایلی آپلود مشده است";

        } else if($photo['error'] != 0) {
            $this->errors[] = $this->upload_errors[$photo['error']];
            return false;
        } else {            
            $this->photo_name = $photo['name'];
            $this->photo_tmp  = $photo['tmp_name'];
            return true;
        }
    }
    */



    public function uploadPhoto($photo)
    {
        if (!isset($photo['name']) || !isset($photo['tmp_name'])) {
            $this->errors[] = "عکس در دسترس نیست";
            return false;
        }

        if (!empty($this->errors)) {
            return false;
        }
        $target_path = UPLOAD_DIR . DS . static::$upload_directory;
        
        if (move_uploaded_file($photo['tmp_name'], $target_path . DS . $photo['name'])) {
            return true;
        } else {
            $this->errors[] = "مشکلی در آپلود فایل بوجود آمد دسترسی خود را بررسی کنید";
            return false;
        }
    }


    public function CreateWithPhoto()
    {
            if ($this->create()) {
                return true;
            } 
            return false;
    }



    public function UpdateWithPhoto($new_photo)
    {
        $photo_path = $this->upload_directory . DS . $this->photo;

        if ($this->uploadPhoto($new_photo))
        {
            if ($this->update()) {
                return true;
            }
        }
        return false;
    }

    public function saveWithPhoto($new_photo = null)
    {
        if (isset($this->id)) {
            return $this->update($new_photo);
        } else {
            return $this->create();
        }
    }

    public function deleteWithPhoto()
    {
        $target_path = UPLOAD_DIR . DS . "products" . DS . $this->photo;

        
        if ($this->delete()) {
            unlink($target_path);
            return true;
        } 
        return false;
    }











    /*** helper functions  ***/
    public function getUploadErrors()
    {
        return $this->errors;    
    }

    public function getPhotoPath()
    {
        return '../uploads/products/' . $this->photo;
    }


}











