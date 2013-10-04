<?php defined('INDEX') or die() and exit(); // Prevents direct script access
/**
 * Super Amazing Commerce
 *
 * Super Amazing Commerce allows developers the ability to build a 
 * completely customizable, secure, fast, online store built for all devices.
 *
 * @package        Super Amazing Commerce
 * @author         Super Amazing, William Mosley, III <http://superamazingstore.com>
 * @copyright      Copyright (c) 2010 - 2013, Super Amazing
 * @license        GPL v2 <http://choosealicense.com/licenses/gpl-v2/>        
 * @link           https://github.com/superamazing/super-amazing-commerce
 * @docs           https://github.com/superamazing/super-amazing-commerce/wiki
 * @since          Version 2.0.0
 * -----------------------------------------------------------------
 *
 * Class
 */
 
// --------------------------------------------------------------------------------

/**
 * Class description
 * @since 0.1.1 s7
 * @author William Mosley, III <will@livesuperamazing.com>
 * 0 Arguments
 * 0 Methods
 */
class Database extends PDO
{
	protected $dsn = NULL;
	protected $username = NULL;
	protected $password = NULL;
	protected $dbName = NULL;
	protected $dbHost = NULL;
	protected $driverOptions = NULL;
	
	function __construct()
	{
		# Require set database constants
		require_once( DB );
		
		$this->dbName = DB_NAME;
		$this->dbHost = DB_HOST;
		$this->dsn = 'mysql:dbname='.$this->dbName.';host='.$this->dbHost.'';
		$this->username = DB_USER;
		$this->password = DB_PASSWORD;
		$this->driver = NULL;
		
		/**
		 * Check if the database has be set
		 */
		
			# Try to connect to the database:
			try
			{	
				# Define Settings to Parent Construct
				parent::__construct($this->dsn, $this->username, $this->password, $this->driver);
				
				
				# Show PDO Database Errors
				$this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				
				
			} // end try
			
			# Report the eorror!
			catch( PDOException $e )
			{
				echo '<h2>'.$e->getMessage().'</h2>';
				exit;

			} // end catch( PDOException $e )S
			
			if( $this->dbName == NULL || $this->dbName == '' || $this->dbName == 'development-database-name-here' )
			{
				$this->dbName = NULL;
				$_GET['p'] = 'install';
			}	
			
		
	}
	 
	 
	 /**
	  * Gets number of rows effected by query
	  */
	  	function getRowsAffected( $query )
		{
			return $this->exec( $query );
			
		} // end function getRowsAffected( $query )
	 
	 /**
	  * Close database connection
	  * @since 0.1.1 s8
	  */
		 function closeDB()
		 {
			 unset( $this->pdo ); 
			 
		 } // end function closeDB()
		 
		 
	/**
	 * Destroy database connection
	 */
		function __destruct()
		{
			$this->closeDB();
			
		} // end __destruct()
	
 
} // end ClassName