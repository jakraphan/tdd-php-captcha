<?php

class AccessLogPDO
{
	public function __construct( $pdo )
	{
		$this->pdo = $pdo;
	}

	public function create( $data )
	{
		$columns = implode( ',', array_keys( $data ) );
		$values  = ':' . implode( ',:', array_keys( $data ) );

		$sql = "insert into access_log( $columns ) values( $values );";
		$stm = $this->pdo->prepare( $sql );
		foreach ( array_keys( $data ) as $name ) 
		{
			$stm->bindParam( $name, $data[ $name ] );
		}
		$stm->execute();

		return $this->pdo->lastInsertId();
	}

	public function count(){
		$sql = "select count(*) from access_log";
		$query = $this->pdo->prepare($sql);
		$query->execute();
		$rows  = $query->fetch(PDO::FETCH_NUM);
		return $rows[0];
	}

}

class AccessLogPDOTest extends PHPUnit_Extensions_Database_TestCase
{
	private $pdo;

	public function createTable(PDO $pdo) {
		$query = "
			CREATE TABLE access_log (
		        id INTEGER PRIMARY KEY AUTOINCREMENT,
		        ip varchar(15) NOT NULL,
		        access_time datetime,
		        response_time decimal(7,4),
		        service_url varchar(50) NOT NULL DEFAULT 0
		    );
		";

		$pdo->query( $query );
	}

	public function tranceAutoIncrement(PDO $pdo)
	{
		$query = "delete from sqlite_sequence where name='access_log';";
		$pdo->query( $query );
	}

	public function getConnection()
	{
		try
		{
			$this->pdo = new PDO( 'sqlite:memory' );
			$this->createTable( $this->pdo );
			$this->tranceAutoIncrement( $this->pdo );
			return $this->createDefaultDBConnection($this->pdo, ':memory:' );
		}

		catch( PDOException $d )
		{
		}
	}

	public function testInsert()
	{
		$accessLogPdo = new AccessLogPDO($this->pdo);
		$actualId = $accessLogPdo->create(['ip'=>"192.168.0.1", "access_time"=>"2010-04-26 12:14:20",
      "response_time"=>00.0020, "service_url"=>"/api/v3/captcha"]);
		$this->assertEquals( 3, $actualId );
	}

	public function testCountRow()
	{
		$accessLogPdo = new AccessLogPDO($this->pdo);
		$result = $accessLogPdo->count();
		$this->assertEquals( 2, $result );
	}

	public function getDataSet()
	{
		return new PHPUnit_Extensions_Database_DataSet_YamlDataSet(
			dirname(__FILE__) . "/access_log.yml"
		);
	}
}