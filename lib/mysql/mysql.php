<?php
/**
 * MySQL database driver0
10 0*
 * @package		Joomla.Frame0work
 * 0@subpackage	Database
 * @since		1.0
 */
class JDatabaseMySQL
{
	/**
	 * The database driver name
	 *
	 * @var string
	 */
	var $name			= 'mysql';

	/**
	 *  The null/zero date string
	 *
	 * @var string
	 */
	var $_nullDate		= '0000-00-00 00:00:00';

	/**
	 * Quote for named objects
	 *
	 * @var string
	 */
	var $_nameQuote		= '`';
	

	/**
	 * The query sql string
	 *
	 * @var string
	 **/
	var $_sql			= '';

	/**
	 * The database error number
	 *
	 * @var int
	 **/
	var $_errorNum		= 0;

	/**
	 * The database error message
	 *
	 * @var string
	 */
	var $_errorMsg		= '';

	/**
	 * The prefix used on all database tables
	 *
	 * @var string
	 */
	var $_table_prefix	= '';

	/**
	 * The connector resource
	 *
	 * @var resource
	 */
	var $_resource		= '';

	/**
	 * The last query cursor
	 *
	 * @var resource
	 */
	var $_cursor		= null;

	/**
	 * Debug option
	 *
	 * @var boolean
	 */
	var $_debug			= 0;

	/**
	 * The limit for the query
	 *
	 * @var int
	 */
	var $_limit			= 0;

	/**
	 * The for offset for the limit
	 *
	 * @var int
	 */
	var $_offset		= 0;

	/**
	 * The number of queries performed by the object instance
	 *
	 * @var int
	 */
	var $_ticker		= 0;

	/**
	 * A log of queries
	 *
	 * @var array
	 */
	var $_log			= null;

	
	/**
	 * UTF-8 support
	 *
	 * @var boolean
	 * @since	1.5
	 */
	var $_utf			= 0;

	/**
	 * The fields that are to be quote
	 *
	 * @var array
	 * @since	1.5
	 */
	var $_quoted	= null;

	/**
	 *  Legacy compatibility
	 *
	 * @var bool
	 * @since	1.5
	 */
	var $_hasQuoted	= null;
	var $cur = '';
	
	var $id = '';

	/**
	* Database object constructor
	*
	* @access	public
	* @param	array	List of options used to configure the connection
	* @since	1.5
	* @see		JDatabase
	*/
	
	################  PAGINATION VARIBALE #######
	var $whr = '';
	var $query = '';
	var $total_ps = '';
	var $targetp = '';
	var $limit = '';
	var $p = '';
	var $start = '';
	var $sql = '';
	var $result = '';
	var $prev = '';
	var $next = '';
	var $lastp = '';
	var $lpm1  = '';
	var $pagination = '';
	var $counter = '';
	var $page_Data  = '';
	####### to be initialize at the time of running code
	var $tb_name = '';
	var $where = '';
	var $adjacents = '';
	var $page = '';
	var $pageLimit = '';
	
	
	function __construct()
	{
		$config_var = new config();
		$host		= $config_var->HOST_NAME;
		$user		= $config_var->HOST_USER;
		$password	= $config_var->HOST_PASS;
		$database	=  $config_var->DB_NAME;
		$prefix		= 'mgl_';
		$select		=  true;

		// perform a number of fatality checks, then return gracefully
		if (!function_exists( 'mysql_connect' )) {
			$this->_errorNum = 1;
			$this->_errorMsg = 'The MySQL adapter "mysql" is not available.';
			return;
		}

		// connect to the server
		if (!($this->_resource = @mysql_connect( $host, $user, $password, true ))) {
			$this->_errorNum = 2;
			$this->_errorMsg = 'Could not connect to MySQL';
			return;
		}else{
		   $this->_errorMsg = 'connected';
		}

		// finalize initialization
		

		// select the database
		if ( $select ) {
			$this->select($database);
		}
	}

	/**
	 * Database object destructor
	 *
	 * @return boolean
	 * @since 1.5
	 */
	

	/**
	 * Test to see if the MySQL connector is available
	 *
	 * @static
	 * @access public
	 * @return boolean  True on success, false otherwise.
	 */
	function test()
	{
		return (function_exists( 'mysql_connect' ));
	}

	/**
	 * Determines if the connection to the server is active.
	 *
	 * @access	public
	 * @return	boolean
	 * @since	1.5
	 */
	function connected()
	{
		if(is_resource($this->_resource)) {
			return mysql_ping($this->_resource);
		}
		return false;
	}

	/**
	 * Select a database for use
	 *
	 * @access	public
	 * @param	string $database
	 * @return	boolean True if the database has been successfully selected
	 * @since	1.5
	 */
	function select($database)
	{
		if ( ! $database )
		{
			return false;
		}

		if ( !mysql_select_db( $database, $this->_resource )) {
			$this->_errorNum = 3;
			$this->_errorMsg = 'Could not connect to database';
			return false;
		}

		// if running mysql 5, set sql-mode to mysql40 - thereby circumventing strict mode problems
		if ( strpos( $this->getVersion(), '5' ) === 0 ) {
			$this->setQuery( "SET sql_mode = 'MYSQL40'" );
			$this->query();
		}

		return true;
	}

	/**
	 * Determines UTF support
	 *
	 * @access	public
	 * @return boolean True - UTF is supported
	 */
	function hasUTF()
	{
		$verParts = explode( '.', $this->getVersion() );
		return ($verParts[0] == 5 || ($verParts[0] == 4 && $verParts[1] == 1 && (int)$verParts[2] >= 2));
	}

	/**
	 * Custom settings for UTF support
	 *
	 * @access	public
	 */
	function setUTF()
	{
		mysql_query( "SET NAMES 'utf8'", $this->_resource );
	}

	/**
	 * Get a database escaped string
	 *
	 * @param	string	The string to be escaped
	 * @param	boolean	Optional parameter to provide extra escaping
	 * @return	string
	 * @access	public
	 * @abstract
	 */
	function getEscaped( $text, $extra = false )
	{
		$result = mysql_real_escape_string( $text );
		if ($extra) {
			$result = addcslashes( $result, '%_' );
		}
		return $result;
	}

	/**
	 * Execute the query
	 *
	 * @access	public
	 * @return mixed A database resource if successful, FALSE if not.
	 */
	function query()
	{
// Take a local copy so that we don't modify the original query and cause issues later
		$this->cur = @mysql_query($this->sql); 
		return $this->cur;
		}

	/**
	 * Description
	 *
	 * @access	public
	 * @return int The number of affected rows in the previous operation
	 * @since 1.0.5
	 */
	function getAffectedRows()
	{
		return @mysql_affected_rows( $this->cur );
	}


	
	/**
	 * Description
	 *
	 * @access	public
	 * @return int The number of rows returned from the most recent query.
	 */
	 
		 
	function getNumRows()
	{
		return @mysql_num_rows( $this->cur);
	}

	/**
	 * This method loads the first field of the first row returned by the query.
	 *
	 * @access	public
	 * @return The value returned in the query or null if the query failed.
	 */
	function loadResult()
	{
		$ret = null;
		if ($row = @mysql_fetch_row( $this->cur )) {
			$ret = $row[0];
		}
		@mysql_free_result( $this->cur );
		return $ret;
	}
	
	
	function getArray()
	{
		 $row = @mysql_fetch_array( $this->cur );
		 @mysql_free_result( $this->cur );
		 return $row;
	}

	/**
	 * Load an array of single field results into an array
	 *
	 * @access	public
	 */
	function loadResultArray($numinarray = 0)
	{
		
		$array = array();
		while ($row = @mysql_fetch_row( $this->cur  )) {
			$array[] = $row[$numinarray];
		}
		@mysql_free_result($this->cur  );
		return $array;
	}

	/**
	* Fetch a result row as an associative array
	*
	* @access	public
	* @return array
	*/
	function loadAssoc()
	{  
	    $ret = null;
		$ret = array();
		while ($assoc = @mysql_fetch_assoc( $this->cur  )) {
			$ret[] = $assoc;
		}
		
		@mysql_free_result( $this->cur );
		return $ret;
	}

	/**
	* Load a assoc list of database rows
	*
	* @access	public
	* @param string The field name of a primary key
	* @return array If <var>key</var> is empty as sequential list of returned records.
	*/
	function loadAssocList( $key='' )
	{
	
		$array = array();
		while ($row = @mysql_fetch_assoc( $this->cur )) {
			if ($key) {
				$array[$row[$key]] = $row;
			} else {
				$array[] = $row;
			}
		}
		@mysql_free_result( $this->cur );
		return $array;
	}

	/**
	* This global function loads the first row of a query into an object
	*
	* @access	public
	* @return 	object
	*/
	function loadObject( )
	{  if ($object = mysql_fetch_object( $this->cur )) {
			$ret = $object;
		}
		mysql_free_result( $this->cur );
		return $ret;
	}

	/**
	* Load a list of database objects
	*
	* If <var>key</var> is not empty then the returned array is indexed by the value
	* the database key.  Returns <var>null</var> if the query fails.
	*
	* @access	public
	* @param string The field name of a primary key
	* @return array If <var>key</var> is empty as sequential list of returned records.
	*/
	function loadObjectList( $key='' )
	{
		$array = array();
		while ($row = @mysql_fetch_object( $this->cur )) {
			if ($key) {
				$array[$row->$key] = $row;
			} else {
				$array[] = $row;
			}
		}
		@mysql_free_result( $this->cur );
		return $array;
	}

	/**
	 * Description
	 *
	 * @access	public
	 * @return The first row of the query.
	 */
	function loadRow()
	{
		$ret = null;
		if ($row = @mysql_fetch_row( $this->cur )) {
			$ret = $row;
		}
		@mysql_free_result( $this->cur );
		return $ret;
	}

	/**
	* Load a list of database rows (numeric column indexing)
	*
	* @access public
	* @param string The field name of a primary key
	* @return array If <var>key</var> is empty as sequential list of returned records.
	* If <var>key</var> is not empty then the returned array is indexed by the value
	* the database key.  Returns <var>null</var> if the query fails.
	*/
	function loadRowList( $key=null )
	{
		$array = array();
		while ($row = @mysql_fetch_row( $this->cur )) {
			if ($key !== null) {
				$array[$row[$key]] = $row;
			} else {
				$array[] = $row;
			}
		}
		@mysql_free_result( $this->cur );
		return $array;
	}

	/**
	 * Inserts a row into a table based on an objects properties
	 *
	 * @access	public
	 * @param	string	The name of the table
	 * @param	object	An object whose properties match table fields
	 * @param	string	The name of the primary key. If provided the object property is updated.
	 */
	function insertObject( $table, &$object, $keyName = NULL )
	{
		$fmtsql = 'INSERT INTO '.$this->nameQuote($table).' ( %s ) VALUES ( %s ) ';
		$fields = array();
		foreach (get_object_vars( $object ) as $k => $v) {
			if (is_array($v) or is_object($v) or $v === NULL) {
				continue;
			}
			if ($k[0] == '_') { // internal field
				continue;
			}
			$fields[] = $this->nameQuote( $k );
			$values[] = $this->isQuoted( $k ) ? $this->Quote( $v ) : (int) $v;
		}
		$this->setQuery( sprintf( $fmtsql, implode( ",", $fields ) ,  implode( ",", $values ) ) );
		if (!$this->query()) {
			return false;
		}
		$id = $this->insertid();
		if ($keyName && $id) {
			$object->$keyName = $id;
		}
		return true;
	}

	/**
	 * Description
	 *
	 * @access public
	 * @param [type] $updateNulls
	 */
	function updateObject( $table, &$object, $keyName, $updateNulls=true )
	{
		$fmtsql = 'UPDATE '.$this->nameQuote($table).' SET %s WHERE %s';
		$tmp = array();
		foreach (get_object_vars( $object ) as $k => $v)
		{
			if( is_array($v) or is_object($v) or $k[0] == '_' ) { // internal or NA field
				continue;
			}
			if( $k == $keyName ) { // PK not to be updated
				$where = $keyName . '=' . $this->Quote( $v );
				continue;
			}
			if ($v === null)
			{
				if ($updateNulls) {
					$val = 'NULL';
				} else {
					continue;
				}
			} else {
				$val = $this->isQuoted( $k ) ? $this->Quote( $v ) : (int) $v;
			}
			$tmp[] = $this->nameQuote( $k ) . '=' . $val;
		}
		$this->setQuery( sprintf( $fmtsql, implode( ",", $tmp ) , $where ) );
		return $this->query();
	}

	/**
	 * Description
	 *
	 * @access public
	 */
	function insertid()
	{
		return mysql_insert_id();
	}

	/**
	 * Description
	 *
	 * @access public
	 */
	function getVersion()
	{
		return mysql_get_server_info( $this->_resource );
	}

	/**
	 * Assumes database collation in use by sampling one text field in one table
	 *
	 * @access	public
	 * @return string Collation in use
	 */
	function getCollation ()
	{
		if ( $this->hasUTF() ) {
			$this->setQuery( 'SHOW FULL COLUMNS FROM #__content' );
			$array = $this->loadAssocList();
			return $array['4']['Collation'];
		} else {
			return "N/A (mySQL < 4.1.2)";
		}
	}

	/**
	 * Description
	 *
	 * @access	public
	 * @return array A list of all the tables in the database
	 */
	function getTableList()
	{
		$this->setQuery( 'SHOW TABLES' );
		return $this->loadResultArray();
	}

	/**
	 * Shows the CREATE TABLE statement that creates the given tables
	 *
	 * @access	public
	 * @param 	array|string 	A table name or a list of table names
	 * @return 	array A list the create SQL for the tables
	 */
	function getTableCreate( $tables )
	{
		settype($tables, 'array'); //force to array
		$result = array();

		foreach ($tables as $tblval) {
			$this->setQuery( 'SHOW CREATE table ' . $this->getEscaped( $tblval ) );
			$rows = $this->loadRowList();
			foreach ($rows as $row) {
				$result[$tblval] = $row[1];
			}
		}

		return $result;
	}
   
   function setQuery($sql)
	{
		$this->_sql		= $sql;
		}
   
   function getQuery()
       { return $this->_sql;}
   
	/**
	 * Retrieves information about the given tables
	 *
	 * @access	public
	 * @param 	array|string 	A table name or a list of table names
	 * @param	boolean			Only return field types, default true
	 * @return	array An array of fields by table
	 */
	function getTableFields( $tables, $typeonly = true )
	{
		settype($tables, 'array'); //force to array
		$result = array();

		foreach ($tables as $tblval)
		{
			$this->setQuery( 'SHOW FIELDS FROM ' . $tblval );
			$fields = $this->loadObjectList();

			if($typeonly)
			{
				foreach ($fields as $field) {
					$result[$tblval][$field->Field] = preg_replace("/[(0-9)]/",'', $field->Type );
				}
			}
			else
			{
				foreach ($fields as $field) {
					$result[$tblval][$field->Field] = $field;
				}
			}
		}

		return $result;
	}
	
	
	function get_page_nav_front()
	{
		if((!isset($this->where))&&($this->where == '')){ $this->whr = '';}
		else { $this->whr = $this->where;}
		$this->query = "SELECT COUNT(*) as num FROM ".$this->tb_name." ".$this->whr."";
		$this->total_ps = mysql_fetch_array(mysql_query($this->query));
		$this->total_ps = $this->total_ps['num'];
		
		/* Setup vars for query. */
		$this->targetp = $this->page; 	//your file name  (the name of this file)
		$this->limit = $this->pageLimit; 								//how many items to show per p
		$this->p = @$_GET['p'];
		if($this->p) 
			$this->start = ($this->p - 1) * $this->limit; 			//first item to display on this p
		else
			$this->start = 0;								//if no p var is given, set start to 0
		
		/* Get data. */
		$this->sql = "SELECT * FROM ".$this->tb_name." ".$this->whr." LIMIT ".$this->start.", ".$this->limit."";

		$this->result = mysql_query($this->sql);
		
		/* Setup p vars for display. */
		if ($this->p == 0) $this->p = 1;					//if no p var is given, default to 1.
		$this->prev = $this->p - 1;							//previous p is p - 1
		$this->next = $this->p + 1;							//next p is p + 1
		$this->lastp = ceil($this->total_ps/$this->limit);		//lastp is = total ps / items per p, rounded up.
		$this->lpm1 = $this->lastp - 1;						//last p minus 1
		
		/* 
			Now we apply our rules and draw the pagination object. 
			We're actually saving the code to a variable in case we want to draw it more than once.
		*/
		$this->pagination = "";
		if($this->lastp > 1)
		{	
			$this->pagination .= "<div class=\"numbering-outer\">";
			//previous button
			if ($this->p > 1) 
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->prev."\">Previous</a>";
			else
				$this->pagination.= "<span class=\"disabled\">Previous</span>";	
			
			//ps	
			if ($this->lastp < 7 + ($this->adjacents * 2))	//not enough ps to bother breaking it up
			{	
				for ($this->counter = 1; $this->counter <= $this->lastp; $this->counter++)
				{
					if ($this->counter == $this->p)
						$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
					else
						$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
				}
			}
			elseif($this->lastp > 5 + ($this->adjacents * 2))	//enough ps to hide some
			{
				//close to beginning; only hide later ps
				if($this->p < 1 + ($this->adjacents * 2))		
				{
					for ($this->counter = 1; $this->counter < 4 + ($this->adjacents * 2); $this->counter++)
					{
						if ($this->counter == $this->p)
							$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
						else
							$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
					}
					$this->pagination.= "...";
					$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lpm1."\">".$this->lpm1."</a>";
					$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lastp."\">".$this->lastp."</a>";		
				}
				//in middle; hide some front and some back
				elseif($this->lastp - ($this->adjacents * 2) > $this->p && $this->p > ($this->adjacents * 2))
				{
					$this->pagination.= "<a href=\"".$this->targetp."&p=1\">1</a>";
					$this->pagination.= "<a href=\"".$this->targetp."&p=2\">2</a>";
					$this->pagination.= "...";
					for ($this->counter = $this->p - $this->adjacents; $this->counter <= $this->p + $this->adjacents; $this->counter++)
					{
						if ($this->counter == $this->p)
							$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
						else
							$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
					}
					$this->pagination.= "...";
					$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lpm1."\">".$this->lpm1."</a>";
					$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lastp."\">".$this->lastp."</a>";		
				}
				//close to end; only hide early ps
				else
				{
					$this->pagination.= "<a href=\"".$this->targetp."&p=1\">1</a>";
					$this->pagination.= "<a href=\"".$this->targetp."&p=2\">2</a>";
					$this->pagination.= "...";
					for ($this->counter = $this->lastp - (2 + ($this->adjacents * 2)); $this->counter <= $this->lastp; $this->counter++)
					{
						if ($this->counter == $this->p)
							$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
						else
							$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
					}
				}
			}
			
			//next button
			if ($this->p < $this->counter - 1) 
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->next."\">Next</a>";
			else
				$this->pagination.= "<span class=\"disabled\">Next</span>";
			$this->pagination.= "</div>\n";		
		}
				
		
		$this->page_Data = array('result'=>$this->result,
						   'nav'=>$this->pagination,
						   'records'=>$this->total_ps);
						   
		return 		$this->page_Data ;	
	}
	function get_page_nav(){	
    
	if((!isset($this->where))&&($this->where == '')){ $this->whr = '';}
	else { $this->whr = $this->where;}
	$this->query = "SELECT COUNT(*) as num FROM ".$this->tb_name." ".$this->whr."";
	$this->total_ps = mysql_fetch_array(mysql_query($this->query));
	$this->total_ps = $this->total_ps['num'];
	
	/* Setup vars for query. */
	$this->targetp = $this->page; 	//your file name  (the name of this file)
	$this->limit = $this->pageLimit; 								//how many items to show per p
	$this->p = @$_GET['p'];
	if($this->p) 
		$this->start = ($this->p - 1) * $this->limit; 			//first item to display on this p
	else
		$this->start = 0;								//if no p var is given, set start to 0
	
	/* Get data. */
	$this->sql = "SELECT * FROM ".$this->tb_name." ".$this->whr." LIMIT ".$this->start.", ".$this->limit."";

	$this->result = mysql_query($this->sql);
	
	/* Setup p vars for display. */
	if ($this->p == 0) $this->p = 1;					//if no p var is given, default to 1.
	$this->prev = $this->p - 1;							//previous p is p - 1
	$this->next = $this->p + 1;							//next p is p + 1
	$this->lastp = ceil($this->total_ps/$this->limit);		//lastp is = total ps / items per p, rounded up.
	$this->lpm1 = $this->lastp - 1;						//last p minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$this->pagination = "<style>div.pagination {
	padding: 3px;
	margin: 3px;
}

div.pagination a {
	padding: 2px 5px 2px 5px !important;
	margin: 2px;
	border: 1px solid #B7D78C;
	background-color: #D3EEB0;
	text-decoration: none; /* no underline */
	color: #0099FF;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #94B52C;
     background-color: #94B52C;
	 color: #FBFFF0;
	 
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #65A411;
	font-weight: bold;
		background-color: #94B52C;
		color: #FFF;
	}
	div.pagination span.disabled {
		padding: 2px 5px 2px 5px;
		margin: 2px;
		border: 1px solid #CFE2B7;
	    background-color: #F0F8E6;
		color: #DDD;
	}
	</style>";
	if($this->lastp > 1)
	{	
		$this->pagination .= "<div class=\"pagination\">";
		//previous button
		if ($this->p > 1) 
			$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->prev."\">Previous</a>";
		else
			$this->pagination.= "<span class=\"disabled\">Previous</span>";	
		
		//ps	
		if ($this->lastp < 7 + ($this->adjacents * 2))	//not enough ps to bother breaking it up
		{	
			for ($this->counter = 1; $this->counter <= $this->lastp; $this->counter++)
			{
				if ($this->counter == $this->p)
					$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
				else
					$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
			}
		}
		elseif($this->lastp > 5 + ($this->adjacents * 2))	//enough ps to hide some
		{
			//close to beginning; only hide later ps
			if($this->p < 1 + ($this->adjacents * 2))		
			{
				for ($this->counter = 1; $this->counter < 4 + ($this->adjacents * 2); $this->counter++)
				{
					if ($this->counter == $this->p)
						$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
					else
						$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
				}
				$this->pagination.= "...";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lpm1."\">".$this->lpm1."</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lastp."\">".$this->lastp."</a>";		
			}
			//in middle; hide some front and some back
			elseif($this->lastp - ($this->adjacents * 2) > $this->p && $this->p > ($this->adjacents * 2))
			{
				$this->pagination.= "<a href=\"".$this->targetp."&p=1\">1</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=2\">2</a>";
				$this->pagination.= "...";
				for ($this->counter = $this->p - $this->adjacents; $this->counter <= $this->p + $this->adjacents; $this->counter++)
				{
					if ($this->counter == $this->p)
						$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
					else
						$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
				}
				$this->pagination.= "...";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lpm1."\">".$this->lpm1."</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lastp."\">".$this->lastp."</a>";		
			}
			//close to end; only hide early ps
			else
			{
				$this->pagination.= "<a href=\"".$this->targetp."&p=1\">1</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=2\">2</a>";
				$this->pagination.= "...";
				for ($this->counter = $this->lastp - (2 + ($this->adjacents * 2)); $this->counter <= $this->lastp; $this->counter++)
				{
					if ($this->counter == $this->p)
						$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
					else
						$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
				}
			}
		}
		
		//next button
		if ($this->p < $this->counter - 1) 
			$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->next."\">Next</a>";
		else
			$this->pagination.= "<span class=\"disabled\">Next</span>";
		$this->pagination.= "</div>\n";		
	}
        	
	
	$this->page_Data = array('result'=>$this->result,
                       'nav'=>$this->pagination,
					   'records'=>$this->total_ps);
					   
	return 		$this->page_Data ;		   
	
}

/*********for the employee panel issue books pagination********/


function get_employee_nav(){
	
    
	if((!isset($this->where))&&($this->where == '')){ $this->whr = '';}
	else { $this->whr = $this->where;}
	$this->query = "SELECT COUNT(*) as num FROM ".$this->tb_name." ".$this->whr."";
	$this->total_ps = mysql_fetch_array(mysql_query($this->query));
	$this->total_ps = $this->total_ps['num'];
	
	/* Setup vars for query. */
	$this->targetp = $this->page; 	//your file name  (the name of this file)
	$this->limit = $this->pageLimit; 								//how many items to show per p
	$this->p = @$_GET['p'];
	if($this->p) 
		$this->start = ($this->p - 1) * $this->limit; 			//first item to display on this p
	else
		$this->start = 0;								//if no p var is given, set start to 0
	
	/* Get data. */
	$this->sql = "SELECT a.book_name,a.book_id,a.book_qty,a.book_price,a.book_id,b.royality_writer_id,b.party_id FROM ".$this->tb_name." ".$this->whr." LIMIT ".$this->start.", ".$this->limit."";
	$this->result = mysql_query($this->sql);
	
	/* Setup p vars for display. */
	if ($this->p == 0) $this->p = 1;					//if no p var is given, default to 1.
	$this->prev = $this->p - 1;							//previous p is p - 1
	$this->next = $this->p + 1;							//next p is p + 1
	$this->lastp = ceil($this->total_ps/$this->limit);		//lastp is = total ps / items per p, rounded up.
	$this->lpm1 = $this->lastp - 1;						//last p minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$this->pagination = "<style>div.pagination {
	padding: 3px;
	margin: 3px;
}

div.pagination a {
	padding: 2px 5px 2px 5px !important;
	margin: 2px;
	border: 1px solid #B7D78C;
	background-color: #D3EEB0;
	text-decoration: none; /* no underline */
	color: #0099FF;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #94B52C;
     background-color: #94B52C;
	 color: #FBFFF0;
	 
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #65A411;
	font-weight: bold;
		background-color: #94B52C;
		color: #FFF;
	}
	div.pagination span.disabled {
		padding: 2px 5px 2px 5px;
		margin: 2px;
		border: 1px solid #CFE2B7;
	    background-color: #F0F8E6;
		color: #DDD;
	}
	</style>";
	if($this->lastp > 1)
	{	
		$this->pagination .= "<div class=\"pagination\">";
		//previous button
		if ($this->p > 1) 
			$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->prev."\">Previous</a>";
		else
			$this->pagination.= "<span class=\"disabled\">Previous</span>";	
		
		//ps	
		if ($this->lastp < 7 + ($this->adjacents * 2))	//not enough ps to bother breaking it up
		{	
			for ($this->counter = 1; $this->counter <= $this->lastp; $this->counter++)
			{
				if ($this->counter == $this->p)
					$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
				else
					$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
			}
		}
		elseif($this->lastp > 5 + ($this->adjacents * 2))	//enough ps to hide some
		{
			//close to beginning; only hide later ps
			if($this->p < 1 + ($this->adjacents * 2))		
			{
				for ($this->counter = 1; $this->counter < 4 + ($this->adjacents * 2); $this->counter++)
				{
					if ($this->counter == $this->p)
						$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
					else
						$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
				}
				$this->pagination.= "...";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lpm1."\">".$this->lpm1."</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lastp."\">".$this->lastp."</a>";		
			}
			//in middle; hide some front and some back
			elseif($this->lastp - ($this->adjacents * 2) > $this->p && $this->p > ($this->adjacents * 2))
			{
				$this->pagination.= "<a href=\"".$this->targetp."&p=1\">1</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=2\">2</a>";
				$this->pagination.= "...";
				for ($this->counter = $this->p - $this->adjacents; $this->counter <= $this->p + $this->adjacents; $this->counter++)
				{
					if ($this->counter == $this->p)
						$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
					else
						$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
				}
				$this->pagination.= "...";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lpm1."\">".$this->lpm1."</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lastp."\">".$this->lastp."</a>";		
			}
			//close to end; only hide early ps
			else
			{
				$this->pagination.= "<a href=\"".$this->targetp."&p=1\">1</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=2\">2</a>";
				$this->pagination.= "...";
				for ($this->counter = $this->lastp - (2 + ($this->adjacents * 2)); $this->counter <= $this->lastp; $this->counter++)
				{
					if ($this->counter == $this->p)
						$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
					else
						$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
				}
			}
		}
		
		//next button
		if ($this->p < $this->counter - 1) 
			$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->next."\">Next</a>";
		else
			$this->pagination.= "<span class=\"disabled\">Next</span>";
		$this->pagination.= "</div>\n";		
	}
        	
	
	$this->page_Data = array('result'=>$this->result,
                       'nav'=>$this->pagination,
					   'records'=>$this->total_ps);
					   
	return 		$this->page_Data ;		   
	

}
/*********for the employee panel issue books pagination********/


function get_agent_nav(){
	
    
	if((!isset($this->where))&&($this->where == '')){ $this->whr = '';}
	else { $this->whr = $this->where;}
	 $str = "SELECT COUNT(*) as num FROM mgl_amt_sell_books a,mgl_sell_books b,mgl_agents c where a.agent_id=c.agent_id and a.amt_book_id=b.sell_amt_id group by b.sell_amt_id  order by c.agent_name asc";
	 $this->total_ps = mysql_num_rows(mysql_query($str));
	 
	//die;
	/* Setup vars for query. */
	$this->targetp = $this->page; 	//your file name  (the name of this file)
	$this->limit = $this->pageLimit; 								//how many items to show per p
	$this->p = @$_GET['p'];
	if($this->p) 
		$this->start = ($this->p - 1) * $this->limit; 			//first item to display on this p
	else
		$this->start = 0;								//if no p var is given, set start to 0
	
	/* Get data. */
	 $this->sql = "SELECT * FROM ".$this->tb_name." ".$this->whr." LIMIT ".$this->start.", ".$this->limit."";
	
	$this->result = mysql_query($this->sql);
	
	/* Setup p vars for display. */
	if ($this->p == 0) $this->p = 1;					//if no p var is given, default to 1.
	$this->prev = $this->p - 1;							//previous p is p - 1
	$this->next = $this->p + 1;	
				//next p is p + 1
	 $this->lastp = ceil($this->total_ps/$this->limit);	
	/* echo ceil($this->total_ps/$this->limit);
	 die;*/
	 	//lastp is = total ps / items per p, rounded up.
	//die;
	//$this->lastp=2;
	$this->lpm1 = $this->lastp - 1;						//last p minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$this->pagination = "<style>div.pagination {
	padding: 3px;
	margin: 3px;
}

div.pagination a {
	padding: 2px 5px 2px 5px !important;
	margin: 2px;
	border: 1px solid #B7D78C;
	background-color: #D3EEB0;
	text-decoration: none; /* no underline */
	color: #0099FF;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #94B52C;
     background-color: #94B52C;
	 color: #FBFFF0;
	 
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #65A411;
	font-weight: bold;
		background-color: #94B52C;
		color: #FFF;
	}
	div.pagination span.disabled {
		padding: 2px 5px 2px 5px;
		margin: 2px;
		border: 1px solid #CFE2B7;
	    background-color: #F0F8E6;
		color: #DDD;
	}
	</style>";
	if($this->lastp > 1)
	{	
		$this->pagination .= "<div class=\"pagination\">";
		//previous button
		if ($this->p > 1) 
			$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->prev."\">Previous</a>";
		else
			$this->pagination.= "<span class=\"disabled\">Previous</span>";	
		
		//ps	
		if ($this->lastp < 7 + ($this->adjacents * 2))	//not enough ps to bother breaking it up
		{	
			for ($this->counter = 1; $this->counter <= $this->lastp; $this->counter++)
			{
				if ($this->counter == $this->p)
					$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
				else
					$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
			}
		}
		elseif($this->lastp > 5 + ($this->adjacents * 2))	//enough ps to hide some
		{
			//close to beginning; only hide later ps
			if($this->p < 1 + ($this->adjacents * 2))		
			{
				for ($this->counter = 1; $this->counter < 4 + ($this->adjacents * 2); $this->counter++)
				{
					if ($this->counter == $this->p)
						$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
					else
						$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
				}
				$this->pagination.= "...";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lpm1."\">".$this->lpm1."</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lastp."\">".$this->lastp."</a>";		
			}
			//in middle; hide some front and some back
			elseif($this->lastp - ($this->adjacents * 2) > $this->p && $this->p > ($this->adjacents * 2))
			{
				$this->pagination.= "<a href=\"".$this->targetp."&p=1\">1</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=2\">2</a>";
				$this->pagination.= "...";
				for ($this->counter = $this->p - $this->adjacents; $this->counter <= $this->p + $this->adjacents; $this->counter++)
				{
					if ($this->counter == $this->p)
						$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
					else
						$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
				}
				$this->pagination.= "...";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lpm1."\">".$this->lpm1."</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lastp."\">".$this->lastp."</a>";		
			}
			//close to end; only hide early ps
			else
			{
				$this->pagination.= "<a href=\"".$this->targetp."&p=1\">1</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=2\">2</a>";
				$this->pagination.= "...";
				for ($this->counter = $this->lastp - (2 + ($this->adjacents * 2)); $this->counter <= $this->lastp; $this->counter++)
				{
					if ($this->counter == $this->p)
						$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
					else
						$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
				}
			}
		}
		
		//next button
		if ($this->p < $this->counter - 1) 
			$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->next."\">Next</a>";
		else
			$this->pagination.= "<span class=\"disabled\">Next</span>";
		$this->pagination.= "</div>\n";		
	}
        	
	
	$this->page_Data = array('result'=>$this->result,
                       'nav'=>$this->pagination,
					   'records'=>$this->total_ps);
					   
	return 		$this->page_Data ;		   
	

}
function sale_reportnavigation(){

	
    
	if((!isset($this->where))&&($this->where == '')){ $this->whr = '';}
	else { $this->whr = $this->where;}
$str = "SELECT COUNT(*) as num FROM ".$this->tb_name." ".$this->whr."";
	$this->total_ps = mysql_num_rows(mysql_query($str));
	
	 
	//die;
	/* Setup vars for query. */
	$this->targetp = $this->page; 	//your file name  (the name of this file)
	$this->limit = $this->pageLimit; 								//how many items to show per p
	$this->p = @$_GET['p'];
	if($this->p) 
		$this->start = ($this->p - 1) * $this->limit; 			//first item to display on this p
	else
		$this->start = 0;								//if no p var is given, set start to 0
	
	/* Get data. */
	 $this->sql = "SELECT * FROM ".$this->tb_name." ".$this->whr." LIMIT ".$this->start.", ".$this->limit."";
	
	$this->result = mysql_query($this->sql);
	
	/* Setup p vars for display. */
	if ($this->p == 0) $this->p = 1;					//if no p var is given, default to 1.
	$this->prev = $this->p - 1;							//previous p is p - 1
	$this->next = $this->p + 1;	
				//next p is p + 1
	 $this->lastp = ceil($this->total_ps/$this->limit);	
	/* echo ceil($this->total_ps/$this->limit);
	 die;*/
	 	//lastp is = total ps / items per p, rounded up.
	//die;
	//$this->lastp=2;
	$this->lpm1 = $this->lastp - 1;						//last p minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$this->pagination = "<style>div.pagination {
	padding: 3px;
	margin: 3px;
}

div.pagination a {
	padding: 2px 5px 2px 5px !important;
	margin: 2px;
	border: 1px solid #B7D78C;
	background-color: #D3EEB0;
	text-decoration: none; /* no underline */
	color: #0099FF;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #94B52C;
     background-color: #94B52C;
	 color: #FBFFF0;
	 
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #65A411;
	font-weight: bold;
		background-color: #94B52C;
		color: #FFF;
	}
	div.pagination span.disabled {
		padding: 2px 5px 2px 5px;
		margin: 2px;
		border: 1px solid #CFE2B7;
	    background-color: #F0F8E6;
		color: #DDD;
	}
	</style>";
	if($this->lastp > 1)
	{	
		$this->pagination .= "<div class=\"pagination\">";
		//previous button
		if ($this->p > 1) 
			$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->prev."\">Previous</a>";
		else
			$this->pagination.= "<span class=\"disabled\">Previous</span>";	
		
		//ps	
		if ($this->lastp < 7 + ($this->adjacents * 2))	//not enough ps to bother breaking it up
		{	
			for ($this->counter = 1; $this->counter <= $this->lastp; $this->counter++)
			{
				if ($this->counter == $this->p)
					$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
				else
					$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
			}
		}
		elseif($this->lastp > 5 + ($this->adjacents * 2))	//enough ps to hide some
		{
			//close to beginning; only hide later ps
			if($this->p < 1 + ($this->adjacents * 2))		
			{
				for ($this->counter = 1; $this->counter < 4 + ($this->adjacents * 2); $this->counter++)
				{
					if ($this->counter == $this->p)
						$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
					else
						$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
				}
				$this->pagination.= "...";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lpm1."\">".$this->lpm1."</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lastp."\">".$this->lastp."</a>";		
			}
			//in middle; hide some front and some back
			elseif($this->lastp - ($this->adjacents * 2) > $this->p && $this->p > ($this->adjacents * 2))
			{
				$this->pagination.= "<a href=\"".$this->targetp."&p=1\">1</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=2\">2</a>";
				$this->pagination.= "...";
				for ($this->counter = $this->p - $this->adjacents; $this->counter <= $this->p + $this->adjacents; $this->counter++)
				{
					if ($this->counter == $this->p)
						$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
					else
						$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
				}
				$this->pagination.= "...";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lpm1."\">".$this->lpm1."</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lastp."\">".$this->lastp."</a>";		
			}
			//close to end; only hide early ps
			else
			{
				$this->pagination.= "<a href=\"".$this->targetp."&p=1\">1</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=2\">2</a>";
				$this->pagination.= "...";
				for ($this->counter = $this->lastp - (2 + ($this->adjacents * 2)); $this->counter <= $this->lastp; $this->counter++)
				{
					if ($this->counter == $this->p)
						$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
					else
						$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
				}
			}
		}
		
		//next button
		if ($this->p < $this->counter - 1) 
			$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->next."\">Next</a>";
		else
			$this->pagination.= "<span class=\"disabled\">Next</span>";
		$this->pagination.= "</div>\n";		
	}
        	
	
	$this->page_Data = array('result'=>$this->result,
                       'nav'=>$this->pagination,
					   'records'=>$this->total_ps);
					   
	return 		$this->page_Data ;		   
	


}



function pending_reportnavigation(){
 
	if((!isset($this->where))&&($this->where == '')){ $this->whr = '';}
	else { $this->whr = $this->where;}
	 $str = "SELECT COUNT(*) as num FROM ".$this->tb_name." ".$this->whr."";

	$this->total_ps = mysql_num_rows(mysql_query($str));
	
	 
	//die;
	/* Setup vars for query. */
	$this->targetp = $this->page; 	//your file name  (the name of this file)
	$this->limit = $this->pageLimit; 								//how many items to show per p
	$this->p = @$_GET['p'];
	if($this->p) 
		$this->start = ($this->p - 1) * $this->limit; 			//first item to display on this p
	else
		$this->start = 0;								//if no p var is given, set start to 0
	
	/* Get data. */
	 $this->sql = "SELECT * FROM ".$this->tb_name." ".$this->whr." LIMIT ".$this->start.", ".$this->limit."";
	
	$this->result = mysql_query($this->sql);
	
	/* Setup p vars for display. */
	if ($this->p == 0) $this->p = 1;					//if no p var is given, default to 1.
	$this->prev = $this->p - 1;							//previous p is p - 1
	$this->next = $this->p + 1;	
				//next p is p + 1
	 $this->lastp = ceil($this->total_ps/$this->limit);	
	/* echo ceil($this->total_ps/$this->limit);
	 die;*/
	 	//lastp is = total ps / items per p, rounded up.
	//die;
	//$this->lastp=2;
	$this->lpm1 = $this->lastp - 1;						//last p minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$this->pagination = "<style>div.pagination {
	padding: 3px;
	margin: 3px;
}

div.pagination a {
	padding: 2px 5px 2px 5px !important;
	margin: 2px;
	border: 1px solid #B7D78C;
	background-color: #D3EEB0;
	text-decoration: none; /* no underline */
	color: #0099FF;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #94B52C;
     background-color: #94B52C;
	 color: #FBFFF0;
	 
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #65A411;
	font-weight: bold;
		background-color: #94B52C;
		color: #FFF;
	}
	div.pagination span.disabled {
		padding: 2px 5px 2px 5px;
		margin: 2px;
		border: 1px solid #CFE2B7;
	    background-color: #F0F8E6;
		color: #DDD;
	}
	</style>";
	if($this->lastp > 1)
	{	
		$this->pagination .= "<div class=\"pagination\">";
		//previous button
		if ($this->p > 1) 
			$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->prev."\">Previous</a>";
		else
			$this->pagination.= "<span class=\"disabled\">Previous</span>";	
		
		//ps	
		if ($this->lastp < 7 + ($this->adjacents * 2))	//not enough ps to bother breaking it up
		{	
			for ($this->counter = 1; $this->counter <= $this->lastp; $this->counter++)
			{
				if ($this->counter == $this->p)
					$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
				else
					$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
			}
		}
		elseif($this->lastp > 5 + ($this->adjacents * 2))	//enough ps to hide some
		{
			//close to beginning; only hide later ps
			if($this->p < 1 + ($this->adjacents * 2))		
			{
				for ($this->counter = 1; $this->counter < 4 + ($this->adjacents * 2); $this->counter++)
				{
					if ($this->counter == $this->p)
						$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
					else
						$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
				}
				$this->pagination.= "...";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lpm1."\">".$this->lpm1."</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lastp."\">".$this->lastp."</a>";		
			}
			//in middle; hide some front and some back
			elseif($this->lastp - ($this->adjacents * 2) > $this->p && $this->p > ($this->adjacents * 2))
			{
				$this->pagination.= "<a href=\"".$this->targetp."&p=1\">1</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=2\">2</a>";
				$this->pagination.= "...";
				for ($this->counter = $this->p - $this->adjacents; $this->counter <= $this->p + $this->adjacents; $this->counter++)
				{
					if ($this->counter == $this->p)
						$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
					else
						$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
				}
				$this->pagination.= "...";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lpm1."\">".$this->lpm1."</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->lastp."\">".$this->lastp."</a>";		
			}
			//close to end; only hide early ps
			else
			{
				$this->pagination.= "<a href=\"".$this->targetp."&p=1\">1</a>";
				$this->pagination.= "<a href=\"".$this->targetp."&p=2\">2</a>";
				$this->pagination.= "...";
				for ($this->counter = $this->lastp - (2 + ($this->adjacents * 2)); $this->counter <= $this->lastp; $this->counter++)
				{
					if ($this->counter == $this->p)
						$this->pagination.= "<span class=\"current\">".$this->counter."</span>";
					else
						$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->counter."\">".$this->counter."</a>";					
				}
			}
		}
		
		//next button
		if ($this->p < $this->counter - 1) 
			$this->pagination.= "<a href=\"".$this->targetp."&p=".$this->next."\">Next</a>";
		else
			$this->pagination.= "<span class=\"disabled\">Next</span>";
		$this->pagination.= "</div>\n";		
	}
        	
	
	$this->page_Data = array('result'=>$this->result,
                       'nav'=>$this->pagination,
					   'records'=>$this->total_ps);
					   
	return 		$this->page_Data ;		   
	


}
## common function for recent activity

function isActivity($activityType,$activityId){
$activityType = trim($activityType);
$activityId = (int)$activityId;
$this->sql = "SELECT * FROM mgl_recent_activities WHERE activityType = '$activityType' AND activityId = '$activityId'";
	$this->query();
	$Rcdrs = $this->getNumRows();
	if($Rcdrs >=1)
	{
		$this->sql = "DELETE FROM mgl_recent_activities WHERE activityType = '$activityType' AND activityId = '$activityId'";
		if($this->query()){
		return true;	
		}else{ return true;}
	}else{
		return true;
	}
}
	
}
