silverstripe-hiddenfields
=========================

Takes form fields you specified through $hidden_fields and hides them from the edit form.

## Usage

* Extract / clone this so that the path to _config.php is SITEROOT/HiddenFieldsDataExtension/_config.php
* Adjust _config.php if you don't want it to apply to all DataObjects

## DIY Demo:

Course.php:

    <?php
    class Course extends DataObject {
    	public static $db = array(
    		'Title'             => 'Varchar(500)',
    	);
    
    	public static $has_many = array(
    		'CourseDates'        => 'CourseDate',
    	);	

    }

CourseDate.php:

    <?php
    class CourseDate extends DataObject {
    	public static $db = array(
    		'StartDate' => 'Date',
    		'EndDate'   => 'Date',
    	);
    
    	public static $has_one = array(
    		'Course' => 'Course'
    	);
    
    	public static $hidden_fields = array(
    		'CourseID'
    	);
    
    }

CourseModelAdmin.php:

    <?php
    
    class CourseModelAdmin extends ModelAdmin {
    	public static $managed_models = array(
    		'Course', 
    		'CourseDates',
    	); 
      	static $url_segment = 'courses'; // Linked as /admin/products/
      	static $menu_title = 'Course Admin';
    	
    }

Do a /dev/build and create a new course in the CMS. After saving, when accessing the CourseDates tab, you will not see the option to select the Course related to the dates (it is automatically saved from the parent - child relationship in this case).


## Screenshot

![Example screenshot](http://content.screencast.com/users/SanderVD/folders/Jing/media/c66ae9b9-d681-4940-adbd-71773d110d54/2012-11-20_1340.png)

1. Unsaved message provided through [ManyMessageDataExtension](https://github.com/svandragt/silverstripe-manymessage)
2. Styling for required formfields provided through [RequiredFieldsCmsDataExtension](https://github.com/svandragt/silverstripe-requiredfieldscms)
3. Field descriptions automatically linked through [DescriptionDataExtension](https://github.com/svandragt/silverstripe-description)